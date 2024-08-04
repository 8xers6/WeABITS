<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $id 	= $conn->real_escape_string($_POST['docid']);
    $fname 	= $conn->real_escape_string($_POST['fname']);
      $mname 	= $conn->real_escape_string($_POST['mname']);
        $lname 	= $conn->real_escape_string($_POST['lname']);
          $suffix 	= $conn->real_escape_string($_POST['suffix']);
	$specialty	= $conn->real_escape_string($_POST['specialty']);

    $timeavail	= $conn->real_escape_string($_POST['time']);
    $about	= $conn->real_escape_string($_POST['about']);

    $image  = $_FILES['images']['name'];

    if(!is_dir("../assets/uploads/".$_SESSION['username']."/doctor")){
        mkdir("../assets/uploads/".$_SESSION['username']."/doctor", 07777);

    }


    if(!empty($id)){



        $insert  = "UPDATE `tbldoctors` SET `firstname`='$fname' ,`middlename`='$mname',`lastname`='$lname',`suffix`='$suffix',`specialization`='$specialty',`timeavailable`='$timeavail',`aboutdoc`='$about'  WHERE `doc_id`=$id";
        $result  = $conn->query($insert);

        if($result === true){

            
            $_SESSION['message'] = 'Doctor has been Updated!';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Doctor')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Doctor')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = ' Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }


    if(!empty($image) ){

        $newName = date('dmYHis').str_replace("", "", $image);
                                                           
    
      
        $target = "../assets/uploads/".$_SESSION['username']."/doctor/".basename($newName);



        $insert  = "UPDATE `tbldoctors` SET `image`='$newName' WHERE `doc_id`=$id";
        $result  = $conn->query($insert);

        if($result === true){
            if(move_uploaded_file($_FILES['images']['tmp_name'], $target)){
                $_SESSION['message'] = 'Doctor Has been Updated!';
                $_SESSION['success'] = 'success';
                
                
                			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Doctor')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Doctor')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
                }

        }else{
            $_SESSION['message'] = ' Error!';
            $_SESSION['success'] = 'danger';
        }
    }

    header("Location: ../doctors");

	$conn->close();