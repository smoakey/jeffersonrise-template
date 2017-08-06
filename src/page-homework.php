<?php
$mondays = getMondays();
$currentMonday = $_GET['week'] ?: getCurrentMonday();
$gradeLevels = getGradeLevelsFromGoogleGroups();
$subjects = getSubjectsFromGoogleGroups();

$deleted = null;
if (isset($_POST['delete_homework'])) {
    $id = $_POST['id'];
    $deleted = deleteHomework($id);

    $returnWeek = isset($_GET['week']) ? '?week=' . $_GET['week'] : '';
    header('Location: /portal/homework' . $returnWeek);
    exit;
}

$saved = null;
if (isset($_POST['submit_homework'])) {
    $data = $_POST;
    unset($data['submit_homework']);
    $saved = saveHomework($data);

    $returnWeek = isset($_GET['week']) ? '?week=' . $_GET['week'] : '';
    header('Location: /portal/homework' . $returnWeek);
    exit;
}
?>

<?php get_header('portal'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">
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

                        <?php foreach ($gradeLevels as $gradeLevel) : ?>
                            <table class="table table-condensed table-bordered homework-list">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="primary">Assessments</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                        <?php if (get_current_user_role($allowOverride = true) != 'student') : ?>
                                            <th>Actions</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $homework = getHomeworkForGradeLevelAndCurrentMonday($gradeLevel, $currentMonday); ?>
                                    <?php if (count($homework)): ?>
                                        <?php foreach ($homework as $h) : ?>
                                            <tr>
                                                <th><?php echo $h['subject']; ?></th>
                                                <td class="primary"><?php echo $h['assessments']; ?></td>
                                                <td><?php echo $h['monday']; ?></td>
                                                <td><?php echo $h['tuesday']; ?></td>
                                                <td><?php echo $h['wednesday']; ?></td>
                                                <td><?php echo $h['thursday']; ?></td>
                                                <td><?php echo $h['friday']; ?></td>
                                                <?php if (get_current_user_role($allowOverride = true) != 'student') : ?>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            data-toggle="modal"
                                                            data-target="#homework-add-edit"
                                                            class="homework-edit btn btn-sm btn-default"
                                                            data-homework='<?php echo json_encode($h); ?>'>Edit</button>

                                                        <form method="post" style="display:inline;">
                                                            <input type="hidden" name="id" value="<?php echo $h['id']; ?>" />
                                                            <button type="submit" class="homework-delete btn btn-sm btn-danger" name="delete_homework">Delete</button>
                                                        </form>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8">No homework has been entered for the week starting: <?php echo $currentMonday; ?>.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php endforeach; ?>

                        <em class="text-muted">&mdash; No Homework</em>
                    </div>
                </div>
            </div>
        </div>

        <div id="homework-add-edit" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-danger">
            <div class="modal-dialog custom-width">
                <div class="modal-content">
                    <form method="post" class="weekly_homework">
                        <input type="hidden" name="id" value="" />
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close">
                                <span class="mdi mdi-close"></span>
                            </button>
                            <h3 class="modal-title">Add Homework</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Select Grade Level</label>
                                    <select name="grade" class="form-control input-sm">
                                        <?php foreach ($gradeLevels as $gradeLevel) : ?>
                                            <option value="<?php echo $gradeLevel; ?>"><?php echo $gradeLevel; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Select Week</label>
                                    <select name="week" class="form-control input-sm">
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
                                </div>
                                <div class="col-md-4">
                                    <label>Select Subject</label>
                                    <select name="subject" class="form-control input-sm">
                                        <?php foreach ($subjects as $subject) : ?>
                                            <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div><br />
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea name="monday" class="form-control" placeholder="Monday" rows="1"></textarea><br />
                                    <textarea name="tuesday" class="form-control" placeholder="Tuesday" rows="1"></textarea><br />
                                    <textarea name="wednesday" class="form-control" placeholder="Wednesday" rows="1"></textarea><br />
                                    <textarea name="thursday" class="form-control" placeholder="Thursday" rows="1"></textarea><br />
                                    <textarea name="friday" class="form-control" placeholder="Friday" rows="1"></textarea>
                                    <hr />
                                    <textarea name="assessments" class="form-control" placeholder="Assessments" rows="1"></textarea>
                                </div>
                            </div><br />
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                            <button type="submit" class="btn btn-success md-close" name="submit_homework">Save Homework</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php get_footer('portal'); ?>