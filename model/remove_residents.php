<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id 	= $conn->real_escape_string($_GET['id']);

	if($id != ''){
		$query 		= "DELETE FROM tbl_residents WHERE res_id = '$id'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Resident has been removed!';
            $_SESSION['success'] = 'danger';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Remove Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing Resident ID!';
		$_SESSION['success'] = 'danger';
	}

 if(!empty($_GET['member'])){
				$hno     = $conn->real_escape_string($_GET['hno']);
				header("Location: ../view_householdmembers.php?id=$hno");
			 }else{


				header("Location: ../residents.php");
			 }
	$conn->close();

