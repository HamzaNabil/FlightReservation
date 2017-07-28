<?php
require_once 'Person.php';
require_once 'Database.php';
require_once 'ErorrHandle.php';
require_once 'Observer.php' ; 


class User extends person{
	 public function __construct(){
		  $this->erorr=new ErorrHandle;
		
	} 
	 public function PerformReservation(){
		 
		 }
	public function UpdateReservation(){}
	
	public function CancelReservation(){}
	
	public function ViewSchedule(){}

	public function selectEmailsFromDB()
	{
		$select = "SELECT * FROM flight_sys.users" ;
		$run = DBconnection::run_query($select) ; 
		if ($run) {
			return true ; 
		}
		return false ;
	}
	
	public function UpdatePassword($ID , $newPassword , $oldPassword)
	{
		//$conn = DB::getinstance() ;
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ;
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
			$UpdateQuery = "UPDATE flight_sys.users SET users.Password = '".$newPassword."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ;
			$run = DBconnection::run_query($UpdateQuery) ;
			if ($run)
				return true ;
		}
	
		else return false ;
	}
	public function UpdatePhone($ID , $newPhone , $oldPassword)
	{
		//$conn = DB::getinstance() ;
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ;
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
			$UpdateQuery = "UPDATE flight_sys.users SET users.Phone = '".$newPhone."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ;
			$run = DBconnection::run_query($UpdateQuery) ;
			if ($run)
				return true ;
		}
	
		else return false ;
	}
	
	public function UpdateAdress($ID , $newAdress , $oldPassword)
	{
		//$conn = DB::getinstance() ;
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ;
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
			$UpdateQuery = "UPDATE flight_sys.users SET users.Adress = '".$newAdress."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ;
			$run = DBconnection::run_query($UpdateQuery) ;
			if ($run)
				return true ;
		}
	
		else return false ;
	}
	public function UpdateEmail($ID , $newEmail , $oldPassword)
	{
		//$conn = DB::getinstance() ;
		$checkQuery = "SELECT * FROM flight_sys.users WHERE users.id = '".$ID."' AND users.Password = '".$oldPassword."' " ;
		if (DBconnection::num_rows(DBconnection::run_query($checkQuery))==1) {
			$UpdateQuery = "UPDATE flight_sys.users SET users.Email = '".$newEmail."' WHERE users.id = '".$ID."' AND users.Password = $oldPassword " ;
			$run = DBconnection::run_query($UpdateQuery) ;
			if ($run)
				return true ;
		}
	
		else return false ;
	}
	public function AddNewIMG($targetFile)
	{
		//$conn = DB::getinstance() ;
		$query = "INSERT INTO flight_sys.image (PhLink) VALUES ('".$targetFile."')" ;
		$run = DBconnection::run_query($query);
		if($run) return mysql_insert_id();
		else return $erorr = -1;
	
	}
	public function updateUserIMG_ID($user_ID , $IMG_NewID)
	{
		//$conn = DB::getinstance() ;
		$UpdateQuery = "UPDATE flight_sys.users SET users.Image_id = '".$IMG_NewID."' WHERE users.id = '".$user_ID."'" ;
		$run = DBconnection::run_query($UpdateQuery) ;
		if ($run)
			return true ;
	
		else return false ;
	
	}
	
}

?>