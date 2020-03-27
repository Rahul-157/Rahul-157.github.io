<table  width="100%" align="center" bgcolor="white" cellpadding="6" cellspacing="0">
 
  <tr style="background: #3989bf;color:white" >
    <td >Id</td>
    <td>Name</td>
    <td>Image</td>
    <td>Email</td>
    <td>Country</td>
    <td>City</td>
    <td>Contact</td>
    <td>Address</td>
    <td>Delete</td>
  </tr>
  <?php
  include("includes/functions.php");
  global $con;
  $all_pro="select * from customers";
  $all_pro=mysqli_query($con,$all_pro);
  while($row=mysqli_fetch_array($all_pro)){
    $id=$row['customer_id'];
    $name=$row['customer_name'];
    $photo=$row['customer_image'];
    if($photo=='')
      $photo='user.jpeg';
    $email=$row['customer_email'];
    $country=$row['customer_country'];
    $city=$row['customer_city'];
    $addr=$row['customer_addr'];
    $contact=$row['customer_contact'];
    echo "<tr>
      <td >$id</td>
      <td>$name</td>
      <td><img style='border-radius:50px' src='../customer/customer_images/$photo' width='80' height='80'></td>
      <td>$email</td>
      <td>$country</td>
      <td>$city</td>
      <td>$contact</td>
      <td>$addr</td>
      <td><a href='index.php?del_customer=$id'><button>Delete</button></a></td>
      </tr>
    ";
  }
   ?>
</table>
