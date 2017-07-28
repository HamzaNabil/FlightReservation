<?php
require_once("IReserve.php");
require_once("Database.php");
class OneWay_Reservation implements IReserve{
	
	public function Reserve($Did,$Rid,$userid,$ClassID,$seats,$totalPrice){
		$db=DB::getinstance();
			$query="Update seats set `Amount`=`Amount`-'".$seats."' where 
			`Flight_id`='".$Did."'  or  and `Class_id` = '".$ClassID."'	";
			 if(!$db->query($query))
			 	return 0;
				$parm=array('FLight_Type_id'=>1,'User_id'=>$userid,'Class_id'=>$ClassID,'SeatNum'=>$SeatNum,'Total_Price'=>$totalPrice);
			
			 if(!$db->insert('ticket',$parm)){
				 	$query="Update seats set `Amount`=`Amount`+'".$seats."' where 
					(`Flight_id`='".$Did."'  or `Flight_id`='".$Rid."') and `Class_id` = '".$ClassID."'	";
					 $db->query($query);
					return 0;
				}
				
			$id=$db->query->last_id();
			$parm=array('Ticket_id'=>$id,'Flight_id'=>$Did);
			if(!$db->insert('route',$parm)){
					return 0;
				}
				return 1;
		}
}

?>