<?php
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_scripts() {
    wp_enqueue_script('bundle', get_template_directory_uri() . '/bundle.js', [], 1.0, false);
    wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/9933c8a108.js', [], 1.0, false);
}