<?php include 'serverapi/server_api.php' ?>
<?php





$email	   = $conn->real_escape_string($_POST['email']);

           
$houseno	   = $conn->real_escape_string($_POST['houseno']);
$barno	   = $conn->real_escape_string($_POST['barno']);
$streetid		   = $conn->real_escape_string($_POST['street']);
$housetype		   = $conn->real_escape_string($_POST['housetype']);
$landownership		   = $conn->real_escape_string($_POST['landownership']);
$s_electricity		   = $conn->real_escape_string($_POST['s_electricity']);
$s_cooking		   = $conn->real_escape_string($_POST['s_cooking']);
$source_water		   = $conn->real_escape_string($_POST['source_water']);
$waste_disposal		   = $conn->real_escape_string($_POST['waste_disposal']);
$toilet		   = $conn->real_escape_string($_POST['toilet']);
$vehicles		   = $conn->real_escape_string($_POST['vehicles']);
$appliances		   = $conn->real_escape_string($_POST['appliances']);


        

      

        $insert="INSERT INTO `tblhousehold`(`bar_no`, `st_id`, `household_no`, `email`, `land_ownership`, `house_type`, `electricity_source`, `waste_disposal`, `water_source`, `toilet_type`, `appliances`, `vehicle`, `energy_source`) 
                                    VALUES ($barno,$streetid,'$houseno','$email','$landownership','$housetype','$s_electricity','$waste_disposal','$source_water','$toilet','$appliances','$vehicles','$s_cooking')";

		if($conn->query($insert) === true){
                        
         
			$query = "SELECT * FROM tblhousehold Where `email`='$email'";
			$result = $conn->query($query);  
			$row = $result->fetch_assoc();
			   
			   if($row){
	   
				$h_no 		= $row['h_no'];
               
				echo json_encode(array("success"=>true,"hno"=>$h_no));
			
			

			   }
			
		}


	

        
        
		
	
		$conn->close();




?>