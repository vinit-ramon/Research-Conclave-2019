<!DOCTYPE html>
<html>
	<head>
		<title>Responsive Navigation Bar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style2.css">
		<script type="text/javascript" src="javascript.js"></script>
	</head>
	<body style="background-color:#24248f">
	<div id="header">
	<div id="logo"><img src="ResponsiveNavigationBar/logo3.png"/></div>
	<div id="res_btn" onclick="show_hide_nav('navbar')" ><img src="ResponsiveNavigationBar/button.png"/></div>
		<ul id="navbar">
			<li><a href="homepage1.php">Home</a></li>
			<li><a href="faculty-convener.php">Work</a></li>
			<li><a href="refresh.php?logout">logout</a></li>
		
		</ul>
		<h1 style="color:white">FACULTY</h1>
	</div>	<div style="height:100px">

</div>
<center>
<style>
input,textarea{width:250px}
textarea{height:100px}
input[type=submit]{width:150px}
</style>
<form method="post">
<table width="200" border="1">
  
  
  
  <tr>
    <td>New notice</td>
    <td><textarea placeholder="contents"  type="text"
    	name="text1"></textarea></td>
  </tr>
  <tr>
    <td colspan="2">
		<input type="submit" value="Save" name="save"/>
		
	</td>
  </tr>
  
</table>
</form>
</center>
<?php
 
error_reporting(0);
$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'login');
	$text1 = mysqli_real_escape_string($db, $_POST['text1']);

         if(empty($text1))
         	{array_push($errors, "notice is required");}
         else{
			$query = "INSERT into notice (notice) VALUES ('".$text1."')";
			mysqli_query($db, $query);
//click on display button to show all values entered by you
            }
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
	</body>
</html>