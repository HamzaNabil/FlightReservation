<?php
class validate
{	
  Private function test_input($data) 
  {
  $data2=$data;
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  if($data2 === $data)
	 return true;
  else
	 return false;
}
  public function validatename($name)
  {
	if(!empty($name) && strlen($name) > 3 && strlen($name) < 50 && $this->test_input($name))
		return true;
	else
	{
		echo"<script>error('name');</script>";
		return false;
	}
  }
  public function validatelname($lname)
  {
	if(!empty($lname) && strlen($lname) > 3 && strlen($lname) < 50 && $this->test_input($lname))
		return true;
	else
	{
		echo"<script>error('last_name');</script>";
		return false;
	}
  }
  public function validateemail($email)
  {
	if(!empty($email) && strlen($email) > 5 && strlen($email) < 50 && filter_var($email, FILTER_VALIDATE_EMAIL)&& $this->test_input($email))
		return true;
	else
	{
		echo "<script>error('email');</script>";
		return false;
	}
  }
  public function validatepass($password)
  {
	if(!empty($password) && strlen($password) > 4 && strlen($password) < 16 && $this->test_input($password))
		return true;
	else
	{
		echo "<script>error('password')</script>";
		return false;
	}
  }
  public function validateusername($username)
  {
	if(!empty($username) && strlen($username) > 4 && strlen($username) < 16 && $this->test_input($username))
		return true;
	else
	{
		echo "<script>error('username')</script>";
		return false;
	}
  }
   public function validateloginpass($password)
  {
	if(!empty($password) && strlen($password) > 4 && strlen($password) < 16 && $this->test_input($password))
		return true;
	else
	{
		echo "<script>errorlogin('password')</script>";
		return false;
	}
  }
  public function validateloginusername($username)
  {
	if(!empty($username) && strlen($username) > 4 && strlen($username) < 16 && $this->test_input($username))
		return true;
	else
	{
		echo "<script>errorlogin('username')</script>";
		return false;
	}
  }
  public function validatetelephone($telephone)
  {
	if(!empty($telephone) && strlen($telephone) == 11 && $this->test_input($telephone) && is_numeric($telephone))
		return true;
	else
	{
		echo "<script>error('telephone')</script>";
		return false;
	}
  }
  public function validatesearch($search)
  {
	if(!empty($search) && strlen($search) > 2 && strlen($search) < 40 && $this->test_input($search))
		return true;
	else
	{
		echo "<script>errorsearch()</script>";
		return false;
	}
  }
}
?>
<script type='text/javascript'>
    function error(element)
	{
		$(document).ready(function() {
		document.getElementById("register_"+element+"_errorloc").innerHTML = "Enter a valid "+element;
    });
	}
    function errorlogin(element)
	{
		$(document).ready(function() {
		document.getElementById("login_"+element+"_errorloc").innerHTML = "Please Provide a valid "+element;
    });
	}
	function errorsearch()
	{
		$(document).ready(function() {
		document.getElementById("search_errorloc").innerHTML = "Bad Search";
    });
	}
</script>