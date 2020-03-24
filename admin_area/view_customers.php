<table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
  <tr align="center">
    <td colspan=10 align="center"><h2>All customers</h2></td>
  </tr>
  <tr align ="center" border="2" bgcolor="#f2d7a3" >
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
    $email=$row['customer_email'];
    $country=$row['customer_country'];
    $city=$row['customer_city'];
    $addr=$row['customer_addr'];
    $contact=$row['customer_contact'];
    echo "<tr>
      <td >$id</td>
      <td>$name</td>
      <td><img src='../customer/customer_images/$photo' width='80' height='80'></td>
      <td>$email</td>
      <td>$country</td>
      <td>$city</td>
      <td>$contact</td>
      <td>$addr</td>
      <td><a href='index.php?del_customer=$id'>Delete</a></td>
      </tr>
    ";
  }
   ?>
</table>
