<?php
require_once '../../core/init.php';

if (!is_logged_in()) {
    login_error_redirect();
}

$countS = $db->query("SELECT * FROM company_reg WHERE comp_location = '$userl'");
$count = mysqli_num_rows($countS);

$countSql = $db->query("SELECT * FROM signup");
$countu = mysqli_num_rows($countSql);

ob_start();

include 'includes/head.php';
include 'includes/sidebar.php';



if (isset($_GET['order'])) {

    $order_id = sanitize($_GET['order']);

     $order = "SELECT * FROM company_reg WHERE comp_id = '$order_id'";
     $result = $db->query($order);
       $orders = mysqli_fetch_assoc($result);

    $company_name = $orders['comp_name'];
    $email = $usere;
    $location = $userl;
    $phone_number = $userc;

    $sql2 = $db->query("INSERT INTO orders (company_name, email, location, phone_number) VALUES ('$company_name', '$email', '$location', '$phone_number') ");

    $_SESSION['success_flash'] = 'Order made successfully!';
    header('Location: clientindex.php');

}



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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Companies</h4>
                                <h2 class="font-light"><?= $count; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Users</h4>
                                <h2 class="font-light"><?= $countu; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0" align="text-center">Hello <?= $user_data['first']; ?> !</h4>
                                <h2 class="font-light">
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <?php
                             $sql = "SELECT * FROM company_reg WHERE comp_location = '$userl'";
                                $result = $db->query($sql);
                                    ?>
                            <div class="card-body">
                                <h4 class="card-title">Companies In Your Location</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">NAME</th>
                                            <th class="border-top-0">CATEGORY</th>
                                            <th class="border-top-0">EMAIL</th>
                                            <th class="border-top-0">LOCATION</th>
                                            <th class="border-top-0">PHONE NO.</th>
                                            <th class="border-top-0">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($company = mysqli_fetch_assoc($result)): ?>

                                        <tr>
                                            <td class="txt-oflo"><?= $company['comp_name']; ?></td>
                                            <td><span class="label label-success label-rounded"><?= $company['comp_category']; ?></span> </td>
                                            <td class="txt-oflo"><?= $company['comp_email']; ?></td>
                                            <td><span class="font-medium"><?= $company['comp_location']; ?></span></td>
                                            <td class="txt-oflo">+254<?= $company['comp_phone']; ?></td>
        
                                                
                                            <td>
                                                <a href="clientindex.php?order=<?= $company['comp_id']; ?>" class="btn btn-success btn-xs">Order</a>
                                               <button type="button" class="btn btn-info btn-xs" id="details-modal" data-toggle ="modal" onclick="detailsmodal(<?=$company['comp_id'];?>)"><span class="fas fas-eye"></span>VIEW</button>

                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Smart Disposal System. Designed and Developed by
                <a href="https://.com">Brian Ouma Omondi</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
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
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="../../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../../dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>