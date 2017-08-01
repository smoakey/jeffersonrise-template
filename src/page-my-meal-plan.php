<?php
$match = null;
if (isset($_POST['submit'])) {
    $match = false;
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    $csv = get_option('portal_meal_time_csv_file');
    $csv_data = array_map('str_getcsv', file($csv));
    foreach ($csv_data as $data) {
        if ($data[1] == $last_name && $data[2] == $first_name) {
            $match = $data[0];
            break;
        }
    }
}
?>

<?php get_header('portal'); ?>

        <?php get_template_part('partials/portal', 'menu'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">

                <div class="row">
                    <?php if ($match) : ?>
                        <div role="alert" class="alert alert-success alert-icon alert-icon-border">
                            <div class="icon"><span class="mdi mdi-check"></span></div>
                            <div class="message">
                                <strong>Student ID Found!</strong>
                                <br />We found a match for student <?php echo $_POST['last_name'] . ', ' . $_POST['first_name']; ?>.
                                <br />The User ID to use when registering for MealTime is: <code><?php echo $match; ?></code>.
                                <br />You can register by <a target="_blank" href="https://www.mymealtime.com/Register.aspx">clicking here.</a>
                            </div>
                        </div>
                    <?php elseif ($match == false) : ?>
                        <div role="alert" class="alert alert-warning alert-icon alert-icon-border">
                            <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                            <div class="message">
                                <strong>Unable to Locate Student ID</strong>
                                <br />We were unable to find a match for <?php echo $_POST['last_name'] . ', ' . $_POST['first_name']; ?>.
                                If you believe this is a mistake please email <a href="mailto:frontdesk@jeffersonrise.org?subject=MealTime%20Student%20Request%20for%20<?php echo $_POST['last_name'] . ',%20' . $_POST['first_name']; ?>">frontdesk@jeffersonrise.org</a>.
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="panel">
                        <div class="panel-heading  panel-heading-divider">
                            My Meal Plan
                            <span class="panel-subtitle">Jefferson RISE student meal plans are managed by a third party called Meal Time. Simply click the reload button below to deposit money into your students account.</span>
                        </div>
                        <div class="panel-body">

                            <div class="col-md-4 text-center">
                                <a target="_blank" href="https://www.mymealtime.com/SignIn.aspx" class="btn btn-default btn-space btn-big btn-block margin-top-50">
                                    <i class="icon mdi mdi-money-box"></i>
                                    Reload my Balance
                                </a>
                            </div>

                            <div class="col-md-2">
                                <div class="text-center margin-top-70">OR</div>
                            </div>

                            <div class="col-md-6">
                                <strong>Lookup your Student ID to Register:</strong><br /><br />
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="first_name" placeholder="Enter First Name" class="form-control">
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" name="submit" class="btn btn-space btn-primary">Lookup</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

<?php get_footer('portal'); ?>