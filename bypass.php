<?php

define('MyConst', TRUE);
include('navbar.php'); 

// Specify the folder path to check for webpages
$folderPath = './bypass/';

// Function to get all HTML files in a folder and its subdirectories
function getHtmlFiles($folder) {
    $files = glob($folder . '*.html');
    foreach (glob($folder . '*', GLOB_ONLYDIR) as $subfolder) {
        $files = array_merge($files, getHtmlFiles($subfolder . '/'));
    }
    return $files;
}

// Get all HTML files in the specified folder and its subdirectories
$files = getHtmlFiles($folderPath);

// Check if any files are found
if (count($files) > 0) {
    // Organize files by folder
    $organizedFiles = [];
    foreach ($files as $file) {
        $folder = dirname($file);
        $fileName = basename($file);
        $organizedFiles[$folder][] = $fileName;
    }

    // Output the organized list
    echo '<h2>Webpages:</h2>';
    echo '<div style="text-align: center;">'; // Center the list
    foreach ($organizedFiles as $folder => $files) {
        // Remove index.html from under the link
        $folderLink = rtrim($folder, '/');
        echo '<h3><a href="' . $folderLink . '/">' . basename($folder) . '</a></h3>';
        echo '<ul>';
        foreach ($files as $file) {
            // Skip index.html in the list
            if ($file != 'index.html') {
                echo '<li><a href="' . $folderLink . '/' . $file . '">' . $file . '</a></li>';
            }
        }
        echo '</ul>';
    }
    echo '</div>';
} else {
    // Output a message if no webpages are found
    echo '<p>No bypasses :\'(</p>';
}
?>
