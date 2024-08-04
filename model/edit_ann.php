<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    $id 	= $conn->real_escape_string($_POST['id']);
	
	$actname 	= $conn->real_escape_string($_POST['activityname']);
  
    $description     = $conn->real_escape_string($_POST['description']);
    $dateofactivity  = $conn->real_escape_string($_POST['dateofactivity']);
    $place  = $conn->real_escape_string($_POST['placeofactivity']);
    $organizer  = $conn->real_escape_string($_POST['organizer']);
    $status  = $conn->real_escape_string($_POST['status']);
   
	
	$profile2 	= $_FILES['img']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);
	$brgyname= $_SESSION['brgyname'];

	if(!is_dir("../assets/uploads/".$_SESSION['username']."/announcement")){
		mkdir("../assets/uploads/".$_SESSION['username']."/announcement", 07777);
	}

    $target= "../assets/uploads/".$_SESSION['username']."/announcement"."/".basename($newName);

          




             if(!empty($profile2)){

             $query = "UPDATE tblannouncement SET `activityname`='$actname',`description`='$description',dateofactivity='$dateofactivity',`placeofactivity`='$place',`organizername`='$organizer',`picture`='$newName',`status`='$status' WHERE id='$id';";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Announcement Information has been updated!!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

						$_SESSION['message'] = 'Announcement Information  has been updated!!';
						$_SESSION['success'] = 'success';
						
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
					}
				}

			}else{
              
                $query = "UPDATE tblannouncement SET activityname='$actname',`description`='$description',dateofactivity='$dateofactivity',placeofactivity='$place',organizername='$organizer',`status`='$status' WHERE id='$id';";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Announcement  Information has been updated!';
					$_SESSION['success'] = 'success';
					
						$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}
			}

    header("Location: ../announcement.php");

	$conn->close();

