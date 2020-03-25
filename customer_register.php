<!DOCTYPE html>
<?php
session_start();
include("./functions/functions.php");
?>
<html lang="en" dir="ltr">
  <head>
    <script type="text/javascript">
  function getFile(){
     document.getElementById("upfile").click();
}</script>
    <meta charset="utf-8">
    <title>My Online Shop</title>

    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <?php cart();?>
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

<br>
            <form  action="customer_register.php"  method="post" enctype="multipart/form-data">
             <h3>Create an Account</h3><br>
               <label>Name</label>
              <input class='ipt' type="text" name="c_name" required><br>
               <label>Email</label>
                   <input class='ipt' type="text" name="c_email"  required> <br>
                   <label>Password</label>
                  <input class='ipt' type="password" name="c_password" required > <br>
                  <label>Country</label>
                   <input class='ipt' type="text" name="c_country"   required><br>
               <label>City</label>
                  <input class='ipt' type="text" name="c_city"  required><br>
                  <label>Contact No</label>
                  <input class='ipt' type="text" name="c_contact"  required><br>
                  <label>Address</label>
                   <textarea class='ipt' name="c_addr" rows="20"  cols="30" ></textarea> <br>
                   <label id="img_upload" onclick="getFile();">Upload Image</label>
                  <div  style='height: 0px;width:0px; overflow:hidden;'> <input class='ipt' type="file" hidden="true" name="c_image" id="upfile" ></div><br>
                  <input class='btn' type="submit" name="Register" value="Register"> 
            </form>
</div>
</div>
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
          <h2 style="text-align:center;padding:10px">&copy; 2020 by Rahul </h2>
        </div>
    </div>
  </body>
</html>
