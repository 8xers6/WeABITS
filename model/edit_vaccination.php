<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$resid 	    = $conn->real_escape_string($_POST['resid']);
	$vbrand 	= $conn->real_escape_string($_POST['vbrand']);
    $vstatus 	    = $conn->real_escape_string($_POST['vstatus']);

    if(!empty($resid) && !empty($vbrand) && !empty($vstatus)){

        $query 		= "UPDATE tbl_residents SET `vaccine_brand` = '$vbrand', `vaccine_status`='$vstatus' WHERE res_id=$resid;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Vaccination Record has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No Vaccine ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../vaccination_records.php");

	$conn->close();