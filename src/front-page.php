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
                    <h3 class="title">Interested Families</h3>
                    <p class="no-margin">Are you interested in enrolling your child at Jefferson RISE?  Does your child live in Jefferson Parish? Is your child ENTERING the 6th, 7th, or 8th grade this fall (2017)?</p>
                </div>
                <div class="four columns">
                    <a href="#" class="button button-large button-block button-solid-red">Apply Now &raquo;</a>
                </div>
            </div>
        </section>

        <section class="our-model">
            <div class="container text-center">
                <h3 class="title text-white">Our Model</h3>
                <h6 class="subtitle text-light-gray text-center margin-bottom-fourty">
                    Preparing students for four-year colleges and professional careers.
                </h6>
                <div class="row">
                    <div class="four columns text-white text-center">
                        <i class="fa fa-graduation-cap fa-4x text-red margin-bottom-twenty" aria-hidden="true"></i>
                        <h5 class="no-margin">Academics</h5>
                        <p class="text-light-gray">With targeted turtoring, independent reading, and extra time on reading and math, Jefferson RISE students will be ready for college.</p>
                    </div>
                    <div class="four columns text-white text-center">
                        <i class="fa fa-user-circle-o fa-4x text-red margin-bottom-twenty" aria-hidden="true"></i>
                        <h5 class="no-margin">Character</h5>
                        <p class="text-light-gray">Respect<br />Integrity<br />Self-Discipline<br />Excellence</p>
                    </div>
                    <div class="four columns text-white text-center">
                        <i class="fa fa-calendar-check-o fa-4x text-red margin-bottom-twenty" aria-hidden="true"></i>
                        <h5 class="no-margin">Student Life</h5>
                        <p class="text-light-gray">Longer school days and year, enrinchment, skill blocks, targeting tutoring, and community circle.</p>
                    </div>
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