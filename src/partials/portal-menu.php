<?php
$menu = get_portal_menu();
$current_url = get_current_page_url();
$menuItems = $menu['items'];
$linkGroups = [];
$group = 'Menu';
foreach ($menuItems as $item) {
    if ($item['url'] == '#divider') {
        $group = $item['title'];
        continue;
    }
    $linkGroups[$group][] = $item;
}
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
                                <?php
                                    $classes = [];
                                    if ($current_url == rtrim($link['url'], '/')) {
                                        $classes[] = 'active';
                                    }
                                    if (isset($link['children'])) {
                                        $classes[] = 'parent';
                                    }
                                ?>
                                <li class="<?php echo implode(' ', $classes); ?>">
                                    <a href="<?php echo $link['url']; ?>">
                                        <i class="icon mdi mdi-<?php echo $link['classes'] ?: 'file'; ?>"></i>
                                        <span><?php echo $link['title']; ?></span>
                                    </a>
                                    <?php if (isset($link['children'])) : ?>
                                        <ul class="sub-menu">
                                            <?php foreach ($link['children'] as $sub_link) : ?>
                                                <?php
                                                    $classes = [];
                                                    if ($current_url == rtrim($sub_link['url'], '/')) {
                                                        $classes[] = 'active';
                                                    }
                                                ?>
                                                <li class="<?php echo implode(' ', $classes); ?>">
                                                    <a href="<?php echo $sub_link['url']; ?>">
                                                        <?php if ($sub_link['classes']) : ?>
                                                            <i class="icon mdi mdi-<?php echo $sub_link['classes'] ?: 'file'; ?>"></i>
                                                        <?php endif; ?>
                                                        <span><?php echo $sub_link['title']; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>