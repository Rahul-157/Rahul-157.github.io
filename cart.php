<!DOCTYPE >
<?php

session_start();

include("./functions/functions.php");
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online Shop</title>

    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <div class="main_wrapper">

      

        <div class="menubar">
          <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">All Products</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><a href="customer_register.php">Sign Up</a></li>
            <li><a href="cart.php">My Cart</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
          <div id="form">
            <form method="get"  action="results.php" enctype="multipart/form-data">
              <input type="text" name="user_query" placeholder="Search Products"/>
              <input type="submit" name="search" value="Search" />
            </form>
          </div>
        </div>

        <div class="content_wrapper">
          <div id="sidebar">
            <div id="sidebar_container">
            <span class="sidebar_title"> Categories </span>
              <ul class="sidebar_links">
                <!-- <li><a href="#">Laptops</a></li>
                <li><a href="#">Mobiles</astylesheet></li>
                <li><a href="#">Computers</a></li>
                <li><a href="#">Cameras</a></li>
                <li><a href="#">iPads</a></li>
                <li><a href="#">Tablets</a></li> -->
                <?php getCats(); ?>
              </ul>
            </div>
            <div id="sidebar_container">
            <span class="sidebar_title"> Brands </span>
              <ul class="sidebar_links">
                <!-- <li><a href="#">HP</a></li>
                <li><a href="#">DELL</a></li>
                <li><a href="#">Motorola</a></li>
                <li><a href="#">Sony</a></li>
                <li><a href="#">LG</a></li>
                <li><a href="#">Apple</a></li> -->
                <?php getBrands(); ?>
              </ul>
            </div>
          </div>
          <div id="content_area">
            <?php cart(); ?>
            <div id="shopping_cart">
              <span style ="float:right; margin:auto ; font-size:18px padding:5px;line-height:50px;">Welcome Guest ! <b style="color:yellow">Shopping Cart - </b>Total Items:<?php total_itemf();?>  Total Price: <?php total_costf();?> <a href="cart.php" style="color:yellow">Go to  Cart</a>
                <?php cart(); ?>
                <?php
                  if(!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php style='text-decoration:none; color:white;'>Login</a>";
                  }
                  else {
                    echo "<a href='logout.php' style='text-decoration:none; color:white;'>Logout</a>";
                  }
                  ?></span>
            </div>

            <div id="products_box">
              <form   action="" method="post" enctype="multipart/form-data">
                <table align="center" width="700" bgcolor="skyblue" border="2">
                  <tr align="center">
                    <th>Remove</th>
                    <th>Product(s)</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                  </tr>
                  <?php
                  global $con;
                  global $total_cost;
                  global $total_item;

                  $ip=getIp();
                  $get_cart_item="select * from cart where ip_add='$ip' ";
                  $get_cart_item=mysqli_query($con,$get_cart_item);
                  while($row_cart=mysqli_fetch_array($get_cart_item)){
                    $pro_qty=$row_cart['qty'];
                    //$total_item=$total_item+$pro_qty;
                    $pro_id=$row_cart['p_id'];
                    $get_pro="select * from products where product_id=$pro_id";
                    $get_pro=mysqli_query($con,$get_pro);
                    $get_pro=mysqli_fetch_array($get_pro);
                    $pro_price=$get_pro['product_price'];
                    $pro_image=$get_pro['product_image'];
                    $pro_title=$get_pro['product_title'];
                    $single_price=$pro_price*$pro_qty;
                    //$total_cost=$total_cost+$single_price;
                    echo "
                   <tr align='center'>
                   <td><input type='checkbox' name='remove[]' value=$pro_id /></td>
                   <td> $pro_title<br><img src='admin_area/product_images/$pro_image' width='60' height='60' border='2' /></td>
                   <td><input type='text' size='4' name='qty[]' value=$pro_qty ></td>
                   <td> $single_price </td>
                   </tr>";

                    }
                   ?>

                   <?php
                   global $con;
                   $flag=1;
                   if(isset($_POST['update_cart'])){
                     foreach($_POST['qty'] as $key => $value)
                      {
                        if($value<0){
                        $value=0;}
                        $get_p_id="select p_id from cart  LIMIT $key,1";
                        $get_p_id=mysqli_query($con,$get_p_id);
                        $get_p_id=mysqli_fetch_array($get_p_id);
                        $get_p_id=$get_p_id['p_id'];

                        $update_qty="update cart set qty=$value  where p_id=$get_p_id ";
                        $update_qty=mysqli_query($con,$update_qty);
                        if(!$update_qty){
                          $flag=0;
                      }
                    }
                      if($flag==1){
                        echo "<script>window.open('cart.php','self')</script>";
                      }
                    }
                    ?>
                   <tr align='center'>
                   <th colspan='2'>Total Items : <?php  global $total_cost;
                     global $total_item; echo $total_item; ?></th>
                   <th colspan='2'>Total Cost : <?php   global $total_cost;
                     global $total_item; echo $total_cost; ?></th>
                 </tr>
                </table>
                <br>
              <table align="center" >
                <tr align="center">
                  <td bordercolor="skyblue"> <input type="submit" name="update_cart" value="Update Cart"> </td>
                  <td bordercolor="skyblue"> <input type="submit" name="continue" value="Continue Shopping"></td>
                  <td bordercolor="skyblue">  <a href="checkout.php"> <button type="button" >Checkout</button> </a> </td>
                </tr>
              </table>
            </form>

              <?php
              global $con;

              $ip=getIp();
              $rem_pro="";

              if(isset($_POST['update_cart'])){
                foreach ($_POST['remove'] as $remove_id) {
                  echo $remove_id;
                  $rem_pro="delete from cart where ip_add='$ip' and p_id=$remove_id ";
                  $rem_pro=mysqli_query($con,$rem_pro);
                }
                if($rem_pro){
                  echo "<script>window.open('cart.php','self')</script>";
                }
              }
                if(isset($_POST['continue'])){
                  echo "<script>window.open('index.php','self')</script>";
                }


               ?>

            </div>
          </div>
        </div>
        <div id="footer">
          <h2 style="text-align:center;padding:10px">&copy; 2019 by Rahul </h2>
        </div>
    </div>
  </body>
</html>
