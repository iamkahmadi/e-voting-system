<?php
	include 'includes/conn.php';

    $vid = null;
    $p = null;

	if(isset($_POST['register'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$id_no = $_POST['id_no'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$filename);	
		}
		//generate voters id
		$set =  time() . '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . time();
		$voter = substr(str_shuffle($set), 0, 15);

		$sql = "INSERT INTO voters (voters_id, password,id_no ,firstname, lastname, photo, is_active) VALUES ('$voter', '$password', '$id_no' , '$firstname', '$lastname', '$filename', 0)";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully';

        include 'includes/header.php';
        include 'includes/anon_header.php';

        echo '
            <div class="c-container">
                <div>
                    <p>
                    your registration is done successfully, you can login to your account after our apprval of regiration. please keep you voter ID and password safe, because you will need them when logging into your account
                    </p>
                    <table>
                        <tr>
                            <th>Voter ID: </th>
                            <td>' . $voter . '</td>
                        </tr>
                        <tr>
                            <th>Password: </th>
                            <td> &nbsp; '. $_POST["password"] .' </td>
                        </tr>
                    </table>
                    <br>
                    <a href="login.php">Go to Home Page</a>
                </div>
            </div>
        ';

		}
		else{
			$_SESSION['error'] = $conn->error;
            include 'includes/header.php';
            include 'includes/anon_header.php';
    
            echo '
                <a href="login.php">Go to Home Page</a>
                <div class="c-container">
                    <div>
                        <p>
                            Registration Failed please try again.
                        </p>
                        <br>
                        <a href="login.php">Go to Home Page</a>
                    </div>
                </div>
            ';
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';

        include 'includes/header.php';
        include 'includes/anon_header.php';

        echo '
            <a href="login.php">Go to Home Page</a>
            <div class="c-container">
                <div>
                    <p>
                        Registration Failed please try again.
                    </p>
                    <br>
                    <a href="login.php">Go to Home Page</a>
                </div>
            </div>
        ';
	}

?>
