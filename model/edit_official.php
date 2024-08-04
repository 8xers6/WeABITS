<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    $id 	= $conn->real_escape_string($_POST['id']);
	$name 	= $conn->real_escape_string($_POST['name']);
	$chair 	= $conn->real_escape_string($_POST['chair']);
    $pos 	= $conn->real_escape_string($_POST['position']);
	$start 	= $conn->real_escape_string($_POST['start']);
    $end 	= $conn->real_escape_string($_POST['end']);
	$status = $conn->real_escape_string($_POST['status']);

	$profile   = $_FILES['img']['name'];

    // change profile2 name
    $newName = date('dmYHis').str_replace(" ", "", $profile);

	$barno=$_SESSION['bar_no'];
    $brgyname=$_SESSION['brgyname'];


	$target = "../assets/uploads/".$_SESSION['username']."/official"."/".basename($newName);

	if(!empty($id) && !empty($profile) && !empty($chair)){

		$query 		= "UPDATE tblofficials SET `name`='$name', `chairmanship`='$chair', `position`='$pos', termstart='$start', termend='$end', `status`='$status',`picture`='$newName' WHERE id=$id;";	
	

		if($conn->query($query) === true){

                  
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';

            if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

               
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';
            
               $barno=$_SESSION['bar_no'];
                  if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Official')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
            }
        }

	}	if(!empty($id) && empty($profile) ){

		$query 		= "UPDATE tblofficials SET `name`='$name', `position`='$pos', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";	
	

		if($conn->query($query) === true){

                  
            $_SESSION['message'] = 'Official Information has been saved!';
            $_SESSION['success'] = 'success';
            
               $barno=$_SESSION['bar_no'];
                  if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Official')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

           
        }

	}
	
	
	if(empty($chair) ){

		$query 		= "UPDATE tblofficials SET `name`='$name', `position`='$pos', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";	
		$result 	= $conn->query($query);

		if($result === true){
            
			$_SESSION['message'] = 'Brgy Official has been updated!';
			$_SESSION['success'] = 'success';
			
			   $barno=$_SESSION['bar_no'];
                  if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Official')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}
		
	}

    header("Location: ../official.php");

	$conn->close();

	?>