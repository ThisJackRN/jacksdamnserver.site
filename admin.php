<?php
require __DIR__ . '/vendor/autoload.php'; // Include Composer autoloader

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $enteredPassword = trim($_POST['password']);

    // Get the stored password from the .env file
    $storedPassword = $_ENV['PASSWORD'];

    // Check if the entered password is correct
    if ($enteredPassword === $storedPassword) {
        // Password is correct, set custom identifier for admin
        session_start();
        $_SESSION['user_id'] = 'admin123'; // Custom admin identifier
        header('Location: panel.php');
        exit();
    } else {
        $errorMessage = 'Not correct stop trying bucko';
    }
}
?>

<!-- Your HTML for admin login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="post" action="admin.php">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
