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
                    <h3 class="title"><?php the_field('call_to_action_title'); ?></h3>
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
                <h3 class="title text-white">Our Model</h3>
                <h6 class="subtitle text-light-gray text-center margin-bottom-fourty">
                    <?php the_field('our_model_subtitle'); ?>
                </h6>
                <div class="row">
                    <?php foreach([1,2,3] as $item) : ?>
                        <div class="four columns text-white text-center">
                            <i class="fa fa-<?php the_field('our_model_item' . $item . '_icon'); ?> fa-4x text-red margin-bottom-twenty" aria-hidden="true"></i>
                            <h5 class="no-margin"><?php the_field('our_model_item' . $item . '_name'); ?></h5>
                            <p class="text-light-gray"><?php the_field('our_model_item' . $item . '_description'); ?></p>
                            <a class="button button-white button-solid-white-hover" href="<?php the_field('our_model_item' . $item . '_link'); ?>">Learn More</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="">
            <div class="container">
                <h3 class="title">News &amp; Events</h3>
                <div class="row">
                    <?php $query = new WP_Query(['post_type' => 'news', 'posts_per_page' => 3]); ?>
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="four columns">
                                <div class="news-item">
                                    <img src="<?php the_field('news_image'); ?>" />
                                    <h5 class="no-margin news-title">
                                        <a href="<?php echo get_post_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <p class="news-date"><?php the_field('news_date'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="twelve columns text-center">
                        <a href="/news" class="button button-blue">View all News &amp; Events</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>