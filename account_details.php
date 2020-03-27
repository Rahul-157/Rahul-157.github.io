<!DOCTYPE html>
<?php

include("./functions/functions.php");

    $user = $_SESSION['customer_email'];

    $get_customer = "select * from customers where customer_email='$user'";

    $run_customer = mysqli_query($con, $get_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $c_id = $row_customer['customer_id'];
    $name = $row_customer['customer_name'];
    $email = $row_customer['customer_email'];
    $pass = $row_customer['customer_password'];
    $country = $row_customer['customer_country'];
    $city = $row_customer['customer_city'];
    $contact = $row_customer['customer_contact'];
    $address= $row_customer['customer_addr'];
    $image = $row_customer['customer_image'];

?>
<script type="text/javascript">
  function getFile(){
     document.getElementById("upfile").click();
}</script>
              <form  align="center" action=""  method="post" enctype="multipart/form-data">
             <h3>Account Details</h3><br>
               <label>Name</label>
              <input class='ipt' type="text" name="c_name" disabled value="<?php echo $name;?>" required><br>
               <label>Email</label>
                   <input class='ipt' type="text" name="c_email" value="<?php echo $email;?>"  disabled required> <br>
                  <label>Country</label>
                   <input class='ipt' type="text" name="c_country" disabled value="<?php echo $country;?>" placeholder="Enter Your Country" required><br>
               <label>City</label>
                  <input class='ipt' type="text" name="c_city"  disabled value="<?php echo $city;?>" required><br>
                  <label>Contact No</label>
                  <input class='ipt' type="text" name="c_contact" disabled value="<?php echo $contact;?>" required><br>
                  <label>Address</label>
                   
                 <input class='ipt' type="text" name="c_addr" disabled value="<?php echo $address;?>" required><br>
            </form>

        