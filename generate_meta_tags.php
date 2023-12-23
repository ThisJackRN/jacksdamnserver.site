<?php
// Function to scan subfolders and get game names
function getGameNames($folderPath) {
    $gameNames = [];

    $subfolders = glob($folderPath . '/*', GLOB_ONLYDIR);

    foreach ($subfolders as $subfolder) {
        $gameNames[] = basename($subfolder);
    }

    return $gameNames;
}

// Get game names for HTML5 games
$html5GameNames = getGameNames('./games');

// Get game names for Flash games
$flashGameNames = getGameNames('./flash/games');

// Combine all game names into keywords
$allGameNames = array_merge($html5GameNames, $flashGameNames);
$metaKeywords = implode(', ', $allGameNames);

// Set the page title
$pageTitle = "Jack's Damn Games";

// Output meta keywords tag
echo '<meta name="keywords" content="' . htmlspecialchars($metaKeywords) . '">';
?>
