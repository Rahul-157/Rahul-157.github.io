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

    <form  style="margin-left:40px;text-align: center" name="reg" action="" method="post" enctype="multipart/form-data">
      <br>
        <h3 style="margin-left: 40px">Update Product</h3><br>
               <label>Title</label>
              <input class='ipt' type="text" name="product_title" value="<?php  echo $title; ?>"><br>
               <label>Category <font color="red">*</font></label>
                   <select  name="product_category" onfocusout="choose_cat(this)" required>
                     <option value="-1">Select a Category</option>
                         <?php showCats(); ?>
                    </select>
<br>
                <label>Brand <font color="red">*</font></label>
                    <select  name="product_brand" required onfocusout="choose_brand(this)">
                     <option value="-1">Select a Brand</option>
                          <?php showBrands(); ?>
                     </select> 

                 <br>
                   
               <label>Price </label>
                  <input class='ipt'  name="product_price"  value="<?php  echo $price; ?>"><br>
                  <label>Decsription  </label>
                  <input class='ipt' name="product_desc"  value="<?php  echo $desc; ?>"><br>
                  <label>Keywords  </label>
                  <input class='ipt'  name="product_keywords"  value="<?php  echo $keywords; ?>"><br>
                  <br>
                   <label id="img_upload" onclick="getFile();">Upload Image</label>
                  <div  style='height: 0px;width:0px; overflow:hidden;'> <input class='ipt' type="file" hidden="true" name="product_image" id="upfile" ></div><br>
                  <input class='btn'  type="submit" name="update_pro" value="Update Now"> 
    </form>
 
<?php
global $con;
if(isset($_POST['update_pro'])){
  $product_title=$_POST['product_title'];
  $product_cat=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_desc=$_POST['product_desc'];
  $product_keywords=strtoupper($_POST['product_keywords']);
  if($_FILES['product_image']['name']!=""){
  $product_image=$_FILES['product_image']['name'];
  $product_image_tmp=$_FILES['product_image']['tmp_name'];
  move_uploaded_file($_FILES['product_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/ecommerce/admin_area/product_images/'. $_FILES['product_image']['name']);
  }
  else
    $product_image=$image;
  // move_uploaded_file($product_image_tmp,"product_images/$product_image");

  $insert_product="update  products set product_cat=$product_cat,product_brand=$product_brand,product_title='$product_title',product_price=$product_price,product_desc='$product_desc', product_image='$product_image',product_keywords='$product_keywords' where product_id=$e_id ";
  $insert_pro=mysqli_query($con,$insert_product);
  if($insert_pro){
    echo "<script>alert('Product Updated Succesfully')</script>";
   echo "<script>window.location.assign('index.php?view_product')</script>";
  }
  }



?>
