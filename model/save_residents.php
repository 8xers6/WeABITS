<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	$barno=$_SESSION['bar_no'];

	$hno     = $conn->real_escape_string($_POST['hno']);
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
	//$blocklisted     = $conn->real_escape_string($_POST['blocklisted']);
   
   
   
		if($gender=='Female'){

				$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`pregnant`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`verify_status`,`blocklisted`) 
				VALUES ($hno,$barno,'$fname','$lname','$mname','$suffix','$bdate','$bplace','$occu','$citi','$cstatus','$religion','$gender','$class_sec','$educ','$mincome','$los','$bloodtype','$pwd','$vbrand','$vstatus','$ailment','$height','$weight','$preg','$soloparent','$contact','$relation','$ename','$eno','verified','No Record')";

			}else{



				$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`verify_status`,`blocklisted`) 
				VALUES ($hno,$barno,'$fname','$lname','$mname','$suffix','$bdate','$bplace','$occu','$citi','$cstatus','$religion','$gender','$class_sec','$educ','$mincome','$los','$bloodtype','$pwd','$vbrand','$vstatus','$ailment','$height','$weight','$soloparent','$contact','$relation','$ename','$eno','verified','No Record')";
			}

   
           
             if($conn->query($query) === true){
                 
                 	$_SESSION['message'] = 'Resident Added Succesfully';
					$_SESSION['success'] = 'success';
					
					
										$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
                 
             }else{
                 
                 	$_SESSION['message'] = 'Error';
					$_SESSION['success'] = 'danger';
                 
             }
	
	
			
			 header("Location: ../view_householdmembers.php?id=$hno");

	$conn->close();

