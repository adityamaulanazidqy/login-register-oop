<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>

<body>
    <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="logout.php">Logout</a>
</body>

</html>