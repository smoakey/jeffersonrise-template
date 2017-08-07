<?php
$wp_query = new WP_Query([
    'post_type' => 'announcements',
    'posts_per_page' => 10,
    'meta_key' => 'start_date',
    'orderby' => 'meta_value',
	'order' => 'ASC'
]);
?>

<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">

            <div class="announcements-wrapper">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <?php
                        $now = strtotime('now');
                        $start = strtotime(get_field('start_date'));
                        $end = get_field('end_date') ? strtotime(get_field('end_date')) : strtotime('+1 day');

                        // only show announcements in the date range
                        if ($now < $start || $now > $end) {
                            continue;
                        }

                        // dont show user closed announcements
                        $key = 'announcement-' . get_the_ID() . '-closed';
                        if (isset($_COOKIE[$key]) && $_COOKIE[$key] == 1) {
                            continue;
                        }

                        $type = get_field('type')['value'];
                        $icon = 'info-outline';
                        if ($type == 'success') {
                            $icon = 'check';
                        } else if ($type == 'warning') {
                            $icon = 'alert-triangle';
                        } else if ($type == 'error') {
                            $icon = 'close-circle-o';
                        }
                    ?>
                    <div role="alert" class="alert alert-<?php echo $type; ?> alert-icon alert-icon-border  alert-dismissible">
                        <div class="icon"><span class="mdi mdi-<?php echo $icon; ?>"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close" data-announcement-id="<?php echo get_the_ID(); ?>">
                                <span aria-hidden="true" class="mdi mdi-close"></span>
                            </button>
                            <strong><?php the_title(); ?></strong> <br />
                            <?php echo get_field('content'); ?>
                            <?php if ($link = get_field('link')) : ?>
                                <br />
                                <a href="<?php echo $link['url']; ?>"><?php echo $link['title'] ?: 'More Information'; ?> &rsaquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if (get_current_user_role($allowOverride = true) == 'student') : ?>
                <div class="row student-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/portal', 'homework'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/portal', 'topapps'); ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="row teacher-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/portal', 'homework-form'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/portal', 'topapps'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer('portal'); ?>