<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container"></body>
<?php
require_once 'Class/DB.php' ; 	
require_once 'Class/Admin.php' ;
$conn = DBconnection::Instance();

$admin = new Admin()  ;
	if (isset($_POST['update'])) {
			$FlightID = $_POST['FlightID'] ; 
			if (!empty($_POST['deptDate'])) {
				if($admin->UpdateDeptDate($FlightID, $_POST['deptDate'])){
					echo "Departure date updated successfully<br/>";
				}else echo "The departure date must be less than return date of the flight<br/>";
			}

			if (!empty($_POST['retDate'])) {
				if($admin->UpdateReturnDate($FlightID,$_POST['retDate'])){
					echo "Return date updated successfully<br/>";
				}else echo "The Return date must be greater than departure date of the flight<br/>";				
			}

			if (!empty($_POST['airCraft'])) {
				if ($admin->UpdateAircraft($FlightID,$_POST['airCraft'])) {
					echo "Aircraft Updated successfully<br/>";
				}
			}

			if (!empty($_POST['BuisnessCost'])) {
				 if ($admin->UpdateBuisnessCost($FlightID,$_POST['BuisnessCost'])) {
				 	 echo "Buisness Cost Updated successfully<Br/>";
				 }
			}

			if (!empty($_POST['EconomyCost'])) {
				 if ($admin->UpdateEconomyCost($FlightID,$_POST['BuisnessCost'])) {
				 	 echo "Economy Cost Updated successfully<Br/>";
				 }	 
			}		
	}

?>



<form class="w3-container" method="POST" >
	<div >

<div class="w3-container w3-green">
  <h2>Update Flight</h2>
</div>

	
   <br>* Flight ID : <input class="w3-input w3-border w3-round-large" type="number" name="FlightID" required> <br/>
     Update Flight departure date :  
	 	<input class="w3-input w3-border w3-round-large" type="date" name="deptDate" >
	 	<br/>
	 Update Flight return date : 
	 	<input class="w3-input w3-border w3-round-large" type="date" name="retDate" >	 <br/>	
	 Update Aircraft : <br>
	 	<?php  
			$aircraft = "SELECT * FROM flight_sys.aircraft" ; 
			$run = mysql_query($aircraft) ; 
			$rows = mysql_num_rows($run) ; 
			echo "<select name='airCraft'>";
			echo "<option class='w3-input w3-border w3-round-large' name='airCraft' value='' >";
			while ($rows--) {
				$airCraft = mysql_fetch_row($run) ; 
				echo "<option class='w3-input w3-border w3-round-large' name = 'airCraft' value ='$airCraft[0]'> " ; 
				echo " ".$airCraft[1]."</option>" ;
			}
			echo "</select>";	

	 	?><br/>
	 Update buisness class ticket cost : 
	 <input class="w3-input w3-border w3-round-large" type="number" min="1500" name="BuisnessCost" placeholder="value must be greater than or equal 1500"> <br/>

	 Update Economy class ticket cost : 
	 <input class="w3-input w3-border w3-round-large" type="number" min="1000" name="EconomyCost" placeholder="value must be greater than or equal 1000"> <br/>
	 <input type="submit"  class="w3-btn w3-green" name="update"  value="Update Flight">	 
	 


</form>