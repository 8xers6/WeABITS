<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $resid	= $conn->real_escape_string($_POST['res_id']);
 
 

    if(!empty($resid)){
        
          $query  = "SELECT*FROM tblchildren WHERE res_id=$resid";
        $result  = $conn->query($query);

        if($result->num_rows){
            
                      $_SESSION['message'] = 'New Born is Already added';
        $_SESSION['success'] = 'danger';
            
            
        }else{
            
                $insert  = "INSERT INTO `tblchildren`( `res_id`) VALUES ($resid)";
        $result1  = $conn->query($insert);

        if($result1 === true){
            $_SESSION['message'] = 'NewBorn added!';
            $_SESSION['success'] = 'success';
            
            
            
            					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username',' Add Newborn')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username',' Add Newborn')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }
            
         
            
        }
         
 
 
 
    

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../newborn");

	$conn->close();