<?php get_header('portal'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">
                <?php get_template_part('partials/portal', get_current_user_role() == 'student' ? 'student' : 'teacher'); ?>
            </div>
        </div>

<?php get_footer('portal'); ?>