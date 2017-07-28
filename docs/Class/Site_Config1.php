<?php
    require_once("User.php");
	require_once("DB.php");
	require_once 'Admin.php';
 
	$db=DBconnection::Instance();
    $member=new User();
	$admin = new Admin();
 	

?>