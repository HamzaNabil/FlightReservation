<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container"></body>
<?php 
require_once 'Class/User.php'  ; 
require_once 'Class/Admin.php' ; 
require_once 'Class/Database.php';
require_once 'Class/DB.php';
$conn = DBconnection::Instance(); 
$user = new User() ; 
$admin = new Admin()  ; 
$mysql = new newDB() ; 
if (isset($_POST['submit'])) {
 	$user->setFirstname($_POST['Firstname']) ; 
	$user->setLastname($_POST['Lastname']) ; 
	$user->setUsername($_POST['Username']) ; 
	$user->setPassword($_POST['Password']) ; 
	$user->setUserType($_POST['Usertype'][0]) ; 
	$user->setEmail($_POST['Email']) ; 
	$user->setPhone($_POST['Phone'])  ;
	$user->setAge($_POST['Age']) ; 
	$user->setGender($_POST['Gender']) ; 
	$user->setAddress($_POST['Address']) ; 
	$user->setImageId(1) ; 
	$user->setCountryId($_POST['country']) ; 

	$checkFullname = "SELECT * FROM flight_sys.users WHERE 
					  users.Fname LIKE '".$user->getFirstname()."' AND users.Lname LIKE '".$user->getLastname()."'  " ; 
	if ($mysql->num_rows($mysql->run_query($checkFullname)) == 0  ) {
		$checkUsername = "SELECT * FROM flight_sys.users WHERE users.UserName LIKE '".$user->getUsername()."' " ;
		if ($mysql->num_rows($mysql->run_query($checkUsername)) == 0 ) {
			$checkEmail = "SELECT * FROM flight_sys.users WHERE users.Email LIKE '".$user->getEmail()."' " ; 
			if ($mysql->num_rows($mysql->run_query($checkEmail)) == 0 ) {
				$checkPhone = "SELECT * FROM flight_sys.users WHERE users.Phone LIKE '".$user->getPhone()."' " ; 
				if ($mysql->num_rows($mysql->run_query($checkPhone)) == 0 ){
						  	if( $admin->addUser($user) ) // add user here after validation
								 echo "Successful Add " ;
							else echo "Unsuccessfull Add , please try agian";						
				}else echo "This Phone number is already exists<br/>";
			}else echo "This Email is already exists<br/>";
		} else echo "This username is already exists , choose another Username <br/>";
	}else echo "This user is already exists<br/>";
	
}


?>

<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Add User </h2><br>
</div>


	Firstname :  <input class="w3-input w3-border w3-round-large" type="text" name="Firstname" placeholder="Firstname" maxlength="20" minlength="3" required> <br/>
	Lasname   :  <input class="w3-input w3-border w3-round-large" type="text" name="Lastname" placeholder="Lasname" maxlength="20" minlength="3" required> <br/>
	Username  :  <input class="w3-input w3-border w3-round-large" type="text" name="Username" placeholder="Username" maxlength="20" minlength="5" required> <br/>
	Password  :  <input class="w3-input w3-border w3-round-large" type="password" name="Password" placeholder="Password" maxlength="30" minlength="6" required> <br/>
	
	<?php 
	echo "Usertype  : "; 	
	
	//foreach(DB::getinstance()->query('SELECT * FROM flight_sys.role') as $row) {
	//	echo "<input type = 'radio' name = 'Usertype' value ='$row[id]' required> " ;
	//	echo ".$row[id].";
	//	echo ".$row[RoleName].";
	//}
		$usertypes = "SELECT * FROM flight_sys.role" ; 
		$run = $mysql->run_query($usertypes) ; 
		$rows = $mysql->num_rows($run) ; 
		while ($rows--) {
			$usertype = $mysql->fetch_rows($run) ; 
		echo "<input type = 'radio' name = 'Usertype' value ='$usertype[0]' required> " ; 
		echo " ".$usertype[1]." " ;
		}
	 ?>
	 <br/>
	 Email : 	<input class="w3-input w3-border w3-round-large" type="email" name="Email" placeholder="Email@example.com" required> <br/> 
	 Phone :    <input class="w3-input w3-border w3-round-large" type="text" name="Phone" placeholder="Phone number" maxlength="11" minlength="11" required> <br/>
	 Age   :    <input class="w3-input w3-border w3-round-large" type="number" name="Age" placeholder="Age" maxlength="2" minlength="1" min="1" required><br/>
	 Gender :   <input type="radio" name="Gender" value ="Male" required>Male </input>
	 			<input type="radio" name="Gender" value ="Female" required>Female </input><br/><br>
	 Address :    <input class="w3-input w3-border w3-round-large" type="text" name="Address" placeholder="Address" maxlength="30" minlength="5" required> <br/>
	 Country :   
	 	<?php  
			$Country = "SELECT * FROM flight_sys.country" ; 
			$run = $mysql->run_query($Country) ; 
			$rows = $mysql->num_rows($run) ; 
			echo "<select name='country'>";
			while ($rows--) {
				$country = $mysql->fetch_rows($run) ; 
				echo "<option class='w3-input w3-border w3-round-large' name = 'country' value ='$country[0]' required> " ; 
				echo " ".$country[1]."</option>" ;
			}
			echo "</select>";	

	 	?><br/><br>
	 	<input type="submit" name="submit">

</form>