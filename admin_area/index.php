<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Admin Panel</title>
    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <?php session_start();
    if(!isset($_SESSION['admin_mail']))
  {
    echo "<script>window.open('admin_login.php','_self')</script>";}
     ?>
<div class="main-wrapper">
  <div id="header">
  </div>


              <div id="left">
          <?php
          global $con;
            $mail=$_SESSION['admin_mail'];
          if(empty($_GET))
        {  echo "<h3 style='padding-left:250px;padding-top:50px'>Welcome $mail </h3>"; }
           include("includes/functions.php");
          if(isset($_GET['insert_product'])){
            include('insert_product.php');}
            if(isset($_GET['view_product'])){
              include('view_products.php');}
            if(isset($_GET['edit_pro'])){
              include('edit_product.php');}
            if(isset($_GET['new_cat'])){
                include('new_cat.php');}
            if(isset($_GET['new_brand'])){
                include('new_brand.php');}
            if(isset($_GET['view_cat'])){
                  include('view_cat.php');}
            if(isset($_GET['view_customers'])){
                  include('view_customers.php');}
            if(isset($_GET['view_brand'])){
                  include('view_brand.php');}
            if(isset($_GET['del_cat'])){
              $cat_id=$_GET['del_cat'];
              $rem_cat="delete from categories where cat_id='$cat_id' ";
              $rem_cat=mysqli_query($con,$rem_cat);
              if($rem_cat)
              {
                echo "<script>alert('Success')</script>";
                echo "<script>window.open('index.php','_self')</script>";
              }
              }
              if(isset($_GET['del_customer'])){
                $cat_id=$_GET['del_customer'];
                $rem_cat="delete from customers where customer_id=$cat_id ";
                $rem_cat=mysqli_query($con,$rem_cat);
                if($rem_cat)
                {
                  echo "<script>alert('Success')</script>";
                  echo "<script>window.open('index.php','_self')</script>";
                }
                }
            if(isset($_GET['edit_cat'])){
                  include('edit_cat.php');}
            if(isset($_GET['logout'])){
                  session_destroy();
                echo "<script>window.open('index.php','_self')</script>";
                }
            if(isset($_GET['edit_brand'])){
                  include('edit_brand.php');}
           if(isset($_GET['delete_pro'])){
             $d_id=$_GET['delete_pro'];
             echo $d_id;
             $run="delete  from products where product_id=$d_id ";
             $run=mysqli_query($con,$run);
             if($run)
             {
               echo "<script>alert('Deleted Succesfully !')</script>";
                echo "<script>window.open('index.php?view_product','_self')</script>";
             }
           }

            ?>

              </div>
              <div id="right">
                <ul  class="sidebar_links">
                  <li><a href='index.php?insert_product'>Insert New Product</a></li>
                  <li><a href='index.php?view_product'>View All Products</a></li>
                  <li><a href='index.php?new_cat'>Insert New Category</a></li>
                  <li><a href='index.php?view_cat'>View All Category</a></li>
                  <li><a href='index.php?new_brand'>Insert New Brand</a></li>
                  <li><a href='index.php?view_brand'>View All Brands</a></li>
                  <li><a href='index.php?view_customers'>View Customers</a></li>
                  <li><a href='#'>View Orders</a></li>
                  <li><a href='#'>View Payments</a></li>
                  <li><a href='index.php?logout'>Admin Logout</a></li>
                </ul>
              </div>

</div>
  </body>
</html>
