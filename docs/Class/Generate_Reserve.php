<?php 
require_once("IReserve.php");
class ReserveGenerator {
  private $Type_Of_Reservw;
  
  // make object from parameter 
  // Ex : if we put parameter one way reservw we will make object from oneway_Reserve class 

  public function __construct(IReserve $Type_Of_Reserve)
  {
    $this->Type_Of_Reserve = $Type_Of_Reserve;
  }
   
  //after we make object from specific type of reserve we take that object and call function from this class 
  // ex: we take object from oneway_Reserve class we call to reserve function from this class 
  public function Do_Reserve($Did,$Rid,$userid,$ClassID,$seats,$totalPrice)
    {
        return $this->Type_Of_Reserve->Reserve($Did,$Rid,$userid,$ClassID,$seats,$totalPrice);
    }
}
?>