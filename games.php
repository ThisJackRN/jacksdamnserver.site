<!DOCTYPE html>
<?php

    define('Navbar', TRUE);
    include('navbar.php');

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="games.css">
  <title>The Games Folder</title>
</head>
<body>

<?php
// Specify the path to the /games folder
$folderPath = 'games';

// Get all subdirectories in the /games folder
$folders = array_filter(glob($folderPath . '/*'), 'is_dir');

// Create a custom sorting function
function compareFolders($folder1, $folder2) {
  $folder1Name = strtolower(trim($folder1));
  $folder2Name = strtolower(trim($folder2));

  return strcmp($folder1Name, $folder2Name);
}

// Sort the folders using the custom sorting function
usort($folders, 'compareFolders');

// Display each folder as a link with an icon and game name
if (!empty($folders)) {
  echo '<div class="game-grid">';
  foreach ($folders as $folder) {
    // Get the folder name
    $folderName = basename($folder);

    // Read the game name from the "game_name.txt" file
    $gameNameFile = $folder . '/game_name.txt';
    if (file_exists($gameNameFile)) {
      $gameName = trim(file_get_contents($gameNameFile));
    } else {
      $gameName = $folderName;
    }

    // Search for favicon and icon files in the folder
    $iconFiles = glob($folder . '/*.{ico,png,svg,gif}', GLOB_BRACE);

    // Get the first icon file or use a default if none found
    $iconSrc = !empty($iconFiles) ? $iconFiles[0] : 'default.png';

    // Display the link to the folder's webpage with the /games/ prefix, an icon, and the game name
    echo '<div class="game-item">';
    echo '<a href="./games/' . $folderName . '">';
    echo '<div class="game-icon-wrapper">';
    echo '<img src="' . $iconSrc . '" alt="' . $gameName . '">';
    echo '</div>';
    echo '<div class="game-name">' . $gameName . '</div>';
    echo '</a>';
    echo '</div>';
  }
  echo '</div>';
} else {
  echo '<p>No folders found in the /games directory.</p>';
}
?>


</body>
</html>
