<?php $customFields = get_post_custom(); ?>

<?php get_header(); ?>

    <main>
        <section class="hero text-center">
            <h1><?php echo $customFields['hero_title'][0]; ?></h1>
            <h2><?php echo $customFields['hero_subtitle'][0]; ?></h2>
            <a href="<?php echo $customFields['hero_button_link'][0]; ?>" class="button button-large-screen-large">
                <?php echo $customFields['hero_button_text'][0]; ?>
            </a>
        </section>

        <section class="call-to-action">
            <a href="#" class="button action">Apply Now &raquo;</a>
            <h3 class="title">Interested Families</h3>
            <p class="no-margin">Are you interested in enrolling your child at Jefferson RISE?  Does your child live in Jefferson Parish? Is your child
    ENTERING the 6th, 7th, or 8th grade this fall (2017)?</p>
        </section>

        <section class="our-model">

        </section>

        <section class="">
            <div class="container">
                <h3 class="title">News &amp; Events</h3>
                <div class="row">
                    <div class="four columns">
                        <div class="news-item">
                            <img src="http://www.clipartbest.com/cliparts/acq/65d/acq65dRoi.jpg" />
                            <h5 class="no-margin news-title"><a href="#">Example News Article</a></h5>
                            <p class="news-date">March 21, 2017</p>
                        </div>
                    </div>
                    <div class="four columns">
                        <div class="news-item">
                            <img src="http://www.clipartbest.com/cliparts/acq/65d/acq65dRoi.jpg" />
                            <h5 class="no-margin news-title"><a href="#">Example News Article</a></h5>
                            <p class="news-date">March 21, 2017</p>
                        </div>
                    </div>
                    <div class="four columns">
                        <div class="news-item">
                            <img src="http://www.clipartbest.com/cliparts/acq/65d/acq65dRoi.jpg" />
                            <h5 class="no-margin news-title"><a href="#">Example News Article</a></h5>
                            <p class="news-date">March 21, 2017</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="twelve columns text-center">
                        <a href="" class="button">View all News &amp; Events</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="donate-now no-padding">
            <a class="button button-block button-blue button-xlarge" href="#">Donate Now <span>&raquo;</span></a>
        </section>
    </main>

<?php get_footer(); ?>