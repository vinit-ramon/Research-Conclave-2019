<html>
	<body action="download.php" method="get">
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
			<li><a href="student.php">convenerHome</a></li>
			<li><a href="student-convener.php">Events</a></li>
			
			<li><a href="refresh.php?logout">logout</a></li>
		
		</ul>
		<h1 style="color:white">STUDENT-CONVENER</h1>
	</div>
	<div style="height:100px">
	</div>

	<?php
	include 'connect.php';
	error_reporting(0);
	echo "<b>Assigned Reviwers</b><br><br>";

	$query3 = "SELECT * FROM abstract_poster";
	$data3 = mysqli_query($db, $query3);
	
	  while($result3 = mysqli_fetch_assoc($data3))
	{
		if($result3['reviewer1']!="" && $result3['reviewer2']!="")  {
		echo "<b>Abstract ID: </b>".$result3['absID']."<br/>";
		echo "<b>Participant: </b>".$result3['abs_part']."<br/>";
		echo "<b>Event type: </b>Poster<br/>";
		echo "<b>Title of Abstract: </b>".$result3['abs_title']."<br/>";
		echo "<b>Reviewer1: </b>".$result3['reviewer1']."<br/>";
		echo "<b>Reviewer2: </b>".$result3['reviewer2']."<br/>";
		
	echo "<br>";
	}}



	$query4 = "SELECT * FROM abstract_oral";
	$data4 = mysqli_query($db, $query4);
	
	  while($result4 = mysqli_fetch_assoc($data4))
	{
		if($result4['reviewer1']!="" && $result4['reviewer2']!="")  {
		echo "<b>Abstract ID: </b>".$result4['absID']."<br/>";
		echo "<b>Participant: </b>".$result4['abs_part']."<br/>";
		echo "<b>Event type: </b>Oral<br/>";
		echo "<b>Title of Abstract: </b>".$result4['abs_title']."<br/>";
		echo "<b>Reviewer1: </b>".$result4['reviewer1']."<br/>";
		echo "<b>Reviewer2: </b>".$result['reviewer2']."<br/>";
		
	echo "<br>";
	}}


	?>

	
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
	
</body>
</html>