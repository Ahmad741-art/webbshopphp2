<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION['username'];
?>

<!-- Include header -->
<?php include 'header.php'; ?>

<a href="logout.php">Logout</a>
