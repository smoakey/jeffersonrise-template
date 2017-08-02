<?php
$mondays = getMondays();
$gradeLevels = getGradeLevelsFromGoogleGroups();
$subjects = getSubjectsFromGoogleGroups();
$currentMonday = getCurrentMonday();

//save home on post
$saved = null;
if (isset($_POST['submit_homework'])) {
    $data = $_POST;
    unset($data['submit_homework']);
    $saved = saveHomework($data);
}
?>

<div class="panel">
    <div class="panel-heading panel-heading-divider">
        Enter Homework
        <span class="panel-subtitle">Enter your weekly homework using the form below</span>
    </div>
    <div class="panel-body">
        <!-- <div role="alert" class="alert alert-warning alert-icon alert-icon-border">
            <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
            <div class="message">
                <strong>Its Monday!</strong> Dont forget to enter your weekly homework.
            </div>
        </div> -->
        <form method="post">
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
            <button class="btn btn-space btn-primary btn-lg" name="submit_homework">Save</button>
        </form>
    </div>
</div>
