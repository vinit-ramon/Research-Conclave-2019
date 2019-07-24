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
		<h1 style="color:white">NOTICE</h1>
	</div>

<div style="height:100px">
</div>
<div  style="float:left;padding:1%;width:30%;">
</div>

	<div  style="float:left;width:40%;border:solid blue;"align="center">
	<table >
	<tr>
	
	<th style="color:red">NOTICES</th>
	</tr>

    <?php
	$conn = mysqli_connect("localhost", "root","", "login");
	if($conn-> connect_error)
	{
		die("Connection failed:". $conn-> connect_error);
	}
	$sql = "SELECT notice_id, notice from notice";
	$result = $conn-> query($sql);
    
	if( $result-> num_rows >0){

		while ($row = $result-> fetch_assoc())
		{
			
              echo "<tr><td>".$row["notice"]."</td></tr>"; 
			
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