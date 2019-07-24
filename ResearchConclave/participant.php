<?php
	include 'connect.php';
	error_reporting(0);
	session_start();
	$part_username = $_SESSION['username'];
	$query = "SELECT * FROM login WHERE username = '".$part_username."'";
	$data = mysqli_query($db, $query);
	$total = mysqli_num_rows($data);
	  while($result = mysqli_fetch_assoc($data))
	{
		$abs_part = $result['Full_name'];
	}
	//echo "<br>".$part_username."<br>";
?>
<html>
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
		<h1 style="color:white">PARTICIPANT</h1>
	</div>
	<div style="height:100px">
<center>
<script type="text/javascript">
function validate()
{
 var error="";
 var name = document.getElementById( "name_of_participant" );
 if( name.value == "" )
 {
  error = " Participant's name not given. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 var title = document.getElementById("title_of_abstract");
 if(title.value == "")
 {
  error = " Abstract's title not given. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 var email = document.getElementById( "email_id" );
 if( email.value == "" || email.value.indexOf( "@" ) == -1 )
 {
  error = " You Have To Write Valid Email Address. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 var type = document.getElementById("type_of_event");
 if(type.value == "")
 {
  error = " Type of event not selected. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 else
 {
  return true;
 }
}

</script>
	<body>
		<h1>Abstract Submission</h1>
		<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validate();"> 
			
			<b>Name of participant:<b> <input type="text" name="abs_part" value="<?php echo $abs_part; ?>" readonly id="name_of_participant"><br><br>
			<b>Title of abstract :<b> <input type="text" name="abs_title" id="title_of_abstract"><br><br>
			<b>E-mail ID:<b> <input type="text" name="part_mailid" id="email_id"><br><br>
			<b>Type of event:<b>
			<select name="abs_type" onchange="getId(this.value);" id="type_of_event">
				<option value="">Select Type</option>
				<option value="Poster">Poster</option>
				<option value="Oral">Oral</option>
				</select>
			<select name="event_name" id="event_list">
				<option value="">Select Event</option>
			</select>
			<br><br>
			<table frame="box">
			  <tr>
				<th><input type="file" name="file" /></th>
			  </tr>
			</table>
			<br>
			<input type="submit">
		</center>
			<?php
if(isset($_FILES['file'])){
      //$errors= array();
	  $errors="";
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
	
	$extensions= array("pdf");
	
	$abs_part=$_POST["abs_part"];
	  $abs_title=$_POST["abs_title"];
	  $part_mailid=$_POST["part_mailid"];
	  $event_name=$_POST["event_name"];
	  $abs_type=$_POST["abs_type"];
	  
	 $query = "SELECT * FROM event WHERE event_name = '".$event_name."'";
	$data = mysqli_query($db, $query);
	$total = mysqli_num_rows($data);
	  while($result = mysqli_fetch_assoc($data))
	{
		$start_date = $result['event_start_date'];
		$end_date = $result['event_end_date'];
		
		$date=date('Y-m-d'); // PHP documentation for other formats
		/*echo '<br>'.$date.'<br>';
		echo $start_date.'<br>';
		echo $end_date;*/
	}
	
	if($abs_type=="Poster"){
	$query = "SELECT * FROM abstract_poster WHERE part_username = '".$part_username."'";
	$data = mysqli_query($db, $query);
	$exist = mysqli_num_rows($data);
	}
	if($abs_type=="Oral"){
	$query = "SELECT * FROM abstract_oral WHERE part_username = '".$part_username."'";
	$data = mysqli_query($db, $query);
	$exist = mysqli_num_rows($data);
	}
	  
	
	if(in_array($file_ext,$extensions)=== false){
         $errors ="Please upload a PDF file.";
      }
	  if($date < $start_date){
		$errors = "Submission of abstracts is yet to start for selected event.";
	  }
	  if($date > $end_date){
		$errors = "Submission of abstracts is over for selected event.";
	  }
	  if($exist != 0){
		$errors = "You have already submitted your abstract.";
	  }

      if(empty($errors)==true){

		  if($abs_type == "Poster"){
		  	
		  $insert = $db->query("INSERT into abstract_poster (abs_part,abs_title,part_mailid,event_name,part_username) VALUES ('".$abs_part."','".$abs_title."','".$part_mailid."','".$event_name."','".$part_username."')");
		  $query = "SELECT * FROM abstract_poster WHERE part_username = '".$part_username."'";
		$data = mysqli_query($db, $query);
		while($result = mysqli_fetch_assoc($data))
		{
		$abs_id_p = $result['absID'];
		}
		$file_name = "Poster".$abs_id_p.".pdf";
		move_uploaded_file($file_tmp,"file/".$file_name);
		$insert = $db->query("UPDATE abstract_poster SET abs_file = '".$file_name."' WHERE absID = '".$abs_id_p."'");
		  }
		 
		 if($abs_type=="Oral"){
		  $insert = $db->query("INSERT into abstract_oral (abs_part,abs_title,part_mailid,event_name,part_username) VALUES ('".$abs_part."','".$abs_title."','".$part_mailid."','".$event_name."','".$part_username."')");
		  $query = "SELECT * FROM abstract_oral WHERE part_username = '".$part_username."'";
		$data = mysqli_query($db, $query);
		while($result = mysqli_fetch_assoc($data))
		{
		$abs_id_o = $result['absID'];
		}
		$file_name = "Oral".$abs_id_o.".pdf";
		move_uploaded_file($file_tmp,"file/".$file_name);
		$insert = $db->query("UPDATE abstract_oral SET abs_file = '".$file_name."' WHERE absID = '".$abs_id_o."'");
		  }
		 
         echo "<br>Success";
		 
      }else{
         //print_r($errors);
		 echo "<br>".$errors;
      }
	}

?>
		</form>
		<p id="error_para" ></p>
		<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
		<script>
			function getId(val){
				//alert(val);
				$.ajax({
					type: "POST",
					url: "c.php",
					data: "abs_type="+val,
					success: function(data){
						$("#event_list").html(data);
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