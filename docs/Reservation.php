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
<link rel="stylesheet" type="text/css" href="css/siteCSS.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Lato", sans-serif}
body{}
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
.mid {width:100%; height:500px;
position:relative;


}
.message{
	width:50%;
	height:450px;
	margin-left:25%;
	margin-top:25px;
	position:absolute;
	background:#FFF;
	border-top:4px  solid;
	border-bottom:4px  solid;
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>




</head>
<?php

	require_once("Class/Site_Config.php");
	require_once("Class/RoundTrip_Reserve.php");
	require_once("Class/OneWay_Reserve.php");
	require_once("Class/Generate_Reserve.php");
	require_once("js/validator.php");
	
    if(isset($_POST['logout'])){
		session_destroy();
        header('Location: Home.php');
    }
    if(!isset($_SESSION['role_id'])){
		 if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		else
			header('Location: LoginForm.php');
	}
?>
<body class>
<div class="header">
<?php
    $id=3;
	if(isset($_SESSION['role_id']))
		$id=$_SESSION['role_id'];
	$query="select Menu_Content from flight_sys.menus where Role_id='".$id."'";
	$result=$db->query($query);
	echo $result[0]["Menu_Content"];
 if(isset($_SESSION['role_id'])){
	echo '<li class="w3-hover-green  w3-right"><a href="Logout.php">LogOut</a></li>
	<li class=" w3-right" style="width:30%"><img src="';?> <?php echo $_SESSION['imageLink'] ?><?php echo '" alt="Avatar" style="width:30%; margin-top:2px; height:45px;" class="w3-circle w3-right"><a href="userProfile.php" class="w3-right" style="width:70%">';?> <?php echo $_SESSION['fname'] ?> <?php echo' </a></li> </div></ul>';
 }
?>
</div>
<div class="mid">
	<div class="w3-card-24 message w3-border-green w3-animate-zoom ">
     	<div class="w3-center">
         	<?php echo ' <img src="'.$_POST['img'].'" alt="Avatar" style="width:30%; height:100px;" class="w3-circle w3-margin-top">'
			?>
             </br>
             <span class="w3-xlarge">Success</span>
        </div>
<?php 
	if(isset($_POST['submit'])){
		$CHECK=0;
	if($_POST['type']="Round Tripe"){
		$Type_Of_Search  = new RoundTrip_Reservation;
		$resrv=new ReserveGenerator($Type_Of_Search);
		$CHECK=$resrv->Do_Reserve($_POST['Did'],$_POST['Rid'],$_SESSION['userid'],$_POST['class'],$_POST['Number'],$_POST['price']);
	}
	else{ 
		$resrv=new ReserveGenerator('OneWay_Reservation');
		$CHECK=$resrv->Do_Reserve($_POST['Did'],"",$_SESSION['userid'],$_POST['class'],$_POST['Number'],$_POST['price']);
	}
	if($CHECK){
     echo '   <div class="w3-container">
      <div class="w3-section">
      <table class="w3-table w3-striped w3-border">
            <thead>
            <tr class="w3-green">
              <th>From</th>
              <th>To</th>
              <th>Type</th>
            </tr>
            </thead>
            <tr>
              <td>'.$_POST['from'].'</td>
              <td>'.$_POST['to'].'</td>
              <td>'.$_POST['class'].'</td>
            </tr>
            <tr class="w3-green">
              <th colspan="2">Depatur Date</th>
               <th colspan="">Arrive Date</th>
            </tr>
            
            </thead>
            <tr>
              <td colspan="2">'.$_POST['Ddepart'].'</td>
              <td colspan="">'.$_POST['Darrive'].'</td>
            </tr>
            <tr class="w3-green">
              <th >Number OF Tickets</th>
              <th >Class</th>
              <th >Total price</th>
            </tr>
            </thead>
            <tr>
              <td colspan="">'.$_POST['Number'].' </td>
              <td colspan="">'.$_POST['type'].' </td>
              <td colspan="">'.$_POST['price'].' </td>
            </tr>
            
           </table>
           </div>
           </div>';
	}
		   else {
			   echo "<script>history.go(-1)</script>";
			 }
	}
	else
	 echo "<script>history.go(-1)</script>"; 
		   
		  ?>
	<button onclick="history.go(-1)" class="w3-btn w3-green w3-center" style="margin-left:25% ;width:50%;"  value="Done">Done</button>
    
</div>
</div>

<footer class="w3-container w3-black w3-center  " style="position:absolute;  width:100%;"> 
 <div class="w3-xlarge">
   <a href="#" class="w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-red w3-show-inline-block"><i class="fa fa-pinterest-p"></i></a>
   <a href="#" class="w3-hover-text-light-blue w3-show-inline-block"><i class="fa fa-twitter"></i></a>
   <a href="#" class="w3-hover-text-grey w3-show-inline-block"><i class="fa fa-flickr"></i></a>
   <a href="#" class="w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-linkedin"></i></a>
 </div>
  <p style="font-weight:normal">Powered by <a href="#" target="_blank"></a></p>
</footer>
</body>
</html>
