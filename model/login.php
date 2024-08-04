<?php 
	include '../server/server.php';

	$email	= $conn->real_escape_string($_POST['email']);
	$password	= 	$password	= hash("sha256",$conn->real_escape_string($_POST['password']));


	if($email != '' AND $password != ''){


       
		$query1		= "SELECT tbl_users.name as name,tblbarangay.username as busername ,tblbarangay.bar_no as barno,tblbarangay.barangayname as barangayname,tbl_users.username as username, tbl_users.user_type as user_type,tbl_users.avatar FROM `tbl_users` LEFT JOIN tblbarangay on tbl_users.bar_no=tblbarangay.bar_no WHERE tbl_users.username='$email' AND tbl_users.password='$password'";
		$clerk_results 	= $conn->query($query1);
		if(mysqli_num_rows($clerk_results) == 1){
			while ($row = $clerk_results->fetch_assoc()) {
				$_SESSION['bar_no'] = $row['barno'];
				$_SESSION['brgyname'] = $row['barangayname'];
				$_SESSION['username'] = $row['busername'];
				$_SESSION['clerkusername'] = $row['username'];
				$_SESSION['role'] = $row['user_type'];
				$_SESSION['avatar'] = $row['avatar'];
				$_SESSION['name'] = $row['name'];
			}
			 
			$_SESSION['message'] = 'You have successfull logged in to Web Application Barangay Information and Transaction System!';
			$_SESSION['success'] = 'success';

            header('location: ../dashboard');

		}else{



		$query 		= "SELECT * FROM tblbarangay WHERE (`email` = '$email' OR `username`='$email')  AND `password` = '$password'";
		
		$result 	= $conn->query($query);
		
		if($result->num_rows){
			while ($row = $result->fetch_assoc()) {
				$_SESSION['bar_no'] = $row['bar_no'];
				$_SESSION['brgyname'] = $row['barangayname'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['role'] = "administrator";
				$_SESSION['avatar'] = $row['avatar'];
			}

			$_SESSION['message'] = 'You have successfull logged in to Web Application Barangay Information and Transaction System!';
			$_SESSION['success'] = 'success';

            header('location: ../dashboard');

		}else{
			$_SESSION['messages'] = 'Username or password is incorrect!';
			$_SESSION['success'] = 'danger';
            header('location: ../admin');
		}

	}
	}else{
		$_SESSION['message'] = 'Username or password is empty!';
		$_SESSION['success'] = 'danger';
        header('location: ../admin');
	}

    

	$conn->close();

?>