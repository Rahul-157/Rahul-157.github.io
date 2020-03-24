<?php

$con=mysqli_connect("localhost","root","","ecommerce");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if (!function_exists('showBrands')){
function showBrands(){
  global $con;
  $get_brands="select * from brands";
  $run_brands=mysqli_query($con,$get_brands);
  while($row_brand=mysqli_fetch_array($run_brands)){
    $brand_id=$row_brand['brand_id'];
    $brand_title=$row_brand['brand_title'];
    echo "<option value='$brand_id'>$brand_title</option>";
  }
}
}

if (!function_exists('showCats')){
function showCats(){
  global $con;
  $get_cats="select * from categories";
  $run_cats=mysqli_query($con,$get_cats);
  while($row_cats=mysqli_fetch_array($run_cats)) {
    $cat_id=$row_cats['cat_id'];
    $cat_title=$row_cats['cat_title'];
    echo "<option value='$cat_id'>$cat_title</option>";
  }
}
}


 ?>
