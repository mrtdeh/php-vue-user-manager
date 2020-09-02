<?php
	require "../config.php";


	header("Content-type: application/json");


	$conn = new mysqli("127.0.0.1", DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) {
		die("اتصال برقرار نشد");
	}
	$res = array('error' => false);


	$action = 'read';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}

	if ($action == 'read') {
		$result = $conn->query("SELECT * FROM `users`");
		$users  = array();

		while ($row = $result->fetch_assoc()) {
			array_push($users, $row);
		}
		$res['users'] = $users;
	}



	if ($action == 'create') {
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];

		$result = $conn->query("INSERT INTO `users` (`username`, `email`, `mobile`) VALUES('$username', '$email', '$mobile')");

		if ($result) {
			$res['message'] = "کاربر با موفقیت اضافه شد";
		} else {
			$res['error']   = true;
			$res['message'] = "اشکالی در ثیت کاربر بوجود اومده";
		}
	}


	

	if ($action == 'update') {
		$id       = $_POST['id'];
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];


		$result = $conn->query("UPDATE `users` SET `username`='$username', `email`='$email', `mobile`='$mobile' WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "اظلاعات کاربر بروز شد";
		} else {
			$res['error']   = true;
			$res['message'] = "اشکالی در بروزرسانی بوجود اومده";
 		}
	}




	if ($action == 'delete') {
		$id       = $_POST['id'];
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];

		$result = $conn->query("DELETE FROM `users` WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "کاربر حذف شد";
		} else {
			$res['error']   = true;
			$res['message'] = "اشکالی در حذف کاربر پیش اومده";
		}
	}



	$conn->close();

	
	echo json_encode($res);
	die();

?>
