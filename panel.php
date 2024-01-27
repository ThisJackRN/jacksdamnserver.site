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
            echo "<div class='blog-post'>$post
                  <form method='post' action=''>
                      <input type='hidden' name='delete_post_index' value='$i'>
                      <button type='submit' name='delete_post' class='btn btn-danger btn-sm'>Delete Post</button>
                  </form>
                  </div><br>";
        }
    }
}

// Function to get and display the latest blog post
function displayLatestBlogPost() {
    // Read the last line from the blog_posts.txt file
    $latestPost = trim(`tail -n 1 blog_posts.txt`);

    if (!empty($latestPost)) {
        echo "<div class='blog-post'>$latestPost</div><br>";
    }
}

// Check if the form is submitted to add a new blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    // Get header and body content from the form
    $header = htmlspecialchars($_POST['header']);
    $body = htmlspecialchars($_POST['hidden_body']);

    // Format the blog post with time and date
    $postContent = "<h2>$header</h2><p>$body</p><p>Posted on " . date('F j, Y, g:i a') . " By Admin</p>\n";

    // Append the new post to the file
    file_put_contents('blog_posts.txt', $postContent, FILE_APPEND);
}

// Check if a specific post should be deleted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post'])) {
    $deleteIndex = $_POST['delete_post_index'];

    // Read existing posts
    $posts = file_get_contents('blog_posts.txt');
    $postsArray = explode("\n", $posts);

    // Remove the selected post
    if (isset($postsArray[$deleteIndex])) {
        unset($postsArray[$deleteIndex]);

        // Save the updated posts to the file
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
        /* Add your custom styles here */
        body {
            padding: 20px;
            font-family: 'Arial', sans-serif; /* Add your custom font-family */
            background-color: #f8f9fa; /* Light gray background color */
            color: #343a40; /* Dark gray text color */
        }
        .container {
            background-color: #ffffff; /* White background for container */
            border: 1px solid #d3d9df; /* Light border color */
            border-radius: 8px; /* Rounded corners */
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light box shadow */
        }
        h1, h2 {
            color: #007bff; /* Blue heading color */
        }
        p {
            font-size: 18px; /* Larger font size for paragraphs */
            font-weight: bold; /* Bold text for paragraphs */
        }
        .blog-post {
            border: 1px solid #ced4da; /* Light border color for blog posts */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px; /* Rounded corners for blog posts */
            background-color: #ffffff; /* White background for blog posts */
        }
        label {
            font-weight: bold; /* Make labels bold */
            color: #007bff; /* Blue label color */
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ced4da; /* Light border color for input fields */
            border-radius: 4px;
            font-family: 'Arial', sans-serif; /* Add your custom font-family */
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px; /* Larger font size for buttons */
            font-weight: bold; /* Bold text for buttons */
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
            background-color: #343a40; /* Dark gray background color for bottom bar */
            color: #ffffff; /* White text color for bottom bar */
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to the Admin Panel</h1>
        <p>This has no use. Come back to hack a different day.</p>

        <form method="post" action="" id="blogPostForm">
            <label for="header">Post Header:</label>
            <input type="text" id="header" name="header" class="form-control" required><br>

            <label for="body">Post Body:</label>
            <div contenteditable="true" id="body" class="form-control" style="border: 1px solid #ced4da; border-radius: 4px; padding: 10px;" required></div><br>

            <!-- Hidden input to store contenteditable div content -->
            <input type="hidden" id="hidden_body" name="hidden_body">

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
        function setHiddenBody() {
            var bodyContent = document.getElementById('body').innerHTML;
            document.getElementById('hidden_body').value = bodyContent;
        }
    </script>
</body>

</html>
