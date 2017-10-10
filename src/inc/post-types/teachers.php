<?php
define('teachers_posts_per_page', 100);

add_action('init', 'create_teacher_post_type');
add_filter('manage_teacher_posts_columns', 'add_teacher_post_column');
add_action('manage_teacher_posts_custom_column', 'add_teacher_post_column_content', 10, 2);
add_action('admin_notices', 'add_teacher_admin_notice');

function create_teacher_post_type() {
    register_post_type('teacher', [
        'labels' => [
            'name' => __('Teachers'),
            'singular_name' => __('Teacher'),
            'add_new_item' => __('Add Teacher'),
            'edit_item' => __('Edit Teacher'),
            'not_found' => __('No Teachers Found'),
        ],
        'description' => 'Teachers',
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => 'portal',
        'supports' => ['']
    ]);
}

function add_teacher_post_column($columns) {
    unset($columns['title']);
    unset($columns['date']);
    $columns['photo'] = _('Photo');
    $columns['name'] = _('Name');
    $columns['email'] = _('Email');
    return $columns;
}

function add_teacher_post_column_content($column, $post_id) {
    switch($column)
    {
        case 'photo':
            $image = get_field($column, $post_id);
            echo '<img src="' . $image . '" width="100" />';
            break;
        default:
            echo get_field($column, $post_id);
    }
}

function add_teacher_admin_notice() {
    $screen = get_current_screen();

    if ($screen->id != 'edit-teacher') {
        return;
    }

    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Tip!</strong> You can drag and drop teachers to set the order you would like to see them on the "Teachers" page in the Portal.</p>
    </div>';
}