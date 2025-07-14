<?php
// Only run on frontend, not admin
if (is_admin()) return;

$rules = [];
$paths = [];

// 1. Add all published page slugs
$pages = get_pages(['post_status' => 'publish']);
foreach ($pages as $page) {
    $url = get_permalink($page->ID);
    $path = wp_parse_url($url, PHP_URL_PATH);
    if ($path && !in_array($path, ['/wp-login.php', '/checkout', '/my-account'])) {
        $paths[] = trailingslashit($path);
    }
}

// 2. WooCommerce pages
if (class_exists('WooCommerce')) {
    $shop_url = get_permalink(wc_get_page_id('shop'));
    if ($shop_url) {
        $paths[] = trailingslashit(wp_parse_url($shop_url, PHP_URL_PATH));
    }

    $product_categories = get_terms(['taxonomy' => 'p', 'hide_empty' => true]);
    foreach ($product_categories as $cat) {
        $url = get_term_link($cat);
        if (!is_wp_error($url)) {
            $paths[] = trailingslashit(wp_parse_url($url, PHP_URL_PATH));
        }
    }
}

// Remove duplicates
$paths = array_unique($paths);

// Build the rules array
foreach ($paths as $path) {
    $rules[] = [
        'source'  => 'document',
        'action'  => 'prerender ',
        'pattern' => [
            'type'  => 'prefix',
            'value' => $path
        ]
    ];
}

// Output the script tag
if (!empty($rules)) {
    echo '<script type="speculationrules">' . "\n";
    echo json_encode(['prerender' => $rules], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}
