<?php
require_once("IReserve.php");
class RoundTrip_Reservation implements IReserve{
	
	public function Reserve($Did,$Rid,$userid,$ClassID,$seats,$totalPrice){
			$db=DB::getinstance();
			$query="Update seats set `Amount`=`Amount`-'".$seats."' where 
			(`Flight_id`='".$Did."'  or `Flight_id`='".$Rid."') and `Class_id` = '".$ClassID."'	";
			 if(!$db->query($query))
			 	return 0;
		$parm=array('FLight_Type_id'=>1,
		'User_id'=>$userid,
		'Class_id'=>$ClassID,
		'SeatNum'=>$seats,
		'Total_Price'=>$totalPrice);
			
			 if(!$db->insert('ticket',$parm)){
				 	$query="Update seats set `Amount`=`Amount`+'".$seats."' where 
					(`Flight_id`='".$Did."'  or `Flight_id`='".$Rid."') and `Class_id` = '".$ClassID."'	";
					$db->query($query);
					return 0;
				}
				
			$ID=$db->last_id();
			$parm1=array('Ticket_id'=>$ID,'Flight_id'=>$Rid);
			$parm2=array('Ticket_id'=>$ID,'Flight_id'=>$Did);
			$db->insert('route',$parm1);
			$db->insert('route',$parm2);
				
			return 1;
				
		}
}
?>