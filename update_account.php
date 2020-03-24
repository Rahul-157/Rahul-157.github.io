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

            <form  action=""  method="post" enctype="multipart/form-data">
              <table align="center" width="750">
                <tr>
                  <th align="center" colspan="2">Update Your Account</th>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Name">Name</td>
                  <td> <input type="text" name="c_name" required> </td>
                </tr>


                <tr>
                  <td align="right">Upload Image</td>
                  <td> <input type="file" name="c_image" > </td>
                </tr>
                <tr>
                  <td align="right">Country</td>
                  <td> <input type="text" name="c_country"  placeholder="Enter Your Country" required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your City">City</td>
                  <td> <input type="text" name="c_city"  required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Contact">Contact No.</td>
                  <td> <input type="text" name="c_contact" required> </td>
                </tr>
                <tr>
                  <td align="right" placeholder="Enter Your Address">Adress</td>
                  <td> <textarea name="c_addr" rows="10" cols="30" ></textarea> </td>
                </tr>
                <tr>
                  <td align="center" colspan="2"> <input type="submit" name="Update"> </td>
                </tr>
              </table>
            </form>

            <?php

            if(isset($_POST['Update'])){
            
              global $con;
              $c_name=$_POST['c_name'];

              $c_image=$_FILES['c_image']['name'];
              $c_image_tmp=$_FILES['c_image']['tmp_name'];
              $c_country=$_POST['c_country'];
              $c_city=$_POST['c_city'];
              $c_addr=$_POST['c_addr'];
              $c_contact=$_POST['c_contact'];
              $ip=getIp();

              move_uploaded_file($_FILES['c_image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/ecommerce/customer/customer_images/'. $_FILES['c_image']['name']);
              $add_customer="update    customers set customer_name='$c_name',customer_country='$c_country',customer_city='$c_city',customer_contact='$c_contact',customer_addr='$c_addr',customer_image='$c_image' where customer_email='$user'  ";

              $add_customer=mysqli_query($con,$add_customer);
              if($add_customer){
                echo "<script>alert('Updated Succesfully !')</script>";

                 echo "<script>window.open('my_account.php','_self')</script>";}
               }



            ?>
