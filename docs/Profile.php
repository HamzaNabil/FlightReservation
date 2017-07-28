<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-grey.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/siteCSS.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Lato", sans-serif}
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px; margin-top:50px ;">
  
    <div class="w3-center"><br>
      <img src="images/img_avatar4.png" alt="Avatar" style="width:30%; height:100px;" class="w3-circle w3-margin-top">
    </div>

    <div class="w3-container">
      <div class="w3-section">
       <table class="w3-table w3-striped w3-border">
<thead>
<tr class="w3-green">
  <th>First Name</th>
  <th>Last Name</th>
  <th>Age</th>
</tr>
</thead>
<tr>
  <td><?php echo $_SESSION['fname'] ?> </td>
  <td><?php echo $_SESSION['lname'] ?></td>
  <td><?php echo $_SESSION['age'] ?></td>
</tr>
<tr class="w3-green">
  <th colspan="3">Email</th>
</tr>
</thead>
<tr>
  <td colspan="3"><?php echo $_SESSION['email'] ?></td>
</tr>
<tr class="w3-green">
  <th colspan="3">Adress</th>
</tr>
</thead>
<tr>
  <td colspan="3"><?php echo $_SESSION['adress'] ?> </td>
</tr>
<tr class="w3-green">
  <th colspan="3">Phone</th>
</tr>

<tr>
  <td colspan="3"><?php echo $_SESSION['phone'] ?></td>
</tr>
<tr class="w3-green">
  <th colspan="3">ID</th>
</tr>
<tr>
  <td colspan="3"><?php echo $_SESSION['userid'] ?></td>
</tr>
</thead>
</table>


    </div>

  </div>
</body>
</html>
