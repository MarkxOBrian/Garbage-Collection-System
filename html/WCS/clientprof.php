<?php
require_once '../../core/init.php';

if (!is_logged_in()) {
    login_error_redirect();
}

$countS = $db->query("SELECT * FROM company_reg");
$count = mysqli_num_rows($countS);

$countSql = $db->query("SELECT * FROM signup");
$countu = mysqli_num_rows($countSql);
$db->query("SELECT * FROM signup WHERE email = 'email'");

if (isset($_GET['delete'])) {
    $delete_id = sanitize($_GET['delete']);
    $db->query("DELETE FROM company_reg WHERE comp_id = '$delete_id'");
    $_SESSION['success_flash'] = 'Company details has been deleted !';
    header('Location: clientindex.php');
}

include 'includes/head.php';
include 'includes/sidebar.php';


 ?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profile</h4>
                    </div>

                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../../assets/images/users/123.jpg" class="rounded-circle" width="150" alt="profile photo" />
                                    <h4 class="card-title m-t-10"><?= $user_data['first']; ?></h4>
                                    <h4 class="card-title m-t-10"></h4>
                                
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">Welcome</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?= $userc; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?= $userl; ?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?= $userl; ?></h6>
                                <div class="map-box">
                                    <iframe src="https://www.google.com/maps/" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?= $user_data['first']; ?>" class="form-control form-control-line" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" value="<?= $usere; ?>" class="form-control form-control-line" name="example-email" id="example-email" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?= $userl; ?>" class="form-control form-control-line" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="<?= $userc; ?>" class="form-control form-control-line" readonly="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
</body>

</html>