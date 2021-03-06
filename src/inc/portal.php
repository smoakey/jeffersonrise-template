<?php
add_action('template_redirect', 'portal_force_login');
add_filter('gal_user_new_role', 'portal_save_google_groups', 10, 5);
add_action('gal_user_loggedin', 'portal_save_google_photo', 10, 5);

if(function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Portal',
        'menu_slug' => 'portal',
        'icon_url' => 'dashicons-screenoptions',
        'position' => '4.4',
        'redirect' => false
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Meals',
        'menu_slug' => 'meal',
        'parent_slug' => 'portal'
    ]);
}

function portal_force_login() {
    global $post;
    $url = get_permalink($post);
    if (strrpos($url, 'portal') !== false && !is_user_logged_in()) {
        wp_safe_redirect(wp_login_url($url));
        exit();
    }
}

function portal_save_google_photo( $wp_user, $google_userinfo, $wp_userisnew, $google_client, $google_oauth2service ) {
    update_user_meta($wp_user->ID, 'user_avatar', $google_userinfo->picture);
}

function portal_save_google_groups($want_role, $user, $blogid, $is_user_member, $in_groups) {
    global $wpdb;

    $userId = $user->data->ID;
    $email = $user->data->user_email;

    // remove their email which comes back as a group
    if (isset($in_groups[$email])) {
        unset($in_groups[$email]);
    }

    // delete old groups
    $wpdb->query('DELETE FROM ' . $wpdb->prefix . 'user_googlegroups WHERE userid = ' . $userId);

    // insert user groups
    foreach ($in_groups as $group => $value) {
        $wpdb->insert($wpdb->prefix . 'user_googlegroups', array(
            'userid' => $userId,
            'group_name' => $group
        ));
    }

   return $want_role;
}