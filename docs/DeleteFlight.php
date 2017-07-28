<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container"></body>
<?php 
require_once 'Class/DB.php';
require_once 'Class/Admin.php';
$conn = DBconnection::Instance() ;
$admin=new Admin();
		if (isset($_POST['delete'])) {
			if ($admin->DeleteFlight($_POST['FlightID'])) {
					echo "Flight deleted successfully";
			}else {
				echo "There is not flight with this ID<br/>";
			}
		}
?>

<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Delete Flight</h2>
</div>

	<br>Enter Flight ID You want to Delete :<br><br> <input class="w3-input w3-border w3-round-large" type="number" name="FlightID" required><br>
	
 <input type="submit"  class="w3-btn w3-green" name="delete"  value="Delete Flight">	
</form>