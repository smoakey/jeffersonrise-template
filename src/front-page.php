<?php get_header(); ?>

    <main>
        <section class="hero text-center">
            <h1><?php the_field('hero_title'); ?></h1>
            <h2><?php the_field('hero_subtitle'); ?></h2>
            <a href="<?php the_field('hero_button_link'); ?>" class="button button-large button-white button-solid-white-hover">
                <?php the_field('hero_button_text'); ?>
            </a>
        </section>

        <section class="call-to-action">
            <div class="container">
                <div class="eight columns">
                    <h3 class="section-title"><?php the_field('call_to_action_title'); ?></h3>
                    <p class="no-margin"><?php the_field('call_to_action_description'); ?></p>
                </div>
                <div class="four columns">
                    <a href="<?php the_field('call_to_action_button_link'); ?>" class="button button-large button-block button-solid-red">
                        <?php the_field('call_to_action_button_text'); ?> &raquo;
                    </a>
                </div>
            </div>
        </section>

        <section class="our-model">
            <div class="container text-center">
                <h3 class="section-title text-white">Our Model</h3>
                <h6 class="subtitle text-light-gray text-center margin-bottom-fourty">
                    <?php the_field('our_model_subtitle'); ?>
                </h6>
                <div class="row">
                    <?php foreach([1,2,3] as $item) : ?>
                        <div class="four columns text-white text-center">
                            <i class="fa fa-<?php the_field('our_model_item' . $item . '_icon'); ?> fa-4x text-red margin-bottom-twenty" aria-hidden="true"></i>
                            <h5 class="no-margin"><?php the_field('our_model_item' . $item . '_name'); ?></h5>
                            <p class="text-light-gray"><?php the_field('our_model_item' . $item . '_description'); ?></p>
                            <?php if (get_field('our_model_item' . $item . '_link')) : ?>
                                <a class="button button-white button-solid-white-hover" href="<?php the_field('our_model_item' . $item . '_link'); ?>">Learn More</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php $query = new WP_Query([
            'post_type' => 'news',
            'posts_per_page' => 3,
            'meta_key' => 'news_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => 'location',
                    'value' => ['Web', 'Both'],
                    'compare' => 'IN'
                ]
            ]
        ]); ?>
        <section class="">
            <div class="container">
                <h3 class="section-title">News &amp; Events</h3>
                <?php if ($query->have_posts()) : ?>
                    <div class="row">
                        <?php $i = 0; ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php $i++; ?>
                            <div class="four columns">
                                <div class="news-item">
                                    <div class="news-image" style="background-image: url('<?php the_field('news_image'); ?>');"></div>
                                    <h5 class="no-margin news-title">
                                        <a href="<?php echo get_post_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <p class="news-date">
                                        <?php echo date('M d, Y', strtotime(get_field('news_date', false, false))); ?>
                                    </p>
                                </div>
                            </div>
                            <?php if ($i % 3 == 0) : ?>
                                </div><div class="row">
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="twelve columns text-center">
                        <a href="/about-us/news/" class="button button-blue">View all News &amp; Events</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>