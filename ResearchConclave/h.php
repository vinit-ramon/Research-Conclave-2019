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
		$a=$type;
		$a=strtolower($a);
		$a="abstract_".$a;
		$query = "SELECT * FROM $a WHERE event_name = '".$cid."'";
		$results = mysqli_query($db, $query);
		
		foreach ($results as $event){
			?>
			<option value="<?php echo $event["part_username"]; ?>"><?php echo $event["part_username"]; ?></option>
			<?php
		}
	}
?>