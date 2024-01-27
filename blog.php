<?php
define('Navbar', TRUE);
include('navbar.php');
function displayAllBlogPosts() {
    // Read blog posts from a file (you can replace this with a database)
    $posts = file_get_contents('blog_posts.txt');

    // Display each blog post with delete button
    $postsArray = explode("\n", $posts);

    // Reverse the order of the posts
    $postsArray = array_reverse($postsArray);

    for ($i = 0; $i < count($postsArray); $i++) {
        $post = $postsArray[$i];
        if (!empty($post)) {
            // Decode HTML entities in the post body
            $post = html_entity_decode($post);

            echo "<div class='blog-post'>$post</div><br>";
        }
    }
}


?>
    <style>
        .container {
            background-color: #6c757d;
            border: 1px solid #d3d9df;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .blog-post {
            border: 1px solid #ced4da;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #6c757d;
        }

        label {
            font-weight: bold;
            color: #007bff;
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
<h2 class="mt-4">All Blog Posts</h2>
        <?php
        // Display all blog posts
        displayAllBlogPosts();
        ?>