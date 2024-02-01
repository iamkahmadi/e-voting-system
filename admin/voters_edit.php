<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		// $password = $_POST['password'];
		$is_active = $_POST['is_active'];

		$sql = "SELECT * FROM voters WHERE id = $id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		// if($password == $row['password']){
		// 	$password = $row['password'];
		// }
		// else{
		// 	$password = password_hash($password, PASSWORD_DEFAULT);
		// }

		// $sql = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', is_active= '$is_active' ,password = '$password' WHERE id = '$id'";
		$sql = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', is_active= '$is_active' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: voters.php');

?>