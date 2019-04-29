<?php

$db = mysqli_connect("127.0.0.1","root","","waste_mngt") or die('Could not connect to the Database');

session_start();
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