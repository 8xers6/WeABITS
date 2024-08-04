<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

    $id 	= $conn->real_escape_string($_GET['id']);

$barno=$_SESSION['bar_no'];
	if(!empty($id)){
		$query 		= "DELETE FROM `tblequipments` WHERE equip_no=$id";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Equipment has been Deleted ';
            $_SESSION['success'] = 'danger';
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing equipment ID!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../equipment");
	$conn->close();
?>
