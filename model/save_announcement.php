<?php 
    include '../server/server.php';

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

        
   $barno=$_SESSION['bar_no'];

    $actname   = $conn->real_escape_string($_POST['activityname']);
  
    $description     = $conn->real_escape_string($_POST['description']);
    $dateofactivity  = $conn->real_escape_string($_POST['dateofactivity']);
    $place  = $conn->real_escape_string($_POST['placeofactivity']);
    $organizer  = $conn->real_escape_string($_POST['organizer']);
    $status  = $conn->real_escape_string($_POST['status']);


    $profile    = $conn->real_escape_string($_POST['profileimg']); // base 64 image
    $profile2   = $_FILES['img']['name'];

    // change profile2 name
    $newName = date('dmYHis').str_replace(" ", "", $profile2);

      // image file directory
  
   

   $brgyname= $_SESSION['brgyname'];

	if(!is_dir("../assets/uploads/".$_SESSION['username']."/announcement")){
		mkdir("../assets/uploads/".$_SESSION['username']."/announcement", 07777);
	}

    $target= "../assets/uploads/".$_SESSION['username']."/announcement"."/".basename($newName);
   

            if(!empty($profile) && !empty($profile2)){

                $query = "INSERT INTO tblannouncement (`bar_no`,`activityname`,`description`,`dateofactivity`,`placeofactivity`,`organizername`,`picture`,`status`) 
                            VALUES ($barno,'$actname','$description','$dateofactivity','$place','$organizer','$profile','$status')";

                if($conn->query($query) === true){

                    $_SESSION['message'] = 'Announcement Information has been saved!';
                    $_SESSION['success'] = 'success';
                    
                    
                    	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                }else{
                    $_SESSION['message'] = 'Please Attach Image!';
                    $_SESSION['success'] = 'danger';
                }
            }else if(!empty($profile) && empty($profile2)){

                $query = "INSERT INTO tblannouncement (`bar_no`,`activityname`,`description`,`dateofactivity`,`placeofactivity`,`organizername`,`picture`,`status`) 
                VALUES (,$barno'$actname','$description','$dateofactivity','$place','$organizer','$profile','$status')";
                if($conn->query($query) === true){

              
                    $_SESSION['message'] = 'Announcement Information has been saved!';
                    $_SESSION['success'] = 'success';
                    
                    	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                }else{
                    $_SESSION['message'] = 'Please Attach Image!';
                    $_SESSION['success'] = 'danger';
                }

            }else if(empty($profile) && !empty($profile2)){

              
                $query = "INSERT INTO tblannouncement (`bar_no`,`activityname`,`description`,`dateofactivity`,`placeofactivity`,`organizername`,`picture`,`status`) 
                VALUES ($barno,'$actname','$description','$dateofactivity','$place','$organizer','$newName','$status')";
                if($conn->query($query) === true){

                  
                    $_SESSION['message'] = 'Announcement Information has been saved!';
                    $_SESSION['success'] = 'success';

                    if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

                       
                    $_SESSION['message'] = 'Announcement Information has been saved!';
                    $_SESSION['success'] = 'success';
                    
                    	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                    }
                }else{

                    $_SESSION['message'] = 'Please Attach Image!';
                    $_SESSION['success'] = 'danger';
                }

            }else{
                
                
                $query = "INSERT INTO tblannouncement (`activityname`,`description`,`dateofactivity`,`placeofactivity`,`organizername`,`picture`,`status`) 
                            VALUES ($barno,'$actname','$description','$dateofactivity','$place','$organizer','blank.png','$status')";

                if($conn->query($query) === true){

                  
                    $_SESSION['message'] = 'Announcement Information has been saved!';
                    $_SESSION['success'] = 'success';
                    
                    	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Announcement')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                    
                    
                }else{

                    $_SESSION['message'] = 'Please Attach Image';
                    $_SESSION['success'] = 'danger';
                }
            }

    
   
     header("Location: ../announcement.php");

    $conn->close();

