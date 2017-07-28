<?php
    require_once("User.php");
	require_once("Database.php");
	require_once 'Admin.php';
	$db=DB::getinstance();
    $member=new User();
	$admin = new Admin();
?>