<?php get_header('portal'); ?>

        <?php get_template_part('partials/portal', 'menu'); ?>

        <div class="be-content">
            <div class="main-content container-fluid">

                <div class="row">
                    <div class="panel">
                        <div class="panel-heading  panel-heading-divider">
                            My Meal Plan
                            <span class="panel-subtitle">Jefferson RISE student meal plans are managed by a third party called Meal Time. Simply click the reload button below to deposit money into your students account.</span>
                        </div>
                        <div class="panel-body">

                            <div class="col-md-4 text-center">
                                <a target="_blank" href="https://jeffersonrise19.mealtime5.com/base/SignIn.aspx" class="btn btn-primary btn-space btn-big btn-block margin-top-50">
                                    <i class="icon mdi mdi-money-box"></i>
                                    Reload my Balance
                                </a>
                            </div>

                            <div class="col-md-2">
                                <div class="text-center margin-top-50">OR</div>
                            </div>

                            <div class="col-md-6">
                                <strong>Lookup your username & password:</strong>
                                <form>
                                    <div class="form-group">
                                        <!-- <label>Email address</label> -->
                                        <input type="text" placeholder="Enter Student Last Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Password</label> -->
                                        <input type="text" placeholder="Enter Student First Name" class="form-control">
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-space btn-primary">Lookup</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

<?php get_footer('portal'); ?>