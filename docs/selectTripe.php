
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="300">
<title>Home</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-grey.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/siteCSS.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
<?php
if(!isset($_SESSION)){ session_start(); }
require_once("Class/Site_Config.php");
	require_once("js/validator.php");
	
    if(isset($_POST['logout'])){
		session_destroy();
        header('Location: Home.php');
    }	
?>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Lato", sans-serif}
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
.show{
	width:50%;
	border-top:3px solid #4caf50;
	border-bottom:3px solid #4caf50;
	margin:auto;
	margin-top:50px;
	background-color: rgba(0, 0, 0, 0.1);

}
.timer{
	width:15%;
	height:20px;
	margin-left:40%;
	margin-top:30px;
}
.w3-lobster {
  font-family: "Lobster", serif;
}
.w3-allerta {
  font-family: "Allerta Stencil", Sans-serif;
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>

<body >
<div class="header">
<?php
    $id=3;
	if(isset($_SESSION['role_id']))
		$id=$_SESSION['role_id'];
	$query="select Menu_Content from flight_sys.menus where Role_id='".$id."'";
	$result=$db->query($query);
	echo $result[0]["Menu_Content"];
 if(isset($_SESSION['role_id'])){
	echo '<li class="w3-hover-green  w3-right"><a href="Logout.php">LogOut</a></li>
	<li class=" w3-right" style="width:30%"><img src="';?> <?php echo $_SESSION['imageLink'] ?><?php echo '" alt="Avatar" style="width:30%; margin-top:2px; height:45px;" class="w3-circle w3-right"><a href="userProfile.php" class="w3-right" style="width:70%">';?> <?php echo $_SESSION['fname'] ?> <?php echo' </a></li> </div></ul>';
 }
?>
</div>

<?php 
if(!isset($_SESSION['role_id']))
echo '<div class="show w3-card-4 w3-allerta">
					<span class="w3-xlarge" style="color:light-green; font:; margin-left:15%;">You Must Login To Compelet Reservation</span>
			</div>';
	echo '<div class="timer w3-card-8"><span class="w3-allerta">Rester Result after : </span><label id="minutes">00</label>:<label id="seconds">00</label>
	<i class"fa fa-clock-o"></i>
	</div>
	<script type="text/javascript">
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 300;
        setInterval(setTime, 1000);

        function setTime()
        {
            --totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds%60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
        }

        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
</script>';
	if(isset($_GET['submit_one'])){
		$from=$_GET['src_tripe'];
		$to=$_GET['Dist_tripe'];
		$depart=date_create($_GET['depature']);
		$adult=$_GET['AdutlNo'];
		$child=$_GET['ChildNo'];
		$class=$_GET['travel_class'];
		$Name = explode(",", $from);
		$From1=$Name[1].",".$Name[2];
		$Name = explode(",", $to);
		$to1=$Name[1].",".$Name[2];
		$result1=$member->search_round($from,$to,date_format($depart,"Y-m-d"),$adult+$child,$class);
		if(!$result1['id']) 
			echo '<div class="show">
					<span class="w3-xlarge" style="color:red; margin-left:40%;">No result Found</span>
			</div>';
		else{
			var_dump($result1) ;
  		foreach ($result1 as $key =>$row){ 
			$datetime1 = new DateTime($row['Depature_date']);
			$datetime2 = new DateTime($row['Arrive_date']);
			$interval = $datetime1->diff($datetime2);
			$Dtime = date("H:i",strtotime($row['Depature_date']));
			$Atime = date("H:i",strtotime($row['Arrive_date']));
			$elapsed = $interval->format('%H:%I');
			$number=$adult+$child;
			$total_price=($row['price'])*$number;
			echo '<div class="show">
			<form action="Reservation.php" method="post">
			<input style="display:none;" name="class" value="'.$class.'"/>
			<input style="display:none;" name="from" value="'.$from.'"/>
			<input style="display:none;" name="to" value="'.$to.'"/>
			<input style="display:none;" name="price" value="'.$total_price.'"/>
			<input style="display:none;" name="Did" value="'.$row['id'].'"/>
			<input style="display:none;" name="Darrive" value="'.$row['Arrive_date'].'"/>
			<input style="display:none;" name="Ddepart" value="'.$row['Depature_date'].'"/>
			<input style="display:none;" name="Number" value="'.$number.'"/>
			<input style="display:none;" name="img" value="'.$row['PhLink'].'"/>
			<input style="display:none;" name="type" value="One Way"/>
			
			<ul class="w3-ul w3-card-4" style="background:#FFF"  >
			  <li class="w3-large" style="height:30px;"> Out Bound </li>
			  <li class="w3-padding-hor-16 " style=" height:100px;">
				<span onclick="this.parentElement.style.display="none"" 
				class="w3-closebtn w3-padding w3-margin-right w3-medium">x</span>
				<img src="'.$row['PhLink'].'" class="w3-left w3-circle w3-margin-right" style="width:60px">
				<div style=" float:left; width:50px">
				 <span class="w3-xlarge">'.$Dtime.'</span> <br />
				 <span style="">'.$From1.'</span>
				</div>
			   <div style=" float:left; margin-left:100px; width:50px">
				 <span class="w3-xlarge">'.$Atime.'</span> <br />
				 <span>'.$to1.'</span>
				</div>
				 <div style=" float:left; margin-left:100px; width:50px">
				 <span class="w3-xlarge" >'.$elapsed.'</span> <br />
				  <span style=" margin-left:25px" ><i class="fa fa-clock-o"></i></span>
				</div>
			 
			  </li>
			
			</ul>
			 <div style="width:100%;background:#FFF">
			 <button class="w3-btn w3-green " style="width:20%;margin-left:80%;" name="submit" >Select  <i class="fa fa-send"></i></button> </div> 
			</form>
			</div>';
			
		}
		}
		
	}
	
	if(isset($_GET['submit_round'])){
		$from=$_GET['src_tripe'];
		$to=$_GET['Dist_tripe'];
		$depart=date_create($_GET['depature']);
		$return=date_create($_GET['return']);
		$adult=$_GET['AdutlNo'];
		$child=$_GET['ChildNo'];
		$class=$_GET['travel_class'];
		
		$Name = explode(",", $from);
		$From1=$Name[1].",".$Name[2];
		$Name = explode(",", $to);
		$to1=$Name[1].",".$Name[2];
		$result1=$member->search_round($from,$to,date_format($depart,"Y-m-d"),$adult+$child,$class);
		$result2=$member->search_round($to,$from,date_format($return,"Y-m-d"),$adult+$child,$class);
		if(!$result1|| !$result2 ) 
			echo '<div class="show">
					<span class="w3-xlarge" style="color:red; margin-left:40%;">No result Found</span>
			</div>';
		else{
		foreach ($result1 as $key =>$row){ 
		$datetime1 = new DateTime($row['Depature_date']);
		$datetime2 = new DateTime($row['Arrive_date']);
		$interval = $datetime1->diff($datetime2);
		$Dtime = date("H:i",strtotime($row['Depature_date']));
		$Atime = date("H:i",strtotime($row['Arrive_date']));
		$elapsed = $interval->format('%H:%I');
	    foreach ($result2 as $key =>$row2){
		$datetime3 = new DateTime($row2['Depature_date']);
		$datetime4 = new DateTime($row2['Arrive_date']);
		$interval1 = $datetime3->diff($datetime4);
		$Dtime1 = date("H:i",strtotime($row2['Depature_date']));
		$Atime1 = date("H:i",strtotime($row2['Arrive_date']));
		$elapsed1 = $interval1->format('%H:%I'); 
		
		$number=$adult+$child;
		$total_price=($row['price']+$row2['price'])*$number;
			echo '<div class="show">
<form action="Reservation.php" method="post">

<input style="display:none;" name="class" value="'.$class.'"/>
<input style="display:none;" name="from" value="'.$from.'"/>
<input style="display:none;" name="to" value="'.$to.'"/>
<input style="display:none;" name="price" value="'.$total_price.'"/>
<input style="display:none;" name="Did" value="'.$row['id'].'"/>
<input style="display:none;" name="Darrive" value="'.$row['Arrive_date'].'"/>
<input style="display:none;" name="Ddepart" value="'.$row['Depature_date'].'"/>
<input style="display:none;" name="Rid" value="'.$row2['id'].'"/>
<input style="display:none;" name="Rarrive" value="'.$row2['Arrive_date'].'"/>
<input style="display:none;" name="Rdepart" value="'.$row2['Depature_date'].'"/>
<input style="display:none;" name="Number" value="'.$number.'"/>
<input style="display:none;" name="img" value="'.$row['PhLink'].'"/>
<input style="display:none;" name="type" value="Round Tripe"/>

<ul class="w3-ul w3-card-4" style="background:#FFF"  >
  <li class="w3-large" style="height:30px;"> Out Bound </li>
  <li class="w3-padding-hor-16 " style=" height:100px;">
    <span onclick="this.parentElement.style.display="none"" 
    class="w3-closebtn w3-padding w3-margin-right w3-medium">x</span>
    <img src="'.$row['PhLink'].'" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <div style=" float:left; width:50px">
     <span class="w3-xlarge">'.$Dtime.'</span> <br />
     <span style="">'.$From1.'</span>
    </div>
   <div style=" float:left; margin-left:100px; width:50px">
     <span class="w3-xlarge">'.$Atime.'</span> <br />
     <span>'.$to1.'</span>
    </div>
     <div style=" float:left; margin-left:100px; width:50px">
     <span class="w3-xlarge" >'.$elapsed.'</span> <br />
      <span style=" margin-left:25px" ><i class="fa fa-clock-o"></i></span>
    </div>
 
  </li>

</ul>
<ul class="w3-ul w3-card-4" style="margin-top:10px;background:#FFF;" >
  <li class="w3-large" style="height:30px;"> IN Bound </li>
  <li class="w3-padding-hor-16 " style=" height:100px;">
    <span onclick="this.parentElement.style.display="none"" 
    class="w3-closebtn w3-padding w3-margin-right w3-medium">x</span>
    <img src="'.$row2['PhLink'].'" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <div style=" float:left; width:50px">
     <span class="w3-xlarge">'.$Dtime1.'</span> <br />
     <span style="margin-left:10px;">'.$to1.'</span>
    </div>
   <div style=" float:left; margin-left:100px; width:50px">
     <span class="w3-xlarge">'.$Atime1.'</span> <br />
     <span style="margin-left:10px;">'.$From1.'</span>
    </div>
     <div style=" float:left; margin-left:100px; width:50px">
     <span class="w3-xlarge" >'.$elapsed1.'</span> <br />
      <span style=" margin-left:25px" ><i class="fa fa-clock-o"></i></span>
    </div>
   
  </li>
</ul>
 <div style="width:100%;background:#FFF">
 <button class="w3-btn w3-green " style="width:20%;margin-left:80%;" name="submit" >Select  <i class="fa fa-send"></i></button> </div> 
</form>
</div>
</div>';
		}
			
		}
		}
	}


?>

</body>
</html>
