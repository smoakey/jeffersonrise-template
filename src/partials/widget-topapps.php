<?php
$wp_query = new WP_Query([
    'post_type' => 'student_app',
    'posts_per_page' => 3,
    'paged' => 1
]);
?>

<div class="panel panel-flat topapps">
    <div class="panel-heading">Popular Apps <a href="/portal/my-apps"><small>View All</small></a></div>
    <div class="panel-body">
        <div class="row">
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                <div class="col-lg-4">
                    <div class="panel panel-border student-app">
                        <a href="<?php echo get_field('link'); ?>" target="_blank" style="background-image: url(<?php echo get_field('icon'); ?>);"></a>
                        <strong><?php the_title(); ?></strong>
                        <small title="<?php echo get_field('caption'); ?>"><?php echo get_field('caption') ?: '&nbsp;'; ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>