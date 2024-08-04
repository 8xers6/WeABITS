<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}



    $id 	= $_SESSION['id'];
	

	

	
    
	$profile 	= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 	= $_FILES['file']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	if(!is_dir("../assets/uploads/resident_profile/".$id)){
		mkdir("../assets/uploads/resident_profile/".$id."/", 0777);
	}

	  // image file directory
  	$target = "../assets/uploads/resident_profile/".$id."/".basename($newName);

	

		if(!empty($id)){

			
        

            if(!empty($profile) && !empty($profile2)){

				$query="UPDATE `tbl_residents` SET 
												  	
											
													`res_picture`='$profile'
												
													  WHERE `res_id`='$id';";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Profile picture has been updated!';
					$_SESSION['success'] = 'success';
				}

			}else if(!empty($profile) && empty($profile2)){

				$query="UPDATE `tbl_residents` SET 
													
												
													`res_picture`='$profile'
													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Profile picture has been updated!';
					$_SESSION['success'] = 'success';
				}

			}else if(empty($profile) && !empty($profile2)){

					$query="UPDATE `tbl_residents` SET 
														
													
														`res_picture`='$newName'
														
														WHERE `res_id`='$id';";

				if($conn->query($query) === true){

                   

					$_SESSION['message'] = 'Profile picture has been updated!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){

						$_SESSION['message'] = 'Profile picture has been updated!';
						$_SESSION['success'] = 'success';
					}
				}

			}else if(empty($profile) && empty($profile2)){
                    
                $_SESSION['message'] = 'No image attach';
                $_SESSION['success'] = 'danger';
			}else{
			      $query="UPDATE `tbl_residents` SET 
													
													`res_pic`='person.png'
													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Profile picture has been updated!';
					$_SESSION['success'] = 'success';
				}
			}

		}else{

			$_SESSION['message'] = 'plss enter house no and street';
			$_SESSION['success'] = 'danger';
		}
	
    header("Location: residentprofile");

	$conn->close();

