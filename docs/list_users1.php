<?php
require_once("Class/Site_Config.php");
	require_once("js/validator.php");
$allUsers = $admin->getUsers() ; 

if(isset($_POST['submit_deactivate']))
{

	$admin->deactive_user($_POST);
	$allUsers=$admin->getUsers();
}

if(isset($_POST['submit_activate']))
{

	$admin->active_user($_POST);
	$allUsers=$admin->getUsers();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>adminpanal</title>
	<link rel="stylesheet" type="text/css" href="css/list_user.css">
    <script src="adminpanal.js"></script>
</head>
<body>

    

    
    <?php 
   $ad=$admin->counts($allUsers);
    echo " <div id='user'>
        <ul>
        <li><p id='active'>Active users : $ad[1]</p></li>
        <li><p id='deactive'>Deactivated users : $ad[0]</p></li>
        </ul>
        
        </div>";
    $status="Deactivated";
    foreach ($allUsers as $key =>$value)
    {
		
    	if($value['active'])
    	{
    		$status="Active";
    	}
    
    echo "<div id='item'>
    <form action='list_users1.php' method='post' >
        <img src='$value[PhLink]'>
        <ul> <p>Frist name : $value[Fname] </p>
       <p>Last name : $value[Lname] </p>
       <p>Email : $value[Email] </p>
       <p>Status :   $status</p>
       <input type='hidden' name='id' value='$value[user]'> 
       <input type='hidden' name='active[]' value='$value[active]'> 
       </ul>  ";
    
       if($value['active'])
       {echo "<input type='submit' name='submit_deactivate' id='submit' value='Dectivate'>
          </form >   
        ";}
       else 
       {
       	echo "<input type='submit' name='submit_activate' id='submit_activate' value='Activate'>
          </form >
        ";
       	
       }
       
       echo "</div>";
    $status="Deactivated";
    }
?>
    

    
    

</body>
</html>