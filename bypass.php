<?php

define('MyConst', TRUE);
include('navbar.php'); 

// Specify the folder path to check for webpages
$folderPath = './bypass/';

// Get all files in the folder with a .html extension
$files = glob($folderPath . '*.html');

// Check if any files are found
if (count($files) > 0) {
    // Sort the files alphabetically
    sort($files);

    // Output an ordered list of webpages
    echo '<h2>Webpages:</h2>';
    echo '<ol>';
    foreach ($files as $file) {
        $fileName = basename($file);
        echo '<li><a href="' . $file . '">' . $fileName . '</a></li>';
    }
    echo '</ol>';
} else {
    // Output a message if no webpages are found
    echo '<p>No bypasses :\'(</p>';
}
?>
