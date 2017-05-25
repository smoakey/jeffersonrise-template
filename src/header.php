<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>, <?php bloginfo('description'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="site-header">
            <div class="container">
                <h1><a title="Home" href="/">Jefferson RISE</a></h1>
                <a href="" class="menu-trigger">
                    <i class="fa fa-bars" aria-hidden="true"></i> Menu
                </a>
                <?php wp_nav_menu(['menu' => 'Main']) ?>
            </div>
        </header>