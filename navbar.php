<?php
function incrementVisitorCount() {
    $countFile = 'visitor_count.json';
    $cookieName = 'visitor_count_cookie';

    try {
        // Read the current count from the file or create it if it doesn't exist
        if (file_exists($countFile)) {
            $countData = json_decode(file_get_contents($countFile), true);
        } else {
            $countData = ['count' => 0, 'highest' => 0];
        }

        // Check if the user already has a cookie
        if (!isset($_COOKIE[$cookieName])) {
            // Increment the count
            $countData['count']++;

            // Save the updated count back to the file only if it's higher
            if (!isset($countData['highest']) || $countData['count'] > $countData['highest']) {
                $countData['highest'] = $countData['count'];
            }

            // Save the updated count back to the file
            file_put_contents($countFile, json_encode($countData));

            // Set a cookie to prevent counting again for the same user
            setcookie($cookieName, 'visited', time() + 3600 * 24); // Cookie valid for 24 hours
        }
        
        // Return the current count
        return $countData['count'];
    } catch (Exception $e) {
        // Handle exceptions (e.g., file not found, permission issues)
        error_log('Error: ' . $e->getMessage());
        return 0; // Return a default value or handle the error as needed
    }
}

// Increment the visitor count and get the updated count
$visitorCount = incrementVisitorCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="
Dive into an expansive world of online gaming at Jack's Damn Games, your premier destination for an extensive array of free Flash and HTML5 games. Experience the perfect blend of nostalgia and innovation as you explore our diverse collection, featuring classic Flash games that transport you to the golden age of online gaming and cutting-edge HTML5 titles offering a seamless, modern gameplay experience.

At Jack's Damn Games, we take pride in curating a broad selection that caters to a variety of gaming preferences. Whether you're drawn to the simplicity and charm of retro Flash games or seeking the latest advancements in HTML5 technology, our platform is your one-stop-shop for gaming variety. Immerse yourself in a world of entertainment with genres spanning action, adventure, strategy, and puzzles, ensuring there's something for every gaming enthusiast.

What sets us apart is our commitment to a user-friendly experience. Navigate effortlessly through our platform, where there are no subscriptions or hidden fees – all our games are accessible for free, ensuring inclusive and high-quality gaming for everyone.

Stay engaged with regular updates as we continuously expand our library, introducing new and captivating games to keep you entertained. Relive the excitement of Flash gaming or embrace the future with HTML5 – Jack's Damn Games is your ultimate destination for a gaming experience that transcends boundaries. Join our dynamic gaming community and embark on a journey filled with challenge, excitement, and endless enjoyment. Welcome to the unparalleled realm of free Flash and HTML5 games at Jack's Damn Games!
Dive into an expansive world of online gaming at Jack's Damn Games, your premier destination for an extensive array of free Flash and HTML5 games. Experience the perfect blend of nostalgia and innovation as you explore our diverse collection, featuring classic Flash games that transport you to the golden age of online gaming and cutting-edge HTML5 titles offering a seamless, modern gameplay experience.

At Jack's Damn Games, we take pride in curating a broad selection that caters to a variety of gaming preferences. Whether you're drawn to the simplicity and charm of retro Flash games or seeking the latest advancements in HTML5 technology, our platform is your one-stop-shop for gaming variety. Immerse yourself in a world of entertainment with genres spanning action, adventure, strategy, and puzzles, ensuring there's something for every gaming enthusiast.

What sets us apart is our commitment to a user-friendly experience. Navigate effortlessly through our platform, where there are no subscriptions or hidden fees – all our games are accessible for free, ensuring inclusive and high-quality gaming for everyone.

Stay engaged with regular updates as we continuously expand our library, introducing new and captivating games to keep you entertained. Relive the excitement of Flash gaming or embrace the future with HTML5 – Jack's Damn Games is your ultimate destination for a gaming experience that transcends boundaries. Join our dynamic gaming community and embark on a journey filled with challenge, excitement, and endless enjoyment. Welcome to the unparalleled realm of free Flash and HTML5 games at Jack's Damn Games!">
    
    <!-- Dynamically generated keywords -->
    <?php include('generate_meta_tags.php'); ?>
    <?php include('generate_sitemap.php'); ?>
    <script async src="https://arc.io/widget.min.js#sMbCtF2L"></script>
    <title><?php echo $pageTitle; ?></title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9613339299215124"
     crossorigin="anonymous"></script>
</head>
<?php
if (!defined('Navbar')) {
   die('Why are you trying to see the navbar? <b>Dont do that again...</b>');
}
?>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="/style.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">JacksDamnServer.Site</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/games.php">Games</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/flash.php">Flash</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/blog.php">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/bypass.php">Bypass</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/WebRetro/index.html">Emulator</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact/Game Submission</a>
      </li>
    </ul>
  </div>
</nav>
<body>

</body>

