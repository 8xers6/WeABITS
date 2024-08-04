<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $username=$_SESSION['username'];
    $idno 	= $conn->real_escape_string($_POST['idno']);
	$res_id 	= $conn->real_escape_string($_POST['resid']);
		$orno 	= $conn->real_escape_string($_POST['orno']);
  $amount 	= $conn->real_escape_string($_POST['amount']);

    $date 	= $conn->real_escape_string($_POST['dateissue']);

    $respic   = $_FILES['respic']['name'];

    

    if(!empty($res_id)&&!empty($idno) && !empty($date) && !empty($respic)){


        $newName = date('dmYHis').str_replace("", "", $respic);
                                                           
        if(!is_dir("../assets/uploads/".$username."/resident/".$res_id)){
           
            mkdir("../assets/uploads/".$username."/resident/".$res_id, 07777);


        }
      
        $target = "../assets/uploads/".$username."/resident/".$res_id.'/'.basename($newName);

        $insert  = "UPDATE `tblbarangayid` SET `id_picture`='$newName',`date_issued`='$date',`amounts`='$amount',`or_no`=$orno WHERE `id_no`='$idno'";
        $result  = $conn->query($insert);

        if($result === true){
         
            if(move_uploaded_file($_FILES['respic']['tmp_name'], $target)){

               
                $_SESSION['message'] = 'Barangay ID has been Updated!';
                $_SESSION['success'] = 'success';
                
                			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay ID')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay ID')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
         
                
            }

           

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else if(!empty($res_id)&&!empty($idno) && !empty($date) && empty($respic)){


  

        $insert  = "UPDATE `tblbarangayid` SET `date_issued`='$date',`amounts`='$amount',`or_no`=$orno WHERE `id_no`='$idno'";
        $result  = $conn->query($insert);

        if($result === true){
         
       
               
                $_SESSION['message'] = 'Barangay ID has been Updated!';
                $_SESSION['success'] = 'success';
                
         			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay ID')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay ID')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                
            

           

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }
    else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../listbrgyid");

	$conn->close();


    ?>