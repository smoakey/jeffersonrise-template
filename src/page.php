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
            <div class="main-content container-fluid">
                <div class="panel">
                    <div class="panel-heading panel-heading-divider">
                        <small class="pull-right text-muted">
                            Updated <?php echo get_the_modified_date('m/d/Y @ g:ia', $post); ?>
                        </small>
                        <?php the_title(); ?>
                    </div>
                    <div class="panel-body">
                        <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php get_footer('portal'); ?>

<?php endif; ?>