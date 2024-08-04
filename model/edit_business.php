<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
        $buspno 	= $conn->real_escape_string($_POST['buspno']);
      $orno 	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
	$bname 	    = $conn->real_escape_string($_POST['bname']);


    $natureBO	= $conn->real_escape_string($_POST['natureBO']); 
    $dtino 	= $conn->real_escape_string($_POST['dtino']); 
	$nature 	= $conn->real_escape_string($_POST['nature']);
    $bstreet 	= $conn->real_escape_string($_POST['bstreet']);

    $bcontact 	= $conn->real_escape_string($_POST['bcontact']);
    
    
       $amount 	= $conn->real_escape_string($_POST['amount']);
    $applied 	= $conn->real_escape_string($_POST['applied']);
    $expired 	= $conn->real_escape_string($_POST['expired']);

    if(!empty($buspno) && !empty($bstreet)){

        $insert  = "UPDATE `tblbusinesspermit` SET `businessname`='$bname',`nature`='$nature',`nature_of_business_ownership`='$natureBO',`dti_registration_no`='$dtino',`bstreet`='$bstreet',`bcontact_no`='$bcontact',`or_no`='$orno',`amounts`='$amount',`ctc_no`='$ctcno',`expired_date`='$expired',`applied`='$applied' WHERE `busp_no`=$buspno ";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Business Permit has been updated!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'error';
            $_SESSION['success'] = 'danger';
        }
    }elseif(!empty($buspno) && empty($bstreet)){
             $insert  = "UPDATE `tblbusinesspermit` SET `businessname`='$bname',`nature`='$nature',`nature_of_business_ownership`='$natureBO',`dti_registration_no`='$dtino',`bcontact_no`='$bcontact',`or_no`='$orno',`amounts`='$amount',`ctc_no`='$ctcno',`expired_date`='$expired',`applied`='$applied' WHERE `busp_no`=$buspno ";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Business Permit has been updated!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'error';
            $_SESSION['success'] = 'danger';
        }
        
    }
    else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");

	$conn->close();



?>