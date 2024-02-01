<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
	$voter = $_POST['voter'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
	$query = $conn->query($sql);

	if ($query->num_rows < 1) {
		$_SESSION['error'] = 'Cannot find voter with the ID';
		header('location: login_page.php');
		exit();
	} else {
		$row = $query->fetch_assoc();

		if ($row["is_active"] == 0) {
			$_SESSION['error'] = 'Your registration is not approved yet';
			header('location: login_page.php');
			exit();
		}

		if (password_verify($password, $row['password'])) {
			$_SESSION['voter'] = $row['id'];
			header('location: home.php');
			exit();
		} else {
			$_SESSION['error'] = 'Incorrect password';
		}
	}
} else {
	$_SESSION['error'] = 'Input voter credentials first';
}

header('location: login_page.php');
