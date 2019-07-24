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
			<li><a href="refresh.php?logout">logout</a></li>
		
		</ul>
		<h1 style="color:white">REVIEWER</h1>
	</div>
	<div style="height:90px">
</div>
<div  style="float:left;padding:0%;width:30%;">
</div>

	<body action="download.php" method="get">
		<?php
	include 'connect.php';
	error_reporting(0);
session_start();
$username = $_SESSION['username'];


	$query = "SELECT * FROM reviewer WHERE username = '".$username."'";
		$data = mysqli_query($db, $query);
		$total = mysqli_num_rows($data);
		while($result = mysqli_fetch_assoc($data))
	{
		$reviewer_type = $result['reviewer_type'];
	}
	
	$a=$reviewer_type;
	$a=strtolower($a);
	$a="abstract_".$a;
	
		$query = "SELECT * FROM $a WHERE reviewer1 = '".$username."' OR reviewer2 = '".$username."'";

		$data = mysqli_query($db, $query);
		$total = mysqli_num_rows($data);
		while($result = mysqli_fetch_assoc($data))
	{
		echo "<b>Abstract ID: </b>".$result['absID']."<br/>";
		echo "<b>Participant: </b>".$result['abs_part']."<br/>";
		echo "<b>Abstract Title: </b>".$result['abs_title']."<br/>";
		echo "<b>E-mail ID: </b>".$result['part_mailid']."<br/>";
		echo "<b>Event: </b>".$result['event_name']."<br/>";
		echo "<b>Event type: </b>".$result['abs_type']."<br/>";
		echo "<b>File Submitted: </b>".$result['abs_file']." ";
		$b = $result['abs_file'];
		$add = "http://localhost/myprojectfolder/phpnew/download.php?file=";
		$add = $add.$b;
		echo "<a href='".$add."'>Download file</a>";
		echo "<br>";
		$t = $result['reviewer1'];
		$u = $result['reviewer2'];
		//echo $t.$username;
		if($t == $username){
			//echo aa;
			echo "<b>Grade: </b>".$result['grade1']."<br/>";
		}
		if($u == $username){
			echo "<b>Grade: </b>".$result['grade2']."<br/>";
		}
	echo "<br><br>";
	}
	
?>
	<form action="" method="POST" enctype="multipart/form-data" >
		<b>Abstract ID: </b><select name="abs_id">
				<?php
				$query = "SELECT * FROM $a WHERE reviewer1 = '".$username."' OR reviewer2 = '".$username."'";
				$data = mysqli_query($db, $query);
				$total = mysqli_num_rows($data);
				while($result = mysqli_fetch_assoc($data))
				{ ?>
					<option value="<?php echo $result["absID"]; ?> "><?php echo $result["absID"]; ?></option>
				<?php }
				?>
				</select>
				<b>Grade: </b><select name="grade" >
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				</select>
				<input type="submit">
				<?php
					$abs_id=$_POST["abs_id"];
					$grade=$_POST["grade"];
					$query = "SELECT * FROM $a WHERE absID = '".$abs_id."'";
						$data = mysqli_query($db, $query);
						$total = mysqli_num_rows($data);
						while($result = mysqli_fetch_assoc($data))
					{
						$rev1=$result['reviewer1'];
						$rev2=$result['reviewer2'];
					}
					if($rev1==$username){
						$insert = $db->query("UPDATE $a SET grade1 = '".$grade."' WHERE absID = '".$abs_id."'");
						$insert = $db->query("UPDATE $a SET grade1_status = 'YES' WHERE absID = '".$abs_id."'");}
					if($rev2==$username){
						$insert = $db->query("UPDATE $a SET grade2 = '".$grade."' WHERE absID = '".$abs_id."'");
						$insert = $db->query("UPDATE $a SET grade2_status = 'YES' WHERE absID = '".$abs_id."'");
					}
				?>
	</form>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
	</body>
</html>