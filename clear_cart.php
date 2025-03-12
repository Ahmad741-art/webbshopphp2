<?php
session_start();
include 'connect.php';

// Delete all items from the cart
$delete_all_query = mysqli_query($conn, "DELETE FROM cart");

if ($delete_all_query) {
    $_SESSION['display_message'] = "All products removed from cart!";
} else {
    $_SESSION['display_message'] = "Failed to remove all products.";
}
header("Location: cart.php");
exit();
?>
