<?php
/**
* 
*/
require_once 'Person.php'; 
require_once 'Database.php';
require_once 'User.php' ; 

class Admin extends person
{
public function getUsers(){
		$db=DB::getinstance(); 
		$query = "SELECT * , users.id as user FROM flight_sys.users left JOIN flight_sys.role ON users.id = role.id 
		left join image on image.id=Image_id
		left join country on country.id=Country_id
		" ; 
		return $db->query($query);
		
	}

	public function counts($results=array())
	{
		$count=array(0,0);
		foreach ($results as $key =>$value)
		{
			if($value['active'])
			{
				$count[1]++;
			}
			else
			{
				$count[0]++;
			}
	
		}
		return $count;
	}
	
	
	public function addUser($user)
	{
		//$conn = DBconnection::Instance() ; 	
		$query = "INSERT INTO flight_sys.users(UserName,Password,Age,Email,Adress,Phone,Gender,Role_id,image_id,Country_id,Fname,Lname,active)
		VALUES('".$user->getUsername()."','".$user->getPassword()."','".$user->getAge()."','".$user->getEmail()."','".$user->getAddress()."',
		'".$user->getPhone()."','".$user->getGender()."','".$user->getUserType()."',
		'".$user->getImageId()."','".$user->getCountryId()."','".$user->getFirstname()."','".$user->getLastname()."','1')  " ;
		$run = DBconnection::run_query($query) ;
		if ($run)
			return true ;
		else return false ;
	
	}

	public function DeleteUser($value)
	{
		$conn = DBconnection::getinstance() ;
		$SelectQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$value."'; " ; 
		 
		if (DBconnection::num_rows(DBconnection::run_query($SelectQuery))==1) {
				$delQuery = "DELETE FROM flight_sys.users WHERE users.id = '".$value."' " ; 
				$run = DBconnection::run_query($delQuery)  ; 
				if ($run) 
					return true ;
				
		}
		else return false ;
	}


// Update functions ele gayeen dool , kol wa7da fe function lwa7daha 3ashan low 7abbet testa5dem ay wa7da w mesh 3ayez el tanya f ay makan tany b3d kda teb2a enta 7or 
// mesh molzam enak te3ml kol el updates m3 b3d

	public function UpdatePassword($ID , $newPassword , $oldPassword)
	{
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ; 
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
				$UpdateQuery = "UPDATE flight_sys.users SET users.Password = '".$newPassword."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ; 
				$run = DBconnection::run_query($UpdateQuery) ; 
				if ($run) 
					return true ;
		}

		else return false ;
	}


	public function UpdateUsername($ID , $newUsername , $oldPassword)
	{
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ; 
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
		$checkUsername = "SELECT * FROM flight_sys.users WHERE users.UserName LIKE '".$newUsername."' " ;
			if (DBconnection::num_rows(DBconnection::run_query($checkUsername)) == 0 ) {
				$UpdateQuery = "UPDATE flight_sys.users SET users.UserName = '".$newUsername."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ; 
				$run = DBconnection::run_query($UpdateQuery) ; 
				if ($run) 
					return true ;				
			}else return false ; 
		}
		else return false ;
	}


	public function UpdatePhone($ID , $newPhone , $oldPassword)
	{
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ; 
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
			$UpdateQuery = "UPDATE flight_sys.users SET users.Phone = '".$newPhone."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ; 
				$checkPhone = "SELECT * FROM flight_sys.users WHERE users.Phone LIKE '".$newPhone."' " ; 
				if (DBconnection::num_rows(DBconnection::run_query($checkPhone)) == 0 ){
					$run = DBconnection::run_query($UpdateQuery) ; 
					if ($run) 
						return true ;					
				}else return false ; 				
		}
		else return false ;
	}


	public function addFlight($SrcCountryID,$DestCountryID,
							  $DepartureDate,$ReturnDate,
							  $AirCraftID,$numBuisnessSeats,
							  $numEconomySeats,$EconomyCost ,$BuisnessCost){

		$addToTableFlightQuery = "INSERT INTO flight_sys.flight(Orgin_airport_id ,Dist_airport_id ,Depature_date ,Arrive_date , Aircraft_id )  
								  VALUES('".$SrcCountryID."','".$DestCountryID."','".$DepartureDate."','".$ReturnDate."','".$AirCraftID."')	" ;
		$runAdd = DBconnection::run_query($addToTableFlightQuery) ; 
		if ($runAdd) {
		 	$getFlightID = "SELECT max(id) FROM flight_sys.flight " ; 
		 	$RunGetFlightID = DBconnection::run_query($getFlightID) ;
		 	$flightID = mysql_fetch_assoc($RunGetFlightID) ; 
		 	$flightID = $flightID['max(id)'] ; // get the id of the record of flight added recently 
					 		
		 	$seatsQuery = "INSERT INTO flight_sys.seats(Flight_id,Amount,Price,Class_id) 
		 					VALUES('".$flightID."','".$numEconomySeats."','".$EconomyCost."','1')" ; 
		 	$runSeatsQuery = DBconnection::run_query($seatsQuery) ; 

		 	$seatsQuery2 = "INSERT INTO flight_sys.seats(Flight_id,Amount,Price,Class_id) 
		 	VALUES('".$flightID."','".$numBuisnessSeats."','".$BuisnessCost."','2')" ; 
		 	$runSeatsQuery2 = DBconnection::run_query($seatsQuery2) ; 

		 	if ($runSeatsQuery && $runSeatsQuery2) {
		 		return true ;
		 	}
		 	else return false ; 
		} 
		return false ; 

	}

	public function DeleteFlight($FlightId)
	{
		$IfExist = "SELECT * FROM flight_sys.flight WHERE flight.id = '".$FlightId."' " ; 
		if (DBconnection::num_rows(DBconnection::run_query($IfExist)) > 0 ) {
			$DeleteQuery = "Delete FROM flight_sys.flight WHERE flight.id = '".$FlightId."' " ; 
			$runDelete = DBconnection::run_query($DeleteQuery) ;
			if ($runDelete) {
				return true ; 
			}		
		}
		else return false ; 

	}

	public function UpdateBuisnessCost($FlightId ,$newBuisnessCost)
	{
 		$Query = "UPDATE flight_sys.seats SET seats.Price = '".$newBuisnessCost."' WHERE seats.Flight_id = '".$FlightId."' AND seats.Class_id ='2' " ;
 		if (DBconnection::run_query($Query)) {
 			return true ; 
 		}
 	}

	public function UpdateEconomyCost($FlightId ,$newEconomyCost)
	{
 		$Query = "UPDATE flight_sys.seats SET seats.Price = '".$newEconomyCost."' WHERE seats.Flight_id = '".$FlightId."' AND seats.Class_id ='1' " ;
 		if (DBconnection::run_query($Query)) {
 			return true ; 
 		}		
	}

	public function UpdateAircraft($FlightId ,$newAircraft)
	{
 		$Query = "UPDATE flight_sys.flight SET flight.Aircraft_id= '".$newAircraft."' WHERE flight.id = '".$FlightId."' " ;
 		if (DBconnection::run_query($Query)) {
 			return true ; 
 		}		 
	}

	public function UpdateReturnDate($FlightId ,$newReturnDate)
	{
		$checkQuery = "SELECT * FROM flight_sys.flight WHERE flight.id = '".$FlightId."' " ; 
		$runCheck = DBconnection::run_query($checkQuery) ; 
		if ($runCheck) {
			$DepartureDate = mysql_fetch_assoc($runCheck) ; 
			$DepartureDate = $DepartureDate['Depature_date'] ; 
			if ($DepartureDate < $newReturnDate) {
				$UpdateQuery = "UPDATE flight_sys.flight SET flight.Arrive_date= '".$newReturnDate."' WHERE flight.id = '".$FlightId."' " ;
				if (DBconnection::run_query($UpdateQuery)) {
					return true ; 
				}
			}else return false ;
		}
	}

	public function UpdateDeptDate($FlightId ,$newDepartureDate)
	{
		$checkQuery = "SELECT * FROM flight_sys.flight WHERE flight.id = '".$FlightId."' " ; 
		$runCheck = DBconnection::run_query($checkQuery) ; 
		if ($runCheck) {
			$ReturnDate = DBconnection::fetch_assoc($runCheck) ; 
			$ReturnDate = $ReturnDate['Arrive_date'] ; 
			if ($ReturnDate > $newDepartureDate) {
				$UpdateQuery = "UPDATE flight_sys.flight SET flight.Depature_date= '".$newDepartureDate."' WHERE flight.id = '".$FlightId."' " ;
				if (DBconnection::run_query($UpdateQuery)) {
					return true ; 
				}
			}else return false ;
		}		
	}
	public function deactive_user($prams=array())
	{
		$db=DB::getinstance();
		$table="user";
		$id=$prams['id'];
		unset($prams['id']);
		unset($prams['submit_deactivate']);
		$prams['active']=0;
		$db->update('users',$prams,$id);
	
	}
	public function active_user($prams=array())
	{
		$db=DB::getinstance();
		$table="user";
		$id=$prams['id'];
		unset($prams['id']);
		unset($prams['submit_activate']);
		$prams['active']=1;
	
		$db->update('users',$prams,$id);
	
	}  

}
?>