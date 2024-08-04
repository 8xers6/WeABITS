<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
	$sresid 	    = $conn->real_escape_string($_POST['resid']);
	$schoolyear 	= $conn->real_escape_string($_POST['sy']);
  



    if(!empty($sresid) && !empty($schoolyear) ){
        
        
        
            $check = "SELECT * FROM tbldaycare WHERE res_id=$sresid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
           $_SESSION['message'] = 'Student Already Added!';
            $_SESSION['success'] = 'danger';
                
                
            }else{
                
                   $insert  = "INSERT INTO tbldaycare (`bar_no`,`res_id`,`schoolyear`) VALUES ($barno,'$sresid', '$schoolyear')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Student added!';
            $_SESSION['success'] = 'success';
            
            	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Student')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Student')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

                
            }

     
    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../daycare.php");

	$conn->close();