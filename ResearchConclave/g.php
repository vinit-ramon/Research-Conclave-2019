<?php
	include_once 'connect.php';
	
	if (!empty($_POST["event_name"])){
		$cid = $_POST["event_name"];
		$query1 = "SELECT * FROM event WHERE event_name = '".$cid."'";
		$data1 = mysqli_query($db, $query1);
		while($result = mysqli_fetch_assoc($data1))
		{
			$type=$result['event_type'];
		}
		$query = "SELECT * FROM reviewer WHERE reviewer_type = '".$type."'";
		$results = mysqli_query($db, $query);
		
		foreach ($results as $event){
			?>
			<option value="<?php echo $event["username"]; ?>"><?php echo $event["username"]; ?></option>
			<?php
		}
	}
?>