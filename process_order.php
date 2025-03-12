<?php
session_start();
include 'connect.php';

if (isset($_POST['place_order'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $total_price = $_POST['total_price'];
    $order_date = date("Y-m-d H:i:s");

    // Insert order into database
    $insert_order = mysqli_query($conn, "INSERT INTO orders (full_name, email, phone, address, payment_method, total_price, order_date) 
        VALUES ('$full_name', '$email', '$phone', '$address', '$payment_method', '$total_price', '$order_date')");

    if ($insert_order) {
        // Clear cart after order
        mysqli_query($conn, "DELETE FROM cart");

        $_SESSION['display_message'] = "Order placed successfully!";
        header("Location: order_success.php"); // Redirect to success page
        exit();
    } else {
        $_SESSION['display_message'] = "Failed to place order.";
        header("Location: checkout.php");
        exit();
    }
}
?>
