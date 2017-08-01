<?php
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/admin.php';
require_once __DIR__ . '/inc/customizer.php';
require_once __DIR__ . '/inc/menus.php';
require_once __DIR__ . '/inc/roles.php';
require_once __DIR__ . '/inc/woocommerce.php';

// Custom Post Types
require_once __DIR__ . '/inc/post-types/news.php';
require_once __DIR__ . '/inc/post-types/student-app.php';
require_once __DIR__ . '/inc/post-types/team.php';

// Portal Related functionality
require_once __DIR__ . '/inc/login.php';
require_once __DIR__ . '/inc/portal.php';

function get_current_user_role() {
    $current_user = wp_get_current_user();
    $user_data = get_userdata($current_user->ID);
    return current($user_data->roles);
}

function get_current_page_url() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    return str_replace(get_site_url(), '', $current_url);
}