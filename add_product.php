<?php
session_start();
include 'connect.php'; // Ensure the database connection is included

// Restrict access to admins only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect non-admin users to login
    exit();
}

if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    $admin_id = $_SESSION['user_id']; // Assuming admin's ID is stored in session

    // Handle file upload
    $product_image = $_FILES['product_image']['name'];
    $image_tmp_name = $_FILES['product_image']['tmp_name'];
    $image_folder = 'images/' . $product_image; // Folder where images will be stored

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        // Insert product into the database
        $insert_product = mysqli_query($conn, "INSERT INTO products (name, price, image, added_by_admin_id) VALUES ('$product_name', '$product_price', '$product_image', '$admin_id')");

        if ($insert_product) {
            echo "Product added successfully!";
        } else {
            echo "Failed to add product!";
        }
    } else {
        echo "Failed to upload image!";
    }
}
?>

<h1>Add New Product</h1>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="product_name" required placeholder="Product Name">
    <input type="number" name="product_price" required placeholder="Product Price">
    <input type="file" name="product_image" required>
    <input type="submit" name="add_product" value="Add Product">
</form>
