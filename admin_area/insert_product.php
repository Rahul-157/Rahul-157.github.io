<!DOCTYPE html>
<?php
include "./includes/functions.php"
?>
<script type="text/javascript">
   function getFile(){
     document.getElementById("upfile").click();
     }
      function choose_cat(x){
      if(x.value==-1){
        alert('Please Select Category');
      }
     }
     function choose_brand(x){
      if(x.value==-1){
        alert('Please Select Brand');
      }
     }
</script>

    <form  style="margin-left:40px;text-align: center" name="reg" action="insert_product.php" method="post" enctype="multipart/form-data">
      <br>
        <h3 style="margin-left: 40px">Insert New Product</h3><br>
               <label>Title</label>
              <input class='ipt' type="text" name="product_title" required><br>
               <label>Category</label>
                   <select onfocusout="choose_cat()" name="product_category" required>
                     <option value="-1">Select a Category</option>
                         <?php showCats(); ?>
                    </select>
<br>
                <label>Brand</label>
                    <select  onfocusout="choose_brand()" name="product_brand" required>
                     <option value="-1">Select a Brand</option>
                          <?php showBrands(); ?>
                     </select> 

                 <br>
                   
               <label>Price </label>
                  <input class='ipt'  name="product_price"  required><br>
                  <label>Decsription  </label>
                  <input class='ipt' name="product_desc"  required><br>
                  <label>Keywords  </label>
                  <input class='ipt'  name="product_keywords"  required><br>
                  <br>
                   <label id="img_upload" onclick="getFile();">Upload Image</label>
                  <div  style='height: 0px;width:0px; overflow:hidden;'> <input class='ipt' type="file" hidden="true" name="product_image" id="upfile" ></div><br>
                  <input class='btn'  type="submit" name="insert_post" value="Add Now"> 
    </form>
 
<?php

if(isset($_POST['insert_post'])){
$product_title=$_POST['product_title'];
$product_cat=$_POST['product_category'];
$product_brand=$_POST['product_brand'];
$product_price=$_POST['product_price'];
$product_desc=$_POST['product_desc'];
$product_keywords=strtoupper($_POST['product_keywords']);
$product_image=$_FILES['product_image']['name'];
$product_image_tmp=$_FILES['product_image']['tmp_name'];
move_uploaded_file($_FILES['product_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/ecommerce/admin_area/product_images/'. $_FILES['product_image']['name']);
// move_uploaded_file($product_image_tmp,"product_images/$product_image");
$insert_product="insert into products (product_cat,product_brand,product_title,product_price,product_desc, product_image,product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
$insert_pro=mysqli_query($con,$insert_product);
if($insert_pro){
  echo "<script>alert('Product Added Succesfully')</script>";
 echo "<script>window.location.assign('index.php?view_product')</script>";
}
}


 ?>
