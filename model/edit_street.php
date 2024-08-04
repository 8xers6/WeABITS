<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$streetname 	    = $conn->real_escape_string($_POST['streetname']);
	$details 	= $conn->real_escape_string($_POST['details']);
    $id 	    = $conn->real_escape_string($_POST['stid']);

    if(!empty($streetname)){

        $query 		= "UPDATE tblstreet SET `streetname` = '$streetname', `details`='$details' WHERE st_id=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Street has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No Street ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../street.php");

	$conn->close();