<form method="post">
  <table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
    <tr>
      <h2> Edit  category</h2>
    </tr>
    <tr>
       <td align="center"><input type="text" name="up_cat" placeholder="Enter New Category Name"></td>
    </tr>
    <tr>
      <td align="center"> <input type="submit" name="done" value="Update"> </td>
    </tr>
  </table>
</form>
<?php
include("includes/functions.php");
global $con;
if(isset($_POST['done'])){
$cat_id=$_GET['edit_cat'];
$cat_title=$_POST['up_cat'];
$up_cat="update  categories  set  cat_title='$cat_title' where cat_id='$cat_id' ";
$up_cat=mysqli_query($con,$up_cat);
if($up_cat)
{
  echo "<script>alert('Success')</script>";
  echo "<script>window.open('index.php?view_cat','_self')</script>";
}
}
 ?>
