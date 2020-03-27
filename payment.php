<div >
  <h2 align="center">Pay Now with PayPal </h2>
  <p style="text-align:center"> <img src="images/paypal-logo.jpg" alt="Pay With Paypal" width="250" height="150"> </p>
</div>

<form action ="" align="center" method="POST">
	<label>Amount</label>
	<input class='ipt' type="text" name="amnt" disabled value="<?php 
    echo $_SESSION['amnt'];
	?>"><br>
	<input class='btn' style="width:100px;height: 50px;" type="submit" name="pay" value="Pay">
</form>
