<?php
// Create a new XML document
$xml = new DomDocument('1.0', 'UTF-8');

// Create the root element <urlset>
$urlset = $xml->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

// Set the base URL of your website
$baseURL = 'https://jacksdamnserver.site/';

// Get all files and directories in the current directory (excluding dot files)
$files = array_diff(scandir('.'), array('..', '.'));

// Loop through each file and create <url> elements
foreach ($files as $file) {
    // Ignore non-PHP files (you can customize this condition based on your needs)
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $urlElement = $xml->createElement('url');

        // Create <loc> element and add URL
        $locElement = $xml->createElement('loc', $baseURL . '/' . $file);
        $urlElement->appendChild($locElement);

        // You can add other optional elements like lastmod and changefreq here
        // Example:
        // $lastmodElement = $xml->createElement('lastmod', date('Y-m-d'));
        // $urlElement->appendChild($lastmodElement);

        // Append the <url> element to <urlset>
        $urlset->appendChild($urlElement);
    }
}

// Append the <urlset> element to the XML document
$xml->appendChild($urlset);

// Save the XML document to a file
$xml->save('sitemap.xml');

echo 'Sitemap generated successfully.';
?>
