<?php
// session_start(); // Session already started elsewhere
include 'connect.php'; // Ensure database connection is included

$cart_count = 0; // Default cart count

// Check if user is logged in as a customer
if (!empty($_SESSION['role']) && $_SESSION['role'] === 'customer' && !empty($_SESSION['user_id'])) {
    $customer_id = $_SESSION['user_id']; // Ensure user_id is stored in session
    $cartHasItems = hasCartItems($conn);

    // Ensure $conn is defined before querying
    if (isset($conn)) {
        echo '
        <link rel="stylesheet" href="css/style.css">
        <div class="header">
            <a href="shop_products.php">Shop</a>
            <div class="cart-container">
                <a href="cart.php" class="cart-icon">🛒</a>';

                if ($cartHasItems) {
                    echo '<span class="cart-dot"></span>';
                }

                echo '
            </div>';
        
        // If the user is an admin, show "Add Product" and "View Products"


        echo '</div>'; // Closing the header div
    }
} else {
    echo '    <link rel="stylesheet" href="css/style.css">
        <div class="header">
    <a href="add_product.php">Add Product</a>
    <a href="add_product.php">Add Product</a>
    <a href="add_product.php">Add Product</a>
    <div class="products-container">
        <a href="view_products.php" class="products-icon">📦</a>
    </div> </div>';
}

// Function to check if cart has items
function hasCartItems(mysqli $conn): bool
{
    $query = "SELECT COUNT(*) AS total FROM cart";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row["total"] > 0; // Returns true if cart has items
    }
    return false;
}
?>
