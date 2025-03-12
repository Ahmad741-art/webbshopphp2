<?php
//session_start(); //har redan gjort start session.
include 'connect.php'; // Ensure database connection is included

$cart_count = 0; // Default cart count

// Check if user is logged in as a customer
if (!empty($_SESSION['role']) && $_SESSION['role'] === 'customer' && !empty($_SESSION['user_id'])) {
    $customer_id = $_SESSION['user_id']; // Ensure user_id is stored in session

    // Ensure $conn is defined before querying
    /*if (isset($conn)) {
        $cart_query = mysqli_query($conn, "SELECT COUNT(*) AS cart_count FROM cart WHERE customer_id = '$customer_id'");
        
        if ($cart_query) {
            $cart_result = mysqli_fetch_assoc($cart_query);
            $cart_count = $cart_result['cart_count'] ?? 0;
        }
    }*/
}
?>
