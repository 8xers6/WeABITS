<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	//$checkno 	= $conn->real_escape_string($_GET['id']);
    $pno 	= $conn->real_escape_string($_GET['pno']);

	if($pno != ''){
		$query 		= "DELETE FROM `tblpatient` WHERE `patient_no`='$pno'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Patient has been removed!';
            $_SESSION['success'] = 'danger';
            
            
            					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Patient')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Patient')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing  ID!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../patientinfo.php?");
	$conn->close();

