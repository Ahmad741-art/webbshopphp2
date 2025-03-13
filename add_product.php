<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');  // Redirect non-admins to login
    exit();
}
?>
<?php
include 'connect.php'; // Ensure database connection

$display_message = ""; // Initialize message variable

if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/' . basename($product_image);

    // Insert product into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $product_name, $product_price, $product_image_folder);

    if ($stmt->execute()) {
        move_uploaded_file($product_image_temp_name, $product_image_folder);
        $display_message = "Product inserted successfully!";
    } else {
        $display_message = "Error inserting product.";
    }

    $stmt->close(); // Close statement
}
?>

<!-- Include Header -->
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container">
    <!-- Display Message -->
    <?php if (!empty($display_message)) : ?>
        <div class='display_message'>
            <span><?= htmlspecialchars($display_message) ?></span>
            <i class='fas fa-times' onclick='this.parentElement.style.display="none";'></i>
        </div>
    <?php endif; ?>

    <section>
        <h3 class="heading">Add Products</h3>
        <form action="" class="add_product" method="post" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter product name" class="input_fields" required>
            <input type="number" name="product_price" min="0" placeholder="Enter product price" class="input_fields" required>
            <input type="file" name="product_image" class="input_fields" required accept="image/png, image/jpg, image/jpeg">
            <input type="submit" name="add_product" class="submit_btn" value="Add Product">
        </form>
    </section>
</div>

<!-- JavaScript -->
<script src="js/script.js"></script>

</body>
</html>
