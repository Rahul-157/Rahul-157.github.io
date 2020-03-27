<?php
include("includes/functions.php");
?><br>
<h3 align="center" style="margin-left: 40px">Insert New Brand</h3><br>
<form  action="" method="post"  style="margin-left:40px;text-align: center">
<label>Brand Name</label>
<input  class='ipt' type="text" name="brand" placeholder=" Brand Name" ><br>
<input class='btn' type="submit" name="add" value="Add Brand">
</form>
<?php
global $con;
if(isset($_POST['add'])){
$new_brand=strtoupper($_POST['brand']);
$new="insert into brands (brand_title) values  ('$new_brand') ";
$new=mysqli_query($con,$new);
if($new){echo "<script>alert('Success')</script>";
echo "<script>window.location.assign('index.php?view_brand')</script>";
}
}

?>
