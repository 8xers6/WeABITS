<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
      

    
    $household 	= $conn->real_escape_string($_POST['houseno']);
	
    $resid 	    = $conn->real_escape_string($_POST['resid']);

    if(!empty($resid) && !empty($household)){

        $query 		= "UPDATE tbl_residents SET `h_no` ='$household' WHERE res_id=$resid;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Successfully Added';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    } else{

        $_SESSION['message'] = 'No HouseHold member change';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../view_householdmembers.php?id=$household");

	$conn->close();


    ?>