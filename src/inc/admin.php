<?php
add_action('init','remove_default_login_redirect');

// remove /wp-admin redirect
function remove_default_login_redirect() {
    remove_action('template_redirect', 'wp_redirect_admin_locations', 1000);
}