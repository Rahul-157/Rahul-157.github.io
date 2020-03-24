<?php

include("functions/functions.php");
 ?>
<div >
  <form   method="post">
    <table width = "500" bgcolor="skyblue" align="center"  cellpadding="10">
      <tr align="center"  >
        <th colspan="2" >Login to Checkout !</th>
      </tr>
      <tr >
      <td align="right">Email</td>
      <td>  <input type="text" name="email" size="30"/> </td>
      </tr>
      <tr >
        <td align="right">Password</td>
        <td> <input type="password" name="pass" size="30"/> </td>
      </tr>
      <tr >
        <td align="left" colspan="2"> <a href="customer_register.php" style="text-decoration:none; color:black" ><b> Register </b></a> </td>
        <td colspan="2" align="right"> <a href="checkout.php?forgot_pass" style="text-decoration:none ; color:black"><b>Forgot Password</b></a> </td>
      </tr>
      <tr align ="center" >
        <td colspan="2"> <input type="submit" name="login" value="Login" /> </td>
      </tr>
    </table>
  </form>
</div>
<?php

global $con;
global $total_cost;
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
    $t=$_SESSION['cost'];

    if($t>0){

    echo "<script>window.open('checkout.php','_self')</script>";
  }
    else {
      // code...
      echo "<script>window.open('my_account.php','_self')</script>";

    }
  }
  else {
    // code...
    echo "<script>window.alert('Invalid Email or Password !')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
  }

}
 ?>
