<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Start or resume the session
session_start();


// Get the password from the environment variables
$correctPassword = $_ENV['PASSWORD'] ?? '';

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    include('admin_panel.php'); // Display admin panel if logged in
    exit();
}

// Check if the provided password matches the correct password
$userPassword = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($userPassword === $correctPassword) {
        // Set session variable to indicate the user is logged in
        $_SESSION['logged_in'] = true;

        // Redirect to avoid resubmitting form data on page refresh
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo 'Password is incorrect!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password System</title>
</head>
<body>
    <form method="post">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
