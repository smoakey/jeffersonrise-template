<?php
$wp_query = new WP_Query([
    'post_type' => 'teacher',
    'posts_per_page' => teachers_posts_per_page,
    'paged' => 1
]);
?>

<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <div class="col-md-4">
                        <div class="panel panel-border teacher">
                            <div class="teacher-photo" style="background-image: url(<?php the_field('photo'); ?>)"></div>
                            <strong><?php echo get_field('name'); ?></strong>
                            <a class="btn btn-danger btn-block" href="mailto:<?php echo get_field('email'); ?>">Email</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php get_footer('portal'); ?>