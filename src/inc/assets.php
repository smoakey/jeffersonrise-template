<?php
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/bundle.js', [], 1.0, false);
}