<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
      

    
	
    $resid 	    = $conn->real_escape_string($_POST['resid']);

    if(!empty($resid)){

        $query 		= "UPDATE tbl_residents SET `blocklisted` ='Blocklisted' WHERE res_id=$resid;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Successfully Added';
            $_SESSION['success'] = 'success';
            
            
            	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Blocklisted')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Blocklisted')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    } else{

        $_SESSION['message'] = 'No ID Found';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../blocklisted.php");

	$conn->close();


    ?>