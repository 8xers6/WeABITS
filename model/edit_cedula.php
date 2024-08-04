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
    $ctcid 	= $conn->real_escape_string($_POST['ctcid']);
	$resid 	= $conn->real_escape_string($_POST['resid']);
    $cedulaimage  = $_FILES['cedulaimage']['name'];
    $amount 	= $conn->real_escape_string($_POST['amount']);
    $date 	= $conn->real_escape_string($_POST['date']);
    
    
    
    
    
    
    
    
    
       if(!empty($ctcno) && !empty($ctcid) && !empty($amount)&&!empty($date)){




        $insert  = "UPDATE `tblcedula` SET `ctc_no`='$ctcno',`date_issued`='$date',`amount`='$amount' WHERE `ctc_id`=$ctcid";
        $result  = $conn->query($insert);

        if($result === true){

                          if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }
        

    }
    
          $_SESSION['message'] = 'Cedula updated!';
                $_SESSION['success'] = 'success';
    
            

        }else{
            $_SESSION['message'] = 'Cedula is Already exist!';
            $_SESSION['success'] = 'danger';
        }

    } 
    
    
    
    
    
    

    if(!empty($cedulaimage)){

        $newName = date('dmYHis').str_replace("", "", $cedulaimage);
                                                           
        if(!is_dir("../assets/uploads/".$username."/cedula")){
           
            mkdir("../assets/uploads/".$username."/cedula", 07777);


        }
      
        $target = "../assets/uploads/".$username."/cedula/".basename($newName);

        $insert  = "UPDATE `tblcedula` SET `cedula_image`='$newName' WHERE `ctc_id`=$ctcid";
        $result  = $conn->query($insert);

        if($result === true){

            if(move_uploaded_file($_FILES['cedulaimage']['tmp_name'], $target)){
                $_SESSION['message'] = 'Cedula updated!';
                $_SESSION['success'] = 'success';
                
                
                
                   if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Cedula')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
                }
            

        }else{
            $_SESSION['message'] = 'Cedula is Already exist!';
            $_SESSION['success'] = 'danger';
        }

    } 
   

    header("Location: ../cedula");

	$conn->close();