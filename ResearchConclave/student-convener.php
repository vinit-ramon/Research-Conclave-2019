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
			
			<li><a href="Assigned_Reviewer.php">Assigned Reviewer</a></li>
			<li><a href="refresh.php?logout">logout</a></li>
		
		</ul>
		<h1 style="color:white">STUDENT-CONVENER</h1>
	</div>
	<div style="height:100px">

<?php
	include 'connect.php';
	error_reporting(0);
	echo "<b>Finished submissions</b><br><br>";
	
	$date=date('Y-m-d');
	$query = "SELECT * FROM event";
	$data = mysqli_query($db, $query);
	$total = mysqli_num_rows($data);
	  while($result = mysqli_fetch_assoc($data))
	{
		if($date > $result['event_end_date']){
		echo "<b>Event Name: </b>".$result['event_name']."<br/>";
		echo "<b>Event Type: </b>".$result['event_type']."<br/>";
		$a=$result['event_type'];
		$a=strtolower($a);
		$a="abstract_".$a;
		$query_a = "SELECT * FROM $a WHERE event_name = '".$result['event_name']."'";
		$data_a = mysqli_query($db, $query_a);
		while($result_a = mysqli_fetch_assoc($data_a))
	{
		echo "<b>Abstract ID: </b>".$result_a['absID']." ";
		echo "<b>Participant: </b>".$result_a['abs_part']." ";
		echo "<b>Abstract Title: </b>".$result_a['abs_title']." ";
		echo "<b>Username: </b>".$result_a['part_username']."<br/>";
		}
	}
	echo "<br><br>";
	}
	echo "<b>Assign reviewers</b><br><br>";
?>
<form action="" method="POST" enctype="multipart/form-data" >
		<b>Event: </b><select name="event_name" onchange="getId(this.value);" id="name_of_event">
				<option value="">Select Event</option>
				<?php
				$query = "SELECT * FROM event";
				$data = mysqli_query($db, $query);
				$total = mysqli_num_rows($data);
				while($result = mysqli_fetch_assoc($data))
				{ if($date > $result['event_end_date']){
			?>
					<option value="<?php echo $result["event_name"];?> "><?php echo $result["event_name"]; ?></option>
				<?php } }
				?>
				</select>
				<b>Participant: </b><select name="part" id="part">
				<option value="">Select Participant</option>
				</select>
				<b>Reviewers: </b><select name="rev1" id="rev1">
				<option value="">Select Reviewer</option>
				</select>
				<select name="rev2" id="rev2">
				<option value="">Select Reviewer</option>
				</select>
				<input type="submit">
				<?php
					$event=$_POST["event_name"];
					$partic=$_POST["part"];
					$query1 = "SELECT * FROM event WHERE event_name = '".$event."'";
					$data1 = mysqli_query($db, $query1);
					while($result = mysqli_fetch_assoc($data1))
					{
						$type=$result['event_type'];
					}
					$a=$type;
					$a=strtolower($a);
					$a="abstract_".$a;
					$review1=$_POST["rev1"];
					$review2=$_POST["rev2"];
					//echo $event.$partic.$a.$review1.$review2;
					if($review1==$review2){
						echo "<br>Both reviewers cannot be same.<br>";
					}
					else{
						 $insert = $db->query("UPDATE $a SET reviewer1 = '".$review1."' WHERE part_username = '".$partic."'");
						 $insert = $db->query("UPDATE $a SET reviewer2 = '".$review2."' WHERE part_username = '".$partic."'");
						echo "<br>Successfully assigned.<br>";
					}
				?>
	</form>
	<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
		<script>
			function getId(val){
				//alert(val);
				$.ajax({
					type: "POST",
					url: "h.php",
					data: "event_name="+val,
					success: function(data){
						$("#part").html(data);
					}
			});
			$.ajax({
					type: "POST",
					url: "g.php",
					data: "event_name="+val,
					success: function(data){
						$("#rev1").html(data);
					}
			});
			$.ajax({
					type: "POST",
					url: "i.php",
					data: "event_name="+val,
					success: function(data){
						$("#rev2").html(data);
					}
			});
			}
		</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
	</body>
</html>