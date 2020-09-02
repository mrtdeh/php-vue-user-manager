<?php

require "config.php";


$servername = "127.0.0.1";
$username = DB_USER;
$password = DB_PASS;
$dbName = DB_NAME;
$create_users_table = "CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`mobile` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
";
// Connect to MySQL
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	echo 'Error connecting to mysql: '.$conn->connect_error;
	echo "</br> please check the config.php file and try again";
	die();
}
// If database is not exist create one
if (!mysqli_select_db($conn,$dbName)){
	$sql = "CREATE DATABASE ".$dbName;
	if ($conn->query($sql) === TRUE) {
		// echo $dbName." Database created successfully </br>";
		mysqli_select_db($conn,$dbName);

	}else {
		echo "Error creating database: " . $conn->error."</br>";
	}
}


if(mysqli_num_rows(mysqli_query($conn,"SHOW TABLES LIKE 'users'"))==0) {
	if ($conn->query($create_users_table) === TRUE) {
		// echo "users Table created successfully </br>";
		// die("ALL DONE ... PLEASE RELOAD AGAIN.");
	}else {
		echo "Error creating Table: " . $conn->error;
		die("\nPlaese Check the config.php and try again.");

	}
}

