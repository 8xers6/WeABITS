<?php 
	include('../server/server.php');


     $barno=$_SESSION['bar_no'];
     
     
     
     
     
     

       $comtype= $conn->real_escape_string($_POST['comtype']);
       $restype= $conn->real_escape_string($_POST['restype']);
     
     	$blottertype= $conn->real_escape_string($_POST['blottertype']);
     	
     	
     	
     	   $location 	    = $conn->real_escape_string($_POST['location']);

    $dateincident           = $conn->real_escape_string($_POST['dateincident']);
	$timeincident 	        = $conn->real_escape_string($_POST['timeincident']);

    $datenotice           = $conn->real_escape_string($_POST['datenotice']);
	$timenotice 	        = $conn->real_escape_string($_POST['timenotice']);


    $status 	    = $conn->real_escape_string($_POST['status']);
    $details 	    = $conn->real_escape_string($_POST['details']);
    
    
    $orno 	        = $conn->real_escape_string($_POST['orno']);
    $amount 	    = $conn->real_escape_string($_POST['amount']);
    
    
    $blotterimg=$_FILES['blotterimg']['name'];
    $logbook=$_FILES['logbook']['name'];
    
    
    if(!is_dir("../assets/uploads/".$_SESSION['username']."/blotter")){
           
            mkdir("../assets/uploads/".$_SESSION['username']."/blotter", 07777);


        }
      
    $newNameA = date('dmYHis').str_replace("", "", $logbook);
    $newName = date('dmYHis').str_replace("", "", $blotterimg);
     	
     $target1 = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newNameA);
     $target = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newName);
     	if($blottertype=='Others'){
     	    $blotterother= $conn->real_escape_string($_POST['blotterother']);
     	  
     	    
     	    if($comtype=='Resident' && $restype=='Resident'){
     	        
     	           $comresid = $conn->real_escape_string($_POST['comresid']);
     	           $resresid= $conn->real_escape_string($_POST['resresid']);
     	           
     	          $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `respondent` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) VALUES ('$barno','$orno','$comresid','$resresid','$blotterother','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')
     	           ";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	           
     	   
     	        
     	        
     	        
     	    }
     	    
     	    if($comtype=='Non-resident' && $restype=='Non-resident'){
     	        
     	         $comfname    = $conn->real_escape_string($_POST['comfirstname']);
     	         $commname    = $conn->real_escape_string($_POST['commiddlename']);
     	         $comlname    = $conn->real_escape_string($_POST['comlastname']);
     	         $comsuffix    = $conn->real_escape_string($_POST['comsuffix']);
     	        
     	          $complainant = new \stdClass();
                  $complainant->firstname = $comfname;
                  $complainant->middlename = $commname;
                  $complainant->lastname = $comlname;
                  $complainant->suffix = $comsuffix;
                                                                  
                                                                  
                $complainant_json = json_encode($complainant);
                
                
                
                 $resfname    = $conn->real_escape_string($_POST['resfirstname']);
     	         $resmname    = $conn->real_escape_string($_POST['resmiddlename']);
     	         $reslname    = $conn->real_escape_string($_POST['reslastname']);
     	         $ressuffix    = $conn->real_escape_string($_POST['ressuffix']);
     	        
     	          $respondent = new \stdClass();
                  $respondent->firstname = $resfname;
                  $respondent->middlename = $resmname;
                  $respondent->lastname = $reslname;
                  $respondent->suffix = $ressuffix;
                                                                  
                                                                  
                $respondent_json = json_encode($respondent);
     	        
     	      
    $comage    = $conn->real_escape_string($_POST['comage']);
    $comaddress   = $conn->real_escape_string($_POST['comaddress']);
    $comcontact   = $conn->real_escape_string($_POST['comcontact']);


	
    $resage    = $conn->real_escape_string($_POST['resage']);
    $resaddress    = $conn->real_escape_string($_POST['resaddress']);
    $rescontact   = $conn->real_escape_string($_POST['rescontact']);
     	       
     	       
     	         $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `com_age`, `com_address`, `com_contact`, `respondent`, `respon_age`, `respon_address`, `respon_contact` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$complainant_json','$comage','$comaddress','$comcontact','$respondent_json', '$resage','$resaddress','$rescontact','$blotterother','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	    
     	        
     	        
     	        
     	        
     	    }
     	    
     	    
     	    if($comtype=='Non-resident' && $restype=='Resident'){
     	               $comfname    = $conn->real_escape_string($_POST['comfirstname']);
     	         $commname    = $conn->real_escape_string($_POST['commiddlename']);
     	         $comlname    = $conn->real_escape_string($_POST['comlastname']);
     	         $comsuffix    = $conn->real_escape_string($_POST['comsuffix']);
     	        
     	          $complainant = new \stdClass();
                  $complainant->firstname = $comfname;
                  $complainant->middlename = $commname;
                  $complainant->lastname = $comlname;
                  $complainant->suffix = $comsuffix;
                                                                  
                                                                  
                $complainant_json = json_encode($complainant);
                
                    $comage    = $conn->real_escape_string($_POST['comage']);
    $comaddress   = $conn->real_escape_string($_POST['comaddress']);
    $comcontact   = $conn->real_escape_string($_POST['comcontact']);

                
                 $resresid= $conn->real_escape_string($_POST['resresid']);
     	           
     	       
     	                 $insert  = "INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `com_age`, `com_address`, `com_contact`, `respondent`,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$complainant_json','$comage','$comaddress','$comcontact','$resresid','$blotterother','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	        
     	    }
     	    
     	    
     	    if($comtype=='Resident' && $restype=='Non-resident'){
     	        
     	        $comresid = $conn->real_escape_string($_POST['comresid']);
     	         
     	        
     	        
                 $resfname    = $conn->real_escape_string($_POST['resfirstname']);
     	         $resmname    = $conn->real_escape_string($_POST['resmiddlename']);
     	         $reslname    = $conn->real_escape_string($_POST['reslastname']);
     	         $ressuffix    = $conn->real_escape_string($_POST['ressuffix']);
     	        
     	          $respondent = new \stdClass();
                  $respondent->firstname = $resfname;
                  $respondent->middlename = $resmname;
                  $respondent->lastname = $reslname;
                  $respondent->suffix = $ressuffix;
                                                                  
                                                                  
                $respondent_json = json_encode($respondent);
                $resage    = $conn->real_escape_string($_POST['resage']);
    $resaddress    = $conn->real_escape_string($_POST['resaddress']);
    $rescontact   = $conn->real_escape_string($_POST['rescontact']);
    
    
     	         $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `respondent`, `respon_age`, `respon_address`, `respon_contact` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$comresid','$respondent_json', '$resage','$resaddress','$rescontact','$blotterother','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	    
    
    
          
                
     	        
     	    }
     	    
     	}else{
     	    
     	      if($comtype=='Resident' && $restype=='Resident'){
     	        
     	           $comresid = $conn->real_escape_string($_POST['comresid']);
     	           $resresid= $conn->real_escape_string($_POST['resresid']);
     	           
     	          $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `respondent` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) VALUES ('$barno','$orno','$comresid','$resresid','$blottertype','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')
     	           ";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	           
     	   
     	        
     	        
     	        
     	    }
     	    
     	    if($comtype=='Non-resident' && $restype=='Non-resident'){
     	        
     	         $comfname    = $conn->real_escape_string($_POST['comfirstname']);
     	         $commname    = $conn->real_escape_string($_POST['commiddlename']);
     	         $comlname    = $conn->real_escape_string($_POST['comlastname']);
     	         $comsuffix    = $conn->real_escape_string($_POST['comsuffix']);
     	        
     	          $complainant = new \stdClass();
                  $complainant->firstname = $comfname;
                  $complainant->middlename = $commname;
                  $complainant->lastname = $comlname;
                  $complainant->suffix = $comsuffix;
                                                                  
                                                                  
                $complainant_json = json_encode($complainant);
                
                
                
                 $resfname    = $conn->real_escape_string($_POST['resfirstname']);
     	         $resmname    = $conn->real_escape_string($_POST['resmiddlename']);
     	         $reslname    = $conn->real_escape_string($_POST['reslastname']);
     	         $ressuffix    = $conn->real_escape_string($_POST['ressuffix']);
     	        
     	          $respondent = new \stdClass();
                  $respondent->firstname = $resfname;
                  $respondent->middlename = $resmname;
                  $respondent->lastname = $reslname;
                  $respondent->suffix = $ressuffix;
                                                                  
                                                                  
                $respondent_json = json_encode($respondent);
     	        
     	      
    $comage    = $conn->real_escape_string($_POST['comage']);
    $comaddress   = $conn->real_escape_string($_POST['comaddress']);
    $comcontact   = $conn->real_escape_string($_POST['comcontact']);


	
    $resage    = $conn->real_escape_string($_POST['resage']);
    $resaddress    = $conn->real_escape_string($_POST['resaddress']);
    $rescontact   = $conn->real_escape_string($_POST['rescontact']);
     	       
     	       
     	         $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `com_age`, `com_address`, `com_contact`, `respondent`, `respon_age`, `respon_address`, `respon_contact` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$complainant_json','$comage','$comaddress','$comcontact','$respondent_json', '$resage','$resaddress','$rescontact','$blottertype','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	    
     	        
     	        
     	        
     	        
     	    }
     	    
     	    
     	    if($comtype=='Non-resident' && $restype=='Resident'){
     	               $comfname    = $conn->real_escape_string($_POST['comfirstname']);
     	         $commname    = $conn->real_escape_string($_POST['commiddlename']);
     	         $comlname    = $conn->real_escape_string($_POST['comlastname']);
     	         $comsuffix    = $conn->real_escape_string($_POST['comsuffix']);
     	        
     	          $complainant = new \stdClass();
                  $complainant->firstname = $comfname;
                  $complainant->middlename = $commname;
                  $complainant->lastname = $comlname;
                  $complainant->suffix = $comsuffix;
                                                                  
                                                                  
                $complainant_json = json_encode($complainant);
                
                    $comage    = $conn->real_escape_string($_POST['comage']);
    $comaddress   = $conn->real_escape_string($_POST['comaddress']);
    $comcontact   = $conn->real_escape_string($_POST['comcontact']);

                
                 $resresid= $conn->real_escape_string($_POST['resresid']);
     	           
     	       
     	                 $insert  = "INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `com_age`, `com_address`, `com_contact`, `respondent`,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$complainant_json','$comage','$comaddress','$comcontact','$resresid','$blottertype','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	        
     	    }
     	    
     	    
     	    if($comtype=='Resident' && $restype=='Non-resident'){
     	        
     	        $comresid = $conn->real_escape_string($_POST['comresid']);
     	         
     	        
     	        
                 $resfname    = $conn->real_escape_string($_POST['resfirstname']);
     	         $resmname    = $conn->real_escape_string($_POST['resmiddlename']);
     	         $reslname    = $conn->real_escape_string($_POST['reslastname']);
     	         $ressuffix    = $conn->real_escape_string($_POST['ressuffix']);
     	        
     	          $respondent = new \stdClass();
                  $respondent->firstname = $resfname;
                  $respondent->middlename = $resmname;
                  $respondent->lastname = $reslname;
                  $respondent->suffix = $ressuffix;
                                                                  
                                                                  
                $respondent_json = json_encode($respondent);
                $resage    = $conn->real_escape_string($_POST['resage']);
    $resaddress    = $conn->real_escape_string($_POST['resaddress']);
    $rescontact   = $conn->real_escape_string($_POST['rescontact']);
    
    
     	         $insert  = "        INSERT INTO `tblblotter`(`bar_no`, `or_no`, `complainant`, `respondent`, `respon_age`, `respon_address`, `respon_contact` ,`blotter_type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `department`, `log_image`, `blotter_image`, `amounts`, `complainant_type`, `respondent_type`) 
     	      VALUES ('$barno','$orno','$comresid','$respondent_json', '$resage','$resaddress','$rescontact','$blottertype','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','pno','$newNameA','$newName','$amount','$comtype','$restype')";
        $result  = $conn->query($insert);

        if($result === true){
            
       
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
              
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
     echo 'success';
                      
                  }
            
            
        }
     	    
    
    
          
                
     	        
     	    }
     	    
     	   
     	}
     	
     
     
     
     /*
	$complainant    = $conn->real_escape_string($_POST['complainant']);
    $comage    = $conn->real_escape_string($_POST['comage']);
    $comaddress   = $conn->real_escape_string($_POST['comaddress']);
    $comcontact   = $conn->real_escape_string($_POST['comcontact']);


	$respondent 	= $conn->real_escape_string($_POST['respondent']);
    $respondentage    = $conn->real_escape_string($_POST['respondentage']);
    $resaddress    = $conn->real_escape_string($_POST['resaddress']);

	$type 	        = $conn->real_escape_string($_POST['type']);
    $location 	    = $conn->real_escape_string($_POST['location']);

    $dateincident           = $conn->real_escape_string($_POST['dateincident']);
	$timeincident 	        = $conn->real_escape_string($_POST['timeincident']);

    $datenotice           = $conn->real_escape_string($_POST['datenotice']);
	$timenotice 	        = $conn->real_escape_string($_POST['timenotice']);


    $status 	    = $conn->real_escape_string($_POST['status']);
    $details 	    = $conn->real_escape_string($_POST['details']);
    
    
    	$orno 	        = $conn->real_escape_string($_POST['orno']);
    $amount 	    = $conn->real_escape_string($_POST['amount']);
    
    
    $blotterimg=$_FILES['blotterimg']['name'];
    $logbook=$_FILES['logbook']['name'];
    
    
 
                                                           
        if(!is_dir("../assets/uploads/".$_SESSION['username']."/blotter")){
           
            mkdir("../assets/uploads/".$_SESSION['username']."/blotter", 07777);


        }
      
         $newNameA = date('dmYHis').str_replace("", "", $logbook);
    $newName = date('dmYHis').str_replace("", "", $blotterimg);
  
        
        
          $target1 = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newNameA);
     $target = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newName);


    if(!empty($complainant) && !empty($respondent)&& !empty($type) && !empty($location)&& !empty($status) && !empty($details)){

        $insert  = "INSERT INTO `tblblotter`(`bar_no`, `complainant`, `com_age`, `com_address`, `com_contact`, `respondent`, `respon_age`, `respon_address`, `type`, `location`, `date_incident`, `time_incident`, `date_notice`, `time_notice`, `details`, `status`, `log_image`, `blotter_image`,`amounts`,`or_no`) 
        VALUES ($barno,'$complainant',$comage,'$comaddress','$comcontact','$respondent','$respondentage','$resaddress','$type','$location','$dateincident','$timeincident','$datenotice','$timenotice','$details','$status','$newNameA','$newName','$amount','$orno')";
        $result  = $conn->query($insert);

        if($result === true){
            
            
            if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 
  

            }
            
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
               $_SESSION['message'] = 'Blotter added!';
               $_SESSION['success'] = 'success';
               
               
               			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                      
                  }
         

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../blotter.php");

	$conn->close();
	
	
	
	
	
	/*