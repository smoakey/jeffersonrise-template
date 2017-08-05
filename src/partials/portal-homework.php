<?php
$gradeLevels = getGradeLevelsFromGoogleGroups();
$currentMonday = getCurrentMonday();
?>

<div class="panel">
    <div class="panel-heading panel-heading-divider">
        My Homework <a href="/portal/homework"><small>View all</small></a>
    </div>
    <div class="panel-body">
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
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No homework has been entered for the week starting: <?php echo $currentMonday; ?>.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
        <em class="text-muted">&mdash; No Homework</em>
    </div>
</div>
