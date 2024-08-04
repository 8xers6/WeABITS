<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
      

    
    
	
    $resid 	    =$_GET['id'];
    $houseno=$_GET['hno'];

    if(!empty($resid)){

        $query 		= "UPDATE tbl_residents SET `h_no` = 0 WHERE `res_id`=$resid;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Resident Has been removed';
            $_SESSION['success'] = 'danger';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    } else{

        $_SESSION['message'] = 'No HouseHold member change';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../view_householdmembers.php?id=$houseno");

	$conn->close();