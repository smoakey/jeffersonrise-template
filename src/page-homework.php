<?php
$mondays = getMondays();
$currentMonday = $_GET['week'] ?: getCurrentMonday();
$gradeLevels = getGradeLevelsFromGoogleGroups();
?>

<?php get_header('portal'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="panel">
                    <div class="panel-heading  panel-heading-divider">
                        <form method="GET" class="form-inline pull-right">
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
                        </form>

                        Homework
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
            </div>
        </div>

<?php get_footer('portal'); ?>