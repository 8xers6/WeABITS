<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    
	
	$borno		= $conn->real_escape_string($_GET['borno']);
  


	
	

		if(!empty($borno)){

			


				$query="UPDATE `tblborrow` SET `status`='cancelled' WHERE `bor_no`=$borno;";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Request No.'.$borno. '  has been Cancelled';
					$_SESSION['success'] = 'danger';

                    header("Location: ../borrowed_items");
				}

			}else{

			$_SESSION['message'] = 'Please Select Status';
			$_SESSION['success'] = 'danger';
            header("Location: ../borrowed_items");
		}
	
  

	$conn->close();

