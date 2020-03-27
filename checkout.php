
<!DOCTYPE html>
<?php
session_start();
include("functions/functions.php");
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online Shop</title>
<script type="text/javascript" src='./js/javascript.js'></script>
    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
   
    <div class="main_wrapper">

       

       <div class="menubar">
          <a href="index.php" ><img style="float:left;padding-left: 90px;padding-top: 5px" src="images/logo.png" height="40" width="40"></a>
          <ul id="menu">
            <li onmouseover="chng(this)" onmouseout="unchng(this)"><a href="index.php">All Products</a></li>
            <li onmouseover="chng(this)" onmouseout="unchng(this)"><a href="cart.php">My Cart</a></li>
            <li onmouseover="chng(this)" onmouseout="unchng(this)"><a href="#">Contact Us</a></li>
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
 if($q=="")
                  echo "<span style='padding:0px 2px 0px 35px'>Welcome $name</span><a href='my_account.php'><img src='images/user.jpeg' style='border-radius:20px;vertical-align: middle'  width='30' height='30' ></a>";
                else
            echo "<span style='padding:0px 2px 0px 35px'  >Welcome $name</span><a href='my_account.php'><img src='customer/customer_images/$q' style='border-radius:20px;vertical-align: middle'  width='30' height='30' ></a>";
      
            }
              ?>  
              <?php
              if(!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php?login' style='text-decoration:none;  onmouseover='chng(this)' onmouseout='unchng(this)' color:white;'>Login</a>";
              }
              else {
                echo "<a href='logout.php' style='text-decoration:none; color:white;'  >Logout</a>";
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

          <div id="content_area">
            <div id="products_box">
              <?php
                  if(isset($_GET['forgot_pass'])){
                    include("forgot_pass.php");
                  }
              else if(!isset($_SESSION['customer_email'])){
               
                include("customer_login.php");
                if(!isset($_GET['login']))
                $_SESSION['checkout']=1;

              }
              else if (isset($_GET['checkout'])){
                include("payment.php");
              }

              else
              {
                echo "<script>window.location.assign('my_account.php')</script>";
              }
               ?>
              
</div>
</div>
          </div>
        </div>
       <div id="footer">
          <h3 style="text-align:center;padding:3px">&copy; 2020 by Rahul </h3>
        </div>
    </div>
  </body>
</html>
<?php 
if(isset($_POST['pay']))
{
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
    $customer_email=$_SESSION['customer_email'];
    $insert_order= "insert into orders  (customer_email,product_id,qty) values ('$customer_email',$pro_id,$pro_qty)";
   
    $insert_order=mysqli_query($con,$insert_order);
    $remove_from_cart="delete from cart where ip_add='$ip' and p_id=$pro_id;";
    $remove_from_cart=mysqli_query($con,$remove_from_cart);

    }
    echo "<script>alert('Order placed Successfully !');window.location.assign('my_account.php?my_orders');</script>";
}

?>
