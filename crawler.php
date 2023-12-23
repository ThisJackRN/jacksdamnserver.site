<?php

function get_all_links($url) {
    $html = file_get_contents($url);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);

    $links = array();

    foreach ($dom->getElementsByTagName('a') as $link) {
        $href = $link->getAttribute('href');
        $full_url = $url . $href; // Assuming relative URLs are used
        $links[] = $full_url;
    }

    return $links;
}

function crawl_site($start_url, $max_depth = 3) {
    $visited = array();
    $queue = array(array($start_url, 1));

    while ($queue) {
        list($current_url, $depth) = array_shift($queue);

        if (!in_array($current_url, $visited) && $depth <= $max_depth) {
            echo "Crawling $current_url\n";
            $links = get_all_links($current_url);
            $visited[] = $current_url;

            foreach ($links as $link) {
                $queue[] = array($link, $depth + 1);
            }
        }
    }

    return $visited;
}

// Example usage
$start_url = "https://localhost";
$max_depth = 3;
$all_links = crawl_site($start_url, $max_depth);

// Print all the links
foreach ($all_links as $link) {
    echo "$link\n";
}

?>
