<?php
$mondays = getMondays();
$currentMonday = $_GET['week'] ?: getCurrentMonday();
?>

<?php get_header('portal'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">

                <?php if (isset($_GET['saved']) && $_GET['saved'] == 1) : ?>
                    <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                        <div class="icon"><span class="mdi mdi-check"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                <span aria-hidden="true" class="mdi mdi-close"></span>
                            </button>
                            <strong>Homework Successfully Saved!</strong>
                            <p>You can view you saved homework below.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1) : ?>
                    <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                        <div class="icon"><span class="mdi mdi-check"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                <span aria-hidden="true" class="mdi mdi-close"></span>
                            </button>
                            <strong>Homework Successfully Deleted!</strong>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="panel">
                    <div class="panel-heading  panel-heading-divider">
                        <div class="pull-right">
                            <form method="GET" class="form-inline">
                                Week:
                                <select name="week" class="form-control input-xs">
                                    <?php foreach ($mondays as $i => $monday) : ?>
                                        <?php
                                            $selected = '';
                                            if ($currentMonday == $monday) {
                                                $selected = 'selected="selected"';
                                            }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $monday; ?>"><?php echo $monday; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-default">Go</button>
                                <?php if (get_current_user_role($allowOverride = true) != 'student') : ?>
                                     | <button class="btn btn-success" type="button" data-toggle="modal" data-target="#homework-add-edit">Add Homework</button>
                                <?php endif; ?>
                            </form>
                        </div>

                        Homework
                    </div>
                    <div class="panel-body">
                        <?php require_once __DIR__ . '/partials/homework-table.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="homework-add-edit" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-danger">
            <div class="modal-dialog custom-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close">
                            <span class="mdi mdi-close"></span>
                        </button>
                        <h3 class="modal-title">Add Homework</h3>
                    </div>
                    <div class="modal-body">
                        <?php require_once __DIR__ . '/partials/homework-form.php'; ?>
                    </div>
                </div>
            </div>
        </div>

<?php get_footer('portal'); ?>