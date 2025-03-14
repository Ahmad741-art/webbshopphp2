<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header(header: 'Location: login.php'); // Redirect non-customers
    exit();
}
?>



<?php 
include 'connect.php';
$display_message = ""; // Initialize message variable

if(isset($_POST['Add_to_cart'])){
    $products_name = $_POST['product_name'];
    $products_price = $_POST['product_price'];
    $products_image = $_POST['product_image'];
    $products_quantity = 1;

    // Check if product already exists in cart
    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name='$products_name'");
    if(mysqli_num_rows($select_cart) > 0){
        $display_message = "Product already added to cart";
    } else {
        // Insert product into cart
        $insert_products = mysqli_query($conn, "INSERT INTO cart (name,price,image,quantity) VALUES ('$products_name', '$products_price', '$products_image', '$products_quantity')");
        if ($insert_products) {
            $display_message = "Product added to cart";
        } else {
            $display_message = "Failed to add product to cart";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <!-- Header -->
   <?php include 'header.php'; ?>

   

   <div class="container">
   <?php if (!empty($display_message)): ?>
        <div class="display_message"> 
            <span><?php echo htmlspecialchars($display_message); ?></span>
            <i class="fas fa-times" onclick="this.parentElement.style.display='none';"></i>
        </div>
   <?php endif; ?>
      <section class="products">
        <h1 class="heading">Let's Shop</h1>
        <div class="product_container">
            <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM products");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" action="">
                <div class="edit_form">
                <?php
                
                        // Check if the image name contains "://" (indicating it's a full URL)
                            if (strpos($fetch_product['image'], "://") !== false) {
                                echo '<img src="' . $fetch_product['image'] . '"style="width: 100px;" alt="">';
                            } else {
                                echo '<img src="images/' . $fetch_product['image'] . '"style="width: 100px;" alt="">';
                            }
                        ?>                    <h3><?php echo $fetch_product['name']; ?></h3>
                    <div class="price">Price: <?php echo $fetch_product['price']; ?>/-</div>
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="submit" class="submit_btn cart_btn" value="Add to cart" name="Add_to_cart">
                </div>
            </form>
            <?php
                }
            } else {
                echo "<div class='empty_text'>No products available</div>";
            }
            ?>
        </div>
      </section>
   </div>
</body>
</html>
