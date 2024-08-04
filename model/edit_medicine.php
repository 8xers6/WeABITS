<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
    $medno 	= $conn->real_escape_string($_POST['medno']);
    $medicine 	= $conn->real_escape_string($_POST['medicine']);
    $quantity	= $conn->real_escape_string($_POST['qty']);
    $stocks 	= $conn->real_escape_string($_POST['stocks']);



    if(!empty($barno) && !empty($medicine)){

        $insert  = "UPDATE `tblmedicine` SET  `med_name`='$medicine',`med_qty`='$quantity',`med_stocks`='$stocks' WHERE  `med_no`='$medno'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Medicine Updated!';
            $_SESSION['success'] = 'success';
            
            
            							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../medicine.php");

	$conn->close();