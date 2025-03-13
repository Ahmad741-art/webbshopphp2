<?php
session_start();
include 'connect.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];
       // echo $user['role'];
       //sleep(3);
        if ($user['role'] === 'admin') {
           header('Location: admin_dashboard.php');
        } else {
            header('Location: customer_dashboard.php');
        }
    } else {
        echo "Invalid email or password";
    }
}
?>

<form action="" method="post">
    <input type="email" name="email" required placeholder="Enter Email">
    <input type="password" name="password" required placeholder="Enter Password">
    <input type="submit" name="login" value="Login">
</form>
