<br>
<h3 align="center" style="margin-left: 40px">Update Category</h3><br>
<form  action="" method="post"  style="margin-left:40px;text-align: center">
<label style="font-size: 12px">Update Category</label>
<input  class='ipt' type="text" name="up_cat" placeholder=" Category Name" ><br>
<input class='btn' type="submit" name="done" value="Update">
</form>
<?php
include("includes/functions.php");
global $con;
if(isset($_POST['done'])){
$cat_id=$_GET['edit_cat'];
$cat_title=strtoupper($_POST['up_cat']);
$up_cat="update  categories  set  cat_title='$cat_title' where cat_id='$cat_id' ";
$up_cat=mysqli_query($con,$up_cat);
if($up_cat)
{
  echo "<script>alert('Success')</script>";
  echo "<script>window.open('index.php?view_cat','_self')</script>";
}
}
 ?>
