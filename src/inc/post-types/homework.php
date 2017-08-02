<?php
define('homework_posts_per_page', 100);

add_action('init', 'create_homework_post_type');
add_filter('manage_homework_posts_columns', 'add_homework_post_column');
add_action('manage_homework_posts_custom_column', 'add_homework_post_column_content', 10, 2);
add_filter( 'page_row_actions', 'homework_disable_quick_edit_and_view', 10, 2 );

// add_action('pre_get_posts', 'set_news_posts_per_page');
// add_action('pre_get_posts', 'set_news_posts_request_filters');
// add_action('rest_api_init', 'add_fields_to_rest_api');

function create_homework_post_type() {
    register_post_type('homework', [
        'labels' => [
            'name' => __('Homework'),
            'singular_name' => __('Homework'),
            'add_new_item' => __('Add Homework'),
            'edit_item' => __('Edit Homework'),
            'not_found' => __('No Homework Found'),
        ],
        'description' => 'Homework',
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => 'portal',
        'show_in_rest' => true,
        'supports' => [''],
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-admin-page'
    ]);
}

function add_homework_post_column($columns) {
    unset($columns['title']);
    unset($columns['date']);
    $columns['start_date'] = _('Start Date');
    return $columns;
}

function add_homework_post_column_content($column, $post_id) {
    switch($column)
    {
        default:
            echo get_field($column, $post_id);
    }
}

function homework_disable_quick_edit_and_view($actions = array(), $post = null) {
    if (!is_post_type_archive('homework')) {
        return $actions;
    }

    //Remove the Quick Edit link
    if (isset($actions['inline hide-if-no-js'])) {
        unset($actions['inline hide-if-no-js']);
        unset($actions['view']);
    }

    // Return the set of links without Quick Edit
    return $actions;
}

// // wordpress is dumb. it uses the main "post" type setting to decide if a page exists for the paged=# param
// function set_news_posts_per_page($query) {
//     if($query->is_main_query() && !is_admin() && is_post_type_archive('news')) {
//         $query->set('posts_per_page', news_posts_per_page);
//     }
//     return $query;
// }
//
// function set_news_posts_request_filters($query) {
//     if($query->get('post_type') == 'news' && !is_admin() && isset($_GET['date'])) {
//         $query->set('meta_query', [
//             ['key' => 'news_date', 'value' => $_GET['date'], 'compare' => '=']
//         ]);
//     }
//     return $query;
// }
//
// function add_fields_to_rest_api() {
//     register_rest_field('news', 'meta', array(
//         'get_callback' => 'get_news_meta',
//         'schema' => null,
//     ));
// }
//
// function get_news_meta($newsItem) {
//     return [
//         'date' => get_field('news_date', $newsItem->id)
//     ];
// }