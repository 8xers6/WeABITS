<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	$barno=$_SESSION['bar_no'];

    $reqno 	= $conn->real_escape_string($_POST['reqno']);

	$id 	= $conn->real_escape_string($_POST['resid']);
	$dtype 	= $conn->real_escape_string($_POST['dtype']);
	
  

	

	

	
    
	$document 	= $_FILES['file']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $document);



	  if(!is_dir("../assets/uploads/".$_SESSION['username']."/requested/".$reqno)){
                    
		mkdir("../assets/uploads/".$_SESSION['username']."/requested/".$reqno, 07777);


	}

	$target = "../assets/uploads/".$_SESSION['username']."/requested/".$reqno.'/'.basename($newName);
	

		if(!empty($reqno)){

			
        
           if(!empty($document)){

					$query="UPDATE `tblrequested_documents` SET 
														
													
														`download_file`='$newName'
														
														WHERE `req_no`=$reqno;";

				if($conn->query($query) === true){

                   


					if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){

						$query="UPDATE `tblrequested_documents` SET `status`='receive' WHERE `req_no`=$reqno;";

			    
				
						if($conn->query($query) === true){

							$notifname=$dtype;
							$notiftype='document';
							$usertype='Resident';
							$message='Your Request is Ready to Received';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);
		
						
							$_SESSION['message'] = 'Document has been Sent!!';
							$_SESSION['success'] = 'success';
						   
						}

					
					}
				}

			}else{
			     
			}

		}else{

			$_SESSION['message'] = 'Error ';
			$_SESSION['success'] = 'danger';
		}
	
    header("Location: ../requested_docs.php");

	$conn->close();

