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
								echo "<li><a href='checkout.php'>My Account</a></li>";
                                                                echo "<li><a href='checkout.php'>Login</a></li>";
                                                                 echo "  ";
                                                                 echo "<li><a href='google.php'>Login with Google</a></li>";
							}else{
								echo "<a href='customer/my_account.php?my_order'>My Account</a>";
                                                                 echo "<li><a href='logout.php'>Logout</a></li>";
							}
							?>
						</li>

						<li>
							<a href="cart.php"> Goto Cart</a>
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


							<li>
								<a href="cart.php"> Shopping Cart</a>
							</li>
							

							<li  class="active">
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
					Contact Us
				</li>
			</ul>
		</div><!--col-md-12 Start-->
		<div class="col-md-3"><!--col-md-3 Start-->
			<?php
			include("includes/sidebar.php");
			?>
		</div><!--col-md-3 End-->

		<div class="col-md-9"><!--col-md-9 Start-->
			<div class="box"><!--box Start-->
				<div class="box-header"><!--box-header Start-->
					<center>
						<h2>Contact Us</h2>
	<p class="text-muted">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>


					</center>
				</div><!--box-header End-->
				<form action="contactus.php" method="post">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" required="" class="form-control">
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" required="">
					</div>

					<div class="form-group">
						<label>Subject</label>
						<input type="text" name="subject" class="form-control" required="">
					</div>

					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control" name="massage"></textarea>
					</div>

					<div class="text-center">
						<button type="submit" name="submit" class="btn btn-primary">
							<i class="fa fa-user-md"></i>Send Message
						</button>
					</div>
				</form>

			</div><!--box End-->
		</div><!--col-md-9 End-->






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

<?php
//Admin mail
if(isset($_POST['submit'])){
$senderName=$_POST['name'];
$senderEmail=$_POST['email'];
$senderSubject=$_POST['subject'];
$senderMassage=$_POST['massage'];
$receiverEmail="garima.chaphekar@sjsu.edu";
$retval = mail($receiverEmail,$senderSubject,$senderMassage,$senderEmail);

//Customer mail
$email=$_POST['email'];
$subject="Regarding your MarketPlace Query";
$msg="Thank you sending us an email. We are looking into your query and shall get back soon. ";
$from="garima.chaphekar@sjsu.edu";
mail($email,$subject,$msg,$from);
if( $retval == true ) {
            echo "<script>alert('Email Sent')</script>";
         }else {
            echo "Email could not be sent due to some technical issue. Please try again";
         }

}
?>