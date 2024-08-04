<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $username=$_SESSION['username'];
	$controlno 	= $conn->real_escape_string($_POST['controlno']);
    $orno	= $conn->real_escape_string($_POST['orno']);

    $res_id	= $conn->real_escape_string($_POST['resid']);

    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
    $purpose 	= $conn->real_escape_string($_POST['purpose']);
    
      $amount 	= $conn->real_escape_string($_POST['amount']);
    $date 	= $conn->real_escape_string($_POST['date']);
    $respic   = $_FILES['respic']['name'];

    if(!empty($controlno) && !empty($orno) && !empty($ctcno) && !empty($purpose)&& !empty($respic)){


        $newName = date('dmYHis').str_replace("", "", $respic);
                                                           
        if(!is_dir("../assets/uploads/".$username."/resident/".$res_id)){
           
            mkdir("../assets/uploads/".$username."/resident/".$res_id, 07777);


        }
        $target = "../assets/uploads/".$username."/resident/".$res_id.'/'.basename($newName);

        $update  = "UPDATE `tbl_barangayclearance` SET `or_no`=$orno,`purpose`='$purpose',`ctc_no`='$ctcno',`date_issued`='$date',`resident_image`='$newName',`amounts`=$amount  WHERE `bclearance_no`=$controlno";
        $result  = $conn->query($update);

        if($result === true){


            if(move_uploaded_file($_FILES['respic']['tmp_name'], $target)){

               
                $_SESSION['message'] = 'Barangay Clearance has been Updated!';
                $_SESSION['success'] = 'success';
                
                
                		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                
         
                
            }
          

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else if(!empty($controlno) && empty($orno) && !empty($ctcno) && !empty($purpose)&& empty($respic)){



        $update  = "UPDATE `tbl_barangayclearance` SET `purpose`='$purpose',`ctc_no`='$ctcno',`date_issued`='$date',`amounts`=$amount  WHERE `bclearance_no`=$controlno";
        $result  = $conn->query($update);

        if($result === true){

            $_SESSION['message'] = 'Barangay Clearance has been Updated!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
       
          

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else if(!empty($controlno) && !empty($orno) && !empty($ctcno) && !empty($purpose)&& empty($respic)){


      

        $update  = "UPDATE `tbl_barangayclearance` SET `or_no`=$orno,`purpose`='$purpose',`ctc_no`='$ctcno',`date_issued`='$date',`amounts`=$amount  WHERE `bclearance_no`=$controlno";
        $result  = $conn->query($update);

        if($result === true){

 
                $_SESSION['message'] = 'Barangay Clearance has been Updated!';
                $_SESSION['success'] = 'success';
                
                
                		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                
         
                
            
          

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else if(!empty($controlno) && empty($orno) && !empty($ctcno) && !empty($purpose)&& !empty($respic)){


        $newName = date('dmYHis').str_replace("", "", $respic);
                                                           
        if(!is_dir("../assets/uploads/".$username."/resident/".$res_id)){
           
            mkdir("../assets/uploads/".$username."/resident/".$res_id, 07777);


        }
        $target = "../assets/uploads/".$username."/resident/".$res_id.'/'.basename($newName);

        $update  = "UPDATE `tbl_barangayclearance` SET `purpose`='$purpose',`ctc_no`='$ctcno',`date_issued`='$date',`resident_image`='$newName',`amounts`=$amount  WHERE `bclearance_no`=$controlno";
        $result  = $conn->query($update);

        if($result === true){


            if(move_uploaded_file($_FILES['respic']['tmp_name'], $target)){

               
                $_SESSION['message'] = 'Barangay Clearance has been Updated!';
                $_SESSION['success'] = 'success';
                
                
                
                		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

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

    header("Location: ../residents_certification.php");

	$conn->close();