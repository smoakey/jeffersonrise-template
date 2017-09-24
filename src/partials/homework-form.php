<?php
$mondays = getMondays();
$gradeLevels = getGradeLevelsFromGoogleGroups();
$subjects = getSubjectsFromGoogleGroups();
$currentMonday = getCurrentMonday();
?>
<form method="post" class="weekly_homework" enctype="multipart/form-data">
    <input type="hidden" name="id" value="" />
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <textarea name="monday" class="form-control" placeholder="Monday" rows="1"></textarea>
                    <p class="notes"><input type="file" name="monday_notes[]" multiple /><span class="current-notes"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="tuesday" class="form-control" placeholder="Tuesday" rows="1"></textarea>
                    <p class="notes"><input type="file" name="tuesday_notes[]" multiple /><span class="current-notes"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="wednesday" class="form-control" placeholder="Wednesday" rows="1"></textarea>
                    <p class="notes"><input type="file" name="wednesday_notes[]" multiple /><span class="current-notes"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="thursday" class="form-control" placeholder="Thursday" rows="1"></textarea>
                    <p class="notes"><input type="file" name="thursday_notes[]" multiple /><span class="current-notes"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="friday" class="form-control" placeholder="Friday" rows="1"></textarea>
                    <p class="notes"><input type="file" name="friday_notes[]" multiple /><span class="current-notes"></p>
                </div>
            </div>
            <hr />
            <textarea name="assessments" class="form-control" placeholder="Assessments" rows="1"></textarea>
        </div>
    </div><br />
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-space btn-default no-homework">No Homework (All)</button>
            <button class="btn btn-space btn-success" name="submit_homework">Save Homework</button>
        </div>
    </div>
</form>