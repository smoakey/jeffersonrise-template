<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">
            <?php if (get_current_user_role() == 'student') : ?>
                <div class="row student-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/portal', 'topapps'); ?>
                        <?php get_template_part('partials/portal', 'homework'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/portal', 'bus'); ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="row teacher-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/portal', 'homework-form'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/portal', 'topapps'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer('portal'); ?>