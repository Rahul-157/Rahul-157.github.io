<?php

include("./functions/functions.php");
?>
<form  action="" method="post" enctype="multipart/form-data">
  <table align="center" width="750">
    <tr>
      <th align="center" colspan="2">Update Your Password</th>
    </tr>
    <tr>
      <td align="right" >Enter Your Current Password</td>
      <td> <input type="password" name="c_pass" required> </td>
    </tr>
    <tr>
      <td align="right" >Enter New Password</td>
      <td> <input type="password" name="n_pass" required> </td>
    </tr>
    <tr>
      <td align="right" >Confirm New Password</td>
      <td> <input type="password" name="nn_pass" required> </td>
    </tr>
    <tr>
      <td align="center" colspan="2"> <input type="submit" name="Update"> </td>
    </tr>
  </table>
</form>
<?php

            if(isset($_POST['Update'])){
if($_POST['n_pass']==$_POST['nn_pass'])
{
  $mail=$_SESSION['customer_email'];
  $get_pass="select * from customers where customer_email='$mail' ";
  $get_pass=mysqli_query($con,$get_pass);
  $get_pass=mysqli_fetch_array($get_pass);
  $c_pass=$get_pass['customer_password'];
  if($c_pass==$_POST['c_pass'])
  {
    $new=$_POST['n_pass'];

    $u_pass="update customers set customer_password='$new' where customer_email='$mail' ";
    $u_pass=mysqli_query($con,$u_pass);
    if($u_pass)
    {
      echo "<script>alert('Password Updated Succesfully !')</script>";
       echo "<script>window.open('my_account.php','_self')</script>";
     }
    }
  else {
    // code...
    echo "<script>alert('Incorrect Password ! ')</script>";
     echo "<script>window.open('my_account.php?change_pass','_self')</script>";
  }
  }
  else {
    // code...
    echo "<script>alert(' Passwords don't match ! ')</script>";
     echo "<script>window.open('my_account.php?change_pass','_self')</script>";
  }
}

 ?>
