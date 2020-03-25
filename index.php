<!DOCTYPE html>
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
    <?php 
    if(isset($_GET['add_cart'])){
        add_cart($_GET['add_cart']);
    }
    ?>
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

            echo "<span style='padding:0px 2px 0px 35px'>Welcome $name</span><a href='my_account.php'><img src='customer/customer_images/$q' style='border-radius:20px;vertical-align: middle'  width='30' height='30' ></a>";

      
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
          

          <div id="content_area">
            <div id="products_box">
              <?php getPro();  ?>
            </div>
          </div>
      </div>
      </div>
        <div id="footer">
          <h3 style="text-align:center;padding:3px">&copy; 2020 by Rahul </h3>
        </div>
    
  </body>
</html>
