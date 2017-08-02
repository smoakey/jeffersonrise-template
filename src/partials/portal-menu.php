<?php
$current_url = get_current_page_url();

$linkGroups = [
    'Menu' => [
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
            'icon' => 'file-text',
            'url' => '/portal/homework',
            'name' => 'Homework'
        ],
        [
            'icon' => 'local-dining',
            'url' => '/portal/my-meal-plan',
            'name' => 'My Meal Plan'
        ]
    ],
    // 'Store' => [
    //     [
    //         'icon' => 'local-wc',
    //         'url' => '/portal/store/category/uniforms/',
    //         'name' => 'Uniforms'
    //     ],
    //     [
    //         'icon' => 'camera',
    //         'url' => '/portal/store/category/photos/',
    //         'name' => 'Photos'
    //     ]
    // ]
];
?>

<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper">
        <a href="#" class="left-sidebar-toggle">Menu</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">

                        <?php foreach ($linkGroups as $group => $links) : ?>
                            <li class="divider"><?php echo $group; ?></li>
                            <?php foreach ($links as $link) : ?>
                                <li class="<?php echo $current_url == $link['url'] ? 'active' : ''; ?>">
                                    <a href="<?php echo $link['url']; ?>">
                                        <i class="icon mdi mdi-<?php echo $link['icon']; ?>"></i>
                                        <span><?php echo $link['name']; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>