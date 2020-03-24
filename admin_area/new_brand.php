<?php
include("includes/functions.php");
?>
<form  action="" method="post" >
<table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
<tr align="center">
  <td colspan="7" align="center"> <h2>Add a New Brand</h2> </td>
</tr>
<tr>
  <td colspan="7" align="center"><input type="text" name="brand" placeholder=" Brand Name" ></td>
</tr>
<tr>
<td colspan="7" align="center">  <input type="submit" name="add" value="Add Brand"></td>
</tr>
</table>
</form>
<?php
global $con;
if(isset($_POST['add'])){
$new_brand=$_POST['brand'];
$new="insert into brand (brand_title) values  ('$new_brand') ";
$new=mysqli_query($con,$new);
if($new){echo "<script>alert('Success')</script>";
echo "<script>window.open('index.php?view_brand','_self')</script>";
}
}

?>
