<?php
session_start();
include 'connect.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database
    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id'");
    $order = mysqli_fetch_assoc($order_query);
}

// deletar hela cart 
$delete_all_query = mysqli_query($conn, "DELETE FROM cart");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed, thank you for the purchase </title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Thank you for your order, <?php echo htmlspecialchars($order['full_name']); ?>!</p>
        <p>Order ID: <?php echo $order['id']; ?></p>
        <p>Email: <?php echo $order['email']; ?></p>
        <p>Phone: <?php echo $order['phone']; ?></p>
        <p>Shipping Address: <?php echo nl2br($order['address']); ?></p>
        <p>products: <?php echo nl2br(string: $order['products']); ?></p>
        <p>Total Price: $<?php echo $order['total_price']; ?></p>
        <p>Payment Method: <?php echo $order['payment_method']; ?></p>
        <div class="table_bottom">
            <a href="shop_products.php" class="btn">back to shopping</a>
        </div>
    </div>

</body>

</html>