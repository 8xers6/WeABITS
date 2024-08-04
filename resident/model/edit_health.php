<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id=$_SESSION['resid'];
	
	$vbrand		= $conn->real_escape_string($_POST['vbrand']);
	$vstatus 		    = $conn->real_escape_string($_POST['vstatus']);
	$ailment 		    = $conn->real_escape_string($_POST['ailment']);
    $bloodtype 		= $conn->real_escape_string($_POST['bloodtype']);


	$height		= $conn->real_escape_string($_POST['height']);
	$weight     = $conn->real_escape_string($_POST['weight']);

	$bmi		= $conn->real_escape_string($_POST['bmi']);
	$bmicateg     = $conn->real_escape_string($_POST['bmicateg']);

	
	

		if(!empty($id)){

			
        

          

				$query="UPDATE `tbl_residents` SET 
												  	
                                                    `vaccine_brand`='$vbrand',
                                                    `vaccine_status`='$vstatus',
                                                    `ailment`='$ailment',
                                                    `blood_type`='$bloodtype',
                                                    `height`='$height',
                                                    `weight`='$weight',
                                                    `bmi`='$bmi',
                                                    `bmi_category`='$bmicateg'
													
													  WHERE `res_id`='$id';";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Health Information has been updated!';
					$_SESSION['success'] = 'success';
				}

			}else{

			$_SESSION['message'] = 'id not found';
			$_SESSION['success'] = 'danger';
		}
	
    header("Location: ../residentprofile.php");

	$conn->close();

