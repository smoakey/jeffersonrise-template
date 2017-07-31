<?php
$wp_query = new WP_Query([
    'post_type' => 'student_app',
    'posts_per_page' => 3,
    'paged' => 1
]);
?>

<div class="panel panel-flat">
    <div class="panel-heading">Recent Apps <a href="/portal/my-apps"><small>View All</small></a></div>
    <div class="panel-body">
        <div class="row">
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                <div class="col-md-4">
                    <div class="panel panel-border student-app">
                        <a href="<?php echo get_field('link'); ?>" target="_blank">
                            <img src="<?php echo get_field('icon'); ?>" width="100" />
                        </a>
                        <strong><?php the_title(); ?></strong>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>