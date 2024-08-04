<?php 
	include '../server/server.php';

	$username 	= $conn->real_escape_string($_POST['username']);
	$password	= hash("sha256",$conn->real_escape_string($_POST['password']));


	if($username != '' AND $password != ''){
		$query 		= "SELECT * FROM tbl_residents WHERE (username = '$username' OR `email`='$username') AND password = '$password'";
		
		$result 	= $conn->query($query);
		
		if($result->num_rows){


			while ($row = $result->fetch_assoc()) {


		
							
				
						$_SESSION['barno'] = $row['bar_no'];
						$_SESSION['resid'] = $row['res_id'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['role'] = $row['user_type'];
						
						header('location: ../dashboard');
	
						$_SESSION['message'] = 'You have successfull logged in to Web Application Barangay Information and Transaction System!';
						$_SESSION['success'] = 'success';


			}



		
			

		}else{
			$_SESSION['message'] = 'Username or password is incorrect!';
			$_SESSION['success'] = 'danger';
            header('location: ../homeresident');
		}
	}else{
		$_SESSION['message'] = 'Username or password is empty!';
		$_SESSION['success'] = 'danger';
        header('location: ../homeresident');
	}




    

	$conn->close();

?>