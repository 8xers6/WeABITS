<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $pno 	= $conn->real_escape_string($_POST['pno']);
    $findings 	= $conn->real_escape_string($_POST['findings']);
    $treatment 	= $conn->real_escape_string($_POST['treatment']);
        $date 	= $conn->real_escape_string($_POST['date']);


    if(!empty($pno) && !empty($findings)){

        $insert  = "UPDATE `tblpatient` SET `findings`='$findings',`treatment`='$treatment',`date`='$date' WHERE `patient_no`=$pno";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Patient Updated!';
            $_SESSION['success'] = 'success';
            
            
            					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Patient info')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Patient info')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../patientinfo.php");

	$conn->close();