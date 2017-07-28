<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body class="w3-container">
<body class="w3-container"></body>
<?php 
require_once 'Class/DB.php' ; 
require_once 'Class/Admin.php' ;
require_once 'Class/Subject.php' ; 

$conn = DBconnection::Instance() ;
$admin=new Admin();
	if (isset($_POST['submit'])) {

		$SrcCountryID = $_POST['srcCountry']; 
		$DestCountryID = $_POST['destCountry'] ; 
		$DepartureDate = $_POST['deptDate'] ; 
		$ReturnDate = $_POST['retDate'] ; 
		$AirCraftID = $_POST['airCraft'] ; 
		$numBuisnessSeats = $_POST['BuisnessSeats'] ; 
		$numEconomySeats = $_POST['EconomySeats'] ; 
		//$flightTypeID = $_POST['flightType'] ; 	// mafesh 7aga fel database torbot el re7la ele bey7otaha el 
													//admin bel type bta3 el re7la eza kanet one way wala round trip
		$BuisnessCost = $_POST['BuisnessCost'] ; 
		$EconomyCost = $_POST['EconomyCost'] ; 

		if ($SrcCountryID != $DestCountryID) {
			if ($DepartureDate < $ReturnDate && $DepartureDate > date("Y-m-d")) {
				if($admin->addFlight($SrcCountryID,$DestCountryID,$DepartureDate,$ReturnDate,$AirCraftID,$numBuisnessSeats,
					$numEconomySeats  , $EconomyCost ,$BuisnessCost) )
					{
						echo "Successfully adding flight<br/>";
						// send notification to system users with this flight 
						$flight = new ProductSubject() ; 
						// TODO...
						// collect emails 
						// for each email get , call function register in flight object 
						$Emails = "SELECT Email FROM flight_sys.users WHERE users.Role_id=2 " ; // users emails query
						$run = DBconnection::run_query($Emails) ; 
						$rows = DBconnection::num_rows($run) ; 
						$check = 0 ; 
						while ($rows--) {
							$CurrentEmail = DBconnection::fetch_rows($run) ;
							$flight->register($CurrentEmail[0]) ; 
							$check++ ; 
						}
						if ($check) {
							$contentOfEmail = "A new flight added from ".$SrcCountryID." to ".$DestCountryID." with cost of economy class ".$EconomyCost."
							 and Buisness class cost ".$BuisnessCost." the departure date is ".$DepartureDate ; 
							$flight->notify($contentOfEmail) ; 
							echo "Users are notified throught their emails with this flight<br/>";
						}
						else {
							echo "no users to send notification<br/>";
						}
					}
				else echo "Unsuccessfull adding flight<br/>";
			}else {
				echo "Departure date must be Greater than the date of today and greater than the Return date  <br/>";
			}
		}else {
			echo "You must choose different distnations in the source and distnation countries <br/>";
		}


    }


?>

<form class="w3-container" method="POST" alter="center">
	<div >

<div class="w3-container w3-green">
  <h2>Add Flight</h2>
</div>

		Source Country :   
	 	<?php  
			$Country = "SELECT * FROM flight_sys.airport" ; 
			$run = DBconnection::run_query($Country) ; 
			$rows = DBconnection::num_rows($run) ; 
			echo "<select class='w3-input w3-border w3-round-large' name='srcCountry'>";
			while ($rows--) {
				$srcCountry = DBconnection::fetch_rows($run) ; 
				echo "<option class='w3-input w3-border w3-round-large' name = 'srcCountry' value ='$srcCountry[0]' required> " ; 
				echo " ".$srcCountry[2]."</option>" ;
			}
			echo "</select>";	

	 	?><br/>

	 	Distnation Country :
	 	<?php  
			$Country = "SELECT * FROM flight_sys.airport" ; 
			$run = DBconnection::run_query($Country) ; 
			$rows = DBconnection::num_rows($run) ; 
			echo "<select class='w3-input w3-border w3-round-large' name='destCountry'>";
			while ($rows--) {
				$destCountry = DBconnection::fetch_rows($run) ; 
				echo "<option class='w3-input w3-border w3-round-large' name = 'destCountry' value ='$destCountry[0]' required> " ; 
				echo " ".$destCountry[2]."</option>" ;
			}
			echo "</select>";	

	 	?><br/>


	 	Departure date : 
	 	<input class="w3-input w3-border w3-round-large" type="date" name="deptDate" required>
	 	<br/>
	 	Return date : 
	 	<input class="w3-input w3-border w3-round-large" type="date" name="retDate" required>	 <br/>	


	 	Select Aircraft : 
	 	<?php  
			$aircraft = "SELECT * FROM flight_sys.aircraft" ; 
			$run = DBconnection::run_query($aircraft) ; 
			$rows = DBconnection::num_rows($run) ; 
			echo "<select class='w3-input w3-border w3-round-large' name='airCraft'>";
			while ($rows--) {
				$airCraft = DBconnection::fetch_rows($run) ; 
				echo "<option class='w3-input w3-border w3-round-large' name = 'airCraft' value ='$airCraft[0]' required> " ; 
				echo " ".$airCraft[1]."</option>" ;
			}
			echo "</select>";	

	 	?><br/>


	 	How many Buisness class seats : <input class="w3-input w3-border w3-round-large" type="number" name="BuisnessSeats" min="10" required placeholder="value must be greater than or equal 10"><br/>
	 	Price of Buisness ticket : <input class="w3-input w3-border w3-round-large"type="number" name="BuisnessCost" min="1500" placeholder="value must be greater than or equal 1500"><br/>

	 	How many Economy class seats : <input class="w3-input w3-border w3-round-large" type="number" name="EconomySeats" min="20" required placeholder="value must be greater than or equal 20"><br/>
	 	Price of Economy ticket : <input class="w3-input w3-border w3-round-large" type="number" name="EconomyCost" min="1000" placeholder="value must be greater than or equal 1000"><br/>


	 	
	 	
	 	<?php  
	 	/* malhash makan fel database a7ot feeh eza kanet el re7la nafsaha leha one way wala round trip
			$flightTypeQuery = "SELECT * FROM flight_sys.flight_type" ; 
			$run = mysql_query($flightTypeQuery) ; 
			$rows = mysql_num_rows($run) ; 
			echo "<select name='flightType'>";
			while ($rows--) {
				$flightType = mysql_fetch_row($run) ; 
				echo "<option name = 'flightType' value ='$flightType[0]' required> " ; 
				echo " ".$flightType[1]."</option>" ;
			}
			echo "</select>";	
		*/
	 	//<input type="submit" name="submit">
	 	?><br/>

<input type="submit"  class="w3-btn w3-green" name="submit">

</div>


</form>

