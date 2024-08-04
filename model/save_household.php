<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $barno=$_SESSION['bar_no'];
    $household 	= $conn->real_escape_string($_POST['householdno']);
	$street 	= $conn->real_escape_string($_POST['street']);
    $housetype 	    = $conn->real_escape_string($_POST['housetype']);
    $landownership 	    = $conn->real_escape_string($_POST['landownership']);
    $electricity 	    = $conn->real_escape_string($_POST['electricity']);
    $cooking 	    = $conn->real_escape_string($_POST['cooking']);
    $water 	    = $conn->real_escape_string($_POST['source_water']);
    $waste	    = $conn->real_escape_string($_POST['waste_disposal']);
    $toilet 	    = $conn->real_escape_string($_POST['toilet']);

    
 
 if(!empty($_POST['vehicles'])) {
            // Loop through each selected checkbox 
            $vehicles="";
            foreach($_POST['vehicles'] as $selected_option) {
        
                $vehicles  .= $selected_option."  ";
            
            }
        
            $vehi=$vehicles;
        }
        
        
        if(!empty($_POST['appliances'])){
        
        
            // Loop through each selected checkbox 
            $appliances="";
            foreach($_POST['appliances'] as $selected_options) {
              
                $appliances  .= $selected_options."  ";
            }
        
            $app= $appliances;
            
        }
        
        
          $insert="INSERT INTO `tblhousehold`(`bar_no`, `st_id`, `household_no`, `land_ownership`, `house_type`, `electricity_source`, `waste_disposal`, `water_source`, `toilet_type`, `appliances`, `vehicle`, `energy_source`) 
                                    VALUES ($barno,$street,'$household','$landownership','$housetype','$electricity','$waste','$water','$toilet','$app','$vehi','$cooking')";

		if($conn->query($insert) === true){
		    
		    
		       $_SESSION['message'] = 'Household has been added';
            $_SESSION['success'] = 'success';
            
            
                header("Location: ../household_records.php");
		}else{
		       $_SESSION['message'] = 'Something went wrong! e';
            $_SESSION['success'] = 'danger';
            
            
                header("Location: ../household_records.php");
		    
		}



    

	$conn->close();