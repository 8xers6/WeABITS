<?php include '../server/server.php' ?>
<?php 


	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id 	= $_SESSION['id'];
	
	$fname 		   = $conn->real_escape_string($_POST['fname']);
	$mname 		   = $conn->real_escape_string($_POST['mname']);
    $lname 		   = $conn->real_escape_string($_POST['lname']);
	$suffix 		   = $conn->real_escape_string($_POST['suffix']);

	$bdate 		    = $conn->real_escape_string($_POST['bdate']);
	$bplace 		= $conn->real_escape_string($_POST['bplace']);
    $age 		    = $conn->real_escape_string($_POST['age']);
	$address 		    = $conn->real_escape_string($_POST['address']);

	$cstatus 		= $conn->real_escape_string($_POST['cstatus']);
	$citi	        = $conn->real_escape_string($_POST['citizenship']);
    $gender 		= $conn->real_escape_string($_POST['gender']);


    $religion		= $conn->real_escape_string($_POST['religion']);

	$contact 		= $conn->real_escape_string($_POST['contact_no']);
	$occu 		    = $conn->real_escape_string($_POST['occupation']);

	$class_sec		= $conn->real_escape_string($_POST['class_sec']);

    $educ 		    = $conn->real_escape_string($_POST['educ']);
	
	$los 		    = $conn->real_escape_string($_POST['los']);

	$mincome 		= $conn->real_escape_string($_POST['m_income']);
	

	$hof 	= $conn->real_escape_string($_POST['headoffamily']);
	$pwd     = $conn->real_escape_string($_POST['pwd']);


	
	

		if(!empty($id)){

			
        

          

				$query="UPDATE `tbl_residents` SET 
												  	`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
                                                    `address`='$address',
													`birthdate`='$bdate',
													`age`='$age',
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`head_of_family`='$hof',
													`contact_no`='$contact',
		                                           
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`pwd`='$pwd'
													
													
													
													  WHERE `res_id`='$id';";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Personal Information has been updated!';
					$_SESSION['success'] = 'success';
				}

			}else{

			$_SESSION['message'] = 'id not found';
			$_SESSION['success'] = 'danger';
		}
	
    header("Location: ../residentprofile.php");

	$conn->close();

