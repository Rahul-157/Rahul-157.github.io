<br>
<h3 align="center" style="margin-left: 40px">Update Brand</h3><br>
<form  action="" method="post"  style="margin-left:40px;text-align: center">
<label>Update Brand</label>
<input  class='ipt' type="text" name="up_brand" placeholder=" Brand Name" ><br>
<input class='btn' type="submit" name="done" value="Update">
</form>
<?php
include("includes/functions.php");
global $con;
if(isset($_POST['done'])){
$brand_id=$_GET['edit_brand'];
$brand_title=strtoupper($_POST['up_brand']);
$up_brand="update  brands set  brand_title='$brand_title' where brand_id='$brand_id' ";
$up_brand=mysqli_query($con,$up_brand);
if($up_brand)
{
  echo "<script>alert('Success')</script>";
  echo "<script>window.open('index.php?view_brand','_self')</script>";
}
}
 ?>
