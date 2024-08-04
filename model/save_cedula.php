<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
  
    $username=$_SESSION['username'];
    $barno=$_SESSION['bar_no'];
	$ctcno 	= $conn->real_escape_string($_POST['ctcno']);
	$resid 	= $conn->real_escape_string($_POST['resid']);

    $cedulaimage  = $_FILES['cedulaimage']['name'];
    $amount 	= $conn->real_escape_string($_POST['amount']);
    $date 	= $conn->real_escape_string($_POST['date']);

    if(!empty($ctcno) && !empty($resid)&& !empty($amount)&&!empty($date)){


        $newName = date('dmYHis').str_replace("", "", $cedulaimage);
                                                           
        if(!is_dir("../assets/uploads/".$username."/cedula")){
           
            mkdir("../assets/uploads/".$username."/cedula", 07777);


        }
      
        $target = "../assets/uploads/".$username."/cedula/".basename($newName);

        $insert  = "INSERT INTO tblcedula (`res_id`,`ctc_no`,`amount`,`date_issued`,`cedula_image`) VALUES ('$resid','$ctcno','$amount','$date','$newName')";
        $result  = $conn->query($insert);

        if($result === true){

            if(move_uploaded_file($_FILES['cedulaimage']['tmp_name'], $target)){
            $_SESSION['message'] = 'Cedula added!';
            $_SESSION['success'] = 'success';
            
            
            
              if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

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

    header("Location: ../cedula");

	$conn->close();