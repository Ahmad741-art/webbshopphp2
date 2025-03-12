<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION['username'];
?>
<a href="logout.php">Logout</a>
