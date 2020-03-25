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
    <div class="main_wrapper">

       

        <div class="menubar">
          <a href="index.php" ><img style="float:left;padding-left: 90px;padding-top: 5px" src="images/logo.png" height="40" width="40"></a>
          <ul id="menu">
            <li><a href="index.php">All Products</a></li>
            <li><a href="cart.php">My Cart</a></li>
            <li><a href="#">Contact Us</a></li>
          <li >
          <div id="form">
            <form method="get"  action="results.php" enctype="multipart/form-data">
              <input class ="ipt" type="text" name="user_query" placeholder="Search Products"/>
              <input id="sbt_btn" type="submit" name="search" value="Search" />
            </form>
          </div>
</li>
          <li >
          <?php 
          global $con;
              if(!isset($_SESSION['customer_email'])) {
                echo "<span style='padding:0px 2px 0px 35px'>Welcome Guest</span><img src='images/user.jpeg' style='padding:0px 2px 0px 5px;vertical-align: middle' width='30' height='30'>";
              }

              else {
                $mail=$_SESSION['customer_email'];
                 $q="select customer_image from customers where customer_email='$mail' ";
                  $q=mysqli_query($con,$q);
                 $q=mysqli_fetch_array($q);
                 $q=$q['customer_image'];
                 $name=$_SESSION['customer_name'];

            echo "<span style='padding:0px 2px 0px 35px'>Welcome $name</span> <img src='customer/customer_images/$q' style='border-radius:20px;vertical-align: middle'  width='30' height='30' >";

      
            }
              ?>  
              <?php
              if(!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php' style='text-decoration:none; color:white;'>Login</a>";
              }
              else {
                echo "<a href='logout.php' style='text-decoration:none; color:white;'>Logout</a>";
              }?></li>
              </ul>
        </div>
        

        <div id="content_wrapper">
          <div id="sidebar">
            <div id="sidebar_container">
            <ul class="sidebar_title" > <li>Categories <li></ul>
              <ul class="sidebar_links">
                <?php getCats(); ?>
              </ul>
            </div>
            <div id="sidebar_container">
            <span class="sidebar_title"> Brands </span>
              <ul class="sidebar_links">
                <?php getBrands(); ?>
              </ul>
            </div>
          </div>

          <div id="content_area" style="background:#f4f7f6">
            <div id="products_box" style="width:70%;background: #deeeef ;min-height: 500px;float:left">
              <h3>Shopping Cart</h3><hr>
                  <?php
                  global $con;
                  $ip=getIp();
                  $get_cart_item="select * from cart where ip_add='$ip' ";
                  $get_cart_item=mysqli_query($con,$get_cart_item);
                  while($row_cart=mysqli_fetch_array($get_cart_item)){
                    $pro_qty=$row_cart['qty'];
                    $pro_id=$row_cart['p_id'];
                    $get_pro="select * from products where product_id=$pro_id";
                    $get_pro=mysqli_query($con,$get_pro);
                    $get_pro=mysqli_fetch_array($get_pro);
                    $pro_price=$get_pro['product_price'];
                    $pro_image=$get_pro['product_image'];
                    $pro_title=$get_pro['product_title'];
                    $len=strlen($pro_title);
                    if($len>40)
                    $pro_title = substr($pro_title,0,40).'...';
                    $single_price=$pro_price*$pro_qty;
                    echo "<a href='details.php?pro_id=$pro_id'>
                           <div class='single_product' style='width:150px'>
                            <img src='admin_area/product_images/$pro_image'>
                            <div class='single_product_container'>
                            <div class='single_product_title'>$pro_title </div><br></a>
                            <p class='single_product_price'>₹$pro_price
                             <a href='cart.php?add_cart=$pro_id' style='float:right'><button>+</button></a>
                             <input style='width:20px;height:20px;float:right' value=$pro_qty>
                             <a href='cart.php?remove_cart=$pro_id' style='float:right'><button>-</button></a>
                           </p>
                            </div>
                          </div></a>
                   ";
                    }
          
                    if(isset($_GET['add_cart'])){
                       $p_id = $_GET['add_cart'];
                       add_cart($p_id);
                     }
                     if(isset($_GET['remove_cart'])){
                       $p_id = $_GET['remove_cart'];
                       remove_cart($p_id);
                     }
                  ?>
            </div>
            <div id="cart_bill">
             <h3>Bill</h3><hr>
             <table style="margin-left: 4px">
              <tr style='border-bottom: 1px solid #ccc;'><th width="40%" align="left">Name</th><th width="15%" align="left" >Quantity</th><th width="15%" align="left" >Subtotal</th></tr>
              <?php 
                 global $con;
                  $get_cart_item="select * from cart where ip_add='$ip' ";
                  $get_cart_item=mysqli_query($con,$get_cart_item);
                  $tot=0;
                  $tot_qty=0;
                  while($row_cart=mysqli_fetch_array($get_cart_item)){
                    $pro_qty=$row_cart['qty'];
                    $pro_id=$row_cart['p_id'];
                    $get_pro="select * from products where product_id=$pro_id";
                    $get_pro=mysqli_query($con,$get_pro);
                    $get_pro=mysqli_fetch_array($get_pro);
                    $pro_price=$get_pro['product_price'];
                    $pro_title=$get_pro['product_title'];
                    $len=strlen($pro_title);
                    if($len>40)
                    $pro_title = substr($pro_title,0,40).'...';
                    $sub_tot=$pro_qty*$pro_price;
                    $tot=$tot+$sub_tot;
                    $tot_qty=$tot_qty+$pro_qty;
                    echo "
                    <tr style='border-bottom: 1px solid #ccc;'><td width='40%' align='left'>$pro_title</td><td width='15%' align=
                    'left' >$pro_qty</td><td width='15%' align='left' >₹ $sub_tot</td></tr>
                    ";
                  }
                  echo "<tr><th align=
                    'left' >Total</th><th align='left'>$tot_qty</th><th align=
                    'left'>₹ $tot</th></tr>";
              ?>

            </table>
          
            </div>
          </div>
        </div>
        <div id="footer">
          <h3 style="text-align:center;padding:3px">&copy; 2020 by Rahul </h3>
        </div>
    </div>
  </body>
</html>
