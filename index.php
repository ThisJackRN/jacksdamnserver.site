

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JacksDamnServer.site</title>
</head>
<style>
    /* Added styles for the latest blog post */
.blog-post {
    border: 1px solid #ced4da;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    background-color: #6c757d;
    word-wrap: break-word; /* Added to handle long words in the post */
}

/* Adjusted margin for better spacing */
.mt-4 {
    margin-top: 20px;
}

</style>
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
        <h2 class="mb-3">Latest Update Post</h2>

        <?php
    // Function to get and display the latest blog post
    function displayLatestBlogPost() {
        // Read the content of the 'blog_posts.txt' file
        $posts = file('blog_posts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        // Get the last item in the array (latest post)
        $latestPost = end($posts);
    
        if (!empty($latestPost)) {
            // Decode HTML entities in the latest post body
            $latestPost = html_entity_decode($latestPost);
        
            echo "<div class='blog-post'>$latestPost</div><br>";
        }
    }
    
    // Display the latest blog post
    displayLatestBlogPost();
    ?>

    </div>

</body>

</html>
