<?php

include("functions/functions.php");
 ?>
 <script type="text/javascript">
   function send_mail(){
    alert("An Email has been sent to your mail. Check for futher instructions.");
    window.location.assign('checkout.php');
   }
 </script>
<div >
  <form   method="post">
    <table width = "500"  align="center"  cellpadding="10">
      <tr align="center"  >
        <th colspan="2" >Forgot Password!</th>
      </tr>
      <tr >
      <td align="left">Email</td>
      <td>  <input class="ipt" type="text" name="email" size="30"/> </td>
      </tr>
     
      <tr align ="center" >
        <td colspan="2"> <input class="btn" style="height: 30px;width: 90px" onclick="send_mail()"type="button" name="login" value="Send Email" /> </td>
      </tr>
    </table>
  </form>
</div>