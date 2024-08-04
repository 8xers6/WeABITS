<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $username=$_SESSION['username'];

		$resid 	= $conn->real_escape_string($_POST['resid']);
	
	
	
	
	
	
	   
	
	if($_POST['state']=="Barangay Clearance"){
	    
	    
	    	$reqno	= $conn->real_escape_string($_POST['reqno']);
	    	$orno	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
    $purpose 	= $conn->real_escape_string($_POST['purpose']);
      $amount 	= $conn->real_escape_string($_POST['amount']);

    $respic   = $_FILES['respic']['name'];
    
    
    
    $sql2="SELECT * FROM `tbl_barangayclearance` WHERE `req_no`=$reqno";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
  
   $_SESSION['message'] = 'Barangay Clearance is already created!';
                $_SESSION['success'] = 'success';
  header("Location: ../generate_brgy_certs.php?id=$resid&reqno=$reqno");
   

}else{


    if(!empty($resid) && !empty($orno) && !empty($ctcno) && !empty($purpose)){


        $newName = date('dmYHis').str_replace("", "", $respic);
                                                           
        if(!is_dir("../assets/uploads/".$username."/resident/".$resid)){
           
            mkdir("../assets/uploads/".$username."/resident/".$resid, 07777);


        }
      
        $target = "../assets/uploads/".$username."/resident/".$resid.'/'.basename($newName);

        $insert  = "INSERT INTO tbl_barangayclearance (`or_no`,`ctc_no`,`res_id`,`req_no`,`purpose`,`amounts`,`resident_image`) VALUES ('$orno','$ctcno','$resid','$reqno', '$purpose','$amount','$newName')";
        $result  = $conn->query($insert);

        if($result === true){
         
            if(move_uploaded_file($_FILES['respic']['tmp_name'], $target)){

               
                $_SESSION['message'] = 'Barangay Clearance has been created!';
                $_SESSION['success'] = 'success';
                
                
                
                			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
            
            
            
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Barangay Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             
 
        }

    }
    
    
    
    	$query="UPDATE `tblrequested_documents` SET `status`='released' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){


        $document=$_POST['state'];
$barno=$_SESSION['bar_no'];
					$notifname=$document;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request has been updated to Released';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$resid','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);




                   
				}
 
              
                    
                 header("Location: ../generate_brgy_certs.php?id=$resid&reqno=$reqno");
                 
        
    
     
                
         
                
            }

           

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

}

	    
	}elseif($_POST['state']=="Certificate of Indigency"){
	    

		    
		    
		    	$reqno	= $conn->real_escape_string($_POST['reqno']);
		    
		     $purpose 	= $conn->real_escape_string($_POST['purpose']);

   

    if(!empty($resid) &&  !empty($purpose)){

        $insert  = "INSERT INTO `tbl_indigency`(`res_id`,`req_no`, `purpose`) 
        VALUES ('$resid','$reqno','$purpose')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Certificate of Indigency has been created!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Certificate of Indigency')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Certificate of Indigency')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }
        
         
        
        

    }
    
    	$query="UPDATE `tblrequested_documents` SET `status`='released' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){


        $document=$_POST['state'];
$barno=$_SESSION['bar_no'];
					$notifname=$document;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request has been updated to Released';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$resid','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);




                   
				}
    
     header("Location: ../generate_indigency_cert.php?id=$resid&reqno=$reqno");

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }
		    
		    
		    
		    
		    
		}elseif($_POST['state']=="Building Clearance"){
	    

		    
		    
		    	$reqno	= $conn->real_escape_string($_POST['reqno']);
		    
		     $purpose 	= $conn->real_escape_string($_POST['purpose']);

   

    $orno 	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
    
        $amount 	= $conn->real_escape_string($_POST['amount']);
  
	$bhouseno	= $conn->real_escape_string($_POST['bhouseno']);
    $bstreet 	= $conn->real_escape_string($_POST['bstreet']);
    $applied 	= $conn->real_escape_string($_POST['applied']);

    if(!empty($resid) && !empty($bhouseno) && !empty($bstreet) && !empty($applied)){

        $insert  = "INSERT INTO tblbuilding_permit (`or_no`, `ctc_no`,`res_id`,`req_no`,`bhouseno`,`bstreet`,`applied`,`amounts`) VALUES ('$orno', '$ctcno','$resid','$reqno', '$bhouseno', '$bstreet','$applied','$amount')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Building Permit added!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Building Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Building Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
    	$query="UPDATE `tblrequested_documents` SET `status`='released' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){


        $document=$_POST['state'];
$barno=$_SESSION['bar_no'];
					$notifname=$document;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request has been updated to Released';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$resid','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);




                   
				}
    
    
    header("Location: ../generate_buildingpermit.php?id=$resid&reqno=$reqno");

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }
		    
		    
		    
		    
		    
		}elseif($_POST['state']=="Business Clearance"){
		    
		    
		    
		     $orno 	= $conn->real_escape_string($_POST['orno']);
    $ctcno 	= $conn->real_escape_string($_POST['ctcno']);
	$bname 	    = $conn->real_escape_string($_POST['bname']);
$reqno	= $conn->real_escape_string($_POST['reqno']);

    $natureBO	= $conn->real_escape_string($_POST['natureBO']); 
    $dtino 	= $conn->real_escape_string($_POST['dtino']); 
	$nature 	= $conn->real_escape_string($_POST['nature']);
    $bstreet 	= $conn->real_escape_string($_POST['bstreet']);

    $bcontact 	= $conn->real_escape_string($_POST['bcontact']);
    
    
       $amount 	= $conn->real_escape_string($_POST['amount']);
    
    
    $applied = date("Y-m-d");
$expired = date('Y-m-d', strtotime($applied. ' + 1 year'));
    
    
    

    if(!empty($bname) && !empty($resid) && !empty($nature) && !empty($applied)&& !empty($bstreet)){

        $insert  = "INSERT INTO `tblbusinesspermit` (`or_no`, `ctc_no`, `businessname`, `res_id`,`req_no`, `nature`, `bstreet`, `bcontact_no`, `applied`, `expired_date`, `nature_of_business_ownership`, `dti_registration_no`,`amounts`) 
         
         VALUES ('$orno', '$ctcno', '$bname', '$resid','$reqno', '$nature', '$bstreet', '$bcontact', '$applied', '$expired','$natureBO','$dtino',$amount)";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Business Clearance has been Created!';
            $_SESSION['success'] = 'success';
            
            
            		$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Business Clearance')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    	$query="UPDATE `tblrequested_documents` SET `status`='released' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){


        $document=$_POST['state'];
$barno=$_SESSION['bar_no'];
					$notifname=$document;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request has been updated to Released';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$resid','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);




                   
				}
    
    header("Location: ../generate_business_permit.php?id=$resid&reqno=$reqno");

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

    }
		    
		    
		    
		}
  

	$conn->close();


    ?>