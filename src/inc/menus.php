<?php
add_action('after_setup_theme', 'register_portal_menu');

function register_portal_menu() {
    register_nav_menu('portal', null);
}