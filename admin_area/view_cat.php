<?php include("includes/functions.php") ?>
<form   method="post">
  <table width="795" align="center" bgcolor="pink" cellpadding="6" border="2 ">
    <tr>
      <td colspan='4' align='center'> <h2>All Categories</h2> </td>
    </tr>
    <tr>
      <td  align='center'><b>Category Id</b></td>
      <td   align='center'><b>Category Title</b></td>
      <td  align='center'><b>Edit</b></td>
      <td  align='center'><b>Delete</b></td>
    </tr>
    <?php
    global $con;
    $get_cats="select * from categories";
    $get_cats=mysqli_query($con,$get_cats);
    while($row=mysqli_fetch_array($get_cats)){
      $id=$row['cat_id'];
      $title=$row['cat_title'];
      echo "<tr>
      <td colspan='1' align='center'>$id</td>
      <td  align='center'>$title</td>
      <td><a href='index.php?edit_cat=$id'>Edit</a></td>
      <td><a href='index.php?del_cat=$id'>Delete</a></td>
      </tr>";
    }
     ?>
  </table>
</form>
