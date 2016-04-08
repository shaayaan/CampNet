<?php

/*
	encryption <<
	id for rows <<
	check for user with same username or emailID <<
	branch restrict 
	drop downs convert
	link verification 
*/

$db = mysqli_connect('localhost','root','','test') or die('Error');


$query = "CREATE TABLE IF NOT EXISTS signupinfo (
  timestamp INT(15),
  signup_sr INT(10) NOT NULL AUTO_INCREMENT,
  name VARCHAR(25) DEFAULT NULL,
  college VARCHAR(45) DEFAULT NULL,
  branch VARCHAR(45) DEFAULT NULL,
  year INT(10) DEFAULT NULL,
  username VARCHAR(20) DEFAULT NULL,
  emailID VARCHAR(45) DEFAULT NULL,
  password VARCHAR(20) DEFAULT NULL,
  ads_count INT(5) DEFAULT NULL,
  PRIMARY KEY (signup_sr)
) ENGINE=InnoDB";

mysqli_query($db, $query);

function newuser()
{
	$db = mysqli_connect('localhost','root','','test') or die('Error');
	$timestamp = time();
	$fname = $_POST['name'];
	$college = $_POST['college'];
	$branch = $_POST['branch'];
	$year = $_POST['year'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$ads_count = 0;
	
	$password = md5($password);
	
	
	
	$query = "INSERT INTO signupinfo (timestamp, name, college, branch, year, username, emailID, password, ads_count) VALUES ($timestamp, '$fname', '$college', '$branch', '$year', '$username', '$email', '$password', $ads_count)";
	$data = mysqli_query($db, $query)or die(mysqli_error());
	if($data)
	{
	echo "YOUR REGISTRATION IS COMPLETED...";
	echo "New record has id: " . mysqli_insert_id($db);

	}
}

function SignUp()
{
	$db = mysqli_connect('localhost','root','','test') or die('Error');
if(!empty($_POST['username']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
{
	if($_POST['password'] == $_POST['password2']) {
	$query = mysqli_query($db, "SELECT * FROM signupinfo WHERE username = '$_POST[username]' or emailID = '$_POST[email]'") or die(mysqli_error());

	if(!($row = mysqli_fetch_array($query)))
	{
		newuser();
	}
	else
	{
		$username = $_POST['username'];
		if($row['username'] == $username) {
			echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
		}
		else{
			echo "You already have registered with the same email ID";
		}
	}
	}
	else{echo"Password incorrect";}
}
}
if(isset($_POST['submit']))
{
	SignUp();
}
?>