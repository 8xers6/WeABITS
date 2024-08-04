<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $resid 	= $conn->real_escape_string($_POST['res_id']);
    $mop 	= $conn->real_escape_string($_POST['mop']);
    $noc 	= $conn->real_escape_string($_POST['noc']);


    if(!empty($resid) && !empty($mop)){

        $insert  = "INSERT INTO `tblpregnant` (`res_id`, `months_pregnant`, `no_of_children`) VALUES ('$resid', '$mop', '$noc');";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Pregnant added!';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Pregnant')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Pregnant')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = ' Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../pregnant.php");

	$conn->close();