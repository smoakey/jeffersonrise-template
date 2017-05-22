<?php
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_scripts() {
    $base = $_SERVER['SERVER_NAME'] == 'localhost' ? 'http://localhost:3001' : get_template_directory_uri();

    wp_enqueue_script('bundle', $base . '/bundle.js', [], 1.0, false);
    wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/9933c8a108.js', [], 1.0, false);
}