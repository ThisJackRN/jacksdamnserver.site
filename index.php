

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

    <div class="container mt-4">
        <h2 class="mb-3">Latest Blog Post</h2>

        <?php
        // Function to get and display the latest blog post
        function displayLatestBlogPost() {
            // Read the last line from the blog_posts.txt file
            $latestPost = trim(`tail -n 1 blog_posts.txt`);

            if (!empty($latestPost)) {
                echo "<div class='blog-post'>$latestPost</div><br>";
            }
        }

        // Display the latest blog post
        displayLatestBlogPost();
        ?>
    </div>

</body>

</html>
