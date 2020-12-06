<?php
session_start();
include("includes/db.php");
include("functions/functions.php");



?>
<?php




if (isset($_GET['pro_id'])) {
	$pro_id=$_GET['pro_id'];
	$get_product="select * from products where product_id='$pro_id' ";
	$run_product=mysqli_query($con,$get_product);
	$row_product=mysqli_fetch_array($run_product);
	$p_cat_id=$row_product['p_cat_id'];
	$p_title=$row_product['product_title'];
	$p_price=$row_product['product_price'];
	$p_desc=$row_product['product_desc'];
	$p_img1=$row_product['product_img1'];
	$p_img2=$row_product['product_img2'];
	$p_img3=$row_product['product_img3'];
	$get_p_cat="select * from product_category where p_cat_id='$p_cat_id'";
	$run_p_cat=mysqli_query($con,$get_p_cat);
	$row_p_cat=mysqli_fetch_array($run_p_cat);
	$p_cat_id=$row_p_cat['p_cat_id'];
	$p_cat_title=$row_p_cat['p_cat_title'];



}

if(isset($_COOKIE['previously_visited'])) {
    $previously_visited_cookie = $_COOKIE['previously_visited'];
    $previously_visited = unserialize($previously_visited_cookie);
  } else {
    $previously_visited = array();
  }
  $current = $pro_id;
  // not found in the previously visited array
  if (!in_array($current, $previously_visited)) {
    if (sizeof($previously_visited) >= 5) {
      array_splice($previously_visited, 4, 1);
      array_splice($previously_visited, 0, 0, $current);
    } else {
      array_splice($previously_visited, 0, 0, $current);
    }
  } else {
    $index = array_search($current, $previously_visited);
    if ($index != 0) {
      array_splice($previously_visited, $index, 1);
      array_splice($previously_visited, 0, 0, $current);
    }
  }

  $previously_visited_cookie = serialize($previously_visited);
  $expire=time()+60*60*24*30;
  
  setcookie('previously_visited', $previously_visited_cookie, $expire, '/');
  
      
  
  
  
  
  
  //setcookie('previously_visited', $previously_visited_cookie, $expire);

  // 
  // most visited products
  // 
  if(isset($_COOKIE['most_visited'])) {
    $most_visited_cookie = $_COOKIE['most_visited'];
	$most_visited = unserialize($most_visited_cookie);
	//print_r($most_visited);
  } else {
    $most_visited = array();
  }

  // found in the most visited array
  if (array_key_exists($current, $most_visited)) {
    $value = $most_visited[$current];
    $most_visited[$current] = $value + 1;
  } else {
    $most_visited[$current] = 1;
  }

  $most_visited_cookie = serialize($most_visited);
  $expire=time()+60*60*24*30;
  setcookie('most_visited', $most_visited_cookie, $expire, '/');
  //setcookie('most_visited', $most_visited_cookie, $expire);







?>

<?php 
	$query = mysqli_query($con,"SELECT AVG(rating) as AVGRATE from reviews where product_id=$pro_id");
	$row = mysqli_fetch_array($query);
	$AVGRATE=$row['AVGRATE'];
	$query = mysqli_query($con,"SELECT count(rating) as Total from reviews where product_id=$pro_id");
	$row = mysqli_fetch_array($query);
	$Total=$row['Total'];
	$query = mysqli_query($con,"SELECT count(review) as TotalReviews from reviews where product_id=$pro_id");
	$row = mysqli_fetch_array($query);
	$TotalReviews=$row['TotalReviews'];
	$review = mysqli_query($con,"SELECT review,rating,emailId,name from reviews where product_id=$pro_id");
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
<script src="scripts/review.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel='stylesheet' href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

					<a href="#">Shopping Cart Total Price: $ <?php totalPrice();?>, Total Items <?php item(); ?></a>

				</div><!--col-md-6 offer Start -->

				<div class="col-md-6">
					<ul class="menu">
						<li>
							<a href="customer_registration.php"> Register</a>
						</li>

						<li>
							<a href="checkout.php"> My Account</a>
						</li>

						<li>
							<a href="cart.php"> Goto Cart</a>
						</li>

						<li>
							<?php
							if(!isset($_SESSION['customer_email'])){
								echo "<a href='checkout.php'>Login</a>";
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
							<li class="active">
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
								<a href="cart.php"> Shoping Cart</a>
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
					Shop
				</li>
				<li><a href="shop.php?p_cat=<?php echo $p_cat_id;?>"><?php  echo $p_cat_title ?></a></li>

				<li><?php echo $p_title  ?></li>

			</ul>
		</div><!--col-md-12 Start-->
		<div class="col-md-3"><!--col-md-3 Start-->
			<?php
			include("includes/sidebar.php");
			?>
				
			</div><!--col-md-3 End-->

<div class="col-md-9">
	<div class="row" id="productmain">
		<div class="col-sm-6"><!--col-sm-6 slider start-->
			<div id="mainimage">
				<div id="mycarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#mycarousel" data-slide-to="0" class="active"></li>
						<li data-target="#mycarousel" data-slide-to="1"></li>
						<li data-target="#mycarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner"><!--carousel-inner start-->
						<div class="item active">
							<center>
				<img src="admin_area/product_images/<?php echo $p_img1   ?>" class="img-responsive">
							</center>
						</div>

						<div class="item">
							<center>
				<img src="admin_area/product_images/<?php echo $p_img2   ?>" class="img-responsive">
							</center>
						</div>

						<div class="item">
							<center>
				<img src="admin_area/product_images/<?php echo $p_img3   ?>" class="img-responsive">
							</center>
						</div>


					</div><!--carousel-inner start-->
					<a href="#mycarousel" class="left carousel-control" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>

					<a href="#mycarousel" class="right carousel-control" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>

				</div>
			</div>
		</div><!--col-sm-6 slider End-->
		
		<div class="col-sm-6">
<div class="box"><!--box Start-->
<h1 class="text-center"><?php echo $p_title   ?>
</h1>
<?php
addCart();
?>
<form action="details.php?add_cart=<?php echo $pro_id   ?>" method="post" class="form-horizontal"><!--Form Start-->
	<div class="form-group"><!--form-group Start-->
		<label class="col-md-5 control-label">Product Quantity</label>
		<div class="col-md-7"><!--col-md-7 End-->
			<select name="product_qty" class="form-control">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>

		 </div><!--col-md-7 End-->
	</div><!--form-group End-->
	<div class="form-group">
		<!-- <label class="col-md-5 control-label">Prouct Size</label>
		<div class="col-md-7">
			<select name="product_size" class="form-control">
				<option>Select a size</option>
				<option>Small</option>
				<option>Medium</option>
				<option>Large</option>
				<option>Extra Large</option>
			</select>
		</div> -->
		</div>
		<p class="price">$ <?php echo $p_price;  ?></p>
		<p class="text-center buttons">
			<button class="btn btn-primary" type="submit">
				<i class="fa fa-shopping-cart"></i>Add to cart
			</button>
		 </p>
		</form><!--Form End-->
			</div><!--box End-->
			<div class="col-xs-4">
				<a href="#" class="thumb">
					<img src="admin_area/product_images/<?php echo $p_img1   ?>" class="img-responsive">
				 </a>
			</div>
			<div class="col-xs-4">
				<a href="#" class="thumb">
					<img src="admin_area/product_images/<?php echo $p_img2   ?>" class="img-responsive">
				 </a>
			</div>
			<div class="col-xs-4">
				<a href="#" class="thumb">
					<img src="admin_area/product_images/<?php echo $p_img1   ?>" class="img-responsive">
				 </a>
			</div>

		</div>
	</div>
<div class="box" id="details">
	<h4>Product Details</h4>
	<p><?php echo $p_desc   ?>
</p>
<h4>Size</h4>
<ul>
	<li>Small</li>
		<li>Medium</li>
	<li>Large</li>

	<li>Extra Large</li>

</ul>
</div>


<!-- Display ratings here -->
<?php
    if ($Total > 0) { ?>
<div class="box" id="display_review">
	<div class="row">	
		<div class="col-md-5" style="padding-top: 50%; transform: translate(0%, -50%);">
			<h1 align="center"><b><?php echo round($AVGRATE,1);?></b> <i class="fa fa-star" data-rating="2" style="font-size:32px;color:#ffc300;"></i></h1>
			<p align="center"><?=$Total;?> ratings and <?=$TotalReviews;?> reviews</p>
		</div>
		<div class="col-md-7">	
		<?php
			while($db_review= mysqli_fetch_array($review)){
		?>
			<h4>
			<?php
			if($db_review['rating']==5){
			?>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<?php
			}
			elseif($db_review['rating']==4){
			?>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<?php
			}
			elseif($db_review['rating']==3){
			?>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<?php
			}
			elseif($db_review['rating']==2){
			?>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<?php
			}
			elseif($db_review['rating']==1){
			?>
			<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<i class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></i>
			<?php
			}
			?>
			
			<?php?>
			by <span style="font-size:14px;"><b><?=$db_review['name'];?></b></span></h4>
			<p><?=$db_review['review'];?></p>
			<hr>
		<?php	
			}
				
		?>
		</div>		
	</div>
</div>
<?php } ?>

<!-- Give Reviews here -->
<?php
    if (isset($_SESSION['customer_email'])) { ?>
<div class="box" id="give_review">
	<h4>Write a Review</h4>
	<div id="rating_div" style="margin-bottom: 1.5rem; margin-top: 1.5rem;">
		<div class="star-rating">
			<span class="fa fa-star-o" data-rating="1" style="font-size:20px;color:#ffc300;"></span>
			<span class="fa fa-star-o" data-rating="2" style="font-size:20px;color:#ffc300;"></span>
			<span class="fa fa-star-o" data-rating="3" style="font-size:20px;color:#ffc300;"></span>
			<span class="fa fa-star-o" data-rating="4" style="font-size:20px;color:#ffc300;"></span>
			<span class="fa fa-star-o" data-rating="5" style="font-size:20px;color:#ffc300;"></span>
			<input type="hidden" name="default" class="rating-value" value="1">
		</div>
	</div>
	<div>
		<input type="hidden" name="product_id" id="product_id" value="<?php echo $pro_id; ?>">
		<input type="text" class="form-control" name="name" id="name" placeholder="Name"><br>
		<input type="text" class="form-control" name="emailId" id="emailId" placeholder="Email ID"><br>
		<textarea class="form-control" rows="5" placeholder="Write your product review here..." name="review" id="review" required></textarea><br>
		<button class="btn btn-default btn-sm btn-info" id="review_btn" style="margin-left: 50%; transform: translate(0%, -50%);">Submit</button>
	</div>
</div>
<?php } ?>



<div id="row same-height-row"><!--row same-height-row Start-->
	<div class="col-md-3 col-sm-6"><!--col-md-3 col-sm-6 Start-->
		<div class="box same-height headline"><!--box same-height headline Start-->
			<h3 class="text-center">Recently viewed products</h3>
			<!-- <a href="recentproducts.php"> Recently viewed products</a> -->
		</div><!--box same-height headline End-->

	</div><!--col-md-3 col-sm-6 End-->

	<?php
	if(isset($_COOKIE['previously_visited'])) {
		$previously_visited_cookie = $_COOKIE['previously_visited'];
		$previously_visited = unserialize($previously_visited_cookie);
		// echo "<div class='col-8 offset-md-2 my-5'>";
		// echo "<table class='table table-bordered text-center'><thead class='thead-light'><tr>";
		// echo "<th>Five previously visited products</th>";
		// echo "</tr></thead>";
		foreach ($previously_visited as $element) {
			//echo "<tr><td>$element</td></tr>";
			$pro_id = $element;
			$get_product="select * from products where product_id='$pro_id' ";
			$run_product=mysqli_query($con,$get_product);
			while ($row=mysqli_fetch_array($run_product)) {
			$pro_id=$row['product_id'];
			$product_title=$row['product_title'];
			$product_price=$row['product_price'];
			$product_img1=$row['product_img1'];
			echo "
			<div class='col-md-4'>
			<div class='product'>
			<a href='details.php?pro_id=$pro_id'>
			<img src='admin_area/product_images/$product_img1' class='img-responsive'>
			</a>
			<div class='text'>
			<h3><a href='details.php?pro_id=$pro_id'>$product_title</a></h3>
			<p class='price'>$ $product_price</p>
			</div>
			</div>
			</div>


			";
			
		}


		}
		echo "</table>";
		echo "</div>";
} 







	

	?>

</div><!--row same-height-row End-->

</div>

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