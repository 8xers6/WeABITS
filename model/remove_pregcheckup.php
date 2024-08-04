<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$checkno 	= $conn->real_escape_string($_GET['id']);
    $pregno 	= $conn->real_escape_string($_GET['pregno']);

	if($checkno != ''){
		$query 		= "DELETE FROM `tblpreg_checkup` WHERE `checkup_no`='$checkno'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Record has been removed!';
            $_SESSION['success'] = 'danger';
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing Street ID!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../pregdetails.php?pregno=$pregno");
	$conn->close();

