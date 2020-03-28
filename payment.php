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
<script type="text/javascript" src='./js/javascript.js'></script>
    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <div class="main_wrapper" >

      
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

        <div class="content_wrapper" style=" width:100%;
  height:auto;
  display: flex;
  margin-top:auto;
  background:#f4f7f6;">
          <div id="sidebar">
            <div id="sidebar_container" >
            <ul class="sidebar_title" > <li>My Account</li> </ul>
            <?php
            global $con;
            $mail=$_SESSION['customer_email'];
            $q="select customer_image from customers where customer_email='$mail' ";
            $q=mysqli_query($con,$q);
            $q=mysqli_fetch_array($q);
            $q=$q['customer_image'];

            echo "<p style='text-align:center '><img src='customer/customer_images/$q' style='border:2px solid white; margin:2px; border-radius:100px'  width='120' height='120' ></p>";


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
<div id="products_box">
 
<div >
  <h2 align="center">Pay Now with PayPal </h2>
  <p style="text-align:center"> <img src="images/paypal-logo.jpg" alt="Pay With Paypal" width="250" height="150"> </p>
</div>

<form action ="" align="center" method="POST">
	<label>Amount</label>
	<input class='ipt' type="text" name="amnt" disabled value="<?php 
    echo $_SESSION['amnt'];
	?>"><br>
	<input class='btn' style="width:100px;height: 50px;" type="submit" name="pay" value="Pay">
</form>
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
    $insert_order= "insert into orders  (customer_email,product_id,qty,price) values ('$customer_email',$pro_id,$pro_qty,$pro_price)";
    $insert_order=mysqli_query($con,$insert_order);
    
    $remove_from_cart="delete from cart where ip_add='$ip' and p_id=$pro_id;";
    $remove_from_cart=mysqli_query($con,$remove_from_cart);
    }
    echo "<script>alert('Order placed Successfully !');window.location.assign('my_account.php?my_orders');</script>";
    $_SESSION['amnt']=0;
    $_SESSION['qty']=0;
}

?>
