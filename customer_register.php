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

            <form  action="customer_register.php"  method="post" enctype="multipart/form-data">
              <table align="center" width="750">
                <tr>
                  <th align="center" colspan="2">Create an Account</th>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Name">Name</td>
                  <td> <input type="text" name="c_name" required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Email">Email</td>
                  <td> <input type="text" name="c_email"  required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Password">Password</td>
                  <td> <input type="password" name="c_password" required > </td>
                </tr>
                <tr>
                  <td align="right">Upload Image</td>
                  <td> <input type="file" name="c_image" > </td>
                </tr>
                <tr>
                  <td align="right">Country</td>
                  <td> <input type="text" name="c_country"  placeholder="Enter Your Country" required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your City">City</td>
                  <td> <input type="text" name="c_city"  required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Contact">Contact No.</td>
                  <td> <input type="text" name="c_contact" required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Address">Contact No.</td>
                  <td> <textarea name="c_addr" rows="10" cols="30" ></textarea> </td>
                </tr>
                <tr>
                  <td align="center" colspan="2"> <input type="submit" name="Register"> </td>
                </tr>
              </table>
            </form>

            <?php
            global $con;
            global $total_cost;
            global $total_item;
            if(isset($_POST['Register'])){
              $c_name=$_POST['c_name'];
              $c_email=$_POST['c_email'];
              $c_password=$_POST['c_password'];
              $c_image=$_FILES['c_image']['name'];
              $c_image_tmp=$_FILES['c_image']['tmp_name'];
              $c_country=$_POST['c_country'];
              $c_city=$_POST['c_city'];
              $c_addr=$_POST['c_addr'];
              $c_contact=$_POST['c_contact'];
              $ip=getIp();

              move_uploaded_file($_FILES['c_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/ecommerce/customer/customer_images/'. $_FILES['c_image']['name']);
              $add_customer="insert into customers (customer_ip,customer_name,customer_email,customer_password,customer_country,customer_city,customer_contact,customer_addr,customer_image) values ('$ip','$c_name','$c_email','$c_password','$c_country','$c_city','$c_contact','$c_addr','$c_image')";
              $add_customer=mysqli_query($con,$add_customer);
              if($add_customer){
                echo "<script>alert('Registered Succesfully !')</script>";
                $_SESSION['customer_email']=$c_email;
                if($total_cost>0){
               echo "<script>window.open('checkout.php','_self')</script>";}
               else {

                 echo "<script>window.open('my_account.php','_self')</script>";}
               }
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
