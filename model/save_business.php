<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $orno 	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
	$bname 	    = $conn->real_escape_string($_POST['bname']);
	$res_id 	= $conn->real_escape_string($_POST['owner1']);

    $natureBO	= $conn->real_escape_string($_POST['natureBO']); 
    $dtino 	= $conn->real_escape_string($_POST['dtino']); 
	$nature 	= $conn->real_escape_string($_POST['nature']);
    $bstreet 	= $conn->real_escape_string($_POST['bstreet']);

    $bcontact 	= $conn->real_escape_string($_POST['bcontact']);
    
    
       $amount 	= $conn->real_escape_string($_POST['amount']);


  $applied = date("Y-m-d");
$expired = date('Y-m-d', strtotime($applied. ' + 1 year'));

    if(!empty($bname) && !empty($res_id) && !empty($nature) && !empty($applied)&& !empty($bstreet)){

        $insert  = "INSERT INTO `tblbusinesspermit` (`or_no`, `ctc_no`, `businessname`, `res_id`, `nature`, `bstreet`, `bcontact_no`, `applied`, `expired_date`, `nature_of_business_ownership`, `dti_registration_no`,`amounts`) 
         
         VALUES ('$orno', '$ctcno', '$bname', '$res_id', '$nature', '$bstreet', '$bcontact', '$applied', '$expired','$natureBO','$dtino',$amount)";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Business Permit added!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");

	$conn->close();