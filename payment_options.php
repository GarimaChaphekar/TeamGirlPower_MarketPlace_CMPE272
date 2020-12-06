<div class="box">
	<?php
	$session_email=$_SESSION['customer_email'];
	$select_customer="select * from customers where customer_email='$session_email'";
	$run_cust=mysqli_query($con,$select_customer);
	$row_customer=mysqli_fetch_array($run_cust);
	$customer_id=$row_customer['customer_id'];

	?>
	
		<h1 class="text-center">Payment options</h1>
		<p class="lead text-center">
			<a href="order.php?c_id=<?php echo $customer_id ?>">Cash On Delivery</a>
		</p>
		<center>
			<p class="lead">
			<!--	<a href="payment.php">Pay with paypal
					<img src="images/maxresdefault.jpg" width="500" height="270" class="img-responsive"></a>
			</p> -->
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="sb-uqlar3899448@business.example.com">
        
        <input type="hidden" name="item_name_1" value="HTC LATEST CELL PHONE">
        <input type="hidden" name="amount_1" value=<?php echo totalprice(); ?>>
		<input type="hidden" name="return" value="http://garimachaphekar.com/order.php?c_id=<?php echo $customer_id ?>"/>

		<input type="image" src="./images/paypal_btn.jpg" alt="submit" width="375" height="75">
                <img src="images/maxresdefault.jpg" width="500" height="270" class="img-responsive">
        </form>
		</center>
	
</div>