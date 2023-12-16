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
// Specify the path to the /flash folder
$folderPath = 'flash';

// Get all HTML and PHP files in the /flash folder
$files = array_filter(glob($folderPath . '/*.{html,php}', GLOB_BRACE), 'is_file');

// Create a custom sorting function
function compareFiles($file1, $file2) {
  $file1Name = strtolower(trim($file1));
  $file2Name = strtolower(trim($file2));

  return strcmp($file1Name, $file2Name);
}

// Sort the files using the custom sorting function
usort($files, 'compareFiles');

// Display each file as a link with an icon and file name
if (!empty($files)) {
  echo '<div class="game-grid">';
  foreach ($files as $file) {
    // Get the file name
    $fileName = basename($file);

    // Use a default icon for files
    $iconSrc = 'default.png';

    // Display the link to the file's webpage with the /flash/ prefix, an icon, and the file name
    echo '<div class="game-item">';
    echo '<a href="./flash/' . $fileName . '">';
    echo '<div class="game-icon-wrapper">';
    echo '<img src="' . $iconSrc . '" alt="' . $fileName . '">';
    echo '</div>';
    echo '<div class="game-name">' . $fileName . '</div>';
    echo '</a>';
    echo '</div>';
  }
  echo '</div>';
} else {
  echo '<p>No HTML or PHP files found in the /flash directory.</p>';
}
?>

</body>
</html>
