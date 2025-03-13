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
    <title>View Products</title>
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
            $display_product = mysqli_query($conn, "SELECT * FROM products");

            if (mysqli_num_rows($display_product) > 0) {
                echo "
                <table>
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                // Fetch data from the database and display it
                $num = 1;
                while ($row = mysqli_fetch_assoc($display_product)) {
                    ?>
                    <!-- Display table rows -->
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px;"></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
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
