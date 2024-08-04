<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
    $resid 	= $conn->real_escape_string($_POST['resid']);

    $reqno 	= $conn->real_escape_string($_POST['reqno']);
    $medicine 	= $conn->real_escape_string($_POST['medicine']);
    $quantity	= $conn->real_escape_string($_POST['qty']);
    $bhwname 	= $conn->real_escape_string($_POST['bhw']);
    $date 	= $conn->real_escape_string($_POST['datereceived']);



    if(!empty($barno) && !empty($medicine)){

        $insert  = "UPDATE `tblreqmedicine` SET `medicine_name`='$medicine',`quantity`='$quantity',`bhw_name`='$bhwname',`date_received`='$date' WHERE `reqmed_no`='$reqno'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Request Updated!';
            $_SESSION['success'] = 'success';
            
            
            							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Request Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Request Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

    }else  if(!empty($barno) && empty($medicine)){

        $insert  = "UPDATE `tblreqmedicine` SET `quantity`='$quantity',`bhw_name`='$bhwname',`date_received`='$date' WHERE `reqmed_no`='$reqno'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Request Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

    }
    else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../medicine.php");

	$conn->close();