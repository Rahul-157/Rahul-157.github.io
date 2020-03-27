<h3>My Orders</h3><hr>
                  <?php
                  global $con;
                  $ip=getIp();
                  $get_order_item="select * from orders where customer_email='$mail' ";
                  $get_order_item=mysqli_query($con,$get_order_item);
                  while($row_order=mysqli_fetch_array($get_order_item)){
                    $pro_qty=$row_order['qty'];
                    $pro_id=$row_order['product_id'];
                    $date = $row_order['date'];
                    $get_pro="select * from products where product_id=$pro_id";
                    $get_pro=mysqli_query($con,$get_pro);
                    $get_pro=mysqli_fetch_array($get_pro);
                    $pro_price=$get_pro['product_price'];
                    $pro_image=$get_pro['product_image'];
                    $pro_title=$get_pro['product_title'];
                    $len=strlen($pro_title);
                    if($len>40)
                    $pro_title = substr($pro_title,0,40).'...';
                   $price=$pro_price*$pro_qty;
                    echo "<a href='details.php?pro_id=$pro_id'>
                           <div class='single_product' style='width:230px;height:auto'>
                            <img src='admin_area/product_images/$pro_image'>
                            <div class='single_product_container'>
                            <div class='single_product_title'>$pro_title </div><br></a>
                            <label style='float:left;font-size:14px'>₹ $price</label>
                             <label style='float:left;font-size:14px'>Quantity</label> 
                             <input  style='width:20px;height:20px;float:left;margin-left:0px' disabled value=$pro_qty>
                            <label style='float:left;width:auto;font-weight:normal;font-size:14px'><b>Date</b>: $date</label>
                            </div>
                          </div></a>
                   ";
                    }?>