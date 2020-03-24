<!DOCTYPE html>
<?php
include "./includes/functions.php"
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Inserting Products</title>
  </head>
  <body bgcolor="skyblue" >
    <form  action="insert_product.php" method="post" enctype="multipart/form-data">
      <table align="center" width="795" height="550" border="2" bgcolor="orange">
        <tr align="center">
          <th colspan="7">Insert New Post Here</th>
        </tr>
        <tr>
          <th align="right">Product Title : </th>
          <td> <input type="text" name="product_title" required /> </td>
        </tr>
        <tr>
          <th align="right">Product Category : </th>
          <td><select  name="product_category" required>
            <option value="-1">Select a Category</option>
              <?php showCats(); ?>
          </select></td>
        </tr>
        <tr>
          <th align="right">Product Brand : </th>
          <td> <select  name="product_brand" required>
            <option value="-1">Select a Brand</option>
            <?php showBrands(); ?>
          </select> </td>
        </tr>
        <tr>
          <th align="right">Product Image : </th>
          <td> <input type="file" name="product_image" required/> </td>
        </tr>
        <tr>
          <th align="right">Product Price : </th>
          <td> <input type="text" name="product_price" required /> </td>
        </tr>
        <tr>
          <th align="right">Product Decsription : </th>
          <td> <textarea name="product_desc" rows="15" cols="40" ></textarea> </td>
        </tr>
        <tr>
          <th align="right">Product Keyword : </th>
          <td> <input type="text" name="product_keywords" /> </td>
        </tr>
        <tr align="center">
          <td colspan="7"> <input type="submit" name="insert_post" value="Add Now"/> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php

if(isset($_POST['insert_post'])){
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
$insert_product="insert into products (product_cat,product_brand,product_title,product_price,product_desc, product_image,product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
$insert_pro=mysqli_query($con,$insert_product);
if($insert_pro){
  echo "<script>alert('Product Added Succesfully')</script>";
 echo "<script>window.open('index.php?insert_product','_self')</script>";
}
}


 ?>
