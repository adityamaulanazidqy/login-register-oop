<?php
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($username, $email, $password)) {
        echo "Registrasi berhasil! Silakan login.";
    } else {
        echo "Registrasi gagal. Username atau email mungkin sudah terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <button type="submit"><a href="register.php">Register</a></button>
</body>

</html>