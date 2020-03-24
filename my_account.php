<!DOCTYPE html>
<?php
session_start();
include("./functions/functions.php");
if(!isset($_SESSION['customer_email'])){
  echo "<script>window.open('checkout.php','_self')</script>";

}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online Shop</title>

    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <div class="main_wrapper" style="background:pink">

      

        <div class="menubar">
          <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">All Products</a></li>
            <li><a href="my_account">My Account</a></li>
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
            <div id="sidebar_container"  >
            <span class="sidebar_title" style="padding-top:15px;padding-bottom:15px"> My Account </span>
            <?php
            global $con;
            $mail=$_SESSION['customer_email'];
            $q="select customer_image from customers where customer_email='$mail' ";
            $q=mysqli_query($con,$q);
            $q=mysqli_fetch_array($q);
            $q=$q['customer_image'];

            echo "<p style='text-align:center '><img src='customer/customer_images/$q' style='border:2px solid white; padding:2px ; margin:2px; '  width='150' height='150' ></p>";


             ?>
              <ul class="sidebar_links">
                <li><a href="my_account.php?my_orders">My Orders</a></li>
                <li><a href="my_account.php?edit_account">Edit Account</a></li>
                <li><a href="my_account.php?change_pass">Change Password</a></li>
                <li><a href="my_account.php?delete_account">Delete Account</a></li>
              </ul>
            </div>

          </div>

          <div id="content_area" >

            <div id="shopping_cart">
              <span style ="float:right; margin:auto ; font-size:18px padding:5px;line-height:50px;"> <b style="color:yellow">Shopping Cart - </b>Total Items:<?php total_itemf();?>  Total Price: <?php total_costf();?> <a href="cart.php" style="color:cyan">Go to  Cart</a>
              <?php
              if(!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php' style='text-decoration:none; color:white;'>Login</a>";
              }
              else {
                echo "<a href='logout.php' style='text-decoration:none; color:white;'>Logout</a>";
              }
              ?></span>
            </div>

            <?php
            if(isset($_GET['edit_account']))
            {
              include('update_account.php');
            }
            if(isset($_GET['change_pass']))
            {
              include('change_pass.php');
            }
            if(isset($_GET['delete_account']))
            {
              $mail=$_SESSION['customer_email'];
              echo $mail;
              $rem_user="delete  from customers where customer_email='$mail' ;";
              $rem_user=mysqli_query($con,$rem_user);
              if($rem_user){
              session_destroy();
              echo "<script>window.open('index.php','_self')</script>";}
             
            }
             ?>
          </div>
        </div>
        <div id="footer">
          <h2 style="text-align:center;padding:10px">&copy; 2019 by Rahul </h2>
        </div>
    </div>
  </body>
</html>
