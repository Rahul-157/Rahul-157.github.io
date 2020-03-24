<form method="post">
  <table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
    <tr>
      <h2> Edit  Brand</h2>
    </tr>
    <tr>
       <td align="center"><input type="text" name="up_brand" placeholder="Enter New Brand Name"></td>
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
$brand_id=$_GET['edit_brand'];
$brand_title=$_POST['up_brand'];
$up_brand="update  brand set  brand_title='$brand_title' where brand_id='$brand_id' ";
$up_brand=mysqli_query($con,$up_brand);
if($up_brand)
{
  echo "<script>alert('Success')</script>";
  echo "<script>window.open('index.php?view_brand','_self')</script>";
}
}
 ?>
