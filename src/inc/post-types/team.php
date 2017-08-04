<?php
define('team_posts_per_page', 100);

add_action('init', 'create_team_post_type');
add_filter('manage_team_posts_columns', 'add_team_post_column');
add_action('manage_team_posts_custom_column', 'add_team_post_column_content', 10, 2);
add_action('admin_head', 'my_admin_column_width');
add_action('save_post', 'update_post_slug', 10, 3);
add_action('admin_notices', 'add_admin_notice');

function create_team_post_type() {
    register_post_type('team', [
        'labels' => [
            'name' => __('Team Members'),
            'singular_name' => __('Team Member'),
            'add_new_item' => __('Add New Team Member'),
            'edit_item' => __('Edit Team Member'),
            'not_found' => __('No Team Member Found'),
        ],
        'description' => 'Jefferson RISE Team Members',
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['slug','page-attributes'],
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-networking',
        'rewrite' => [
            'slug' => 'about-us/our-team'
        ],
    ]);
}

function set_team_posts_per_page($query) {
    if($query->is_main_query() && !is_admin() && is_post_type_archive('team')) {
        $query->set('posts_per_page', team_posts_per_page);
    }
    return $query;
}

function add_team_post_column($columns) {
    unset($columns['title']);
    unset($columns['date']);
    $columns['photo'] = _('Photo');
    $columns['name'] = _('Name');
    $columns['role'] = _('Role');
    return $columns;
}

function add_team_post_column_content($column, $post_id) {
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

function my_admin_column_width() {
    echo
        '<style type="text/css">
            .wp-admin.post-type-team .wp-list-table tbody td { vertical-align: middle; }
            .wp-admin.post-type-team .row-actions .inline { display: none; }
            .wp-admin.post-type-team .wp-list-table .column-photo { width: 140px; }
        </style>'
    ;
}

function update_post_slug($post_ID, $post, $update) {
    $name = get_field('name', $post_ID);
    $slug = strtolower(str_replace(' ', '-', $name));

    if ($post->post_type == 'team' && $post->post_name != $slug) {
        $post->post_title = $name;
        $post->post_name = $slug;
        $result = wp_update_post($post, true);
    }
}

function add_admin_notice() {
    $screen = get_current_screen();

    if ($screen->id != 'edit-team') {
        return;
    }

    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Tip!</strong> You can drag and drop team members to set the order you would like to see them on the "Team" page.</p>
    </div>';
}