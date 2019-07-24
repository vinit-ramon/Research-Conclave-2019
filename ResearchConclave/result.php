<!DOCTYPE html>
<html>
	<head>
		<title>Responsive Navigation Bar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style2.css">
		<script type="text/javascript" src="javascript.js"></script>
	</head style="background-color:#24248f">
	<body>
	<div id="header">
	<div id="logo"><img src="ResponsiveNavigationBar/logo3.png"/></div>
	<div id="res_btn" onclick="show_hide_nav('navbar')" ><img src="ResponsiveNavigationBar/button.png"/></div>
		<ul id="navbar">
			<li><a href="homepage1.php">Home</a></li>
			<li><a href="result.php">Events</a></li>
 			<li><a href="login.php">Login</a></li>
		   
		</ul>
		<h1 style="color:white">Events</h1>
	</div>

<div style="height:100px">
</div>
<div  style="float:left;padding:1%;width:30%;">
</div>

	<div  style="float:left;width:40%;border:solid blue;"align="center">
	<table >
	<tr>
	<th style="color:red">Name</th>
	<th style="color:red">Title</th>
	<th style="color:red">Event Name</th>
	<th style="color:red">Event type</th>
	</tr>

    <?php
	$conn = mysqli_connect("localhost", "root","", "login");
	if($conn-> connect_error)
	{
		die("Connection failed:". $conn-> connect_error);
	}
	$sql = "SELECT abs_part, abs_title,event_name from abstract_oral";
	$result = $conn-> query($sql);
    
	if( $result-> num_rows >0){

		while ($row = $result-> fetch_assoc())
		{
			
              echo "<tr><td>". $row["abs_part"] ."</td><td>".$row["abs_title"]."</td><td>".$row["event_name"] ."</td><td>".'ORAL'."</td></tr>"; 
			
		}

		
	}
	else{
		echo "0 result";
	} 

	$sql2 = "SELECT abs_part, abs_title,event_name from abstract_poster";
	$result2 = $conn-> query($sql2);
    
	if( $result2-> num_rows >0){

		while ($row = $result2-> fetch_assoc())
		{
			
              echo "<tr><td>". $row["abs_part"] ."</td><td>".$row["abs_title"]."</td><td>".$row["event_name"] ."</td><td>".'POSTER' ."</td></tr>"; 
			
		}

		echo"</table>";
	}
	else{
		echo "0 result";
	} 
	$conn->close();


    ?>
</table>
</div>
	</body>
</html>