<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $hno 	= $conn->real_escape_string($_POST['hno']);
    $household 	= $conn->real_escape_string($_POST['householdno']);
	$street 	= $conn->real_escape_string($_POST['street']);
    $housetype 	    = $conn->real_escape_string($_POST['housetype']);
    $landownership 	    = $conn->real_escape_string($_POST['landownership']);
    $electricity 	    = $conn->real_escape_string($_POST['electricity']);
    $cooking 	    = $conn->real_escape_string($_POST['cooking']);
    $water 	    = $conn->real_escape_string($_POST['source_water']);
    $waste	    = $conn->real_escape_string($_POST['waste_disposal']);
    $toilet 	    = $conn->real_escape_string($_POST['toilet']);

    
 

    if(!empty($_POST['checkapp']) && !empty($_POST['checkvehi'])){


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
       

        $query 		= "UPDATE `tblhousehold` SET `st_id`='$street',`household_no`='$household',`land_ownership`='$landownership',`house_type`='$housetype',`electricity_source`='$electricity',`waste_disposal`='$waste',`water_source`='$water',`toilet_type`='$toilet',`energy_source`='$cooking',`vehicle`='$vehi',`appliances`='$app' WHERE `h_no`='$hno'";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong! e';
            $_SESSION['success'] = 'danger';
        }

    }else  if(empty($_POST['checkapp']) && !empty($_POST['checkvehi'])){


        if(!empty($_POST['vehicles'])) {
            // Loop through each selected checkbox 
            $vehicles="";
            foreach($_POST['vehicles'] as $selected_option) {
        
                $vehicles  .= $selected_option."  ";
            
            }
        
            $vehi=$vehicles;
        }
        
        
    
       

        $query 		= "UPDATE `tblhousehold` SET `st_id`='$street',`household_no`='$household',`land_ownership`='$landownership',`house_type`='$housetype',`electricity_source`='$electricity',`waste_disposal`='$waste',`water_source`='$water',`toilet_type`='$toilet',`energy_source`='$cooking',`vehicle`='$vehi' WHERE `h_no`='$hno'";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong! e';
            $_SESSION['success'] = 'danger';
        }

    } else if(!empty($_POST['checkapp']) && empty($_POST['checkvehi'])){


      
        
        
        if(!empty($_POST['appliances'])){
        
        
            // Loop through each selected checkbox 
            $appliances="";
            foreach($_POST['appliances'] as $selected_options) {
              
                $appliances  .= $selected_options."  ";
            }
        
            $app= $appliances;
            
        }
       

        $query 		= "UPDATE `tblhousehold` SET `st_id`='$street',`household_no`='$household',`land_ownership`='$landownership',`house_type`='$housetype',`electricity_source`='$electricity',`waste_disposal`='$waste',`water_source`='$water',`toilet_type`='$toilet',`energy_source`='$cooking',`appliances`='$app' WHERE `h_no`='$hno'";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';
            
            				$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Household Information')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Household Information')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong! e';
            $_SESSION['success'] = 'danger';
        }

    }else{
        $query 		= "UPDATE `tblhousehold` SET `st_id`='$street',`household_no`='$household',`land_ownership`='$landownership',`house_type`='$housetype',`electricity_source`='$electricity',`waste_disposal`='$waste',`water_source`='$water',`toilet_type`='$toilet',`energy_source`='$cooking' WHERE `h_no`='$hno'";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'HouseHold has been updated!';
            $_SESSION['success'] = 'success';
            
            
            				$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Household Information')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Update Household Information')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Something went wrong! e';
            $_SESSION['success'] = 'danger';
        }
     
    }

    header("Location: ../household_records.php");

    

	$conn->close();