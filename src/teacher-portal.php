<?php
get_header('portal');

$current_user = wp_get_current_user();
$user_data = get_userdata($current_user->ID);
$user_meta = get_user_meta($current_user->ID);
$role = ucwords(current($user_data->roles));
?>
<body>
    <div class="be-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand"></a>
                </div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav navbar-right be-user-nav">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                                <img src="<?php echo $user_meta['user_avatar'][0]; ?>" alt="Avatar">
                                <span class="user-name"><?php echo $current_user->display_name; ?></span>
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <li>
                                    <div class="user-info">
                                        <div class="user-name"><?php echo $current_user->display_name; ?></div>
                                        <div><?php echo $role; ?></div>
                                    </div>
                                </li>
                                <!-- <li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li> -->
                                <!-- <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li> -->
                                <li><a href="<?php echo wp_logout_url(home_url()); ?>">
                                    <span class="icon mdi mdi-power"></span> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="page-title"><span>Student Dashboard</span></div>
                </div>
            </div>
        </nav>

        <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper">
                <a href="#" class="left-sidebar-toggle">Blank Page</a>
                <div class="left-sidebar-spacer">
                    <div class="left-sidebar-scroll">
                        <div class="left-sidebar-content">
                            <ul class="sidebar-elements">
                                <li class="divider">Menu</li>
                                <li class="active">
                                    <a href="#"><i class="icon mdi mdi-home"></i><span>Home</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon mdi mdi-file"></i><span>All Homework</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon mdi mdi-globe"></i><span>My Site</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading panel-heading-divider">
                                Enter Homework
                                <span class="panel-subtitle">Enter your weekly homework using the form below</span>
                            </div>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group xs-pt-10">
                                        <textarea class="form-control" placeholder="Monday"></textarea>
                                    </div>
                                    <div class="form-group xs-pt-10">
                                        <textarea class="form-control" placeholder="Tuesday"></textarea>
                                    </div>
                                    <div class="form-group xs-pt-10">
                                        <textarea class="form-control" placeholder="Wednesday"></textarea>
                                    </div>
                                    <div class="form-group xs-pt-10">
                                        <textarea class="form-control" placeholder="Thursday"></textarea>
                                    </div>
                                    <div class="form-group xs-pt-10">
                                        <textarea class="form-control" placeholder="Friday"></textarea>
                                    </div>
                                    <button class="btn btn-space btn-primary btn-lg">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
    <script>
        jQuery(document).ready(App.init);
    </script>
</body>

</html>