<?php
// Start session with secure settings
session_start();

// Load required files
require_once 'app/config/config.php';
require_once 'app/core/ErrorHandler.php';
require_once 'app/models/User.php';
require_once 'app/models/Company.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/CompanyController.php';

// Set error reporting based on environment
if (defined('ENVIRONMENT') && ENVIRONMENT === 'production') {
	error_reporting(0);
	ini_set('display_errors', 0);
	ErrorHandler::setDebug(false);
} else {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ErrorHandler::setDebug(true);
}

// Set error handlers
set_error_handler([ErrorHandler::class, 'handleError']);
set_exception_handler([ErrorHandler::class, 'handleException']);
register_shutdown_function([ErrorHandler::class, 'handleShutdown']);

// Database connection
try {
	$db = new PDO(
		"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
		DB_USER,
		DB_PASS,
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false
		]
	);
} catch (PDOException $e) {
	ErrorHandler::addError('Database connection failed: ' . $e->getMessage(), $e->getCode());
	die('An error occurred. Please try again later.');
}

// Helper functions
function redirect($path) {
	try {
		header("Location: " . BASEURL . $path);
		exit();
	} catch (Exception $e) {
		ErrorHandler::addError('Redirect failed: ' . $e->getMessage());
	}
}

function isLoggedIn() {
	return isset($_SESSION['user_id']);
}

function isCompanyLoggedIn() {
	return isset($_SESSION['company_id']);
}

function sanitize($data) {
	try {
		return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
	} catch (Exception $e) {
		ErrorHandler::addError('Sanitization failed: ' . $e->getMessage());
		return '';
	}
}

function flash($name = '', $message = '', $class = 'alert alert-success') {
	try {
		if (!empty($name)) {
			if (!empty($message) && empty($_SESSION[$name])) {
				$_SESSION[$name] = $message;
				$_SESSION[$name . '_class'] = $class;
			} elseif (empty($message) && !empty($_SESSION[$name])) {
				$class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
				echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
				unset($_SESSION[$name]);
				unset($_SESSION[$name . '_class']);
			}
		}
	} catch (Exception $e) {
		ErrorHandler::addError('Flash message failed: ' . $e->getMessage());
	}
}

$db = mysqli_connect("127.0.0.1", "root", "", "waste_mngt");
if (!$db) {
	error_log("Could not connect to the Database");
	exit("An error occurred. Please try again later.");
}

require_once $_SERVER['DOCUMENT_ROOT'].'/ProjectMini/config.php';
require_once BASEURL.'helpers/helpers.php';

if (isset($_SESSION['SBUser'])) {
	$user_id = $_SESSION['SBUser'];
	$query = $db->query("SELECT * FROM signup WHERE id = '$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$user_data['first_name']);
	$user_data['first'] = $fn[0];
	$usere = $user_data['email'];
	$userc = $user_data['cellphone'];
	$userl = $user_data['location'];
}
if (isset($_SESSION['SBUser1'])) {
	$user_id1 = $_SESSION['SBUser1'];
	$query = $db->query("SELECT * FROM company_reg WHERE comp_id = '$user_id1'");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$user_data['comp_name']);
	$user_data['first'] = $fn[0];
	$usern = $user_data['comp_name'];
	$usere = $user_data['comp_email'];
	$usercat = $user_data['comp_category'];
	$userl = $user_data['comp_location'];
	$userd = $user_data['comp_dtls'];
	$userprofile = $user_data['comp_logo'];
	
}
if (isset($_SESSION['SBUser3'])) {

	$super_id = $_SESSION['SBUser3'];
	$querys = $db->query("SELECT * FROM superadmin WHERE super_id = '$super_id'");
	$user_datas = mysqli_fetch_assoc($querys);
	$super = $super['super_email'];

	$queryc = $db->query("SELECT * FROM company_reg ORDER BY comp_id");
	$user_data = mysqli_fetch_assoc($queryc);
	$fn = explode(' ',$user_data['comp_name']);
	$user_data['first'] = $fn[0];
	$usern = $user_data['comp_name'];
	$usere = $user_data['comp_email'];
	$usercat = $user_data['comp_category'];
	$userl = $user_data['comp_location'];
	$userd = $user_data['comp_dtls'];
	$userprofile = $user_data['comp_logo'];

	$queryu = $db->query("SELECT * FROM signup ORDER BY id");
	$user_data = mysqli_fetch_assoc($queryu);
	$fn = explode(' ',$user_data['first_name']);
	$user_data['first'] = $fn[0];
	$usere = $user_data['email'];
	$userc = $user_data['cellphone'];
	$userl = $user_data['location'];


	
}

?>