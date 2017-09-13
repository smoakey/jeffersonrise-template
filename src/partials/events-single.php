<?php
$eventId = $_GET['event_id'];
$post = get_post($eventId);
$hasSidebar = get_field('news_image', $post->ID) ? true : false;
?>

<div class="panel">
    <div class="panel-heading">
        <a class="btn btn-default pull-right" href="/portal/events">All Events</a>
        <?php the_title(); ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="<?php echo $hasSidebar ? 'col-md-8' : 'col-md-12'; ?>">
                <div class="news-event-date">
                    <?php echo date('M d, Y', strtotime(get_field('news_date', $post->ID, false))); ?>
                </div>
                <div class="news-event-preview">
                    <?php echo get_field('news_details', $post->ID, false); ?>
                </div>
                <div class="news-event-author cf">
                    <?php echo get_avatar($post->post_author, 30); ?>
                    <?php the_author_meta('display_name', $post->post_author); ?><br />
                    <?php echo human_time_diff(strtotime(get_field('news_date', $post->ID)), current_time('timestamp')); ?> ago
                </div>
            </div>
            <?php if ($hasSidebar) : ?>
                <div class="col-md-4">
                    <?php if (get_field('news_image')) : ?>
                        <div class="news-event-image text-center">
                            <img src="<?php the_field('news_image'); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>