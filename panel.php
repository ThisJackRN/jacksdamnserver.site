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
    header('Location: index.php'); // Replace 'index.php' with your desired page for non-admin users
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

// Function to get and display all blog posts
function displayAllBlogPosts() {
    // Read blog posts from a file (you can replace this with a database)
    $posts = file_get_contents('blog_posts.txt');

    // Display each blog post with delete button
    $postsArray = explode("\n", $posts);
    for ($i = 0; $i < count($postsArray); $i++) {
        $post = $postsArray[$i];
        if (!empty($post)) {
            // Decode HTML entities in the post body
            $post = html_entity_decode($post);

            echo "<div class='blog-post'>$post
            <form method='post' action='".$_SERVER['PHP_SELF']."'>
                <input type='hidden' name='delete_post_index' value='$i'>
                <button type='submit' name='delete_post' class='btn btn-danger btn-sm'>Delete Post</button>
            </form>
        </div><br>";
        }
    }
}



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

// Check if the form is submitted to add a new blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    // Check if 'header' and 'hidden_header' are set in $_POST
    $header = isset($_POST['hidden_header']) ? $_POST['hidden_header'] : '';
    $body = $_POST['hidden_body'];

    // Set the timezone to Eastern Time (EST)
    date_default_timezone_set('America/New_York');
    
    // Format the blog post with time and date
    $postContent = "<h2>$header</h2><div class='blog-post-content'>$body</div><p>Posted on " . date('F j, Y, g:i a') . " By Admin</p>\n";


    // Append the new post to the file
    file_put_contents('blog_posts.txt', $postContent, FILE_APPEND);
}

// Check if the form is submitted to delete a blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post'])) {
    // Check if 'delete_post_index' is set in $_POST
    $deleteIndex = isset($_POST['delete_post_index']) ? intval($_POST['delete_post_index']) : -1;

    // Read existing blog posts
    $posts = file_get_contents('blog_posts.txt');

    // Separate each post into an array
    $postsArray = explode("\n", $posts);

    // Remove the post at the specified index
    if ($deleteIndex >= 0 && $deleteIndex < count($postsArray)) {
        unset($postsArray[$deleteIndex]);

        // Save the updated posts back to the file
        file_put_contents('blog_posts.txt', implode("\n", $postsArray));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #d3d9df;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #007bff;
        }

        p {
            font-size: 18px;
            font-weight: bold;
        }

        .blog-post {
            border: 1px solid #ced4da;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #ffffff;
        }

        label {
            font-weight: bold;
            color: #007bff;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-family: 'Arial', sans-serif;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px;
        }

        /* Added navigation bar styles */
        nav {
            background-color: #007bff;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        nav a {
            color: #fff;
            margin-right: 20px;
            font-weight: bold;
            text-decoration: none;
        }

        .styling-bar {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .styling-bar label {
            margin-right: 10px;
        }

        select, input[type="number"], input[type="color"] {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <!-- Add more navigation links as needed -->
    </nav>

    <div class="container">
        <h1>Welcome to the Admin Panel</h1>
        <p>I hope you are me because if not uh oh...</p>

        <div class="styling-bar">
            <label for="fontFamily">Font Family:</label>
            <select id="fontFamily" onchange="applyFontFamily(this.value)">
                <option value="Arial, sans-serif">Arial, sans-serif</option>
                <option value="Georgia, serif">Georgia, serif</option>
                <option value="'Times New Roman', Times, serif">Times New Roman, Times, serif</option>
                <!-- Add more font options as needed -->
            </select>
            <button type="button" onclick="applyAllSettings()">Apply All Settings</button>
            <label for="fontSize">Font Size:</label>
            <input type="number" id="fontSize" min="8" max="72" value="16" onchange="applyFontSize(this.value + 'px')">

            <label for="fontColor">Font Color:</label>
            <input type="color" id="fontColor" onchange="applyFontColor(this.value)">
        </div>

        <form method="post" action="" id="blogPostForm">
            <label for="header">Post Header:</label>
            <div contenteditable="true" id="header" name="header" class="form-control plaintext-only" style="border: 1px solid #ced4da; border-radius: 4px; padding: 10px; min-height: 50px;" required></div><br>

            <label for="body">Post Body:</label>
            <div contenteditable="true" id="body" name="body" class="form-control stretch-body" style="border: 1px solid #ced4da; border-radius: 4px; padding: 10px; min-height: 150px;" required></div><br>

            <!-- Hidden input to store contenteditable div content for the header -->
            <input type="hidden" id="hidden_header" name="hidden_header">

            <!-- Hidden input to store contenteditable div content for the body -->
            <input type="hidden" id="hidden_body" name="hidden_body">

            <button type="button" onclick="applyStyle('bold')">Bold</button>
            <button type="button" onclick="applyStyle('italic')">Italic</button>
            <button type="submit" name="submit_post" onclick="setHiddenBody()">Submit Post</button>
        </form>

        <form method="post" action="">
            <button type="submit" name="logout">Logout</button>
        </form>

        <h2 class="mt-4">All Blog Posts</h2>
        <?php
        // Display all blog posts
        displayAllBlogPosts();
        ?>

        <h2 class="mt-4">Latest Blog Post</h2>
        <?php
        // Display the latest blog post
        displayLatestBlogPost();
        ?>
    </div>
    <div class="bottom-bar">
        &copy; 2024 Admin Panel. All rights reserved.
    </div>

    <script>
    function logDeleteButton(index) {
        console.log("Delete button clicked for post index:", index);
    }
        function setHiddenBody() {
            var headerContent = document.getElementById('header').innerHTML;
            var bodyContent = document.getElementById('body').innerHTML;

            document.getElementById('hidden_header').value = headerContent;
            document.getElementById('hidden_body').value = bodyContent;
        }

        function applyStyle(style) {
            document.execCommand(style, false, null);
        }

        function applyFontFamily(fontFamily) {
            document.getElementById('body').style.fontFamily = fontFamily;
        }

        function applyFontSize(fontSize) {
            var selection = window.getSelection();
            if (selection.rangeCount > 0) {
                var range = selection.getRangeAt(0);
                var span = document.createElement("span");
                span.style.fontSize = fontSize;
                range.surroundContents(span);
            }
        }

        function applyFontColor(fontColor) {
            var selection = window.getSelection();
            if (selection.rangeCount > 0) {
                var range = selection.getRangeAt(0);
                var span = document.createElement("span");
                span.style.color = fontColor;
                range.surroundContents(span);
            }
        }

        function applyAllSettings() {
            var fontFamily = document.getElementById('fontFamily').value;
            var fontSize = document.getElementById('fontSize').value + 'px';
            var fontColor = document.getElementById('fontColor').value;

            applyFontFamily(fontFamily);
            applyFontSize(fontSize);
            applyFontColor(fontColor);
        }
    </script>

</body>

</html>
