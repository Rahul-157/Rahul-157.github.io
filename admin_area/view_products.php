<table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
  <tr align="center">
    <td colspan=7 align="center"><h2>All Products</h2></td>
  </tr>
  <tr align ="center" border="2" bgcolor="#f2d7a3" >
    <td >Id</td>
    <td>Title</td>
    <td>Image</td>
    <td>Price</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <?php
  include("includes/functions.php");
  global $con;
  $all_pro="select * from products";
  $all_pro=mysqli_query($con,$all_pro);
  while($row=mysqli_fetch_array($all_pro)){
    $id=$row['product_id'];
    $title=$row['product_title'];
    $photo=$row['product_image'];
    $price=$row['product_price'];
    echo "<tr>
      <td >$id</td>
      <td>$title</td>
      <td><img src='product_images/$photo' width='80' height='80'></td>
      <td>$price</td>
      <td><a href='index.php?edit_pro=$id'>Edit</a></td>
      <td><a href='index.php?delete_pro=$id'>Delete</a></td>
      </tr>
    ";
  }
   ?>
</table>
