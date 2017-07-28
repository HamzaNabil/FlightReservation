<?php 
//require_once 'Database.php' ; 
require_once 'ErorrHandle.php';
require_once 'Observer.php' ; 


class person  implements ProductObserver{
	public $user_id;
    public $first_name;
	public $last_name;
    public $user_name;
    public $password;
    public $user_type;
    public $email;
    public $phone;
	public $age;
    public $db;
	public $gender;
	public $address_id;
    public $search;
    public $choice;
    public $deleteid;
	public $active;
	public $erorr;
	
	public function __construct(){
		}
		public function setFirstname($Firstname)
		{
			if (strlen($Firstname) >= 3) {
				$this->first_name = $Firstname ;
				return true ;
			}
			else return false ;
		}
		public function getFirstname()
		{
			return $this->first_name ;
		}
		
		
			
		public function update($Email,$contentOfEmail)
		{
			mail($Email, "notification from flight system", $contentOfEmail) ;
		}


		public function setLastname($Lastname)
		{
			if (strlen($Lastname) >= 3) {
				$this->last_name = $Lastname ;
				return true ;
			}
			else return false ;
		}
		public function getLastname()
		{
			return $this->last_name ;
		}
		
		
		
		public function setUsername($Username)
		{
			if (strlen($Username) >= 3) {
				$this->user_name = $Username ;
				return true ;
			}
			else return false ;
		}
		public function getUsername()
		{
			return $this->user_name ;
		}
		
		
		
		
		public function setPassword($Password)
		{
			if (strlen($Password) >= 6) {
				$this->password = $Password ;
				return true ;
			}
			else return false ;
		}
		public function getPassword()
		{
			return $this->password ;
		}
		
		
		
		
		public function setUserType($userType)
		{
			$this->user_type = $userType ;
		}
		public function getUserType()
		{
			return $this->user_type ;
		}
		
		
		
		public function setEmail($Email)
		{
			$this->email = $Email ;
		}
		public function getEmail()
		{
			return $this->email ;
		}
		
		
		
		
		public function setPhone($Phone)
		{
			$this->phone = $Phone ;
		}
		public function getPhone()
		{
			return $this->phone ;
		}
		
		
		
		public function setAge($Age)
		{
			$this->age = $Age ;
		}
		public function getAge()
		{
			return $this->age ;
		}
		
		
		
		public function setGender($Gender)
		{
			$this->gender = $Gender ;
		}
		public function getGender()
		{
			return $this->gender ;
		}
		
		
		
		public function setAddress($Address)
		{
			$this->address = $Address ;
		}
		public function getAddress()
		{
			return $this->address ;
		}
		
		
		public function setImageId($ImageId)
		{
			$this->image_id = $ImageId ;
		}
		public function getImageId()
		{
			return $this->image_id ;
		}
		
		
		public function setCountryId($CountryId)
		{
			$this->address_id = $CountryId ;
		}
		public function getCountryId()
		{
			return $this->address_id ;
		}
		
		

	function Login($username,$password){
        $username = trim($username);
        $password = trim($password);
        
          return $this->CheckLoginInDB($username,$password);
       
        

    }
   function  CheckLoginInDB($username,$password){
	   	$db=DB::getinstance();
        $query = "Select *,users.id as userid from users 
		left join image on image.id=users.Image_id
		left join country on country.id=users.Country_id
		where UserName='".$username."' and Password ='".$password."' ";
        $row=$db->query($query);
		print_r($row);
        if(!isset($row[0]['userid'])){
			 $this->erorr->HandleError('Wrong User Name Or Password');
             return false;
        }
		if(!isset($_SESSION)){ session_start(); }
		$active=$row[0]['active'];
		if(!$active){
			$this->erorr->HandleError('Acount Has been blocked by Admin');
			return 0;
		}
        $_SESSION['userid']=$row[0]['userid'];
        $_SESSION['fname']=$row[0]['Fname'];
		$_SESSION['lname']=$row[0]['Lname'];
        $_SESSION['email']=$row[0]['Email'];
        $_SESSION['role_id']=$row[0]['Role_id'];
		$_SESSION['image_id']=$row[0]['Image_id'];
		$_SESSION['country_id']=$row[0]['Country_id'];
		$_SESSION['imageLink']=$row[0]['PhLink'];
		$_SESSION['country']=$row[0]['CountryName'];
        $_SESSION['phone']=$row[0]['Phone'];
        $_SESSION['adress']=$row[0]['Adress'];
		$_SESSION['gender']=$row[0]['Gender'];
		$_SESSION['age']=$row[0]['Age'];
        return 1;

   }
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }  
    function RedirectToLoginURL()
    {
		$this->user_type=$_SESSION['role_id'];
		echo $this->user_type;
        $query = "Select PhLink from flight_sys.link left join flight_sys.link_select on link.id=link_select.link_id where Role_id='".$this->user_type."'";
        $result= DBconnection::run_query($query);
		if(!$result)
		$link="#";
        $row= DBconnection::fetch_assoc($result);
        $link=$row['PhLink'];
        header("Location: $link");
        exit;
    }
    /****************register**************/
    function RegisterUser()
    {	
		echo $_POST['firstname'];
        $this->first_name = $_POST['firstname'];
		$this->last_name = $_POST['lastname'];
        $this->email  = $_POST['email'];
        $this->user_name = $_POST['username'];
        $this->password = $_POST['password'];
        $this->user_type = 1 ;
        $this->age = $_POST['age'];
	    $this->gender = $_POST['gender'];
		$this->address_id= $_POST['country'];
        if(!$this->InsertIntoDB())
        {
            return false;
        }
        
        return true;
    }
   
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }

	function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    function InsertIntoDB()
    {
        
        $insert_query = "insert into flightreservationsystem.users
                values
                (
				'',
                '" . $this->first_name ."',
				'" . $this->last_name . "',
                '" . $this->user_name . "',
               	'" . $this->password . "',
				'" . $this->email . "',
				'" . $this->user_type . "',
				'1',
				'" . $this->address_id . "',
				'" . $this->gender ."'
                )";    
				echo   $this->first_name ;
        if(!DBconnection::run_query( $insert_query ))
        {
            return false;
        }   
        return true;
    }
	
    
	public function search_round($from,$to,$depDate,$seatNo,$class){
		$db=DB::getinstance();
		$Name = explode(",", $from);
		$src_id=$this->getID("airport","Name",$Name[2]);
		$Name = explode(",", $to);
		$dist_id=$this->getID("airport","Name",$Name[2]);
		$query="select flight.id as id,Arrive_date,Depature_date,Amount,price,PhLink
				from flight left join seats on flight.id=seats.Flight_id
				left join airport on airport.id=Orgin_airport_id
				left join image on image.id=airport.Image_id
				where Cast(flight.Depature_date AS DATE) =Cast('$depDate' AS DATE) 
				and Dist_airport_id=$dist_id and Orgin_airport_id=$src_id
				and Class_id=$class and amount >$seatNo";
		$result=$db->query($query);
		if($result)
			return $result;
		return 0;
		
	}
	
	public function getID($table,$col,$data){
		$db=DB::getinstance();
		$query="select id from  $table  where $col = '$data' ";
		$result=$db->query($query);
		return $result[0]['id'];
	}
	public function round_reservation($Did,$Rid,$userid,$ClassID,$seats,$totalPrice){
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
		
		
		
		public function Oneway_reservation($Did,$userid,$ClassID,$seats,$totalPrice){
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