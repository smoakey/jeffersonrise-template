<?php
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_scripts() {
    global $post;

    $bundle = 'portal';
    $base = 'http://localhost:3001';
    $base_local = get_template_directory();

    $url = get_current_page_url();
    if (strrpos($url, 'portal') === false
        && strrpos($url, 'product') === false) {
        $bundle = 'web';
        wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/9933c8a108.js', [], 1.0, true);
    }

    if ($_SERVER['SERVER_NAME'] != 'localhost') {
        $base = get_template_directory_uri();

        $file = "/dist/$bundle.min.css";
        wp_enqueue_style('bundle_css', $base . $file, [], @filemtime($base_local.$file));
    }

    $file = "/dist/$bundle.min.js";
    wp_enqueue_script('bundle', $base.$file, [], @filemtime($base_local.$file), true);
}