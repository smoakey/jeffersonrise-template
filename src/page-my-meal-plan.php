<?php
$match = null;
if (isset($_POST['submit'])) {
    $match = false;
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    // get the uploaded file
    $csv = get_field('meal_time_id_csv', 'option');
    $file = get_attached_file($csv['id']);

    // dont continue if we have no file
    if (!file_exists($file)) {
        return;
    }

    // parse csv data into map
    $csv_data = array_map('str_getcsv', file($file));

    // search for match
    foreach ($csv_data as $data) {
        if ($data[1] == $last_name && $data[2] == $first_name) {
            $match = $data[0];
            break;
        }
    }
}
?>

<?php get_header('portal'); ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <?php if ($match) : ?>
                    <?php $help_doc = get_field('meal_time_help_guide', 'option'); ?>
                    <div role="alert" class="alert alert-success alert-icon alert-icon-border">
                        <div class="icon"><span class="mdi mdi-check"></span></div>
                        <div class="message">
                            <strong>Student ID Found!</strong>
                            <br />We found a match for student <?php echo $_POST['last_name'] . ', ' . $_POST['first_name']; ?>.
                            <br />The User ID to use when registering for MealTime is: <code><?php echo $match; ?></code>.
                            <br /><a target="_blank" href="<?php echo $help_doc['url']; ?>">Click here</a> to download a document describing the procedure to set up your account.
                            <br />You can register by <a target="_blank" href="https://www.mymealtime.com/Register.aspx">clicking here.</a>
                        </div>
                    </div>
                <?php elseif ($match === false) : ?>
                    <div role="alert" class="alert alert-warning alert-icon alert-icon-border">
                        <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                        <div class="message">
                            <strong>Unable to Locate Student ID</strong>
                            <br />We were unable to find a match for <?php echo $_POST['last_name'] . ', ' . $_POST['first_name']; ?>.
                            If you believe this is a mistake please email <a href="mailto:frontdesk@jeffersonrise.org?subject=MealTime%20Student%20Request%20for%20<?php echo $_POST['last_name'] . ',%20' . $_POST['first_name']; ?>">frontdesk@jeffersonrise.org</a>.
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel">
                            <div class="panel-heading panel-heading-divider">
                                Meal Info
                            </div>
                            <div class="panel-body">
                                <?php echo get_field('meal_info', 'option'); ?>
                            </div>
                        </div>
                        <div class="panel panel-table">
                            <div class="panel-heading">
                                Meal Menus
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Menus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (have_rows('menus', 'option')): ?>
                                            <?php while(have_rows('menus', 'option')): the_row(); ?>
                                                <tr>
                                                    <td><?php the_sub_field('month'); ?> <?php the_sub_field('year'); ?></td>
                                                    <td>
                                                        <?php while(have_rows('month_menus', 'option')): the_row(); ?>
                                                            <?php $menu = get_sub_field('menu'); ?>
                                                            <a target="_blank" href="<?php echo $menu['url']; ?>" class="btn btn-default btn-sm">
                                                                <i class="icon mdi mdi-collection-pdf"></i>
                                                                <?php echo $menu['title']; ?>
                                                            </a><br />
                                                        <?php endwhile; ?>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="2">
                                                    <p class="text-muted"><em>No menus found</em></p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading panel-heading-divider">
                                Meal Account
                            </div>
                            <div class="panel-body">
                                <div role="alert" class="alert alert-primary alert-icon alert-icon-border">
                                    <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                                    <div class="message">
                                        <strong>Coming Soon:</strong><br />
                                        MealTime Account Lookup &amp; Balance Reload
                                    </div>
                                </div>
                                <!-- <a target="_blank" href="https://www.mymealtime.com/SignIn.aspx" class="btn btn-default btn-space btn-big btn-block">
                                    <i class="icon mdi mdi-money-box"></i>
                                    Reload My MealTime Balance
                                </a>
                                <hr class="or" />

                                <p class="text-center"><strong>Lookup your Student ID to Register:</strong></p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="last_name" required placeholder="Enter Last Name" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="first_name" required placeholder="Enter First Name" class="form-control input-sm">
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" name="submit" class="btn btn-space btn-primary">Lookup</button>
                                    </div>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php get_footer('portal'); ?>