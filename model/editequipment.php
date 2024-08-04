<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	$eqname 	= $conn->real_escape_string($_POST['eqname']);
	$description 	= $conn->real_escape_string($_POST['description']);
	$qty 	= $conn->real_escape_string($_POST['qty']);
    $status 	= $conn->real_escape_string($_POST['status']);

    $id 	= $conn->real_escape_string($_POST['id']);
	$image   = $_FILES['imgeq']['name'];
$barno=$_SESSION['bar_no'];
	if(!empty($barno)&&!empty($eqname)&&!empty($status)&&!empty($id)&&!empty($image)){


		$newD = date('dmYHis').str_replace(" ", "", $image);
	


		if(!is_dir("../assets/uploads/".$_SESSION['username']."/equipment")){
		  mkdir("../assets/uploads/".$_SESSION['username']."/equipment", 07777);
	  }
  
	  $target1= "../assets/uploads/".$_SESSION['username']."/equipment"."/".basename($newD);


		$query 		= "UPDATE `tblequipments` SET `equipment_name`='$eqname',`quantity`=$qty,`status`='$status',`image`='$newD',`description`='$description' WHERE equip_no=$id";
		
		$result 	= $conn->query($query);
		
		if($result === true){

			if(move_uploaded_file($_FILES['imgeq']['tmp_name'], $target1)){

				$_SESSION['message'] = 'Equipment has been Updated ';
				$_SESSION['success'] = 'success';
				
			}
         
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else if(!empty($barno)&&!empty($eqname)&& empty($image) &&!empty($id)){

		$query 		= "UPDATE `tblequipments` SET `equipment_name`='$eqname',`quantity`=$qty,`status`='$status',`description`='$description' WHERE equip_no=$id";
		
		$result 	= $conn->query($query);
		
		if($result === true){

			
				$_SESSION['message'] = 'Equipment has been Updated ';
				$_SESSION['success'] = 'success';
				
		
         
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }


	}
	else{

		$_SESSION['message'] = 'Missing equipment ID!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../equipment");
	$conn->close();
?>
