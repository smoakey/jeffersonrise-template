<?php get_header('portal'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">
                <?php echo apply_filters('the_content', $post->post_content); ?>
            </div>
        </div>

<?php get_footer('portal'); ?>