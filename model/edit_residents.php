<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    $id 	= $conn->real_escape_string($_POST['id']);
	
	$fname 		   = $conn->real_escape_string($_POST['fname']);
	$mname 		   = $conn->real_escape_string($_POST['mname']);
    $lname 		   = $conn->real_escape_string($_POST['lname']);
	$suffix 	   = $conn->real_escape_string($_POST['suffix']);


	$bdate 		    = $conn->real_escape_string($_POST['bdate']);
	$bplace 		= $conn->real_escape_string($_POST['bplace']);
   // $age 		    = $conn->real_escape_string($_POST['age']);

	$cstatus 		= $conn->real_escape_string($_POST['cstatus']);
	$citi	        = $conn->real_escape_string($_POST['citizenship']);
    $gender 		= $conn->real_escape_string($_POST['gender']);

	//$houseno		= $conn->real_escape_string($_POST['house_no']);
	//$street 		= $conn->real_escape_string($_POST['street']);
    $religion		= $conn->real_escape_string($_POST['religion']);

	$contact 		= $conn->real_escape_string($_POST['contact_no']);
	$occu 		    = $conn->real_escape_string($_POST['occupation']);

    $educ 		    = $conn->real_escape_string($_POST['educ']);
    $class_sec		= $conn->real_escape_string($_POST['class_sec']);
	$los 		    = $conn->real_escape_string($_POST['los']);



	$mincome 		= $conn->real_escape_string($_POST['m_income']);
	$bloodtype 		= $conn->real_escape_string($_POST['bloodtype']);



	$remarks 		= $conn->real_escape_string($_POST['remarks']);
	$alive 	= $conn->real_escape_string($_POST['alive']);


	


	$ename		= $conn->real_escape_string($_POST['ename']);
	$eno     = $conn->real_escape_string($_POST['eno']);



	$vbrand		= $conn->real_escape_string($_POST['vbrand']);
	$vstatus 		    = $conn->real_escape_string($_POST['vstatus']);
	$ailment 		    = $conn->real_escape_string($_POST['ailment']);


	$height		= $conn->real_escape_string($_POST['height']);
	$weight     = $conn->real_escape_string($_POST['weight']);


	$pregnant		= $conn->real_escape_string($_POST['pregnant']);
	$soloparent     = $conn->real_escape_string($_POST['soloparent']);

	$relation    = $conn->real_escape_string($_POST['relation']);


	$pwd     = $conn->real_escape_string($_POST['pwd']);
	$blocklisted     = $conn->real_escape_string($_POST['blocklisted']);

	
    
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
												  	`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
													
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',




													`blood_type`='$bloodtype',

													
													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',

													`height`='$height',
													`weight`='$weight',
												
													`pwd`='$pwd',
													
													`contact_no`='$contact',
											
													
													`remarks`='$remarks', 

													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'

													
													  WHERE `res_id`='$id';";

			    
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}else if(!empty($profile) && empty($profile2)){

				$query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
													
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
											
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
													`bmi`='$bmi',
													`bmi_category`='$bmicateg',
													`pwd`='$pwd',
													
													`contact_no`='$contact',
												
													
													`remarks`='$remarks', 
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
		
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'
													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}else if(empty($profile) && !empty($profile2)&& empty($houseno)&& empty($street)){

					$query="UPDATE `tbl_residents` SET 
														`firstname`='$fname',
														`lastname`='$lname',
														`middlename`='$mname',
														`suffix`='$suffix',
														
														
														`birthdate`='$bdate',
														
														`birthplace`='$bplace',
														`occupation`='$occu',
														`citizenship`='$citi',
														`civil_status`='$cstatus',
														`religion`='$religion',
														`gender`='$gender',
														`alive`='$alive',
													
														`classified_sector`='$class_sec',
														`educational_attainment`='$educ',
														`monthly_income`='$mincome',
														`length_of_stay`='$los',
														`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',

													`height`='$height',
													`weight`='$weight',
													
													`pwd`='$pwd',
														
														`contact_no`='$contact',
													
														`res_picture`='$newName',
														`remarks`='$remarks',
														`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'
														
														WHERE `res_id`='$id';";

				if($conn->query($query) === true){

                   

					$_SESSION['message'] = 'Resident Information has been updated!!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){

						$_SESSION['message'] = 'Resident Information has been updated!!';
						$_SESSION['success'] = 'success';
						
						
								$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
					}
				}

			}else if(empty($profile) && empty($profile2)&& empty($houseno)&& empty($street)){

				$query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
												
												
												
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
													
													`pwd`='$pwd',
													`contact_no`='$contact',
												
												
													`remarks`='$remarks',
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'

													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}else if(empty($profile) && empty($profile2)&& !empty($houseno)&& empty($street)){

				$query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
												
													 
												
												
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
												
													`pwd`='$pwd',
													`contact_no`='$contact',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
												
													`remarks`='$remarks',
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`relation`='$relation',
													`blocklisted`='$blocklisted'

													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}else if(empty($profile) && empty($profile2)&& empty($houseno)&& !empty($street)){

				$query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
												
												
												
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
													
													`pwd`='$pwd',
													`contact_no`='$contact',
												
												
													`remarks`='$remarks',
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'
													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}else if(empty($profile) && empty($profile2)&& !empty($houseno)&& !empty($street)){

				$query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
											
												
												
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
												
													`pwd`='$pwd',
													`contact_no`='$contact',
												
												
													`remarks`='$remarks',
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'
													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}

			}
			else{
			      $query="UPDATE `tbl_residents` SET 
													`firstname`='$fname',
													`lastname`='$lname',
													`middlename`='$mname',
													`suffix`='$suffix',
													
													`birthdate`='$bdate',
													
													`birthplace`='$bplace',
													`occupation`='$occu',
													`citizenship`='$citi',
													`civil_status`='$cstatus',
													`religion`='$religion',
													`gender`='$gender',
													`alive`='$alive',
													
													`classified_sector`='$class_sec',
													`educational_attainment`='$educ',
													`monthly_income`='$mincome',
													`length_of_stay`='$los',
													`blood_type`='$bloodtype',

													`vaccine_brand`='$vbrand',
													`vaccine_status`='$vstatus',
													`ailment`='$ailment',
													`height`='$height',
													`weight`='$weight',
													`bmi`='$bmi',
													`bmi_category`='$bmicateg',
													
													`pwd`='$pwd',
													`contact_no`='$contact',
													
													
													`remarks`='$remarks', 
													`emergencyname`='$ename',
													`emergencycontact`='$eno',
													`pregnant`='$pregnant',
													`solo_parent`='$soloparent',
													`relation`='$relation',
													`blocklisted`='$blocklisted'

													
													 WHERE `res_id`='$id';";
				
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
					
					
					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
				}
			}

		}else{

			$_SESSION['message'] = 'id not found';
			$_SESSION['success'] = 'danger';
		}
	


			 if(!empty($_POST['member'])){
				$hno     = $conn->real_escape_string($_POST['hno']);
				header("Location: ../view_householdmembers.php?id=$hno");
			 }else{


				header("Location: ../residents.php");
			 }


	$conn->close();

