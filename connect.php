<?php
// Database connection
$conn = mysqli_connect('webbshopphp-db-1', 'root', 'rootpassword', 'shopping_cart');

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>