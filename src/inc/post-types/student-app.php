<?php
define('studentapp_posts_per_page', 100);

add_action('init', 'create_student_app_post_type');
add_filter('manage_student_app_posts_columns', 'add_student_app_post_column');
add_action('manage_student_app_posts_custom_column', 'add_student_app_post_column_content', 10, 2);
add_action('admin_notices', 'add_student_app_admin_notice');

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

function add_student_app_admin_notice() {
    $screen = get_current_screen();

    if ($screen->id != 'edit-student_app') {
        return;
    }

    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Tip!</strong> You can drag and drop apps to set the order you would like to see them on the "Apps" page. The first three are displayed on the dashboard page.</p>
    </div>';
}