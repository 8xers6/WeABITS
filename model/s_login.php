<?php 
	include '../server/server.php';

	$username 	= $conn->real_escape_string($_POST['username']);
	$password	= sha1($conn->real_escape_string($_POST['password']));


	if($username != '' AND $password != ''){
		$query 		= "SELECT * FROM tblsuperuser WHERE username = '$username' AND password = '$password'";
		
		$result 	= $conn->query($query);
		
		if($result->num_rows){
			while ($row = $result->fetch_assoc()) {
				//$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['user_type'];
			
			}

			$_SESSION['messages'] = 'You have successfull logged in to Web Application Barangay Information and Transaction System!';
			$_SESSION['success'] = 'success';

            header('location: ../s_dashboard');

		}else{
			$_SESSION['messages'] = 'Username or password is incorrect!';
			$_SESSION['success'] = 'danger';
            header('location: ../s_admin');
		}
	}else{
		$_SESSION['message'] = 'Username or password is empty!';
		$_SESSION['success'] = 'danger';
        header('location: ../s_admin');
	}

    

	$conn->close();

