<?php 
include 'connect.php';

if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']); // Ensure it's an integer

    $delete_query = mysqli_query($conn, "DELETE FROM products WHERE id = $delete_id");

    if ($delete_query) {
        header("Location: view_products.php"); // Redirect after deleting
        exit(); // Stop further script execution
    } else {
        echo "Failed to delete product.";
    }
} else {
    echo "Invalid request.";
}
?>
