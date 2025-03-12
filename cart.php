<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header('Location: login.php'); // Redirect non-customers
    exit();
}
?>


<?php
//session_start();  // Start the session
//include 'connect.php';

// Update query for cart quantity
if (isset($_POST['update_cart_quantity'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    // Query to update the quantity in the cart table
    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity=$update_value WHERE id=$update_id");

    // Check if update query was successful
    if ($update_quantity_query) {
        $_SESSION['display_message'] = "Quantity updated successfully!";  // Store message in session
        header('Location: cart.php');  // Redirect to cart page
        exit();  // Make sure to exit after redirect
    } else {
        $_SESSION['display_message'] = "Failed to update quantity.";  // Store error message in session
        header('Location: cart.php');  // Redirect to cart page
        exit();  // Make sure to exit after redirect
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- Include header -->
<?php include 'header.php'; ?>

<!-- Display message -->
<?php 
if (isset($_SESSION['display_message'])): ?>
    <div class="display_message"> 
        <span><?php echo htmlspecialchars($_SESSION['display_message']); ?></span>
        <i class="fas fa-times" onclick="this.parentElement.style.display='none';"></i>
    </div>
    <?php unset($_SESSION['display_message']); ?> <!-- Unset the session variable after displaying -->
<?php endif; ?>

<div class="container">
    <section class="shopping_cart">
        <h1 class="heading">My Cart</h1>
        <table>
            <?php 
            // Query to get cart products
            $select_cart_products = mysqli_query($conn, "SELECT * FROM cart");
            $num=1;
            $grand_total = 0; // Initialize grand total variable

            if (mysqli_num_rows($select_cart_products) > 0) {
                echo "<thead>
                        <th>Sl No</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>";

                while ($fetch_cart_products = mysqli_fetch_assoc($select_cart_products)) {
                    $total_price = $fetch_cart_products['price'] * $fetch_cart_products['quantity'];
                    $grand_total += $total_price; // Add to grand total
                    ?>
                    <tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $fetch_cart_products['name'] ?></td>
                        <td>
                            <img src="images/<?php echo $fetch_cart_products['image'] ?>" alt="Product">
                        </td>
                        <td><?php echo $fetch_cart_products['price'] ?>/-</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $fetch_cart_products['id'] ?>" name="update_quantity_id">
                                <div class="quantity_box">
                                    <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity'] ?>" name="update_quantity">
                                    <input type="submit" class="update_quantity" value="Update" name="update_cart_quantity">
                                </div>
                            </form>
                        </td>
                        <td><?php echo $total_price ?>/-</td>
                        <td>
    <a href="remove_from_cart.php?id=<?php echo $fetch_cart_products['id']; ?>" onclick="return confirm('Are you sure you want to remove this item?');">
        <i class="fas fa-trash"></i> Remove
    </a>
</td>

                    </tr>
<?php
$num++;
}
} else {
                echo "<tr><td colspan='7'>No products in the cart.</td></tr>";
            }
            ?>
            </tbody>
        </table>
        
        <!-- Bottom area -->
        <div class="table_bottom">
            <a href="shop_products.php" class="bottom_btn">Continue Shopping</a>
            <a href="checkout.php" class="bottom_btn">Proceed to Checkout</a>
            <h3 class="bottom_btn">Grand Total: <span><?php echo $grand_total; ?>/-</span></h3>
        </div>

        <!-- Button to delete all cart items -->
        <a href="clear_cart.php" class="delete_all_btn" onclick="return confirm('Are you sure you want to clear the entire cart?');">
    <i class="fas fa-trash"></i> Delete All
</a>

    </section>
</div>

</body>
</html>
