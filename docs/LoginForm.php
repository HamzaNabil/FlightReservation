<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-grey.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/siteCSS.css">
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
</head>
<?PHP
require_once("Class/Site_Config.php");
require_once("js/validator.php");
if(!isset($_SESSION)){ session_start(); }
if ( !isset( $_SESSION["origURL"] )  ){
	if(isset( $_SERVER["HTTP_REFERER"]))
		$_SESSION["origURL"] = $_SERVER["HTTP_REFERER"];
	else 
		$_SESSION["origURL"] ='Home.php';
}
if(isset($_POST['Login']))
{
	$db=DB::getinstance();
    $username=$_POST["Username"];
    $password=$_POST["Password"];
    $vali=new validate();
    if(
    !($vali->validateloginusername($username) ^
    $vali->validateloginpass($password)) && !empty($username)
    )
    if($member->Login($username,$password)==1)
    {
		
		$page=$_SESSION["origURL"];
		unset($_SESSION["origURL"]);
		header('Location:'.$page );
    }
	
}
?>
<body>
<div class="header">
<ul class=" w3-black w3-xlarge">
  <li class="w3-green"><a href="Home.php">Home</a></li>
  <li class="w3-hover-green"><a href="#">Offers</a></li>
  <li class="w3-hover-green"><a href="#">Company</a></li>
  <li class="w3-hover-green"><a href="#">Contact</a></li>
  <div class="log w3-right w3-padding-right">
      <li class="w3-hover-green"><a href="LoginForm.php">Login</a></li>
      <li class="w3-hover-green"><a href="Register.html">Sign up</a></li>
  </div>
</ul>
</div>
<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:400px; margin-top:50px;">
  
    <div class="w3-center"><br>
      <img src="images/img_avatar4.png" alt="Avatar" style="width:30%; height:100px;" class="w3-circle w3-margin-top">
    </div>

    <div class="w3-container">
      <div class="w3-section">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div><span class='error'><?php echo $member->erorr->GetErrorMessage(); ?></span></div>
        <label class="w3-label "><b>Username</b></label>
        <input class="w3-input w3-border w3-hover-border-black w3-margin-bottom" type="text" name="Username" placeholder="Enter Username" required>

        <label class="w3-label "><b>Password</b></label>
        <input class="w3-input w3-border w3-hover-border-black" type="password" name="Password" placeholder="Enter Password" required>
        
        <button class="w3-btn w3-btn-block w3-green w3-section" name="Login">Login</button>
        <input class="w3-check" type="checkbox" checked="checked"> Remember me
       </form>
      </div>
    </div>

    <div class="w3-container w3-border-top w3-padding-hor-16 w3-light-grey">
      <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
    </div>

  </div>
	
</body>
</html>
