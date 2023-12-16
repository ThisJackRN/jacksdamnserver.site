<!DOCTYPE html>
<?php
define('Navbar', TRUE);
include('navbar.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="games.css">
    <title>The Flash Games Folder</title>
</head>
<body>

<?php
// Specify the path to the /flash/games folder
$folderPath = '/flash/Games';

// Get all subdirectories in the /flash/games folder with .swf files
$folders = array_filter(glob($folderPath . '/*'), function ($dir) {
    $result = is_dir($dir) && count(glob($dir . '/*.swf')) > 0;
    if (!$result) {
        echo 'Error reading directory: ' . $dir . '<br>';
    }
    return $result;
});


// Create a custom sorting function
function compareFolders($folder1, $folder2)
{
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

        // Get the full SWF file name
        $swfFiles = glob($folder . '/*.swf');
        $swfFileName = !empty($swfFiles) ? basename($swfFiles[0]) : '';

        // Display the link to the folder's webpage with the /flash/games/ prefix, an icon, and the game name
        echo '<div class="game-item">';
        echo '<a href="javascript:void(0);" onclick="loadGame(\'' . $folderName . '\', \'' . $gameName . '\', \'' . $swfFileName . '\')">';
        echo '<div class="game-icon-wrapper">';
        echo '<img src="' . getIconSrc($folder) . '" alt="' . $gameName . '">';
        echo '</div>';
        echo '<div class="game-name">' . $gameName . '</div>';
        echo '</a>';
        echo '</div>';

    }
    echo '</div>';
} else {
    echo '<p>No folders found in the /flash/games directory.</p>';
    echo 'FolderPath: ' . $folderPath . '<br>';
    print_r($folders);
}

// Function to get the first icon file or use a default if none found
function getIconSrc($folder) {
    $iconFiles = glob($folder . '/*.{ico,png,svg,gif}', GLOB_BRACE);
    return !empty($iconFiles) ? $iconFiles[0] : 'default.png';
}
?>

<!-- Your script tags -->
<script>
    function loadGame(folderName, gameName, swfFileName) {
        window.location.href = `./flash/index.php?folder=${encodeURIComponent(folderName)}&game=${encodeURIComponent(swfFileName)}`;
    }
</script>


</body>
</html>
