<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from the cart
    $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE id=$product_id");

    if ($delete_query) {
        $_SESSION['display_message'] = "Product removed from cart!";
    } else {
        $_SESSION['display_message'] = "Failed to remove product.";
    }
    header("Location: cart.php");
    exit();
}
?>
