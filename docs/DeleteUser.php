
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container"></body>
<?php 
require_once 'Class/User.php'  ; 
require_once 'Class/Admin.php' ; 
require_once 'Class/DB.php';


$conn = DBconnection::Instance() ; 
$user = new User() ; 
$admin = new Admin()  ; 
	if (isset($_POST['submit'])) {
		$value=$_POST['id'];
		if($admin->DeleteUser($value)) 
			echo "1 row affected";		
		else 
			echo "There is no user by this ID , make sure of the ID that you enter <br/>";	
    }


?>

<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Delete User</h2>
</div>

	
	<br>Enter the id of the user you want to delete : <br><br>
	<input class="w3-input w3-border w3-round-large" type="number" required name="id">	<br/>
	<input type="submit"  class="w3-btn w3-green" name="submit"  value="Delete user">	
	</div>

</form>