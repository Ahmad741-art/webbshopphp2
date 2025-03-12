<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <section class="order_success">
        <h1 class="heading">Order Placed Successfully!</h1>
        <p>Thank you for your order. We will contact you soon.</p>
        <a href="shop_products.php" class="btn">Continue Shopping</a>
    </section>
</div>

</body>
</html>
