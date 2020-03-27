<?php include("includes/functions.php") ?>

  <table table width="100%" align="center" bgcolor="white" cellpadding="6" cellspacing="0">
    <tr style="background: #3989bf;color:white">
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
      <td><a href='index.php?edit_brand=$id'><button>Edit</button></a></td>
      <td><a href='index.php?del_brand=$id'><button>Delete</button></a></td>
      </tr>";
    }
     ?>
  </table>
