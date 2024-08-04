<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id = $conn->real_escape_string($_GET['id']);

	if($id != ''){
		$query 		= "UPDATE `tblblotter` SET `department`='pno' WHERE `id`=$id";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Blotter has been Transferred!';
            $_SESSION['success'] = 'success';
            
    
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing Blotter ID!';
		$_SESSION['success'] = 'danger';
	}
	
	header("Location: ../lupon.php");

	$conn->close();
?>
