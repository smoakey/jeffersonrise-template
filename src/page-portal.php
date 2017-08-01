<?php get_header('portal'); ?>
        <?php get_template_part('partials/portal', 'menu'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">
                <?php get_template_part('partials/portal', get_current_user_role()); ?>
            </div>
        </div>

<?php get_footer('portal'); ?>