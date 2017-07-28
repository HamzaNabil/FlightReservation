<?php
if(!isset($_SESSION)){ session_start(); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-grey.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/commonCSS.css" />

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Lato", sans-serif}
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/jscript">
function myDropFunc() {
    var x = document.getElementById("demoDrop");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}
</script>
<script type="text/jscript">
function ReportsFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}
</script>
<script>
function setURL(url){
    document.getElementById('iframe').src = url;
}
</script>
</head>
<?php

	require_once("Class/Site_Config.php");
	require_once("js/validator.php");
	
    if(isset($_POST['logout'])){
		session_destroy();
        header('Location: Home.php');
    }
    if($_SESSION['role_id']!=1)
     	header('Location: Home.php');
?>
<body >
<div class="header">
<ul class=" w3-black w3-xlarge">
  <li class="w3-green"><a href="AdminHome.php">Home</a></li>
  <li class="w3-hover-green"><a href="#">Offers</a></li>
  <li class="w3-hover-green"><a href="#">Company</a></li>
  <li class="w3-hover-green"><a href="#">Contact</a></li>
   <li class="w3-hover-green" style="width:150px;"><a href="AdminPanel.php">Admin Panel</a></li>
  <div class="w3-right w3-padding-right " style="width:50%; ">
  <li class="w3-hover-green  w3-right"><a href="Logout.php">LogOut</a></li>
  
      <li class=" w3-right" style="width:30%"><img src="<?php echo $_SESSION['imageLink'] ?>" alt="Avatar" style="width:30%; margin-top:2px; height:45px;" class="w3-circle w3-right"><a href="userProfile.php" class="w3-right" style="width:70%"><?php echo $_SESSION['fname'] ?></a></li>
     
  </div>
</ul>
</div>
<nav class="w3-sidenav w3-light-grey w3-card-8" style="width:200px; padding-top:2px;">
  <a href="#" class="w3-green ">Options</a> 
  <a onclick="setURL('list_users1.php')" href="#">List Users</a>
  <a onclick="setURL('AddUser.php')" href="#">Add User</a>
  <a onclick="setURL('DeleteUser.php')" href="#">Delete User</a>
  <a onclick="setURL('UpdateUser.php')" href="#">Update User</a>
  <div class="w3-dropdown-click">
    <a onclick="myDropFunc()" href="#">
      Flights Controll <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoDrop" class="w3-dropdown-content w3-white w3-card-4">
    <a onclick="setURL('AddFlight.php')" href="#">Add Flight</a>
      <a onclick="setURL('UpdateFlight.php')" href="#">Update Flight</a>
      <a onclick="setURL('DeleteFlight.php')" href="#">Delete Flight</a>
      
    </div>
  </div>
  <div class="w3-accordion">
    <a onclick="ReportsFunc()" href="#">
      Reports <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-accordion-content w3-white w3-card-4">
      <a href="#">Flight Reports</a>
      <a href="#">Company Reports</a>
    </div>
  </div>
</nav>
<div class="AdminFrame">
<iframe class="iframe"  id="iframe" src="" frameborder="0" scrolling="" onload="resizeIframe(this)" />
</div>

</body>
</html>
