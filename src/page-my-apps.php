<?php
$wp_query = new WP_Query([
    'post_type' => 'student_app',
    'posts_per_page' => studentapp_posts_per_page,
    'paged' => 1
]);
?>

<?php get_header('portal'); ?>

        <?php get_template_part('partials/portal', 'menu'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">

                <div class="row">
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <div class="col-md-3">
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

<?php get_footer('portal'); ?>