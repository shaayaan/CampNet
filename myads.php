<?php
// Start the session
session_start();
	$db = mysqli_connect('localhost','root','','test') or die('Error');
	
	$user_id = $_SESSION['user_id'];
	$query = mysqli_query($db, "SELECT * FROM ads_list WHERE uploader_id = '$user_id'") or die(mysqli_error());
	$row = mysqli_fetch_array($query);
	if(!$row){
		echo"no ads";
	}
	else {
		do{
			echo "Title :{$row['title']}  <br> ".
			 "Description: {$row['description']} <br> ".
			 "Cost: {$row['cost']} <br> ".
			 "--------------------------------<br>";
		}
		while($row = mysqli_fetch_array($query));
	}
?>