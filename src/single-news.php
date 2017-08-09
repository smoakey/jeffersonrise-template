<?php get_header(); ?>
    <?php
        $hasSidebar = get_field('news_image') ? true : false;
    ?>
    <main>
        <header class="page-header">
            <h2 class="container">
                <a href="/about-us/news" class="button button-white button-solid-white-hover pull-right">
                    All News &amp; Events
                </a>
                News &amp; Events
            </h2>
        </header>
        <div class="page-content container">
            <div class="row">
                <div class="<?php echo $hasSidebar ? 'eight' : 'twelve'; ?> columns">
                    <h3 class="news-event-title"><?php the_title(); ?></h3>
                    <div class="news-event-date">
                        <?php echo date('M d, Y', strtotime(get_field('news_date', false, false))); ?>
                    </div>
                    <div class="news-event-preview">
                        <?php echo get_field('news_details', false, false); ?>
                    </div>
                    <div class="news-event-author cf">
                        <?php echo get_avatar($post->post_author, 30); ?>
                        <?php the_author_meta('display_name', $post->post_author); ?><br />
                        <?php echo human_time_diff(strtotime(get_field('news_date')), current_time('timestamp')); ?> ago
                    </div>
                </div>
                <?php if ($hasSidebar) : ?>
                    <div class="four columns">
                        <?php if (get_field('news_image')) : ?>
                            <div class="news-event-image text-center">
                                <img src="<?php the_field('news_image'); ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

<?php get_footer(); ?>