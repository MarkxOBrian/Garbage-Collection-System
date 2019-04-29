<?php 
function display_errors($errors){
	$display = '<ul class="bg-warning" style="padding-top: 40px;">';
	foreach ($errors as $error) {
		$display .= '<li class="text-danger text-center">'.$error.'<li>';
		# code...
	}
	$display .='</ul>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty, ENT_QUOTES, "utf-8");
}

function login($user_id){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date('Y-m-d H:i:s');
	$db->query("UPDATE signup SET last_login = '$date' WHERE id = '$user_id'");
	$_SESSION['success_flash'] = 'You are now logged in!';
	header('Location: html/WCS/clientindex.php');
}

function login2($user_id1){
	$_SESSION['SBUser1'] = $user_id1;
	global $db;
	$date = date('Y-m-d H:i:s');
	$db->query("UPDATE company_reg SET last_login = '$date' WHERE comp_id = '$user_id1'");
	$_SESSION['success_flash'] = 'You are now logged in!';
	header('Location: html/WCS/adminindex.php');
}
function login3($user_id3){
	$_SESSION['SBUser3'] = $user_id1;
	global $db;
	$date = date('Y-m-d H:i:s');
	$db->query("UPDATE superadmin SET last_login = '$date' WHERE super_id = '$user_id3'");
	$_SESSION['success_flash'] = 'You are now logged in!';
	header('Location: html/WCS/superadmin.php');
}

function is_logged_in(){
	if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
		return true;
	}
	return false;
}
function is_logged_in2(){
	if(isset($_SESSION['SBUser1']) && $_SESSION['SBUser1'] > 0){
		return true;
	}
	return false;
}

function login_error_redirect($url = '/ProjectMini/indexmain.php'){
	$_SESSION['error_flash'] = 'You Must be logged in to access that page';
	header('Location: '.$url);
}

 ?>
