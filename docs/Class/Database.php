
<?php
class DB{
	public $error_message;
	private static $instace=null;
	private $host="127.0.0.1",$name="root",$password="",$DB_name="flight_sys",$query,$query_run,$result,$PDO,$error;
	
	private  function  __construct()
	{
		if($this->PDO = new PDO("mysql:host=$this->host;dbname=$this->DB_name",$this->name,$this->password))
		{	
						
		}
		else 
		{
			die("falied to connect to database");
		}
		
	}
	public static function getinstance()
	{
		if(!isset(self::$instace))
		{
			self::$instace=new DB();
		}
     	return self::$instace;
	}
	
	
	public function query($sql,$prams=array())//a generic function that preforms a query by sending the query and the prameters 
	{
		
		if($this->query=$this->PDO->prepare($sql))  //prepare the sql query which will be done i.e. will replace the '?' marks when binding
		{
			
			if(count($prams))   //check if there is prameters to be binded 
			{
				

				$x=1; //the position of prameter where the value will be binded
				
				foreach ($prams as $pram)
				{
					
					$this->query->bindValue($x , $pram);
					$x++;
					
				}
				
				
			}
			if($this->query->execute())
			{
	           
				$this->result=$this->query->fetchAll(PDO::FETCH_ASSOC);
			 	if(!$this->result)
					return true;
				return $this->result;
			}
			
			else 
			{
				
				return false;
				
			}
		
		}
		
	}
	
	
	public function insert($table,$fields=array()) 
	{
		if(!count($fields)) //  checks if there any input or not
		{
			
			return false;
		}
		
		else 
		{
			
			$values=null;
			$keys=array_keys($fields);
			$keys=implode('` , `', $keys);
			$x=count($fields);
			while ($x--)
			{
				$values.="?";
				if($x>0)
				{
					$values.=',';
					
				}
					
				
			}
			
			$sql="INSERT INTO $table ( `".$keys."` ) VALUES ({$values})";
			if ($this->query($sql,$fields))
			{
				return true;
			}
			
			else 
			{
				return false;
			}
		}
		
		
	}
	
	
	public function update ($table,$values,$id) 
	{
		
	$set="";
	$x=1;
	
	foreach ($values as $key =>$value)
	{
		
		$set.="{$key} = ? ";
		if($x<count($values))
		{
			$set.=" , ";
		}
		$x++;
	}
	$sql="UPDATE $table SET $set WHERE id=$id";
	$this->query($sql,$values);

	
	}
	
	
	public function last_id()
	{
		
		return  $this->PDO->lastInsertId();
	}
   
}

?>
  
