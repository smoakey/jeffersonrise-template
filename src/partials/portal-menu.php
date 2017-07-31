<?php
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
$current_url = str_replace(get_site_url(), '', $current_url);

$links = [
    [
        'icon' => 'home',
        'url' => '/portal',
        'name' => 'Dashboard'
    ],
    [
        'icon' => 'apps',
        'url' => '/portal/my-apps',
        'name' => 'My Apps'
    ],
    [
        'icon' => 'local-dining',
        'url' => '/portal/my-meal-plan',
        'name' => 'My Meal Plan'
    ]
];
?>

<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper">
        <a href="#" class="left-sidebar-toggle">Blank Page</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">

                        <li class="divider">Menu</li>
                        <?php foreach ($links as $link) : ?>
                            <li class="<?php echo $current_url == $link['url'] ? 'active' : ''; ?>">
                                <a href="<?php echo $link['url']; ?>">
                                    <i class="icon mdi mdi-<?php echo $link['icon']; ?>"></i>
                                    <span><?php echo $link['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>