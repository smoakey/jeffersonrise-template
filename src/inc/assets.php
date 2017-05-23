<?php
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_scripts() {
    $base = 'http://localhost:3001';
    if ($_SERVER['SERVER_NAME'] != 'localhost') {
        $base = get_template_directory_uri();
        wp_enqueue_style('bundle_css', $base . '/dist/bundle.min.css');
    }

    wp_enqueue_script('bundle', $base . '/dist/bundle.min.js', [], 1.0, false);
    wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/9933c8a108.js', [], 1.0, false);
}