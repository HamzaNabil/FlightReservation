
<?php
class DBconnection{
	   public $host;
	   public $username;
	   public $password;
	   public $dbname;
	   public $conn;
	   public $error_message;
	   private static $Dbconnection=NULL;
	 //inside constructor implement connection data base 
	 private function __construct() {
	 	$Dbconnection = mysql_connect("localhost","root","","flight_sys") or die("Error in database connection");
	 }
	
     public static function Instance()
	 {
	        
	        if (self::$Dbconnection==NULL) {
	            $Dbconnection = new DBconnection();
	        }
	        return self::$Dbconnection;
	 }
	  function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
   
    public function run_query($query)
    {
        $run = mysql_query($query) ; 
        if ($run) {
            return $run ; 
        }
        else return false ;
    }

    public function num_rows($run)
    {
        return mysql_num_rows($run) ; 
    }
    
    public function fetch_rows($run)
    {
        return mysql_fetch_row($run) ; 
    }

    public function fetch_assoc($run)
    {
        return mysql_fetch_assoc($run) ; 
    }


   /* function IsFieldUnique($tablename,$columname,$field)
    {
        $qry = "select * from $tablename where $columname=$field";
        $result = mysql_query($qry,$this->conn);   
        if( mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }*/
 /*   function UpdateFieldUnique($tablename,$columname,$field)
    {
        $qry = "select id from $tablename where $columname='.$field.'";
        $result = mysql_query($qry,$this->conn);   
        if($result && mysql_num_rows($result) > 0)
        {
            if($result && mysql_num_rows($result) == 1)
            {
            }
            }
            return false;
        }
        return true;
    }*/
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }	   
	   		
}

?>
  
