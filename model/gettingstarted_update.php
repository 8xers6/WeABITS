<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	

	
	
	
	
	
	

					
	
	$number 	= $conn->real_escape_string($_POST['number']);
	$mission 	= $conn->real_escape_string($_POST['mission']);
	$vision 	= $conn->real_escape_string($_POST['vision']);
	//$email 	= $conn->real_escape_string($_POST['email']);
	
	$city_logo 	= $_FILES['city_logo']['name'];
	$brgy_logo 	= $_FILES['brgy_logo']['name'];

	$gcash 	= $_FILES['gcashqrcode']['name'];



	$barno=$_SESSION['bar_no'];
	$brgyname= $_SESSION['brgyname'];

	// change city_logo name
	$newC = date('dmYHis').str_replace(" ", "", $city_logo);
	// change brgy_logo name
	$newB = date('dmYHis').str_replace(" ", "", $brgy_logo);


		// change city_logo name
		$newD = date('dmYHis').str_replace(" ", "", $gcash);
	


	  if(!is_dir("../assets/uploads/".$_SESSION['username']."/barangayinfo")){
		mkdir("../assets/uploads/".$_SESSION['username']."/barangayinfo", 07777);
	}

    $target1= "../assets/uploads/".$_SESSION['username']."/barangayinfo"."/".basename($newC);
	$target2= "../assets/uploads/".$_SESSION['username']."/barangayinfo"."/".basename($newB);


    $target3= "../assets/uploads/".$_SESSION['username']."/barangayinfo"."/".basename($newD);
	



	 
	 if(!empty($number)&& !empty($mission)&& !empty($vision)&& !empty($city_logo)){
          
$query = "UPDATE tblbarangay SET `phonenumber`='$number',`mission`='$mission',`vision`='$vision',`citylogo`='$newC'
WHERE bar_no=$barno;";

		if($conn->query($query) === true){

		

			if(move_uploaded_file($_FILES['city_logo']['tmp_name'], $target1)){

				$_SESSION['message'] = 'Barangay Information  has been updated!!';
				$_SESSION['success'] = 'success';

				
			}
		}

		  
	} 
	
	if(!empty($number)&& !empty($mission)&& !empty($vision)&& !empty($brgy_logo) ){
          
		$query = "UPDATE tblbarangay SET `phonenumber`='$number',`mission`='$mission',`vision`='$vision',`brgylogo`='$newB'
		 WHERE bar_no=$barno;";

		if($conn->query($query) === true){

		

				

				if(move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target2)){

					$_SESSION['message'] = 'Barangay Information  has been updated!!';
				$_SESSION['success'] = 'success';

				}
			
		}

		  
	 }
	 
	 if(!empty($number)&& !empty($mission)&& !empty($vision)&& !empty($gcash)){
          
		$query = "UPDATE tblbarangay SET `phonenumber`='$number',`mission`='$mission',`vision`='$vision',`gcash_qrcode`='$newD',`getstarted`='1'  WHERE bar_no=$barno;";

		if($conn->query($query) === true){

		

			

					if(move_uploaded_file($_FILES['gcashqrcode']['tmp_name'], $target3)){
						$_SESSION['message'] = 'Barangay Information  has been updated!!';
						$_SESSION['success'] = 'success';
						
					}
				
			
		}

		  
	 }
	 
	 
	


	 if(!empty($number)&& !empty($mission)&& !empty($vision)){
          
		$query = "UPDATE tblbarangay SET `phonenumber`='$number',`mission`='$mission',`vision`='$vision'
		 WHERE bar_no=$barno;";

		if($conn->query($query) === true){

		

				$_SESSION['message'] = 'Barangay Information  has been updated!!';
				$_SESSION['success'] = 'success';

				
			
		}

		  
	} 
	 
	 
	 
	

	if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();

?>