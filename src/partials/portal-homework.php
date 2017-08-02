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
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</div>
