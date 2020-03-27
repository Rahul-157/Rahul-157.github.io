<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/admin.css">
    <title></title>
  </head>
  <body>
   
    <div class="login">
      <form  method="post">
    <input type="email" name="email" placeholder="Email"  >
  <input type="password" name="pass" placeholder="Password" id="password">
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
  
  if(mysqli_num_rows($run_q)>0){
  $run_q=mysqli_fetch_array($run_q);
  $o_pass=$run_q['admin_pass'];
  if($pass==$o_pass)
  {
    $_SESSION['admin_mail']=$mail;
    echo "<script>window.location.assign('index.php')</script>";
  }  
  else{
    echo "<script>alert('Invalid Credentials')</script>";
  }
  }
  
}
 ?>
  </body>
</html>
