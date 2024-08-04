<?php 
	include '../server/server.php';


    $id 	= $conn->real_escape_string($_POST['id']);
	
	//$barno=$_SESSION['bar_no'];



	$type 	        = $conn->real_escape_string($_POST['type']);
    $location 	    = $conn->real_escape_string($_POST['location']);

    $dateincident           = $conn->real_escape_string($_POST['dateincident']);
	$timeincident 	        = $conn->real_escape_string($_POST['timeincident']);

    $datenotice           = $conn->real_escape_string($_POST['datenotice']);
	$timenotice 	        = $conn->real_escape_string($_POST['timenotice']);


    $status 	    = $conn->real_escape_string($_POST['status']);
    
     $orno 	    = $conn->real_escape_string($_POST['orno']);
        $amount 	    = $conn->real_escape_string($_POST['amount']);
    $details 	    = $conn->real_escape_string($_POST['details']);
    
    
      $blotterimg=$_FILES['blotterimg']['name'];
    $logbook=$_FILES['logbook']['name'];
    
    
 
                                                           
        if(!is_dir("../assets/uploads/".$_SESSION['username']."/blotter")){
           
            mkdir("../assets/uploads/".$_SESSION['username']."/blotter", 07777);


        }
      
         $newNameA = date('dmYHis').str_replace("", "", $logbook);
    $newName = date('dmYHis').str_replace("", "", $blotterimg);
  
        
        
          $target1 = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newNameA);
     $target = "../assets/uploads/".$_SESSION['username']."/blotter/".basename($newName);


	if(!empty($id)){

		$query 		= "UPDATE `tblblotter` SET `blotter_type`='$type',`location`='$location',`date_incident`='$dateincident',`time_incident`='$timeincident',`date_notice`='$datenotice',`time_notice`='$timenotice',`details`='$details',`status`='$status' WHERE `id`=$id";	
		$result 	= $conn->query($query);

		if($result === true){
            
			$_SESSION['message'] = 'Blotter details has been updated!';
			$_SESSION['success'] = 'success';

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'No Blotter ID found!';
		$_SESSION['success'] = 'danger';
	}


     if(!empty($blotterimg) && !empty($id)){
         
         
         	$query 		= "UPDATE `tblblotter` SET `blotter_image`='$newName'  WHERE `id`=$id";	
		$result 	= $conn->query($query);

		if($result === true){
            
             if(move_uploaded_file($_FILES['blotterimg']['tmp_name'], $target)){
                 	$_SESSION['message'] = 'Blotter details has been updated!';
			$_SESSION['success'] = 'success';
                
                
                $barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

            }
            
		

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}
         
         
         
         
     }
     
     
      if(!empty($id)){
         
         
         	$query 		= "UPDATE `tblblotter` SET `amounts`='$amount', `or_no`='$orno'   WHERE `id`=$id";	
		$result 	= $conn->query($query);

		if($result === true){
            
           	$_SESSION['message'] = 'Blotter details has been updated!';
			$_SESSION['success'] = 'success';
			
			
			
			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            
		

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}
         
         
         
         
     }
     
     
     if(!empty($logbook) && !empty($id)){
         
         	$query 		= "UPDATE `tblblotter` SET `log_image`='$newNameA'  WHERE `id`=$id";	
		$result 	= $conn->query($query);

		if($result === true){
		    
		    
		     
            
             if(move_uploaded_file($_FILES['logbook']['tmp_name'], $target1)){
        
        
              	$_SESSION['message'] = 'Blotter details has been updated!';
			$_SESSION['success'] = 'success';
			
			
					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated BLotter')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
			
			
                      
                  }
            
		

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}
         
         
         
         
         
     }	
	
	
	if($_POST['pno']=='pno'){
	    echo 'success';
	    
	}else{
	    echo 'success';
	    
	}



	$conn->close();