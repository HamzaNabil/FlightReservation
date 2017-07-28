
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container">
<?php 
require_once 'Class/User.php'  ; 
require_once 'Class/Admin.php' ; 
require_once 'Class/DB.php';


$conn = DBconnection::Instance() ; 
$user = new User() ; 
$admin = new Admin()  ; 

	if (isset($_POST['submit'])) {
			if (!empty($_POST['newPass'])) {
				if($admin->UpdatePassword($_POST['userID'],$_POST['newPass'],$_POST['oldPass'])){
					echo "Password Updated successfully<br/>";
					$_POST['oldPass'] = $_POST['newPass'] ; // 3ashan ba2eet el updates ele t7t teshta8al hat5aly el old pass bel new pass 
				}
			}
			if (!empty($_POST['username'])) {
				  if($admin->UpdateUsername($_POST['userID'],$_POST['username'],$_POST['newPass']))
					echo "Username Updated successfully<br/>";
				  else echo "This username is already exists<br/>";
			}
			if (!empty($_POST['Phone'])) {
				if($admin->UpdatePhone($_POST['userID'],$_POST['Phone'],$_POST['oldPass']))
					echo "Phone number Updated successfully<br/>";
				else echo "This Phone number is already exists<br/>";
			}
    }


?>

<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Update User</h2>
</div>

		<br>* User ID : <input class="w3-input w3-border w3-round-large" type="number" name="userID" required> <br/>
		* User Password : <input class="w3-input w3-border w3-round-large" type="password" name="oldPass" required> <br/>
		Update Passowrd : <input class="w3-input w3-border w3-round-large" type="password" name="newPass" ><br/>
		Update Username : <input class="w3-input w3-border w3-round-large" type="text" name="username" ><br/>
		Update Phone : 	<input class="w3-input w3-border w3-round-large" type="text" name="Phone" ><br/>
		<input type="submit"  class="w3-btn w3-green" name="submit"  value="Delete user">
		
</form>
</body>