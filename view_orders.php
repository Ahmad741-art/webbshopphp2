<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');  // Redirect non-admins to login
    exit();
}
?>

<!-- Including PHP logic - Connecting to Database -->
<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ORDERS</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Container -->
    <div class="container">
        <section class="display_product">
            <?php
            // Query to get products from the database
            $display_product = mysqli_query($conn, "SELECT * FROM orders");

            if (mysqli_num_rows($display_product) > 0) {
                echo "
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Payment Method</th>
                            <th>Products</th>
                            <th>Total Price</th>
                            <th>Order Date</th>

                        </tr>
                    </thead>
                    <tbody>";

                // Fetch data from the database and display it
                $num = 1;
                while ($row = mysqli_fetch_assoc($display_product)) {
                    ?>
                    <!-- Display table rows -->
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($row['products']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($row['order_date']); ?></td>



                        <td>
                            <a href="delete.php?delete=<?php echo $row['id']; ?>" class="delete_product_btn" onclick="return confirm('Are you sure you want to delete this product?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="update.php?edit=<?php echo $row['id']; ?>" class="update_product_btn">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $num++;
                }
                echo "
                    </tbody>
                </table>";
            } else {
                echo "<div class='empty_text'>No products available</div>";
            }
            ?>
        </section>
    </div>

</body>
</html>
