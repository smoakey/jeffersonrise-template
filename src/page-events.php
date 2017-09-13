<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">
            <?php if (isset($_GET['event_id'])) : ?>
                <?php get_template_part('partials/events', 'single'); ?>
            <?php else : ?>
                <?php get_template_part('partials/events', 'list'); ?>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer('portal'); ?>