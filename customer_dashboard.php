<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit;
}
?>

<!-- Include header -->
<?php include 'header.php'; ?>

<!-- Welcome Section Styled -->
<div style="
    background-color: #f1f1f1;
    padding: 20px;
    margin: 20px;
    border-radius: 8px;
    font-size: 22px;
    color: #333;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-align: center;
">
    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
</div>

<!-- Logout Button Styled and Right Aligned -->
<div style="text-align: right; margin: 20px;">
    <a href="logout.php" style="
        padding: 10px 20px;
        background-color: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    ">Logout</a>
</div>
