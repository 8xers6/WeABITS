<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$pregno 	= $conn->real_escape_string($_POST['pregno']);
	$mop	= $conn->real_escape_string($_POST['mop']);
    $noc 	= $conn->real_escape_string($_POST['noc']);

	if(!empty($pregno)){

		$query 		= "UPDATE tblpregnant SET `months_pregnant` = '$mop', `no_of_children`='$noc' WHERE preg_no=$pregno;";	
		$result 	= $conn->query($query);

		if($result === true){
            
			$_SESSION['message'] = 'Pregnant info has been updated!';
			$_SESSION['success'] = 'success';
			
			
			
						$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Pregnant')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Pregnant')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

		}else{
			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'No position ID found!';
		$_SESSION['success'] = 'danger';
	}

    header("Location: ../pregnant.php");

	$conn->close();