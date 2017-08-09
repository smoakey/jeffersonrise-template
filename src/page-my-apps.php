<?php
$wp_query = new WP_Query([
    'post_type' => 'student_app',
    'posts_per_page' => studentapp_posts_per_page,
    'paged' => 1
]);
?>

<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <div class="col-md-3">
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
<?php get_footer('portal'); ?>