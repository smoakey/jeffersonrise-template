<?php get_header('portal'); ?>
    <div class="be-content">
        <div class="main-content container-fluid">

            <?php require_once __DIR__ . '/partials/announcements.php'; ?>

            <?php if (get_current_user_role($allowOverride = true) == 'student') : ?>
                <div class="row student-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/widget', 'homework-table'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/widget', 'topapps'); ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="row teacher-dashboard">
                    <div class="col-md-8">
                        <?php get_template_part('partials/widget', 'homework-form'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php get_template_part('partials/widget', 'topapps'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer('portal'); ?>