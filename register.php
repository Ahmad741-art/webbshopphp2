<?php
include 'connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];  // Select Admin or Customer

    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form action="" method="post">
    <input type="text" name="username" required placeholder="Enter Username">
    <input type="email" name="email" required placeholder="Enter Email">
    <input type="password" name="password" required placeholder="Enter Password">
    <select name="role">
        <option value="customer">Customer</option>
        <option value="admin">Admin</option>
    </select>
    <input type="submit" name="register" value="Register">
</form>
