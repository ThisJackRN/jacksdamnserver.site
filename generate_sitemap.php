<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

function generateSitemap($directory) {
    $lastSitemapUpdate = file_exists('sitemap.xml') ? filemtime('sitemap.xml') : 0;
    $latestHtmlFileUpdate = getLatestHtmlFileUpdate($directory);

    if ($latestHtmlFileUpdate > $lastSitemapUpdate) {
        updateSitemap($directory);
    }
}

function updateSitemap($directory) {
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    $htmlFiles = findHtmlFiles($directory);

    if ($htmlFiles === false) {
        error_log('Error reading HTML files.');
        return;
    }

    foreach ($htmlFiles as $htmlFile) {
        $relativePath = getRelativePath($directory, $htmlFile);
        $relativePath = str_replace('\\', '/', $relativePath); // Replace backslashes with forward slashes
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

function findHtmlFiles($directory) {
    $htmlFiles = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'html') {
            $htmlFiles[] = $file->getPathname();
        }
    }

    return $htmlFiles;
}

function getRelativePath($directory, $file) {
    return '/' . ltrim(str_replace(DIRECTORY_SEPARATOR, '/', substr($file, strlen($directory))), '/');
}

function getLatestHtmlFileUpdate($directory) {
    $latestUpdate = 0;
    $htmlFiles = findHtmlFiles($directory);

    foreach ($htmlFiles as $htmlFile) {
        $fileUpdate = filemtime($htmlFile);
        $latestUpdate = max($latestUpdate, $fileUpdate);
    }

    return $latestUpdate;
}

$directory = __DIR__; // Current directory where the script is located

generateSitemap($directory);
?>
