<?php
// Start the session
session_start();
	$db = mysqli_connect('localhost','root','','test') or die('Error');

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);

	$query = mysqli_query($db, "SELECT * FROM signupinfo WHERE username = '$username'") or die(mysqli_error());

	if($row = mysqli_fetch_array($query)) {
		
		$fetchpass = (strlen($password) > 20) ? substr($password, 0, 20) : $password;
		if($row['password'] == $fetchpass){
			echo "login successful";
			$_SESSION['user_id'] = $row['signup_sr'];
			$_SESSION['college'] = $row['college'];
			$_SESSION['branch'] = $row['branch'];
			$_SESSION['year'] = $row['year'];
			
		}
		else {
			echo "wrong password ";
		}
	}
	else {
		echo "no user with this username found";
	}
?>