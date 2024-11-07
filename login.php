<?php
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        session_start();
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['username'] = $loggedInUser['username'];
        header("location: welcome.php");
    } else {
        echo "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <button type="submit"><a href="register.php">Register</a></button>
</body>

</html>