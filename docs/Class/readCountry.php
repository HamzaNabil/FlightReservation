<?php

require_once("Site_Config.php");
$word=$_POST["keyword"];
if(!empty($_POST["keyword"])&& strlen($word)>2){
$db=DB::getinstance();

$query ="SELECT  `CountryName`,`City`,`Name`
FROM airport left join country on airport.Country_id=country.id
WHERE airport.City like '".$word."%' or CountryName like '".$word."%' ORDER BY CountryName";
 $result=$db->query($query);
if($result!=1){
?>
<ul id="country-list">
<?php
foreach ($result as $key =>$country){
if($_POST["type"]==1){
?>
<li onClick="selectCountry1('<?php echo $country["CountryName"],",",$country["City"],",",$country["Name"];  ?>');">
<?php
}
else if($_POST["type"]==0){
?>
<li onClick="selectCountry('<?php echo $country["CountryName"],",",$country["City"],",",$country["Name"];  ?>');">
<?php
}
else if($_POST["type"]==3) {
?>
<li onClick="selectCountry3('<?php echo $country["CountryName"],",",$country["City"],",",$country["Name"];  ?>');">
<?php	
}
else{
?>
<li onClick="selectCountry4('<?php echo $country["CountryName"],",",$country["City"],",",$country["Name"];  ?>');">
<?php
}
echo '<img src="images/plane.jpg" class="w3-circle" style="width:20px"; height="20px; margin-right:10px;">';
echo "  ",$country["CountryName"],",",$country["City"],",",$country["Name"];  ?></li>
<?php } ?>
</ul>
<?php 
}
else {
	echo '<ul id="country-list">';
	echo '<li>No result<li>';
	echo '</ul>';
}
} ?>
