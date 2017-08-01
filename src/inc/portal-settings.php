<?php
// was the form submitted
if (isset($_POST['submit'])) {
    foreach ($_FILES as $setting => $upload) {
        if ($upload['error'] != 0) {
            continue;
        }

        // upload file
        $upload_overrides = array('test_form' => false);
        $uploaded = wp_handle_upload($upload, $upload_overrides);

        // if uploaded, update site options
        if ($uploaded && !isset($uploaded['error'])) {
            update_option($setting . '_url', $uploaded['url'], true);
            update_option($setting . '_file', $uploaded['file'], true);
        }
    }
}

//get current files
$bus_stop_file = get_option('portal_bus_stop_pdf_url');
$bus_stop_file_name = $bus_stop_file ? array_pop(explode('/', $bus_stop_file)) : 'None';
$meal_time_file = get_option('portal_meal_time_csv_url');
$meal_time_file_name = $meal_time_file ? array_pop(explode('/', $meal_time_file)) : 'None';
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Portal Settings</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>Bus Stop PDF: </th>
                    <td>
                        <input type="file" name="portal_bus_stop_pdf" accept="application/pdf" />
                        <br />
                        Current:
                        <?php if ($bus_stop_file) : ?>
                            <a href="<?php echo $bus_stop_file; ?>" target="_blank">
                                <?php echo $bus_stop_file_name; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $bus_stop_file_name; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>MealTime User ID Lookup CSV: </th>
                    <td>
                        <input type="file" name="portal_meal_time_csv" accept="application/csv,application/x-csv,text/csv,text/comma-separated-values,text/x-comma-separated-values,text/tab-separated-values" />
                        <br />
                        Current:
                        <?php if ($meal_time_file) : ?>
                            <a href="<?php echo $meal_time_file; ?>" target="_blank">
                                <?php echo $meal_time_file_name; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $meal_time_file_name; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Upload Files">
        </p>
    </form>
</div>