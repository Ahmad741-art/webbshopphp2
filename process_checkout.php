<?php
session_start();
include 'connect.php';  // Include the database connection

// Check if the form is submitted
if (isset($_POST['place_order'])) {
    // Get the user's order details from the form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $select_cart_products = mysqli_query($conn, "SELECT * FROM cart");
 
    // skapar json object till order
    
    // AND Get the cart total price
    $total_price = 0;
    $products = '{';
    while ($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
        $products = $products . "\"" . $fetch_cart_products['name'] ."\":" . $fetch_cart_products['quantity'] . ",";
        $total_price = $total_price + $fetch_cart_products['price'] ;
    }
    $products = substr($products,0,-1);
    $products = $products . '}';
    //echo $products; //test

/*
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            // Get product info from the database
            $product_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
            $product = mysqli_fetch_assoc($product_query);
            $total_price += $product['price'] * $quantity;  // Calculate total price
        }
    }
*/


    // Insert order details into the orders table
    $query = "INSERT INTO orders (full_name, email, phone, address, payment_method, products, total_price) 
              VALUES ('$full_name', '$email', '$phone', '$address', '$payment_method','$products', '$total_price')";

    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);  // Get the order ID after insertion

        // Clear the cart after successful order
        unset($_SESSION['cart']);  // Remove cart from session

        // Redirect to an order confirmation page
        header("Location: order_confirmation.php?order_id=$order_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
