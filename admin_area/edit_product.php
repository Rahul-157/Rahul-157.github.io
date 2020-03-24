<?php
 include("includes/functions.php");
$e_id=$_GET['edit_pro'];
$get_pro="select * from products where product_id='$e_id' ";
$get_pro=mysqli_query($con,$get_pro);
$get_pro=mysqli_fetch_array($get_pro);
$title=$get_pro['product_title'];
$brand=$get_pro['product_brand'];
$category=$get_pro['product_cat'];
$price=$get_pro['product_price'];
$desc=$get_pro['product_desc'];
$image=$get_pro['product_image'];
$keywords=$get_pro['product_keywords'];
 ?>
<form  action="" method="post" enctype="multipart/form-data">
  <table align="center" width="795" height="550" border="2" bgcolor="orange">
    <tr align="center">
      <th colspan="7">Update a Product </th>
    </tr>
    <tr>
      <th align="right">Product Title : </th>
      <td> <input type="text" name="product_title"   value=<?php echo $title ;?> > </td>
    </tr>
    <tr>
      <th align="right">Product Category : </th>
      <td><select  name="product_category"  >
        <option value="-1" >Select a Category</option>
          <?php showCats(); ?>
      </select></td>
    </tr>
    <tr>
      <th align="right">Product Brand : </th>
      <td> <select  name="product_brand"  >
        <option value="-1">Select a Brand</option>
        <?php showBrands(); ?>
      </select> </td>
    </tr>
    <tr>
      <th align="right">Product Image : </th>
      <td> <input type="file" name="product_image" /> </td>
      <td> <img src="product_images/<?php echo $image ;?>" height="80" width="80"> </td>
    </tr>
    <tr>
      <th align="right">Product Price : </th>
      <td> <input type="text" name="product_price"  value=<?php echo $price; ?>  > </td>
    </tr>
    <tr>
      <th align="right">Product Decsription : </th>
      <td> <textarea name="product_desc" rows="15" cols="40" ></textarea> </td>
    </tr>
    <tr>
      <th align="right">Product Keyword : </th>
      <td> <input type="text" name="product_keywords" value=<?php echo $keywords; ?> > </td>
    </tr>
    <tr align="center">
      <td colspan="7"> <input type="submit" name="update_pro" value="Update Now"/> </td>
    </tr>
  </table>
</form>
<?php
global $con;
if(isset($_POST['update_pro'])){
  $product_title=$_POST['product_title'];
  $product_cat=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_desc=$_POST['product_desc'];
  $product_keywords=$_POST['product_keywords'];
  $product_image=$_FILES['product_image']['name'];
  $product_image_tmp=$_FILES['product_image']['tmp_name'];
  move_uploaded_file($_FILES['product_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/ecommerce/admin_area/product_images/'. $_FILES['product_image']['name']);
  // move_uploaded_file($product_image_tmp,"product_images/$product_image");

  $insert_product="update  products set product_cat=$product_cat,product_brand=$product_brand,product_title='$product_title',product_price=$product_price,product_desc='$product_desc', product_image='$product_image',product_keywords='$product_keywords' where product_id=$e_id ";
  $insert_pro=mysqli_query($con,$insert_product);
  if($insert_pro){
    echo "<script>alert('Product Updated Succesfully')</script>";
   echo "<script>window.open('index.php?view_product','_self')</script>";
  }
  }



?>
