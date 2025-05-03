<?php
require_once 'app/config/config.php';
require_once 'core/init.php';

// Initialize controllers
$userController = new UserController($db);
$companyController = new CompanyController($db);

// Handle user registration
if (isset($_GET['add'])) {
    $userController->register();
}

// Handle user login
if (isset($_GET['check'])) {
    $userController->login();
}

// Get companies for display
$companies = $companyController->getAllCompanies();

// Include header
include 'includes/head.php';
include 'includes/navigation.php';

// Display any errors
echo ErrorHandler::displayErrors();

// Include views
include 'app/views/auth/login.php';
include 'app/views/auth/register.php';
include 'app/views/auth/company_register.php';
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="main box-border">
                <!-- Slider content -->
                <div id="mi-slider" class="mi-slider">
                    <!-- ... existing slider code ... -->
                </div>
            </div>
        </div>
    </div>

    <!-- Companies List -->
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="#" class="list-group-item active">Garbage Collection Companies</a>
                <ul class="list-group">
                    <?php foreach ($companies as $company): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($company['comp_name']) ?>
                            <span class="label label-primary pull-right">
                                <?= htmlspecialchars($company['comp_location']) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

<!-- Scripts -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
<script src="assets/ItemSlider/js/jquery.catslider.js"></script>
<script>
    $(function() {
        $('#mi-slider').catslider();
    });
</script> 