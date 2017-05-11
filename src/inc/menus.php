<?php
add_action('after_setup_theme', 'register_portal_menu');
add_action('admin_menu', 'add_admin_menu');

function register_portal_menu() {
    register_nav_menu('portal', __('Portal Menu'));
}

function add_admin_menu() {
    add_menu_page('Portal', 'Portal', 'manage_options', 'portal', '', 'dashicons-screenoptions', 4);
}
