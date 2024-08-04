<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$fundno 	    = $conn->real_escape_string($_POST['fundno']);
	$funds 	= $conn->real_escape_string($_POST['funds']);
    $dateapproved 	    = $conn->real_escape_string($_POST['dateapproved']);

    $datereceived 	    = $conn->real_escape_string($_POST['datereceived']);

    if(!empty($fundno)){

        $query 		= "UPDATE `tblfunds` SET `Funds`='$funds',`date_approved`='$dateapproved',`date_received`='$datereceived' WHERE fund_no=$fundno";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Barangay Funds has been updated!';
            $_SESSION['success'] = 'success';
            
            	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Funds')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Funds')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No Funds ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../barangayfunds.php");

	$conn->close();