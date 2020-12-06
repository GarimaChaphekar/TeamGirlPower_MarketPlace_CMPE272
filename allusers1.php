
<!DOCTYPE html>

<div id = "top">
<div class = "col-md-6 offer">
<!--Top Bar End -->

<nav class="navbar navbar-light bg-light">
  

</div>
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


