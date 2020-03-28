<?php
$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//getting cataegories
if (!function_exists('getCats')){
function getCats(){
  global $con;
  $get_cats="select * from categories";
  $run_cats=mysqli_query($con,$get_cats);
  while($row_cats=mysqli_fetch_array($run_cats)) {
    $cat_id=$row_cats['cat_id'];
    $cat_title=$row_cats['cat_title'];
    echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
  }
}
}

// getting Brands
if (!function_exists('getBrands')){
function getBrands(){
  global $con;
  $get_brands="select * from brands";
  $run_brands=mysqli_query($con,$get_brands);
  while($row_brand=mysqli_fetch_array($run_brands)){
    $brand_id=$row_brand['brand_id'];
    $brand_title=$row_brand['brand_title'];
    echo "<li ><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
  }
}
}

if (!function_exists('getIp')){

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}
}

if (!function_exists('add_cart')){
function add_cart($pro_id){
    global $con;
    $ip = getIp();
    $get_pro="select product_price from products where product_id=$pro_id;";
    $get_pro=mysqli_query($con,$get_pro);
    $get_pro=mysqli_fetch_array($get_pro);
    $check_pro="select * from cart where p_id=$pro_id and ip_add='$ip' ";
    $run_check=mysqli_query($con,$check_pro);
    if(mysqli_num_rows($run_check)==1){
      $row=mysqli_fetch_array($run_check);
      $qty=$row['qty']+1;
      $insert_pro="update  cart set qty=$qty where ip_add='$ip' and p_id=$pro_id ";
      $run_pro=mysqli_query($con,$insert_pro);
      if($run_pro){
      $_SESSION['qty']++;
      $_SESSION['amnt']=$_SESSION['amnt']+$get_pro['product_price'];
      echo "
      <script>
       
          var loc = window.location.href;
          loc=loc.split('?');
          window.location.assign(loc[0])
         
      </script>";
      }
    }
    else
    {
      $insert_pro="insert into cart (p_id,ip_add,qty) values($pro_id,'$ip',1) ";
      $run_pro=mysqli_query($con,$insert_pro);
      if($run_pro){
      $_SESSION['qty']++;
      $_SESSION['amnt']=$_SESSION['amnt']+$get_pro['product_price'];
      echo "
      <script>
       
          var loc = window.location.href;
          loc=loc.split('?');
          window.location.assign(loc[0])
         
      </script>";
      }
    }
    

  }
}




if (!function_exists('remove_cart')){
function remove_cart($pro_id){
    global $con;
    $ip = getIp();
    $get_pro="select product_price from products where product_id=$pro_id;";
    $get_pro=mysqli_query($con,$get_pro);
    $get_pro=mysqli_fetch_array($get_pro);
    $check_pro="select * from cart where p_id=$pro_id and ip_add='$ip' ";
    $run_check=mysqli_query($con,$check_pro);
    if(mysqli_num_rows($run_check)==1){
      $row=mysqli_fetch_array($run_check);
      $qty=$row['qty']-1;
      if ($qty==0){
      $remove_pro="delete  from cart where ip_add='$ip' and p_id=$pro_id ";
      $run_pro=mysqli_query($con,$remove_pro);
      if($run_pro){
      $_SESSION['qty']--;
      $_SESSION['amnt']=$_SESSION['amnt']-$get_pro['product_price'];
      echo "<script>var loc = window.location.href;
      loc=loc.split('?');
      window.location.assign(loc[0])</script>";
      }
      }
      else
      {
      $remove_pro="update  cart set qty=$qty where ip_add='$ip' and p_id=$pro_id ";
      $run_pro=mysqli_query($con,$remove_pro);
      if($run_pro){
      $_SESSION['qty']--;
      $_SESSION['amnt']=$_SESSION['amnt']-$get_pro['product_price'];
      echo "<script>var loc = window.location.href;
      loc=loc.split('?');
      window.location.assign(loc[0])</script>";
      }
      }
    }
    }
}

if (!function_exists('getPro')){
function getPro()
{
  global $con;
  if(!isset($_GET['cat']) && !isset($_GET['brand'])){ $get_pro="select * from products"; }
  else if (!isset($_GET['cat']) && isset($_GET['brand'])) { $brand=$_GET['brand']; $get_pro="select * from products where product_brand=$brand "; }
  else if (isset($_GET['cat']) && !isset($_GET['brand'])) { $cat=$_GET['cat'];  $get_pro="select * from products where product_cat=$cat "; }
  else if (isset($_GET['cat']) && isset($_GET['brand'])) {  $brand=$_GET['brand']; $cat=$_GET['cat']; $get_pro="select * from products where product_cat=$cat and product_brand=$brand "; }

  $run_pro=mysqli_query($con,$get_pro);
  $count_pro=mysqli_num_rows($run_pro);
  if($count_pro==0){
    echo "
    <h2>There are no Products</h2>
    ";
  }
  while($row_pro=mysqli_fetch_array($run_pro)){
    $pro_id=$row_pro['product_id'];
    $pro_title=$row_pro['product_title'];
    $len=strlen($pro_title);
    if($len>40)
    $pro_title = substr($pro_title,0,40).'...';
    $pro_image=$row_pro['product_image'];
    $pro_price=$row_pro['product_price'];
    echo "
    <a href='details.php?pro_id=$pro_id'>
    <div class='single_product'>
      <img src='admin_area/product_images/$pro_image'>
      <div class='single_product_container'>
      <div class='single_product_title'>$pro_title </div><br></a>
      <p class='single_product_price'>₹$pro_price
       <a href='index.php?add_cart=$pro_id' style='float:right'><button>Add to Cart</button></a>
     </p>
      </div>
    </div>
    
    ";
  }
}
}

if (!function_exists('getDetails')){
function getDetails()
{
  if(isset($_GET['pro_id'])){
  global $con;
  $product_id=$_GET['pro_id'];
  $get_pro="select * from products where product_id=$product_id";
  $run_pro=mysqli_query($con,$get_pro);
  while($row_pro=mysqli_fetch_array($run_pro)){
    $pro_title=$row_pro['product_title'];
    $pro_image=$row_pro['product_image'];
    $pro_price=$row_pro['product_price'];
    $pro_desc=$row_pro['product_desc'];
    $pro_desc=explode(',',$pro_desc);
    echo "
    <div style='float:left' class='single_product'>
      <img style='width:150px ;height:150px' src='admin_area/product_images/$pro_image'>
      <p >Price : Rs. $pro_price</p>
      </div>
      <div style='position:absolute;top:75px;left: 500px;text-align:left'>
      <h3>Details</h3>";
      foreach ($pro_desc as $key ) {
        # code...
        echo "<p style='text-align:left; font-weight:100 ; margin : auto; padding :10px 0px 10px 0px;'>$key</p>";
      }
      echo"
      <a href='index.php'  > <button>Go Back</button></a>
      <a href='index.php?add_cart=$product_id'><button >Add to Cart</button></a>
    </div>

    ";
  }
  }
}
}

if (!function_exists('getPro_search')){
function getPro_search(){
  global $con;
  if(isset($_GET['search'])){
    $search_query=strtoupper($_GET['user_query']);
    $search_query=explode(' ', $search_query);
    foreach  ($search_query as $keyword) {

    $get_pro="select * from products where product_keywords like '%$keyword%' ";
      $run_pro=mysqli_query($con,$get_pro);
      while($row_pro=mysqli_fetch_array($run_pro)){
        $pro_id=$row_pro['product_id'];
        $pro_title=$row_pro['product_title'];
         $len=strlen($pro_title);
    if($len>40)
    $pro_title = substr($pro_title,0,40).'...';
        $pro_image=$row_pro['product_image'];
        $pro_price=$row_pro['product_price'];
        echo "
       <a href='details.php?pro_id=$pro_id'>
    <div class='single_product'>
      <img src='admin_area/product_images/$pro_image'>
      <div class='single_product_container'>
      <div class='single_product_title'>$pro_title </div><br></a>
      <p class='single_product_price'>₹$pro_price
       <a href='index.php?add_cart=$pro_id' style='float:right'><button>Add to Cart</button></a>
     </p>
      </div>
    </div>
    
        ";
      }
    }
  }
}
}

?>
