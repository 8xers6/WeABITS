<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    

	$reqno		= $conn->real_escape_string($_GET['reqno']);

	
	

		if(!empty($reqno)){

			


				$query="UPDATE `tblrequested_documents` SET `status`='cancelled'  WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){
$_SESSION['message'] = 'Request No.'.$reqno. ' status has been cancelled';
					$_SESSION['success'] = 'danger';

				    header("Location: ../myrequest");
                   
				}

			}
	
  

	$conn->close();

