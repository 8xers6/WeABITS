<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }


  
    
	$name 	= $conn->real_escape_string($_POST['name']);
	$chair 	= $conn->real_escape_string($_POST['chair']);
    $pos 	= $conn->real_escape_string($_POST['position']);
	$start 	= $conn->real_escape_string($_POST['start']);
    $end 	= $conn->real_escape_string($_POST['end']);
	$status 	= $conn->real_escape_string($_POST['status']);
    $profile   = $_FILES['img']['name'];



    $barno=$_SESSION['bar_no'];
    $brgyname=$_SESSION['brgyname'];

    // change profile2 name
    $newName = date('dmYHis').str_replace(" ", "", $profile);

    

      // image file directory
    $target = "../assets/uploads/".$_SESSION['username']."/official"."/".basename($newName);




    if(!empty($name) && !empty($chair) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)&& !empty($profile)){

        $query  = "INSERT INTO tblofficials (`name`, `chairmanship`, `position`, termstart, termend, `status`,`picture`,`bar_no`) VALUES ('$name', '$chair','$pos', '$start','$end', '$status','$newName',$barno)";
        if($conn->query($query) === true){

                  
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';

            if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

               
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';
            
            
              if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Official')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            }
        }

    }elseif(!empty($name) && empty($chair) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)&& !empty($profile)){

        $query  = "INSERT INTO tblofficials (`name`, `position`, termstart, termend, `status`,`picture`,`bar_no`) VALUES ('$name','$pos', '$start','$end', '$status','$newName',$barno)";
        if($conn->query($query) === true){

                  
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';

            if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

               
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';
            
            
                    if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Official')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            }
        }

    }
    
    
    
    
    else{


        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    }

    header("Location: ../official.php");

	$conn->close();