<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

function generateSitemap($directory) {
    $lastSitemapUpdate = file_exists('sitemap.xml') ? filemtime('sitemap.xml') : 0;
    $latestFileUpdate = getLatestFileUpdate($directory);

    if ($latestFileUpdate > $lastSitemapUpdate) {
        updateSitemap($directory);
    }
}

function updateSitemap($directory) {
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    $files = findFiles($directory, ['html', 'php']);

    if ($files === false) {
        error_log('Error reading files.');
        return;
    }

    foreach ($files as $file) {
        $relativePath = getRelativePath($directory, $file);
        $sitemap .= '<url>' . PHP_EOL;
        $sitemap .= '  <loc>https://jacksdamnserver.site' . $relativePath . '</loc>' . PHP_EOL;
        $sitemap .= '</url>' . PHP_EOL;
    }

    $sitemap .= '</urlset>';

    if (file_put_contents('sitemap.xml', $sitemap) === false) {
        error_log('Error writing sitemap.xml.');
    } else {
        error_log('Sitemap generated successfully.');
    }
}

function findFiles($directory, $extensions) {
    $files = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), $extensions)) {
            $files[] = $file->getPathname();
        }
    }

    return $files;
}

function getRelativePath($directory, $file) {
    return '/' . ltrim(str_replace(DIRECTORY_SEPARATOR, '/', substr($file, strlen($directory))), '/');
}

function getLatestFileUpdate($directory) {
    $latestUpdate = 0;
    $files = findFiles($directory, ['html', 'php']);

    foreach ($files as $file) {
        $fileUpdate = filemtime($file);
        $latestUpdate = max($latestUpdate, $fileUpdate);
    }

    return $latestUpdate;
}

$directory = __DIR__; // Current directory where the script is located

generateSitemap($directory);
?>
