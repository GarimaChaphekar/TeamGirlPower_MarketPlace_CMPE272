<div class="panel panel-default sidebar-menu">
	<div class="panel-heading"><!--panel-heading Start-->
		<?php
		$session_customer=$_SESSION['customer_email'];
		$get_cust="select * from customers where customer_email='$session_customer'";
		$run_cust=mysqli_query($con,$get_cust);
		$row_customers=mysqli_fetch_array($run_cust);
		$customer_image= $row_customers['customer_image'];
		$customer_name= $row_customers['customer_name'];
		if(!isset($_SESSION['customer_email'])){

		} else{
			echo "<center>
			<img src='customer_images/$customer_image' class='img-responsive'>
		</center>
		<br>
		<h3 align='center' class='panel-title'>Name:$customer_name</h3></center>";
		}

		?>

		
	</div><!--panel-heading End-->
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php if(isset($_GET['my_order'])){echo "active";}?> ">
				<a href="my_account.php?my_order"><i class="fa fa-list"></i>My Order</a>
			</li>

			<li class="<?php if (isset($_GET['pay_offline'])){echo "active";}   ?>">
				<a href="my_account.php?pay_offline">
					<i class="fa fa-bolt"></i>Pay Offline</a>
			</li>


			


			<li class="<?php if (isset($_GET['edit_act'])){echo "active";}   ?>">
				<a href="my_account.php?edit_act">
					<i class="fa fa-pencil"></i>Edit Account</a>
			</li>


			<li class="<?php if (isset($_GET['change_pass'])){echo "active";}   ?>">
				<a href="my_account.php?change_pass">
					<i class="fa fa-user"></i>Change password</a>
			</li>

			<li class="<?php if (isset($_GET['delete_ac'])){echo "active";}   ?>">
				<a href="my_account.php?delete_ac">
					<i class="fa fa-trace-o"></i>Delete Account</a>
			</li>

			
		</ul>
	</div>
</div>