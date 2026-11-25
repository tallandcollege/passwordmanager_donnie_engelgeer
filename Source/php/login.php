<?php
require_once 'db.php';
session_start();

$loginCheck = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $stmt = $pdo->prepare('SELECT * FROM hoofdwachtwoorden WHERE wachtwoord = ? LIMIT 1');
    $stmt->execute([$_POST['password'] ?? '']);
    $row = $stmt->fetch();

    if ($row) {
        $loginCheck = true;
    }
}

if ($loginCheck) {
    $_SESSION['logged_in'] = true;

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWmanager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>PWmanager</h1>
    <form action="login.php" method="POST">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
