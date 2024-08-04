<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $studno 	= $conn->real_escape_string($_POST['studno']);
    
	$schoolyear 	= $conn->real_escape_string($_POST['sy']);

    

    if(!empty($studno)&&!empty($schoolyear)){

        $query 		= "UPDATE tbldaycare SET `schoolyear` = '$schoolyear' WHERE  stud_no=$studno;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Student info has been updated!';
            $_SESSION['success'] = 'success';
            
            
            	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Student')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Student')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Student info not Updated!';
        $_SESSION['success'] = 'danger';

    }

    header("Location: ../daycare.php");

	$conn->close();