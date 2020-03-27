<?php
include("includes/functions.php");
?>
<br>
<h3 align="center" style="margin-left: 40px">Insert New Category</h3><br>
<form  action="" method="post"  style="margin-left:40px;text-align: center">
<label style="font-size: 14px;">Category Name</label>
<input  class='ipt'type="text" name="cat" placeholder=" Category Name" ><br>
<input class='btn' type="submit" name="add" value="Add Category">
</form>
<?php
global $con;
if(isset($_POST['add'])){
$new_cat=strtoupper($_POST['cat']);
$new="insert into categories (cat_title) values  ('$new_cat') ";
$new=mysqli_query($con,$new);
if($new){echo "<script>alert('Success')</script>";
echo "<script>window.open('index.php>view_cat','_self')</script>";
}
}

?>
