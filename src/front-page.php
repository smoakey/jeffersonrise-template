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
            <a href="#" class="button action">Apply Now &raquo;</a>
            <h3 class="title">Interested Families</h3>
            <p class="no-margin">Are you interested in enrolling your child at Jefferson RISE?  Does your child live in Jefferson Parish? Is your child ENTERING the 6th, 7th, or 8th grade this fall (2017)?</p>
        </section>

        <section class="our-model">

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