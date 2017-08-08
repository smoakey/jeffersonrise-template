<?php
$gradeLevels = getGradeLevelsFromGoogleGroups();
$currentMonday = $_GET['week'] ?: getCurrentMonday();
?>

<?php foreach ($gradeLevels as $gradeLevel) : ?>
    <table class="table table-condensed table-bordered">
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
                        <td>
                            <?php echo $h['monday']; ?>
                            <?php if ($h['monday_notes']) : ?>
                                <a href="<?php echo $h['monday_notes']; ?>" target="_blank" title="Download Notes">
                                    <i class="icon mdi mdi-file-text"></i> Notes
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $h['tuesday']; ?>
                            <?php if ($h['tuesday_notes']) : ?>
                                <a href="<?php echo $h['tuesday_notes']; ?>" target="_blank" title="Download Notes">
                                    <i class="icon mdi mdi-file-text"></i> Notes
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $h['wednesday']; ?>
                            <?php if ($h['wednesday_notes']) : ?>
                                <a href="<?php echo $h['wednesday_notes']; ?>" target="_blank">
                                    <i class="icon mdi mdi-file-text"></i> Notes
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $h['thursday']; ?>
                            <?php if ($h['thursday_notes']) : ?>
                                <a href="<?php echo $h['thursday_notes']; ?>" target="_blank">
                                    <i class="icon mdi mdi-file-text"></i> Notes
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $h['friday']; ?>
                            <?php if ($h['friday_notes']) : ?>
                                <a href="<?php echo $h['friday_notes']; ?>" target="_blank">
                                    <i class="icon mdi mdi-file-text"></i> Notes
                                </a>
                            <?php endif; ?>
                        </td>
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
                                    <input type="hidden" name="week" value="<?php echo isset($_GET['week']) ? $_GET['week'] : ''; ?>" />
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