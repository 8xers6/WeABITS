<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
  
    $reqno 	= $conn->real_escape_string($_GET['reqno']);
    
     $resid 	= $conn->real_escape_string($_GET['resid']);




    if(!empty($reqno) ){

        $query  = "DELETE FROM `tblreqmedicine` WHERE `reqmed_no`='$reqno'";
        $result  = $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Request Medicine Deleted!';
            $_SESSION['success'] = 'danger';
            
            							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Request Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Request Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = ' Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
    
    

    header("Location: ../patientrecord.php?id=$resid");

	$conn->close();