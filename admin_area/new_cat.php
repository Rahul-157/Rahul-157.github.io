<?php
include("includes/functions.php");
?>
<form  action="" method="post" >
<table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
<tr align="center">
  <td colspan="7" align="center"> <h2>Add a New Category</h2> </td>
</tr>
<tr>
  <td colspan="7" align="center"><input type="text" name="cat" placeholder="Type New Category Name" ></td>
</tr>
<tr>
<td colspan="7" align="center">  <input type="submit" name="add" value="Add Category"></td>
</tr>
</table>
</form>
<?php
global $con;
if(isset($_POST['add'])){
$new_cat=$_POST['cat'];

$new="insert into categories (cat_title) values  ('$new_cat') ";
$new=mysqli_query($con,$new);
if($new){echo "<script>alert('Success')</script>";
echo "<script>window.open('index.php>view_cat','_self')</script>";
}
}

?>
