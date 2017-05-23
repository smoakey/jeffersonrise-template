<?php
$wp_query = new WP_Query([
    'post_type' => 'news',
    'posts_per_page' => news_posts_per_page,
    'paged' => get_query_var('paged') ?: 1
]);


$echo = false;
$max = $wp_query->max_num_pages;
$current = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$prev = $current != previous_posts($echo) ? previous_posts($echo) : '';
$next = $current != next_posts($max, $echo) ? next_posts($max, $echo) : '';
?>

<?php get_header(); ?>
    <main>
        <header class="page-header">
            <h2 class="container">News &amp; Events</h2>
        </header>
        <div class="page-content container">
            <div class="row">
                <div class="eight columns">
                    <?php if(isset($_GET['date'])) : ?>
                        <div class="news-event-list-filtered">
                            <a class="pull-right" href="/news"><i class="fa fa-times"></i></a>
                            Filtered News &amp; Events to <?php echo date('M d, Y', strtotime($_GET['date'])); ?></em>
                        </div>
                    <?php endif; ?>

                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <div class="news-event-item">
                            <?php if (get_field('news_image') && false == true) : ?>
                                <div class="news-event-image">
                                    <img src="<?php the_field('news_image'); ?>" />
                                </div>
                            <?php endif; ?>
                            <h5 class="news-event-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                            <div class="news-event-preview">
                                <?php echo get_field('news_details', false, false); ?>
                            </div>
                            <div class="news-event-author cf">
                                <?php echo get_avatar(get_the_author_meta('ID'), 30); ?>
                                <?php the_author_meta('display_name'); ?><br />
                                <?php echo human_time_diff(get_post_time(), current_time('timestamp')); ?> ago
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <?php if ($prev || $next) : ?>
                        <div class="row pagination">
                            <div class="six columns">
                                <?php if ($prev) : ?>
                                    <a href="<?php echo $prev; ?>" class="button">&laquo; Newer</a>
                                <?php endif; ?>
                                &nbsp;
                            </div>
                            <div class="six columns text-right">
                                <?php if ($next) : ?>
                                    <a href="<?php echo $next; ?>" class="button">Older &raquo;</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="four columns">
                    <div id="calendar"></div>
                    <input type="text" id="calendar-input" class="hide" />
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>