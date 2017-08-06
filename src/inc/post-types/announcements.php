<?php
add_action('init', 'create_announcement_post_type');
add_filter('manage_announcements_posts_columns', 'add_announcements_post_column');
add_action('manage_announcements_posts_custom_column', 'add_announcements_post_column_content', 10, 2);

function create_announcement_post_type() {
    register_post_type('announcements', [
        'labels' => [
            'name' => __('Announcements'),
            'singular_name' => __('Announcement'),
            'add_new_item' => __('Add Announcement'),
            'edit_item' => __('Edit Announcement'),
            'not_found' => __('No Announcements Found'),
        ],
        'description' => 'Announcements',
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => 'portal',
        'supports' => ['title'],
        'menu_icon' => 'dashicons-megaphone',
    ]);
}

function add_announcements_post_column($columns) {
    unset($columns['title']);
    unset($columns['date']);

    $columns['title'] = _('Title');
    $columns['link'] = _('Link');
    $columns['type'] = _('Type');
    $columns['start_date'] = _('Start Date');
    $columns['end_date'] = _('End Date');
    return $columns;
}

function add_announcements_post_column_content($column, $post_id) {
    switch($column)
    {
        case 'link':
            $link = get_field('link', $post_id);
            echo $link['url'];
            break;
        default:
            echo get_field($column, $post_id);
    }
}