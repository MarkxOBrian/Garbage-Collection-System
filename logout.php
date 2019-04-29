<?php

require_once 'core/init.php';
unset($_SESSION['SBUser']);
header('Location: indexmain.php');

unset($_SESSION['SBUser1']);
header('Location: registercom.php');

unset($_SESSION['SBUser3']);
header('Location: registercom.php')
?>