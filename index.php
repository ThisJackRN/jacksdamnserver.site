

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
