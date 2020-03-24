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
    <div class="main_wrapper">

       

        <div class="menubar">
          <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">All Products</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><a href="customer_register.php">Sign Up</a></li>
            <li><a href="#">My Cart</a></li>
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
            <div id="shopping_cart">
              <span style ="float:right; margin:auto ; font-size:18px padding:5px;line-height:50px;">Welcome Guest ! <b style="color:yellow">Shopping Cart - </b>Total Items:<?php total_itemf();?>  Total Price:<?php total_costf();?> <a href="cart.php" style="color:yellow">Go to  Cart</a>
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
              <?php getPro_search(); ?>
            </div>
          </div>
        </div>
        <div id="footer">
          <h2 style="text-align:center;padding:10px">&copy; 2019 by Rahul </h2>
        </div>
    </div>
  </body>
</html>
