<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to home page or login page
    header('Location: index.php'); // Replace 'index.php' with your actual home page
    exit();
}

// Check if the user is the admin
$isAdmin = ($_SESSION['user_id'] === 'admin123');

if (!$isAdmin) {
    // Redirect non-admin users to a different page
    header('Location: index.php'); // Replace 'non_admin.php' with your desired page for non-admin users
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {
    // Clear any user-specific data or session variables
    session_unset();
    session_destroy();

    // Redirect to home page or any other desired location
    header('Location: index.php'); // Replace 'index.php' with your actual home page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Welcome to the Admin Panel</h1>
    <p>this has no use come back to hack a different day</p>

    <form method="post" action="">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
