<?php
include 'config.php'; // Menggunakan file konfigurasi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $hashed_password);
    $stmt->execute();

    echo 'User added successfully';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <h1>Add New User</h1>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Add User">
    </form>
</body>
</html>
