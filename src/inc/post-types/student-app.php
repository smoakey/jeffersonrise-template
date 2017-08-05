<?php
define('studentapp_posts_per_page', 100);

add_action('init', 'create_student_app_post_type');
add_filter('manage_student_app_posts_columns', 'add_student_app_post_column');
add_action('manage_student_app_posts_custom_column', 'add_student_app_post_column_content', 10, 2);

function create_student_app_post_type() {
    register_post_type('student_app', [
        'labels' => [
            'name' => __('Apps'),
            'singular_name' => __('App'),
            'add_new_item' => __('Add New App'),
            'edit_item' => __('Edit App'),
            'not_found' => __('No Apps Found'),
        ],
        'description' => 'Apps',
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => 'portal',
        'supports' => ['title']
    ]);
}

function add_student_app_post_column($columns) {
    unset($columns['date']);
    $columns['caption'] = _('Caption');
    $columns['icon'] = _('Icon');
    $columns['link'] = _('Link');
    return $columns;
}

function add_student_app_post_column_content($column, $post_id) {
    switch($column)
    {
        case 'icon':
            $image = get_field($column, $post_id);
            echo '<img src="' . $image . '" width="50" />';
            break;
        case 'link':
            $link = get_field($column, $post_id);
            echo '<a target="_blank" href="' . $link . '">' . $link . '</a>';
            break;
        default:
            echo get_field($column, $post_id);
    }
}