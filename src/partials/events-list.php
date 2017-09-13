<?php
$wp_query = new WP_Query([
    'post_type' => 'news',
    'paged' => get_query_var('paged') ?: 1,
    'meta_key' => 'news_date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_query' => [
        'relation' => 'AND',
        [
            'key' => 'location',
            'value' => ['Portal', 'Both'],
            'compare' => 'IN'
        ]
    ]
]);

$echo = false;
$max = $wp_query->max_num_pages;
$current = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$prev = $current != previous_posts($echo) ? previous_posts($echo) : '';
$next = $current != next_posts($max, $echo) ? next_posts($max, $echo) : '';
?>

<div class="row">
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading panel-heading-divider">
                Events
                <?php if(isset($_GET['date'])) : ?>
                    <span class="badge">
                        <?php echo date('M d, Y', strtotime($_GET['date'])); ?>
                        <a class="text-danger" href="/portal/events"><span class="mdi mdi-close"></span></a>
                    </span>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <div class="news-event-item clearfix">
                        <?php if (get_field('news_image') && false == true) : ?>
                            <div class="news-event-image">
                                <img src="<?php the_field('news_image'); ?>" />
                            </div>
                        <?php endif; ?>
                        <h5 class="news-event-title">
                            <a href="/portal/events/?event_id=<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h5>
                        <div class="news-event-preview">
                            <?php echo get_field('news_details', false, false); ?>
                        </div>
                        <div class="news-event-author cf">
                            <?php echo get_avatar(get_the_author_meta('ID'), 30); ?>
                            <?php the_author_meta('display_name'); ?><br />
                            <?php echo human_time_diff(strtotime(get_field('news_date')), current_time('timestamp')); ?> ago
                        </div>
                    </div>
                <?php endwhile; ?>

                <?php if ($prev || $next) : ?>
                    <div class="row events-paging">
                        <div class="col-md-6">
                            <?php if ($prev) : ?>
                                <a href="<?php echo $prev; ?>" class="btn btn-default">&laquo; Newer</a>
                            <?php endif; ?>
                            &nbsp;
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if ($next) : ?>
                                <a href="<?php echo $next; ?>" class="btn btn-default">Older &raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body">
                <div id="calendar"></div>
                <input type="text" id="calendar-input" class="hide" />
            </div>
        </div>
    </div>
</div>