
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-grey.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/siteCSS.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
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
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
	$(function(){
		var today=new Date();
		var future = new Date(today.getFullYear()+1,today.getMonth(),today.getDate());
		
		$( "#oneway_start" ).datepicker({
			minDate:today,
			maxDate:future,
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			
		});
		$( "#start" ).datepicker({
			minDate:today,
			maxDate:future,
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function() {
				var date = $(this).datepicker('getDate');
				if (date ){
					date.setDate(date.getDate() + 4);
					$( "#end" ).datepicker( "option", "minDate", date );
					var rdate= $( "#end" ).datepicker('getDate');
					if(!rdate || rdate < date+3)
						$( "#end" ).datepicker('setDate',date );
				}
			}
		});
		$( "#end" ).datepicker({
			minDate:today,
			maxDate:future,
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
		});
	})
</script>
<script type="text/javascript">
 		$("#f1").show();
		$("#f2").hide();
    $(document).ready(function(){
    $(".show1").click(function(){
        $("#f2").hide();
		$("#f1").show();
		 var myElement = document.querySelector(".show1");
		 var myElement1 = document.querySelector(".show2");
		 myElement.style.color = "#eee";
		 myElement.style.position = "relative";
		 myElement1.style.color = "#888"
    });
	 $(".show2").click(function(){
        $("#f1").hide();
		$("#f2").show();
		var myElement = document.querySelector(".show1");
		var myElement1 = document.querySelector(".show2");
		myElement.style.color = "#888";
		myElement.style.position = "relative";
		myElement1.style.color = "#eee";
		
    });
	$(".logbot").click(function(){
		$(".login--frame").show(700);
		
    });
	$(".closebot").click(function(){
		$(".login--frame").hide(700);
		
    });
});
</script>
<script>
$(document).ready(function(){
	$("#search-box1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "Class/readCountry.php",
		data:{keyword:$(this).val(), type:1},
		beforeSend: function(data){
			$("#search-box1").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
			
		},
		success: function(data){
			$("#suggesstion-box1").show();
			$("#suggesstion-box1").html(data);
		},
		});
	});
});

function selectCountry1(val) {
$("#search-box1").val(val);
$("#suggesstion-box1").hide();
$("#search-box1").css("background","#FFF");
}
</script>
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "Class/readCountry.php",
		data:{keyword:$(this).val(), type:0},
		beforeSend: function(data){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
			
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
		},
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
$("#search-box").css("background","#FFF");
}
</script>
<script>
$(document).ready(function(){
	$("#search-box4").keyup(function(){
		$.ajax({
		type: "POST",
		url: "Class/readCountry.php",
		data:{keyword:$(this).val(), type:4},
		beforeSend: function(data){
			$("#search-box4").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
			
		},
		success: function(data){
			$("#suggesstion-box4").show();
			$("#suggesstion-box4").html(data);
		},
		});
	});
});

function selectCountry4(val) {
$("#search-box4").val(val);
$("#suggesstion-box4").hide();
$("#search-box4").css("background","#FFF");
}
</script>
<script>
$(document).ready(function(){
	$("#search-box3").keyup(function(){
		$.ajax({
		type: "POST",
		url: "Class/readCountry.php",
		data:{keyword:$(this).val(), type:3},
		beforeSend: function(data){
			$("#search-box3").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
			
		},
		success: function(data){
			$("#suggesstion-box3").show();
			$("#suggesstion-box3").html(data);
		},
		});
	});
});

function selectCountry3(val) {
$("#search-box3").val(val);
$("#suggesstion-box3").hide();
$("#search-box3").css("background","#FFF");
}
</script>
<script>
$(document).ready(function(){
    $("#search-box").focusin(function(){
        $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
    });
    $("#search-box").focusout(function(){
        $("#search-box").css("background","#FFF ");
    });
	$("#search-box1").focusin(function(){
        $("#search-box1").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
    });
    $("#search-box1").focusout(function(){
        $("#search-box1").css("background","#FFF ");
    });
	$("#search-box3").focusin(function(){
        $("#search-box3").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
    });
    $("#search-box3").focusout(function(){
        $("#search-box3").css("background","#FFF ");
    });
	$("#search-box4").focusin(function(){
        $("#search-box4").css("background","#FFF url(LoaderIcon.gif) no-repeat 260px");
    });
    $("#search-box3").focusout(function(){
        $("#search-box4").css("background","#FFF ");
    });
});
</script>
 <script type="text/javascript">
        function codeAddress() {
            //$(".header").html();
        }
        window.onload = codeAddress;
       </script>
</head>
<body class>


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

<div class=" w3-display-container  w3-animate-top  slider">
  <img class="mySlides" src="images/1920x880_rome.jpg" >
  <img class="mySlides" src="images/hb_1920x590_rome_generic2.jpg" >
  <img class="mySlides" src="images/hb_1920x880_london.jpg" >
  <div class="w3-center w3-section w3-large w3-text-white w3-display-bottomleft"
   style="width:40%;  margin-left:50%;  ">
    <div class="w3-left w3-padding-left w3-hover-text-khaki" onclick="plusDivs(-1)">❮</div>
    <div class="w3-right w3-padding-right w3-hover-text-khaki" onclick="plusDivs(1)">❯</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
  </div>
</div>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>
<script>
var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("demo");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
	 for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  dots[slideIndex-1].className += " w3-white";
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 2000); 
}
</script>

<nav class="form">
	 <div class="tripeOption">
        <input type="button" class="show1 w3-btn" value="Round Tripe" ></button>
        <input type="button" class="show2 w3-btn" value="One Way Tripe" ></button>
    </div>
    <div class="round" id="f1">
       <form action="selectTripe.php" method="get">
       <div class="from">
        <input class="w3-input w3-border w3-hover-border-black " id="search-box" type="text" name="src_tripe" placeholder="From" required>
        <div id="suggesstion-box"></div>
        </div>
		<div class="to">
            <input class="w3-input w3-border w3-hover-border-black" id="search-box1" type="text" name="Dist_tripe" placeholder="To" required>
            <div id="suggesstion-box1"></div>
        </div>
        <div class="depart ">
<input class="w3-input  w3-border w3-hover-border-black" type="text" placeholder="dd/mm/yy" name="depature" id="start" required>
        </div>
        <div class="arrive">
 <input class="w3-input  w3-border w3-hover-border-black" type="text"  name="return" id="end" placeholder="dd/mm/yy" required>
        </div>
         <div class="adult">
            <input class="w3-input  w3-border w3-hover-border-black" type="number" min="1" name="AdutlNo" placeholder="Adult" required>
        </div>
         <div class="child">
            <input class="w3-input  w3-border w3-hover-border-black" type="number" min="0" lang="en" name="ChildNo" placeholder="Child" required>
        </div>
        <div class="arrive">
            <select class="w3-input  w3-border w3-hover-border-black" id="class" name="travel_class" required="required" >
                        <?php 
						   $db=DB::getinstance();
						   $query = ("SELECT * FROM flight_sys.travelclass");
						   $result=$db->query($query);
						   foreach ($result as $key =>$row){
						   echo "<option value=".$row['id'].">" . $row['Name'] . "</option>";
						   
					   }
              		 ?>
             </select>
        </div>
        
         <div class="search">
        	<button class="w3-btn w3-theme-d2" name="submit_round">Search <i class="fa fa-search"></i></button>
        </div>
       </form>
      </div>
<div class="round" id="f2">
       <form action="selectTripe.php" method="get">
       <div class="from">
        <input class="w3-input w3-border w3-hover-border-black " id="search-box3" type="text" name="src_tripe" placeholder="From" required>
        <div id="suggesstion-box3" ></div>
        </div>
		<div class="to">
            <input class="w3-input w3-border w3-hover-border-black"  id="search-box4" type="text" name="Dist_tripe" placeholder="To" required>
             <div id="suggesstion-box4" ></div>
        </div>
        <div class="dep1">
<input class="w3-input  w3-border w3-hover-border-black" type="text" placeholder="dd/mm/yy" name="depature" id="oneway_start" required>
        </div>
         <div class="adult">
            <input class="w3-input  w3-border w3-hover-border-black" type="number" min="1" name="AdutlNo" placeholder="Adult" required>
        </div>
         <div class="child">
            <input class="w3-input  w3-border w3-hover-border-black" type="number" min="0" lang="en" name="ChildNo" placeholder="Child" required>
        </div>
        <div class="arrive">
            <select class="w3-input  w3-border w3-hover-border-black" id="class" name="travel_class" required="required" >
                        <?php 
						  $db=DB::getinstance();
						   $query = ("SELECT * FROM flight_sys.travelclass");
						   $result=$db->query($query);
						   foreach ($result as $key =>$row){
						   echo "<option value=".$row['id'].">" . $row['Name'] . "</option>";
						   
					   }
              		 ?>
             </select>
        </div>
        
         <div class="search">
        	<button class="w3-btn w3-theme-d2" name="submit_one">Search <i class="fa fa-search"></i></button>
        </div>
       </form>
      </div>
   </nav>
 
<!--<nav class="formWarp w3-animate-opacity">
    <div class="tripeOption">
    <input type="button" class="show1" value="Round Tripe" ></button>
    <input type="button" class="show2" value="One Way Tripe" ></button>
    </div>
    
    <nav class="round">
    </nav>

    <nav class="way" >
    
    </nav>
</nav> -->
<footer class="w3-container w3-black w3-center  " style="position:absolute; margin-top:150px; width:100%;"> 
 <div class="w3-xlarge">
   <a href="#" class="w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-red w3-show-inline-block"><i class="fa fa-pinterest-p"></i></a>
   <a href="#" class="w3-hover-text-light-blue w3-show-inline-block"><i class="fa fa-twitter"></i></a>
   <a href="#" class="w3-hover-text-grey w3-show-inline-block"><i class="fa fa-flickr"></i></a>
   <a href="#" class="w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-linkedin"></i></a>
 </div>
  <p style="font-weight:normal">Powered by <a href="#" target="_blank"></a></p>
</footer>
</body>
</html>
