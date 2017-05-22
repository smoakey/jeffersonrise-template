<?php get_header(); ?>

    <main>
        <header class="page-header">
            <h2 class="container">
                <a href="/news" class="button button-white button-solid-white-hover pull-right">
                    All News &amp; Events
                </a>
                <?php the_title(); ?>
            </h2>
        </header>
        <div class="page-content container">
            <div class="row">
                <div class="eight columns">
                    <div class="news-event-preview">
                        <?php echo get_field('news_details', false, false); ?>
                    </div>
                    <div class="news-event-author cf">
                        <?php echo get_avatar($post->post_author, 30); ?>
                        <?php the_author_meta('display_name', $post->post_author); ?><br />
                        <?php echo human_time_diff(get_post_time(), current_time('timestamp')); ?> ago
                    </div>
                </div>
                <div class="four columns">
                    <?php if (get_field('news_image')) : ?>
                        <div class="news-event-image">
                            <img src="<?php the_field('news_image'); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </main>

<?php get_footer(); ?>