<?php

// Function to increment and retrieve the visitor count
function incrementVisitorCount() {
    $countFile = 'visitor_count.json';

    // Check if the count file exists
    if (file_exists($countFile)) {
        // Read the current count from the file
        $countData = json_decode(file_get_contents($countFile), true);

        // Increment the count
        $countData['count']++;

        // Save the updated count back to the file
        file_put_contents($countFile, json_encode($countData));
    } else {
        // If the file doesn't exist, create it with an initial count of 1
        $countData = ['count' => 1];
        file_put_contents($countFile, json_encode($countData));
    }

    // Return the current count
    return $countData['count'];
}

// Increment the visitor count and get the updated count
$visitorCount = incrementVisitorCount();

// Now, you can use $visitorCount in your HTML or wherever you want to display the count
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JacksDamnServer.site</title>
</head>

<body>
    <?php
    // Include the navbar
    define('Navbar', TRUE);
    include('navbar.php');
    ?>

    <h1>WELCOME TO JACKSDAMNSERVER.SITE</h1>
    <h2>FILLED WITH UNBLOCKED GAMES AND MORE</h2>
    <div class="d-flex justify-content-center">
    <p>Total Visitors: <?php echo $visitorCount; ?> &lt;3</p>
    </div>
    <div class="d-flex justify-content-center">
        <a href="games.php" class="btn btn-primary">Enter!</a>
    </div>

    
</body>

</html>
