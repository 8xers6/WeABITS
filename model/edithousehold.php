<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $household 	= $conn->real_escape_string($_POST['householdno']);
	$street 	= $conn->real_escape_string($_POST['street']);
    $id 	    = $conn->real_escape_string($_POST['id']);

    if(!empty($id) && !empty($household) && empty($street)){

        $query 		= "UPDATE tblhousehold SET `household_no` = '$household' WHERE id=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    } else if(!empty($id) && !empty($household) && !empty($street)){

        $query 		= "UPDATE tblhousehold SET `household_no` = '$household', `st_id`=$street WHERE h_no=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No HouseHold change';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../household.php");

	$conn->close();