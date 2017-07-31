<?php
add_action('login_head', 'add_login_stylesheet');

function add_login_stylesheet() {
    $base = 'http://localhost:3001';

    if ($_SERVER['SERVER_NAME'] != 'localhost') {
        $base = get_template_directory_uri();
        echo '<link rel="stylesheet" type="text/css" href="' . $base . "/dist/portal.min.css" . '"></script>';
    }

    echo '<script src="'. $base . "/dist/portal.min.js" . '"></script>';
}
