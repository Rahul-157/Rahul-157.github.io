<?php include("includes/functions.php") ?>
<form   method="post">
  <table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
    <tr>
      <td colspan='4' align='center'> <h2>All Brands</h2> </td>
    </tr>
    <tr>
      <td  align='center'><b>Brand Id</b></td>
      <td   align='center'><b>Brand Title</b></td>
      <td  align='center'><b>Edit</b></td>
      <td  align='center'><b>Delete</b></td>
    </tr>
    <?php
    global $con;
    $get_brand="select * from brands";
    $get_brand=mysqli_query($con,$get_brand);
    while($row=mysqli_fetch_array($get_brand)){
      $id=$row['brand_id'];
      $title=$row['brand_title'];
      echo "<tr>
      <td colspan='1' align='center'>$id</td>
      <td  align='center'>$title</td>
      <td><a href='index.php?edit_brand=$id'>Edit</a></td>
      <td><a href='index.php?del_brand=$id'>Delete</a></td>
      </tr>";
    }
     ?>
  </table>
</form>
