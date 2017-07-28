<?php 
require_once 'User.php' ; 

class ProductSubject{
	private $observers = array();

	public function register($observer)
	{
		$this->observers[] = $observer ;
  	}

	public function notify($contentOfEmail){
		$user = new User() ; 
		for($i=0  ; $i<sizeof($this->observers) ; $i++) {
			$user->update($this->observers[$i],$contentOfEmail) ; 
		}

	}

}


 ?>