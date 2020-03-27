
<table width="100%" align="center" bgcolor="white" cellpadding="6" cellspacing="0">
  
  <tr style="background: #3989bf;color:white">
    <th >Id</th>
    <th>Title</th>
    <th>Image</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th>
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
    $price=(string)number_format ($price);
    echo "<tr>
      <td>$id</td>
      <td>$title</td>
      <td><img  src='product_images/$photo' width='75' height='75'></td>
      <td>₹ $price</td>
      <td><a href='index.php?edit_pro=$id'><button>Edit</button></a></td>
      <td><a href='index.php?delete_pro=$id'><button>Delete</button></a></td>
      </tr>
    ";
  }
   ?>
</table>
