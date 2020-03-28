<table  width="100%" align="center" bgcolor="white" cellpadding="6" cellspacing="0">
 
  <tr style="background: #3989bf;color:white" >
    <td >Id</td>
    <td>Customer Email</td>
    <td>Product ID</td>
    <td>Date</td>
    <td>Quantity</td>
    <td>Price</td>
  </tr>
  <?php
  include("includes/functions.php");
  global $con;
  $all_pro="select * from orders";
  $all_pro=mysqli_query($con,$all_pro);
  while($row=mysqli_fetch_array($all_pro)){
    $id=$row['id'];
    $product_id=$row['product_id'];
    $email=$row['customer_email'];
    $date=$row['date'];
    $qty=$row['qty'];
    $price=$row['price'];
    echo "<tr>
      <td >$id</td>
      <td>$email</td>
      <td>$product_id</td>
      <td>$date</td>
      <td>$qty</td>
      <td>$price</td>
      </tr>
    ";
  }
   ?>
</table>
