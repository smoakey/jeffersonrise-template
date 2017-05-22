<?php get_header(); ?>

    <main>
        <header class="page-header">
            <h2 class="container">
                <?php the_title(); ?>
            </h2>
        </header>
        <div class="page-content container">
            <?php echo apply_filters('the_content', $post->post_content); ?>
        </div>
    </main>

<?php get_footer(); ?>