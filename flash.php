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
// Function to get folders and display game links
function displayGameLinks($folderPath) {
  $folders = array_filter(glob($folderPath . '/*'), 'is_dir');

  // Use a unique function name based on the folder path
  $compareFunction = function ($folder1, $folder2) {
    $folder1Name = strtolower(trim($folder1));
    $folder2Name = strtolower(trim($folder2));

    return strcmp($folder1Name, $folder2Name);
  };

  usort($folders, $compareFunction);

  if (!empty($folders)) {
    echo '<div class="game-grid">';
    foreach ($folders as $folder) {
      $folderName = basename($folder);
      $gameNameFile = $folder . '/game_name.txt';

      if (file_exists($gameNameFile)) {
        $gameName = trim(file_get_contents($gameNameFile));
      } else {
        $gameName = $folderName;
      }

      $iconFiles = glob($folder . '/*.{ico,png,svg,gif}', GLOB_BRACE);
      $iconSrc = !empty($iconFiles) ? $iconFiles[0] : 'default.png';

      echo '<div class="game-item">';
      echo '<a href="./flash/' . $folderName . '">';
      echo '<div class="game-icon-wrapper">';
      echo '<img src="' . $iconSrc . '" alt="' . $gameName . '">';
      echo '</div>';
      echo '<div class="game-name">' . $gameName . '</div>';
      echo '</a>';
      echo '</div>';
    }
    echo '</div>';
  } else {
    echo '<p>No folders found in the ' . $folderPath . ' directory.</p>';
  }
}

// Display links for the 'flash' folder
displayGameLinks('flash');
?>

</body>
</html>
