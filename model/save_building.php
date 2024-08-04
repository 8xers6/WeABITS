<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    

	$res_id 	= $conn->real_escape_string($_POST['resid']);
    $orno 	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
    
        $amount 	= $conn->real_escape_string($_POST['amount']);
  
	$bhouseno	= $conn->real_escape_string($_POST['bhouseno']);
    $bstreet 	= $conn->real_escape_string($_POST['bstreet']);
    $applied 	= $conn->real_escape_string($_POST['applied']);

    if(!empty($res_id) && !empty($bhouseno) && !empty($bstreet) && !empty($applied)){

        $insert  = "INSERT INTO tblbuilding_permit (`or_no`, `ctc_no`,`res_id`,`bhouseno`,`bstreet`, `applied`,`amounts`) VALUES ('$orno', '$ctcno','$res_id', '$bhouseno', '$bstreet','$applied','$amount')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Building Permit added!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Building Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Building Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../building_permit.php");

	$conn->close();