<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
    $resid 	= $conn->real_escape_string($_POST['resid']);
    $medicine 	= $conn->real_escape_string($_POST['medicine']);
    $quantity	= $conn->real_escape_string($_POST['qty']);
    $bhwname 	= $conn->real_escape_string($_POST['bhw']);
    $date 	= $conn->real_escape_string($_POST['datereceived']);



    if(!empty($barno) && !empty($medicine)){

        $insert  = "INSERT INTO `tblreqmedicine`( `res_id`, `medicine_name`, `quantity`, `bhw_name`, `date_received`) 
                                         VALUES ('$resid','$medicine','$quantity','$bhwname','$date')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Request added!';
            $_SESSION['success'] = 'success';
            
            
            							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Request Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Request Medicine')";
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

    header("Location: ../medicine.php");

	$conn->close();