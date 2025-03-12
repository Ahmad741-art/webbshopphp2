<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');  // Redirect non-admins to login
    exit();
}
?>

<h1>Welcome Admin, <?php echo $_SESSION['username']; ?></h1>
<a href="view_products.php">Manage Products</a>
<a href="view_orders.php">View Orders</a>
<a href="logout.php">Logout</a>
