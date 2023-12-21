<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Game</title>
    <link rel="stylesheet" href="../flash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>


    <?php
        define('Navbar', TRUE);
        include('../navbar.php');
    ?>

<div id="container" class="container-game"></div>

<script>
    window.RufflePlayer = window.RufflePlayer || {};
    window.addEventListener("load", (event) => {
        const ruffle = window.RufflePlayer.newest();
        const player = ruffle.createPlayer();
        const container = document.getElementById("container");

        if (container) {
            container.appendChild(player);

            // Get the folder and game names from the URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const folderName = urlParams.get('folder');
            const gameName = urlParams.get('game');

            if (folderName && gameName) {
                // Display the game name for UI
                document.title = gameName;

                // Load the SWF file directly
                player.load(`./games/${folderName}/${gameName}`);
            } else {
                console.error("Folder name or game name not provided in the URL parameters.");
            }
        } else {
            console.error("Container not found");
        }
    });
</script>

<script src="./!Ruffles/ruffle.js"></script>

</body>
</html>
