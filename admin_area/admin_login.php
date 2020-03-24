<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/admin.css">
    <title></title>
  </head>
  <body>
    <h2>Please Login to Proceed </h2>
    <div class="login">
      <form  method="post">


    <input type="text" name="email" placeholder="Username" id="username">
  <input type="password" name="pass" placeholder="password" id="password">
  <a href="#" class="forgot">Forgot password?</a>
  <input type="submit" name="login" value="Sign In">
    </form>
</div>
<div class="shadow"></div>
<?php
session_start();
global $con;
include("includes/functions.php");
if(isset($_POST['login'])){
  $mail=$_POST['email'];
  $pass=$_POST['pass'];
  $run_q=" select * from admins where admin_email='$mail' ";
  $run_q=mysqli_query($con,$run_q);
  $run_q=mysqli_fetch_array($run_q);
  $o_pass=$run_q['admin_pass'];
  if($pass==$o_pass)
  {
    $_SESSION['admin_mail']=$mail;
    echo "<script>window.open('index.php','_self')</script>";
  }
}
 ?>
  </body>
</html>
