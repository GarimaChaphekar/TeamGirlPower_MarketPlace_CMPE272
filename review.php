<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

$product_id = $_REQUEST['product_id'];
$rating = $_REQUEST['rating'];
$name = $_REQUEST['name'];
$emailId = $_REQUEST['emailId'];
$review = $_REQUEST['review'];

$query = "INSERT INTO reviews VALUES (NULL, $product_id, $rating, '$name', '$emailId', '$review')";

if (mysqli_query($con, $query)) {
    echo "Review added successfully";
} else {
    echo "Could not add review.";
}
?>