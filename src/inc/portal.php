<?php
add_action('template_redirect', 'portal_force_login');
// add_filter('page_template', 'portal_use_portal_template');
add_filter('gal_user_new_role', 'portal_save_google_groups', 10, 5);
add_action('gal_user_loggedin', 'portal_save_google_photo', 10, 5);

function portal_force_login() {
    global $post;
    $url = get_permalink($post);
    if (strrpos($url, 'portal') !== false && !is_user_logged_in()) {
        wp_safe_redirect(wp_login_url($url));
        exit();
    }
}

function portal_save_google_photo( $wp_user, $google_userinfo, $wp_userisnew, $google_client, $google_oauth2service ) {
    update_user_meta( $wp_user->ID, 'user_avatar', $google_userinfo->picture );
}

function portal_save_google_groups($want_role, $user, $blogid, $is_user_member, $in_groups) {

    // echo '<pre>';
    // print_r($user);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($in_groups);
    // echo '</pre>';
    //
    // die();


   return $want_role;
}