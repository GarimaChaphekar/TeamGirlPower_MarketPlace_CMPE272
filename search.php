<?php
session_start();
include("includes/db.php");
//include("functions/functions.php");

$term = trim(strip_tags($_GET['user_query']));//retrieve the search term that autocomplete sends
$sql = "SELECT * FROM products WHERE product_keywords LIKE '%".$term."%' LIMIT 1";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result))
{
        $pro_id= $row['product_id'];
        echo "<script>window.open('details.php?pro_id=$pro_id','_self')</script>";
}




//$term = trim(strip_tags($_GET['user_query']));//retrieve the search term that autocomplete sends
//$sql = "SELECT * FROM customers WHERE customer_name LIKE '%".$term."%' OR customer_email LIKE '%".$term."%' OR //customer_contact LIKE '%".$term."%'";
//$result = mysqli_query($con, $sql);
//$allUsers = '';
//$row_set = [];

while($row = mysqli_fetch_assoc($result))
{
        $row_set[] = $row['customer_email'];
       $allUsers .= $row['customer_name'].'|';
            $allUsers .= $row['customer_email'].'|';
            $allUsers .= $row['customer_city'].'|';
            $allUsers .= $row['customer_contact'].'|';
}
// echo json_encode($row_set);
// echo json_encode($allUsers);


$allUsers = explode("|",$allUsers);

if(empty($row_set)){
 echo "<script>alert('No records found for the search criteria')</script>";
}
$con->close();



//$term = trim(strip_tags($_GET['user_query']));//retrieve the search term that autocomplete sends
//$sql = "SELECT * FROM customers WHERE customer_name LIKE '%".$term."%' OR customer_email LIKE '%".$term."%' OR //customer_contact LIKE '%".$term."%'";
//$result = mysqli_query($con, $sql);
//$allUsers = '';
//$row_set = [];

while($row = mysqli_fetch_assoc($result))
{
        $row_set[] = $row['customer_email'];
       $allUsers .= $row['customer_name'].'|';
            $allUsers .= $row['customer_email'].'|';
            $allUsers .= $row['customer_city'].'|';
            $allUsers .= $row['customer_contact'].'|';
}
// echo json_encode($row_set);
// echo json_encode($allUsers);


$allUsers = explode("|",$allUsers);

if(empty($row_set)){
 echo "<script>alert('No records found for the search criteria')</script>";
}
$con->close();


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
    <title>URBANISTA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  </head>
  <body>
  <div id="top">
		<!--Top Bar Start -->
		<div class="container">
			<!--container Start -->
			<div class="col-md-6 offer">
				<!--col-md-6 offer Start -->
				<a href="#" class="btn btn-success btn-sm">
				<?php
						if(!isset($_SESSION['customer_email'])){
							echo "Welcome Guest";
						} else{
							echo "Welcome: " .$_SESSION['customer_email'] . "";
						}
						?>
				</a>

				<a href="#">Shopping Cart Total Price: $ , Total Items </a>

			</div>
			<!--col-md-6 offer Start -->

			<div class="col-md-6">
				<ul class="menu">
					<li>
						<a href="customer_registration.php"> Register</a>
					</li>

					<li>
						<a href="#"> My Account</a>
					</li>

					<li>
						<a href="#"> Goto Cart</a>
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
					<li>
							<a href="allusers.php">Display All Users</a>
					</li>
				</ul>

			</div>


		</div>
		<!--container End -->


	</div>
    <!--Top Bar End -->

    <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand home" href="index.php">
						<img src="images/logo.jpg" alt="teehosting" class="hidden-xs">
						<img src="images/logo-small.jpg" alt="teehosting" class="visible-xs">
	</a>
    </nav>
    

	<div class="navbar navbar-default" id="navbar">
		<!--navbar navbar-default start -->
		<div class="container">
			<div class="navbar-header">
				

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
					<span class="sr-only"> Toggle Navigation</span>
					<i class="fa fa-align-justify"> </i>
				</button>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
					<span class="sr-only"></span>
					<i class="fa fa-search"></i>
				</button>
			</div>
			<!--navbar-header start -->

			<div class="navbar-collapse collapse" id="navigation">
				<!--navbar-collapse collapse start -->
				
				<!--padding-nav start -->
				


				<div class="navbar-collapse collapse right">
					<!--navbar-collapse collapse-right start -->
					<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
						<span class="sr-only"> Toggle Search</span>
						<i class="fa fa-search"></i>
					</button>
				</div>
				<!--navbar-collapse collapse-right End -->

				<div class="collapse clearfix" id="search">

					<form class="navbar-form" method="get" action="search.php">
						<div class="input-group">
							<input type="text" name="user_query" placeholder="Search" class="form-control" required="">
							<span class="input-group-btn">
								<button type="submit" value="Search" name="search" class="btn btn-primary">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>

					</form>
				</div>

			</div>
			<!--navbar-collapse collapse End -->

		</div>


	</div>
	<!--navbar navbar-default End -->
    
    <table class="table">
  <thead class="table table-sm" ,align="center">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">City</th>
      <th scope="col">Contact no.</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
            if(!empty($row_set)){
                for($i=0; $i<4; $i++){
                        echo "<td>" . $allUsers[$i] . "</td>";
                        
                }
            
            }
            
            
            ?>
    </tr>
  </tbody>
</table>






  
            
            

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>                      
  </body>
</html>