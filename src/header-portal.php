<?php
$current_user = wp_get_current_user();
$user_data = get_userdata($current_user->ID);
$user_meta = get_user_meta($current_user->ID);
$role = ucwords(current($user_data->roles));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>, <?php bloginfo('description'); ?></title>
        <?php wp_head(); ?>
        <style>
            html { margin-top: 0 !important; }
        </style>
    </head>
    <body>
        <div class="be-wrapper">
            <nav class="navbar navbar-default navbar-fixed-top be-top-header">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="/portal" class="navbar-brand"></a>
                    </div>
                    <div class="be-right-navbar">
                        <ul class="nav navbar-nav navbar-right be-user-nav">
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                    <img src="<?php echo isset($user_meta['user_avatar'][0]) ? $user_meta['user_avatar'][0] : get_avatar_url($current_user->ID); ?>" alt="Avatar">
                                    <span class="user-name"><?php echo $current_user->display_name; ?></span>
                                </a>
                                <ul role="menu" class="dropdown-menu">
                                    <li>
                                        <div class="user-info">
                                            <div class="user-name"><?php echo $current_user->display_name; ?></div>
                                            <div><?php echo $role; ?></div>
                                        </div>
                                    </li>
                                    <?php if ($role == 'Administrator') : ?>
                                        <li><a href="/wp-admin"><span class="icon mdi mdi-settings"></span> Wordpress Admin</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo wp_logout_url(home_url()); ?>">
                                        <span class="icon mdi mdi-power"></span> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="page-title"><span><?php echo $role; ?> Dashboard</span></div>
                    </div>
                </div>
            </nav>