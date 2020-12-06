
<!DOCTYPE html>

<div style="text-align:center">

<!--Top Bar End -->


    <a class="navbar-brand home" style="text-align:center" href="index.php">
						<img src="images/logo.jpg" alt="teehosting" class="hidden-xs" >
						
	</a>
<br>
<br>

</div>



</html>

<?php
include("includes/db.php");
$sql = "SELECT customer_name, customer_email, customer_country, customer_city, customer_contact, customer_address FROM customers";
$result = mysqli_query($con, $sql);

?>

<table border = "1" cellpadding = "3" cellspacing = "2" style = "background-color: #ADD8E6">
    <tr>
    <th>Name</th>
    
    <th>Email</th>
    <th>Country</th>
    <th>City</th>
	<th>Cell Phone</th>
	<th>Address</th>
   </tr>

   <?php		

for ( $counter = 0;$row = mysqli_fetch_row( $result );$counter++ )
{   
    print( "<tr>" );
    foreach ( $row as $key => $value )
        print( "<td>$value</td>" );
        print( "</tr>" );
}


?>	
</table>
<h1 style="text-align:center"> Farm Fresh Users</h1>

<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://sahithikhandavalli.com/Users1.php');
curl_exec ($ch);

//echo "<h1 style="text-align:center"> The Michael Scott Users</h1>";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://vandanachandola.online/users1.php');
curl_exec ($ch);
echo "<br>";




?>



