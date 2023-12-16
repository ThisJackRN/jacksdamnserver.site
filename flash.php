<!DOCTYPE html>
<?php

define('Navbar', TRUE);
include('navbar.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="games.css">
  <title>The Flash Games Folder</title>
</head>

<body>

  <?php
  // Function to get the list of Flash games and icons
  function getFlashGamesAndIcons($folderPath)
  {
    $flashGames = array();

    // Get all subdirectories
    $folders = array_filter(glob($folderPath . '/*'), 'is_dir');

    // Create a custom sorting function
    function compareFolders($folder1, $folder2)
    {
      $folder1Name = strtolower(trim($folder1));
      $folder2Name = strtolower(trim($folder2));
      return strcmp($folder1Name, $folder2Name);
    }

    // Sort the folders using the custom sorting function
    usort($folders, 'compareFolders');

    // Iterate through each folder
    foreach ($folders as $folder) {
      $folderName = basename($folder);
      $flashGame = array();

      // Read the game name from the "game_name.txt" file
      $flashGameNameFile = $folder . '/game_name.txt';
      if (file_exists($flashGameNameFile)) {
        $flashGame['name'] = trim(file_get_contents($flashGameNameFile));
      } else {
        $flashGame['name'] = $folderName;
      }

      // Search for favicon and icon files in the folder
      $iconFiles = glob($folder . '/*.{ico,png,svg,gif}', GLOB_BRACE);

      // Get the first icon file or use a default if none found
      $flashGame['iconSrc'] = !empty($iconFiles) ? $iconFiles[0] : 'default.png';

      // Add the Flash game to the list
      $flashGames[] = $flashGame;
    }

    return $flashGames;
  }

  // Display Flash games
  // Display Flash games
  $flashGames = getFlashGamesAndIcons('flash/games');
  displayFlashGames($flashGames, 'flash/games/flashplayer.php?game=', 'flash-game-item');


  function displayFlashGames($flashGames, $linkPrefix, $itemClass = 'flash-game-item')
  {
    if (!empty($flashGames)) {
      echo "<div class='{$itemClass}-grid'>";
      foreach ($flashGames as $flashGame) {
        echo "<div class='{$itemClass}'>";
        echo "<a href='{$linkPrefix}{$flashGame['name']}'>";
        echo "<div class='{$itemClass}-icon-wrapper'>";
        echo "<img src='{$flashGame['iconSrc']}' alt='{$flashGame['name']}'>";
        echo "</div>";
        echo "<div class='{$itemClass}-name'>{$flashGame['name']}</div>";
        echo "</a>";
        echo "</div>";
      }
      echo "</div>";
    } else {
      echo '<p>No folders found.</p>';
    }
  }
  ?>

</body>

</html>
