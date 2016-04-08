#likes database

<?php $db = mysqli_connect('localhost','root','','test') or die('Error');

	$query = "CREATE TABLE IF NOT EXISTS liked_ads (
	  timestamp INT(15),
	  like_sr INT(11) NOT NULL AUTO_INCREMENT,
	  user_id VARCHAR(40) DEFAULT NULL,
	  ad_sr INT(11) DEFAULT NULL,
	  PRIMARY KEY (like_sr)
	) ENGINE=InnoDB";

	mysqli_query($db, $query);
	
	?>
	
Qwerty1234!@