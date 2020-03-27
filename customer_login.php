<?php

include("functions/functions.php");
 ?>
<div >
  <form   method="post">
    <table width = "500"  align="center"  cellpadding="10">
      <tr align="center"  >
        <th colspan="2" >Login to Checkout !</th>
      </tr>
      <tr >
      <td align="left">Email</td>
      <td>  <input class="ipt" type="email" name="email" size="30"/> </td>
      </tr>
      <tr >
        <td align="left">Password</td>
        <td> <input class="ipt" type="password" name="pass" size="30"/> </td>
      </tr>
      <tr >
        <td align="left" > <a href="customer_register.php" style="text-decoration:none; color:#17a5b2" ><b> Register </b></a> </td>
        <td align="right"> <a href="checkout.php?forgot_pass" style="text-decoration:none ; color:#17a5b2"><b>Forgot Password</b></a> </td>
      </tr>
      <tr align ="center" >
        <td colspan="2"> <input class="btn" style="height: 30px;width: 90px" type="submit" name="login" value="Login" /> </td>
      </tr>
    </table>
  </form>
</div>
<?php

global $con;

if(isset($_POST['login']))
{
  $mail=$_POST['email'];
  $pass=$_POST['pass'];
  $sel_c="select * from customers where customer_password='$pass' and customer_email='$mail' ";
  $sel_c=mysqli_query($con,$sel_c);
  $check_c=mysqli_num_rows($sel_c);
  if($check_c==1)
  {
    $cust=mysqli_fetch_array($sel_c);
    $_SESSION['customer_email']=$mail;
    $_SESSION['customer_name']=$cust['customer_name'];
    $t=$_SESSION['checkout'];

    if($t==1){

    echo "<script>window.open('checkout.php','_self')</script>";
  }
    else {
      // code...
      echo "<script>window.open('index.php','_self')</script>";

    }
  }
  else {
    // code...
    echo "<script>window.alert('Invalid Email or Password !')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
  }

}
 ?>
