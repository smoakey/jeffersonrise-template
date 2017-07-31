<?php
define('studentapp_posts_per_page', 100);

add_action('init', 'create_student_app_post_type');
add_filter('manage_student_app_posts_columns', 'add_student_app_post_column');
add_action('manage_student_app_posts_custom_column', 'add_student_app_post_column_content', 10, 2);

function create_student_app_post_type() {
    register_post_type('student_app', [
        'labels' => [
            'name' => __('Student Apps'),
            'singular_name' => __('Student App'),
            'add_new_item' => __('Add New Student App'),
            'edit_item' => __('Edit Student App'),
            'not_found' => __('No Student Apps Found'),
        ],
        'description' => 'Student Apps',
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => 'portal',
        'supports' => ['title']
    ]);
}

function add_student_app_post_column($columns) {
    unset($columns['date']);
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
    }
}