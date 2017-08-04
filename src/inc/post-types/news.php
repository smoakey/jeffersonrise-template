<?php
define('news_posts_per_page', 10);

add_action('init', 'create_news_post_type');
add_action('pre_get_posts', 'set_news_posts_per_page');
add_action('pre_get_posts', 'set_news_posts_request_filters');
add_action('rest_api_init', 'add_fields_to_rest_api');

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
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title'],
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => [
            'slug' => 'about-us/news'
        ],
    ]);
}

// wordpress is dumb. it uses the main "post" type setting to decide if a page exists for the paged=# param
function set_news_posts_per_page($query) {
    if($query->is_main_query() && !is_admin() && is_post_type_archive('news')) {
        $query->set('posts_per_page', news_posts_per_page);
    }
    return $query;
}

function set_news_posts_request_filters($query) {
    if($query->get('post_type') == 'news' && !is_admin() && isset($_GET['date'])) {
        $query->set('meta_query', [
            ['key' => 'news_date', 'value' => $_GET['date'], 'compare' => '=']
        ]);
    }
    return $query;
}

function add_fields_to_rest_api() {
    register_rest_field('news', 'meta', array(
        'get_callback' => 'get_news_meta',
        'schema' => null,
    ));
}

function get_news_meta($newsItem) {
    return [
        'date' => get_field('news_date', $newsItem->id)
    ];
}