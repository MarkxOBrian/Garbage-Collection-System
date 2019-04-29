<?php 
require_once '../../core/init.php';

$countS = $db->query("SELECT * FROM company_reg");
$count = mysqli_num_rows($countS);

$countSql = $db->query("SELECT * FROM signup");
$countu = mysqli_num_rows($countSql);

$countSql2 = $db->query("SELECT * FROM orders");
$counto = mysqli_num_rows($countSql2);

if (isset($_GET['delete'])) {
    $delete_id = sanitize($_GET['delete']);
    $db->query("DELETE FROM company_reg WHERE comp_id = '$delete_id'");
    $_SESSION['success_flash'] = 'Company details has been deleted !';
    header('Location: superadmin.php');
}
if (isset($_GET['deleteu'])) {
    $delete_id = sanitize($_GET['deleteu']);
    $db->query("DELETE FROM signup WHERE id = '$delete_id'");
    $_SESSION['success_flash'] = 'User details has been deleted !';
    header('Location: superadmin.php');
}
if (isset($_GET['deleteo'])) {
    $delete_id = sanitize($_GET['deleteo']);
    $db->query("DELETE FROM orders WHERE order_id = '$delete_id'");
    $_SESSION['success_flash'] = 'Order details has been deleted !';
    header('Location: superadmin.php');
}

include 'includes/head.php';
include 'includes/supersidebar.php';


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
                    <div class="col-md-3">
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Companies</h4>
                                <h2 class="font-light"><?= $count; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Users</h4>
                                <h2 class="font-light"><?= $countu; ?></h2>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Orders</h4>
                                <h2 class="font-light"><?= $counto; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h2> Welcome Admin</h2>
                                <h2><?php 
                                if (isset($_SESSION['success_flash'])) {
                                echo '<div class="bg_success"><h4 class="text-success text-center">'.$_SESSION['success_flash'].'</h4></div>';
                                unset($_SESSION['success_flash']);
                                 }
                                 ?></h2>
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
                            $sql = "SELECT * FROM company_reg ORDER BY comp_id";
                            $result = $db->query($sql);
                             ?>
                            <div class="card-body">
                                <h4 class="card-title">Latest Companies</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">NAME</th>
                                            <th class="border-top-0">CATEGORY</th>
                                            <th class="border-top-0">EMAIL</th>
                                            <th class="border-top-0">LOCATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php while ($company = mysqli_fetch_assoc($result)): ?>

                                        <tr>
                                            <td class="txt-oflo"><?= $company['comp_name']; ?></td>
                                            <td><span class="label label-success label-rounded"><?= $company['comp_category']; ?></span> </td>
                                            <td class="txt-oflo"><?= $company['comp_email']; ?></td>
                                            <td><span class="font-medium"><?= $company['comp_location']; ?></span></td>
                                            <td>
                                               <button type="button" class="btn btn-info btn-xs" id="details-modal" data-toggle ="modal" onclick="detailsmodal(<?=$company['comp_id'];?>)"><span class="fas fas-eye"></span>VIEW</button>

                                            </td>
                                            <td>
                                                <a href="superadmin.php?delete=<?=$company['comp_id']; ?>" class="btn btn-danger btn-xs" >Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <?php 
                            $sql2 = "SELECT * FROM orders ORDER BY order_id";
                            $result2 = $db->query($sql2);
                             ?>
                            <div class="card-body">
                                <h4 class="card-title">ALL Orders</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">COMPANY NAME</th>
                                            <th class="border-top-0">CLIENT EMAIL</th>
                                            <th class="border-top-0">CLIENT PHONE NO.</th>
                                            <th class="border-top-0">LOCATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php while ($order = mysqli_fetch_assoc($result2)): ?>

                                        <tr>
                                            <td class="txt-oflo"><?= $order['company_name']; ?></td>
                                            <td><span><?= $order['email']; ?></span> </td>
                                            <td class="txt-oflo">+254<?= $order['phone_number']; ?></td>
                                            <td><span class="font-medium"><?= $order['location']; ?></span></td>
                                            <td>
                                                <a href="superadmin.php?deleteo=<?=$order['order_id']; ?>" class="btn btn-danger btn-xs" >Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <?php 
                            $sql = "SELECT * FROM signup ORDER BY id";
                            $result = $db->query($sql);
                             ?>
                            <div class="card-body">
                                <h4 class="card-title">Registered Clients</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">FIRST NAME</th>
                                            <th class="border-top-0">SECOND NAME</th>
                                            <th class="border-top-0">EMAIL</th>
                                            <th class="border-top-0">PHONE NO.</th>
                                            <th class="border-top-0">LOCATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php while ($user = mysqli_fetch_assoc($result)): ?>

                                        <tr>
                                            <td class="txt-oflo"><?= $user['first_name']; ?></td>
                                            <td><span><?= $user['second_name']; ?></span> </td>
                                            <td class="txt-oflo"><?= $user['email']; ?></td>
                                            <td class="txt-oflo">+254<?= $user['cellphone']; ?></td>
                                            <td><span class="font-medium"><?= $user['location']; ?></span></td>
                                            <td>
                                                <a href="superadmin.php?deleteu=<?=$user['id']; ?>" class="btn btn-danger btn-xs" >Delete</a>
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
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
        
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
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

 ?>