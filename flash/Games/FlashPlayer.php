<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Player</title>
</head>

<body>

    <div id="container"></div>

    <script>
        window.RufflePlayer = window.RufflePlayer || {};

        window.addEventListener("DOMContentLoaded", () => {
            let ruffle = window.RufflePlayer.newest();
            let player = ruffle.createPlayer();
            let container = document.getElementById("container");
            container.appendChild(player);

            // Get the file path from the URL parameter
            let filePath = "<?php echo isset($_GET['game']) ? htmlspecialchars($_GET['game']) : 'default.swf'; ?>";

            // Load the specified Flash game
            player.load(filePath);
        });
    </script>
    <script src="../ruffle.js"></script>

</body>

</html>
