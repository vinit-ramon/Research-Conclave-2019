<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'login');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$Full_name = mysqli_real_escape_string($db, $_POST['Full_name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$usertype = mysqli_real_escape_string($db, $_POST['usertype']);


		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required");
		 }
		 if (empty($Full_name)) { array_push($errors, "Full_name is required");
		 }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($usertype)) { array_push($errors, "usertype is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {

			$query = "SELECT * FROM login WHERE username='$username'";
			$results=mysqli_query($db, $query);

			if (mysqli_num_rows($results)==0)
			{
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO login (username,Full_name, email, password ,usertype) 
					  VALUES('$username','$Full_name' ,'$email', '$password' , '$usertype')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: homepage1.php');
		}}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				
				$row  = mysqli_fetch_array($results);

				if($row['usertype']=="faculty-convener")
					header('location: faculty.php');
				elseif($row['usertype']=="student-convener")
					header('location: student.php');
				elseif($row['usertype']=="reviewer")
					header('location: reviewer.php');
				elseif($row['usertype']=="participant")
					header('location: participant.php');

					else
						array_push($errors,"user doesn't exists");
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>