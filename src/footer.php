        <?php if (get_field('footer_button_link')) : ?>
            <section class="footer-link no-padding">
                <a href="<?php the_field('footer_button_link'); ?>" class="button button-block button-solid-blue button-xlarge">
                    <?php the_field('footer_button_text'); ?> <span>&raquo;</span>
                </a>
            </section>
        <?php endif; ?>

        <footer class="social">
            <div class="container">
                <div class="twelve columns text-center">
                    <?php if (get_theme_mod('twitter_link')) : ?>
                        <a href="<?php echo get_theme_mod('twitter_link'); ?>" target="_blank">
                            <i class="fa fa-twitter fa-2x" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('facebook_link')) : ?>
                        <a href="<?php echo get_theme_mod('facebook_link'); ?>" target="_blank">
                            <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('instagram_link')) : ?>
                        <a href="<?php echo get_theme_mod('instagram_link'); ?>" target="_blank">
                            <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('youtube_link')) : ?>
                        <a href="<?php echo get_theme_mod('youtube_link'); ?>" target="_blank">
                            <i class="fa fa-youtube fa-2x" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
        <footer class="copyright">
            <div class="container">
                <div class="six columns">
                    &copy; Copyright <?php echo date("Y"); ?> Jefferson RISE Charter School.
                </div>
                <div class="six columns text-right">
                    Crafted by <a target="_blank" href="http://christophersmoak.me">Christopher Smoak</a>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>