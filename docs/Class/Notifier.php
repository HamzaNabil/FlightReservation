<?php
require_once 'ProductObserver.php' ; 
require_once 'ProductSubject.php' ; 

class Notifier implements ProductObserver {

	private $product ; 

	public function __construct(ProductSubject $subject)
	{
		$this->product = $subject ; 
	}

	public function update()
	{
		$newPrice = $this->product->getPrice() ; 
		//echo "<br/>$newPrice";
	}

}


?>