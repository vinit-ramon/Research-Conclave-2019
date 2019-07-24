<?php
	include_once 'connect.php';
	
	if (!empty($_POST["abs_type"])){
		$cid = $_POST["abs_type"];
		$query = "SELECT * FROM event WHERE event_type = '".$cid."'";
		$results = mysqli_query($db, $query);
		
		foreach ($results as $event){
			?>
			<option value="<?php echo $event["event_name"]; ?> "><?php echo $event["event_name"]; ?></option>
			<?php
		}
	}
?>