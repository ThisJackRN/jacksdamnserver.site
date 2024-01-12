<?php
// admin.php

// Check if the form is submitted for logging out
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Clear any session data (you may want to perform additional logout actions)
    session_start();
    session_unset();
    session_destroy();

    // Redirect to prevent issues with refreshing the page after logout
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <h1>Welcome to the Admin Panel</h1>
        <p>Your admin content goes here.</p>

        <!-- Add the logout button -->
        <form method="post" action="admin.php">
            <button type="submit" class="btn btn-outline-danger" name="logout">Logout</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
