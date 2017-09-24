<?php
$gradeLevels = getGradeLevelsFromGoogleGroups();
$currentMonday = $_GET['week'] ?: getCurrentMonday();

function createNoteLinks($notes) {
    $links = [];

    if (!$notes) {
        return '';
    }

    $notes = explode(',', $notes);

    foreach ($notes as $note) {
        $filename = array_pop(explode('/', $note));
        $title = $filename;
        if (strlen($filename) > 20) {
            $extension = array_pop(explode('.', $filename));
            $filename = substr($filename, 0, 14) . '... .' . $extension;
        }
        $links[] = '<a href="' . $note . '" target="_blank" title="' . $title . '"><i class="icon mdi mdi-file-text"></i> ' . $filename . '</a>';
    }

    echo '<br />' . join('<br />', $links);
}
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
                            <?php echo createNoteLinks($h['monday_notes']); ?>
                        </td>
                        <td>
                            <?php echo $h['tuesday']; ?>
                            <?php echo createNoteLinks($h['tuesday_notes']); ?>
                        </td>
                        <td>
                            <?php echo $h['wednesday']; ?>
                            <?php echo createNoteLinks($h['wendesday_notes']); ?>
                        </td>
                        <td>
                            <?php echo $h['thursday']; ?>
                            <?php echo createNoteLinks($h['thursday_notes']); ?>
                        </td>
                        <td>
                            <?php echo $h['friday']; ?>
                            <?php echo createNoteLinks($h['friday_notes']); ?>
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