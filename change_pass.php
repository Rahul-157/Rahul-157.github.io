<?php

include("./functions/functions.php");
?>
<form  action="" method="post" enctype="multipart/form-data">
 <h3><b>Update Your Password</b></h3><br>
    <label>Current Password</label>
<input class='ipt' type="password" name="c_pass" required> <br>
   <label>New Password</label>
      <input class='ipt' type="password" name="n_pass" required><br>
      <label>Confirm Password</label>
    <input class='ipt' type="password" name="nn_pass" required> <br>
      <input class='btn' type="submit"  value="Update" name="Update">
   
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
