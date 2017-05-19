<?php
add_action('init', 'create_news_post_type');

function create_news_post_type() {
    register_post_type('news', [
        'labels' => [
            'name' => __('News & Events'),
            'singular_name' => __('News/Event'),
            'add_new_item' => __('Add News/Event Item'),
            'edit_item' => __('Edit News/Event Item'),
            'not_found' => __('No News/Event Items Found'),
        ],
        'description' => 'News and events',
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-calendar-alt'
    ]);
}