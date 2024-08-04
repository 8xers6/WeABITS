<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    
	
	$req_no		= $conn->real_escape_string($_GET['req_no']);



	
	

		if(!empty($req_no)){

			


				$query="UPDATE `tblrequested_documents` SET `status`='cancelled'  WHERE `req_no`=$req_no;";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Request No.'.$req_no. ' status has been Cancelled';
					$_SESSION['success'] = 'danger';

                    header("Location: myrequest.php");
				}

			}else{

			$_SESSION['message'] = 'Please Select Status';
			$_SESSION['success'] = 'danger';
            header("Location: myrequest.php");
		}
	
  

	$conn->close();

