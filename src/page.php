<?php if (strpos(get_current_page_url(), 'portal') === false) : ?>

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

<?php else : ?>

    <?php get_header('portal'); ?>
        <div class="be-content">
            <div class="page-head">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="main-content container-fluid">
                <?php echo apply_filters('the_content', $post->post_content); ?>
            </div>
        </div>
    <?php get_footer('portal'); ?>

<?php endif; ?>