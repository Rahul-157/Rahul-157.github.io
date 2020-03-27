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
     }
    function val_email(){
        var email = document.forms["reg"]["c_email"].value;
        var reg_email=/^\w+(\.\w+)*@[a-zA-Z]+\.[a-zA-Z]{2,3}$/;
        if (!reg_email.test(email))
        window.alert("Email Invalid");
    }
    function val_tel(){
        var contact = document.forms["reg"]["c_contact"].value;
        var reg_tel=/^[0-9]{10}/;
        if (!reg_tel.test(contact))
        window.alert("Contact Invalid");
    }
  
</script>
              <form   name="reg" align="center" action=""  method="post" enctype="multipart/form-data">
             <h3>Update Details</h3><br>
               <label>Name</label>
              <input class='ipt' type="text" name="c_name" value="<?php echo $name;?>" required><br>
               <label>Email</label>
                   <input class='ipt'   name="c_email" onfocusout="val_email()" value="<?php echo $email;?>" required> <br>
                   <label>Password</label>
                  <input class='ipt' type="password" name="c_password" required > <br>
                  <label>Country</label>
                   <input class='ipt' type="text" name="c_country" value="<?php echo $country;?>" placeholder="Enter Your Country" required><br>
               <label>City</label>
                  <input class='ipt' type="text" name="c_city"  value="<?php echo $city;?>" required><br>
                  <label>Contact No</label>
                  <input class='ipt' onfocusout="val_tel()" name="c_contact" value="<?php echo $contact;?>" required><br>
                  <label>Address</label>
                   <input class='ipt'  name="c_addr" value="<?php echo $address;?>" required>
                   <br>
                   <label id="img_upload" onclick="getFile();">Upload Image</label>
                  <div  style='height: 0px;width:0px; overflow:hidden;'> <input class='ipt' type="file" hidden="true" name="c_image" id="upfile" ></div><br>
                  <input class='btn' type="submit" name="Update" value="Update"> 
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
