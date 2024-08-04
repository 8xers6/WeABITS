<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    
	
	$barno=$_SESSION['bar_no'];
	$reqno		= $conn->real_escape_string($_POST['reqno']);
    
	$id		= $conn->real_escape_string($_POST['resid']);
	$certificate	= $conn->real_escape_string($_POST['certificate']);
		$reason	= $conn->real_escape_string($_POST['reason']);
	
	

		if(!empty($reqno)){

			


				$query="UPDATE `tblrequested_documents` SET `status`='cancelled', `comment`='$reason' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){


					$notifname=$certificate;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request has been updated to Released';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);


					$_SESSION['message'] = 'Request No.'.$reqno. ' status has been cancelled';
					$_SESSION['success'] = 'success';
                   header("Location: ../requested_details.php?resid=$id&req_no=$reqno");
                   
				}

			}
	
  

	$conn->close();

