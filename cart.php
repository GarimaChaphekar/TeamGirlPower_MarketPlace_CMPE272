<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>E-Commerce Store</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
		<div id="top"> <!--Top Bar Start -->
			<div class="container"><!--container Start -->
				<div class="col-md-6 offer"><!--col-md-6 offer Start -->
					<a href="#" class="btn btn-success btn-sm">
						
											<?php
						if(!isset($_SESSION['customer_email'])){
							echo "Welcome Guest";
						} else{
							echo "Welcome: " .$_SESSION['customer_email'] . "";
						}
						?>
	
					</a>

					<a href="#">Shopping Cart Total Price: $<?php totalPrice();?>, Total Items <?php item(); ?></a>

				</div><!--col-md-6 offer Start -->

				<div class="col-md-6">
					<ul class="menu">
						<li>
							<a href="customer_registration.php"> Register</a>
						</li>

						<li>
							<?php
							if(!isset($_SESSION['customer_email'])){
								echo "<a href='checkout.php'>My Account</a>";
							}else{
								echo "<a href='customer/my_account.php?my_order'>My Account</a>";
							}
							?>
						</li>

						<li>
							<a href="cart.php"> Goto Cart</a>
						</li>

						<li>
							<?php
							if(!isset($_SESSION['customer_email'])){
								echo "<a href='checkout.php'>Login</a>";
                                                                echo "  ";
                                                                 echo "<li><a href='google.php'>Login with Google</a></li>";
							} else{
								echo "<a href='logout.php'>Logout</a>";
							}
							?>
						</li>
					</ul>

				</div>


			</div> <!--container End -->
			

		</div>  <!--Top Bar End -->

		<div class="navbar navbar-default" id="navbar"> <!--navbar navbar-default start -->
			<div class="container">
				<div class="navbar-header"> <!--navbar-header start -->
					<!-- <a class="navbar-brand home" href="index.php">
						<img src="images/logo.jpg" alt="teehosting" class="hidden-xs">
						<img src="images/logo-small.jpg" alt="teehosting" class="visible-xs">
					</a> -->

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
						<span class="sr-only"> Toggle Navigation</span>
						<i class="fa fa-align-justify"> </i>
					</button>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
						<span class="sr-only"></span>
						<i class="fa fa-search"></i>
					</button>
				</div> <!--navbar-header start -->

				<div class="navbar-collapse collapse" id="navigation"> <!--navbar-collapse collapse start -->
					<div class="padding-nav">  <!--padding-nav start -->
						<ul class="nav navbar-nav navbar-left">
							<li>
								<a href="index.php">Home</a>
							</li>
							<li>
								<a href="shop.php"> Shop</a>
							</li>
							<li>
								
								<?php
							if(!isset($_SESSION['customer_email'])){
								echo "<a href='checkout.php'>My Account</a>";
							}else{
								echo "<a href='customer/my_account.php?my_order'>My Account</a>";
							}
							?>
							</li>


							<li class="active">
								<a href="cart.php"> Shopping Cart</a>
							</li>
							
							<li>
								<a href="contactus.php"> Contact Us</a>
							</li>

						</ul>
					</div> <!--padding-nav start -->
					<a href="cart.php" class="btn btn-primary navbar-btn right">
						<i class="fa fa-shopping-cart"></i>
						<span><?php item(); ?> items In Cart</span>
					</a>


					<div class="navbar-collapse collapse right"> <!--navbar-collapse collapse-right start -->
		<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
							<span class="sr-only"> Toggle Search</span>
							<i class="fa fa-search"></i>
		</button>
					</div> <!--navbar-collapse collapse-right End -->
				
				<div class="collapse clearfix" id="search">
						
						<form class="navbar-form" method="get" action="result.php">
							<div  class="input-group">
				<input type="text" name="user_query" placeholder="Search" class="form-control" required="">
<span class="input-group-btn">
		<button type="submit" value="Search" name="search" class="btn btn-primary" >
									<i class="fa fa-search"></i>
		</button>
		</span>
							</div>
							
						</form>
					</div>

				</div> <!--navbar-collapse collapse End -->

			</div>
			

		</div> <!--navbar navbar-default End -->

<div id="content">
	<div class="container"><!--container Start-->
		<div class="col-md-12"><!--col-md-12 Start-->
			<ul class="breadcrumb"> 
				<li><a href="home.php">Home</a></li>
				<li>
					Cart
				</li>
			</ul>
		</div><!--col-md-12 Start-->
		<div class="col-md-9" id="cart"> <!--col-md-9 Start-->
			<div class="box">
				<form action="cart.php" method="post" enctype="multipart-form-data">

					<h1>Shopping Cart</h1>
					<?php
					$ip_add=getUserIP();
					$select_cart="select * from cart where ip_add='$ip_add'";
					$run_cart=mysqli_query($con,$select_cart);
					$count=mysqli_num_rows($run_cart);

					?>
					<p class="text-muted">Currently you have <?php echo $count  ?> item(s) in your cart</p>
					<div class="table-responsive"><!--table-responsive Start-->
						<table class="table">
							<thead>
								<tr>
									<th colspan="2">Product</th>
									<th>Quantity</th>
									<th>Unit Price</th>
									<th>Size</th>
									<th colspan="1">Delete</th>
									<th colspan="1">Sub Total</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$total=0;
								while ($row=mysqli_fetch_array($run_cart)) {
									$pro_id=$row['p_id'];
									$pro_size=$row['size'];
									$pro_qty=$row['qty'];
									$get_product="select * from products where product_id='$pro_id'";
									$run_pro=mysqli_query($con,$get_product);
			while ($row=mysqli_fetch_array($run_pro)) {
			$p_title=$row['product_title'];	
				$p_img1=$row['product_img1'];
				$p_price=$row['product_price'];
				$sub_total=$row['product_price']*$pro_qty;
				$total +=$sub_total;  //$total =$total+$sub_total;

						
							
								?>

								<tr>
									<td><img src="admin_area/product_images/<?php echo $p_img1   ?>"></td>
		<td><?php echo $p_title   ?></td>
		<td><?php echo $pro_qty   ?></td>
		<td><?php echo $p_price   ?></td>
		<td><?php echo $pro_size   ?></td>
		<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id   ?>"></td>
		<td><?php echo $sub_total   ?></td>
								</tr>
								<?php } }  ?>
							</tfoot>
						</table>
					</div><!--table-responsive End-->
					
					<div class="box-footer">
						<div class="pull-left"><!--pull-left Start-->
							<h4>Total Price</h4>
						</div><!--pull-left End-->
						<div class="pull-right">
							
							<h4>$<?php echo  $total;   ?></h4>
						</div>
					</div>
					<div class="box-footer">
						<div class="pull-left"><!--pull-left Start-->
							<a href="shop.php" class="btn btn-default">
								<i class="fa fa-chevron-left"></i>Continue Shopping
							</a>
						</div><!--pull-left End-->
						<div class="pull-right">
							<button class="btn btn-default" type="submit" name="update" value="Update Cart">
								<i class="fa fa-refresh">Update Cart</i>
							</button>
							<a href="checkout.php" class="btn btn-primary">
								Proceed to checkout<i class="fa fa-chevron-right"></i>
							</a>

						</div>
					</div>
				</form>
			</div>

			<?php
			function update_cart(){
				global $con;
				if(isset($_POST['update'])){
					foreach ($_POST['remove'] as $remove_id) {
						$delete_product="delete from cart where p_id='$remove_id' ";
						$run_del=mysqli_query($con,$delete_product);
						if ($run_del) {
							echo "<script>window.open('cart.php','_self')</script>";
						}
					}
				}
			}

			echo @$up_cart=update_cart();

			?>
	

		<div id="col-md-3"><!--col-md-3 Start-->
			<div class="box" id="order-summary">
				<div class="box-header">
					<h3>Order Summary</h3>
				</div>
				<p class="text-muted">
					Shippping and additional costs are calculated based on the values you have entered
				</p>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr>
							<td>Order Subtotal</td>
							<th>$ <?php echo $total   ?></th>
						</tr>
						<tr>
							<td>Shipping and handling</td>
							<td>$ 0</td>
						</tr>

						<tr>
							<td>Tax</td>
							<td>$ 0</td>
						</tr>
						<tr class="total">
							<td>Total</td>
							<th>$ <?php echo $total   ?></th>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div><!--col-md-3 End-->



</div><!--container End-->
	
</div><!--Content End-->




<!--Footer Start-->
<?php 
include("includes/footer.php");
 ?>

<!--Footer End-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>