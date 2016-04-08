<?php
// Start the session
session_start();

	$db = mysqli_connect('localhost','root','','test') or die('Error');

	$query = "CREATE TABLE IF NOT EXISTS ads_list (
	  timestamp INT(15),
	  ad_sr INT(11) NOT NULL AUTO_INCREMENT,
	  title VARCHAR(40) DEFAULT NULL,
	  description VARCHAR(300) DEFAULT NULL,
	  image VARCHAR(100) DEFAULT NULL,
	  cost INT(10) DEFAULT NULL,
	  uploader_id INT(25) DEFAULT NULL,
	  like_flag INT(1) DEFAULT NULL,
	  college VARCHAR(45) DEFAULT NULL,
	  branch VARCHAR(45) DEFAULT NULL,
	  year INT(10) DEFAULT NULL,
	  PRIMARY KEY (ad_sr)
	) ENGINE=InnoDB";

	mysqli_query($db, $query);
	
				
	if(isset($_POST['submit']))
	{
		create_ad();
	}
	
	
	function create_ad() {
		$user_id = $_SESSION['user_id'];
		//$user_id = $_POST['user_id'];
		$db = mysqli_connect('localhost','root','','test') or die('Error');
		$query = mysqli_query($db, "SELECT * FROM signupinfo WHERE signup_sr = '$user_id'") or die(mysqli_error());
		$row = mysqli_fetch_array($query);
		if($row['ads_count'] < 10){
				$timestamp = time();
				$title = $_POST['title'];
				$description = $_POST['description'];
				$cost = $_POST['cost'];
			//	$uploader_id = $_POST['user_id'];
				$uploader_id = $_SESSION['user_id'];
			$college = $row['college'];
				$branch = $row['branch'];
				$year = $row['year'];
				$ads_count = $row['ads_count'];	

				
				
					///////////////////////////////////
			//	$ad_sr = mysqli_insert_id($db);
				$target_dir = "uploads/";
				$random_digit=time();
				$target_file = $target_dir . $random_digit .'_'. basename($_FILES["upload_photo"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["upload_photo"]["tmp_name"]);
					if($check !== false) {
					//	echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["upload_photo"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["upload_photo"]["tmp_name"], $target_file)) {
					//	echo "The file ". basename( $_FILES["upload_photo"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}
				//////////////////////////////////
				
				$query = "INSERT INTO ads_list (timestamp, title, description, image, cost, uploader_id, college, branch, year) VALUES ($timestamp, '$title', '$description','$target_file', '$cost', '$uploader_id', '$college', '$branch', '$year')";
				$data = mysqli_query($db, $query)or die(mysqli_error());
				
				if($data)
				{
					$ads_count += 1;
					$query = "UPDATE signupinfo SET ads_count=$ads_count WHERE signup_sr=$user_id";
					$data = mysqli_query($db, $query) or die(mysqli_error());
					echo "YOUR ad is succesfully posted online...";
				}
		}
		else{
			echo "you have already posted maximum (10) ads..";
		}

	}
?>