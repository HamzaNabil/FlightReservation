<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<body class="w3-container">
<?php 
require_once 'Class/User.php'  ; 
require_once 'Class/DB.php';


$conn = DBconnection::Instance() ; 
$user = new User() ; 

	if (isset($_POST['submit'])) {
			if (!empty($_POST['Phone'])) {
				if ($_SESSION['userid']==$_POST['userID']){
					if($user->UpdatePhone($_POST['userID'],$_POST['Phone'],$_POST['oldPass']))
						echo "Phone number Updated successfully<br/>";
				}else echo "You must enter your personal ID";
			}
    }


?>


<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Change Passwordt</h2>
</div>
		
		<br>* User ID : <input class="w3-input w3-border w3-round-large" type="number" name="userID" required> <br/>
		* User Password : <input class="w3-input w3-border w3-round-large" type="password" name="oldPass" required> <br/>
		* Update Phone : 	<input class="w3-input w3-border w3-round-large" type="text" name="Phone" required><br/>
		<input type="submit"  class="w3-btn w3-green" name="submit"  >	
</form>



</body>