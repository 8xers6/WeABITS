
<?php include '../server/server.php' ?>

<?php
// Load the database configuration file

if(isset($_POST['importSubmit'])){

    $cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);

    $hashcur= hash("sha256",$cur_pass);
    $busername=$_SESSION['username'];
    
    
    $excelfile=$_FILES["file"]["name"];
    
    $check = "SELECT * FROM tblbarangay WHERE username='$busername' AND `password`='$hashcur' AND `excel_file`='$excelfile'";
    $res = $conn->query($check);
    
    if(mysqli_num_rows($res) === 1){
        
         $excelfile=date("Ymdhis");

        $wquery 		= "UPDATE `tblbarangay` SET `excel_file`='$excelfile' WHERE `username`='$busername'";	
        $wresult 	= $conn->query($wquery);
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
//residentsrow data
$res_id=$line[0];
$h_nor= $line[1];
$email= $line[2];
$firstname= $line[3];
$middlename= $line[4];
$lastname= $line[5];
$suffix= $line[6];
$birthdate= $line[7];
$birthplace= $line[8];
$occupation= $line[9];
$citizenship= $line[10];
$civil_status=$line[11];
$religion=$line[12];
$gender=$line[13];
$alive=$line[14];
$relation=$line[15];
$classified_sector=$line[16];
$educational_attainment=$line[17];
$monthly_income=$line[18];
$length_of_stay=$line[19];
$blood_type=$line[20];
$pwd=$line[21];
$vaccine_brand=$line[22];
$vaccine_status=$line[23];
$ailment=$line[24];
$height=$line[25];
$weight=$line[26];
$pregnant=$line[27];
$solo_parent=$line[28];
$contact_no=$line[29];
$emergencyname=$line[30];
$emergencycontact=$line[31];
$username=$line[32];
$verify_status=$line[33];
$remarks=$line[34];
$blocklisted=$line[35];
$created_at=$line[36];



//household data

$h_no=$line[37];
$bar_no=$line[38];
$st_id=$line[39];
$household_no=$line[40];
$hemail=$line[41];
$land_ownership=$line[42];
$house_type=$line[43];
$electricity_source=$line[44];
$energy_source=$line[45];
$waste_disposal=$line[46];
$water_source=$line[47];
$toilet_type=$line[48];
$appliances=$line[49];
$vehicles=$line[50];
$password=$line[51];
            
                
                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM `tbl_residents` WHERE `res_id`='$res_id' ";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tbl_residents` SET  
                       `username`='$username',
                     `h_no`='$h_nor',
                     `firstname`='$firstname',
                    `lastname`='$lastname',
                    `middlename`='$middlename',
                    `suffix`='$suffix',
                    `birthdate`='$birthdate',
                    `birthplace`='$birthplace',
                    `occupation`='$occupation',
                    `citizenship`='$citizenship',
                    `civil_status`='$civil_status',
                    `religion`='$religion',
                    `gender`='$gender',
                    `alive`='$alive',
                    `classified_sector`='$classified_sector',
                    `educational_attainment`='$educational_attainment',
                    `monthly_income`='$monthly_income',
                    `length_of_stay`='$length_of_stay',
                    `blood_type`='$blood_type',
                    `vaccine_brand`='$vaccine_brand',
                    `vaccine_status`='$vaccine_status',
                    `ailment`='$ailment',
                    `height`='$height',
                    `weight`='$weight',
                    `pwd`='$pwd',
                    `contact_no`='$contact_no',
                    `remarks`='$remarks', 
                    `emergencyname`='$emergencyname',
                    `emergencycontact`='$emergencycontact',
                    `pregnant`='$pregnant',
                    `solo_parent`='$solo_parent',
                    `relation`='$relation',
                    `blocklisted`='$blocklisted',
                    `password`='$password'
                    WHERE `res_id`='$res_id' ");

                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../residents.php");
                }else{
                    // Insert member data in the database
                    $barno=$_SESSION['bar_no'];
                    $conn->query("INSERT INTO `tbl_residents`(`res_id`,`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`pregnant`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`email`,`username`,`verify_status`,`password`) 
                    VALUES ('$res_id',$h_nor,$barno,'$firstname','$lastname','$middlename','$suffix','$birthdate','$birthplace','$occupation','$citizenship','$civil_status','$religion','$gender','$classified_sector','$educational_attainment','$monthly_income','$length_of_stay','$blood_type','$pwd','$vaccine_brand','$vaccine_status','$ailment','$height','$weight','$pregnant','$solo_parent','$contact_no','$relation','$emergencyname','$emergencycontact','$email','$username','$verify_status','$password')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../residents.php");
                }


                // Check whether member already exists in the database with the same email
                $prevQuery1 = "SELECT * FROM `tblhousehold` WHERE `h_no`='$h_no'";
                $prevResult1 = $conn->query($prevQuery1);
                
                if($prevResult1->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tblhousehold` SET  `email`='$hemail'  WHERE `h_no`='$h_no'");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                }else{
                    // Insert member data in the database
                    $barno=$_SESSION['bar_no'];
                    $conn->query("INSERT INTO `tblhousehold`(`h_no`,`bar_no`, `st_id`, `household_no`, `email`, `land_ownership`, `house_type`, `electricity_source`, `waste_disposal`, `water_source`, `toilet_type`, `appliances`, `vehicle`, `energy_source`) 
                    VALUES ($h_no,$barno,$st_id,'$household_no','$hemail','$land_ownership','$house_type','$electricity_source','$waste_disposal','$water_source','$toilet_type','$appliances','$vehicles','$energy_source')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../residents.php");

   
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
         
     
        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
       
        }
    }else{
        $_SESSION['message'] = 'Invalid File';
        $_SESSION['success'] = 'danger';
      
    }


}else{
     $clerkusername=$_SESSION['clerkusername'];
       	$query1		= "SELECT tblbarangay.username as busername ,tblbarangay.bar_no as barno,tblbarangay.barangayname as barangayname,tbl_users.username as username, tbl_users.user_type as user_type,tbl_users.avatar FROM `tbl_users` LEFT JOIN tblbarangay on tbl_users.bar_no=tblbarangay.bar_no WHERE tbl_users.username='$clerkusername' AND tbl_users.password='$hashcur' AND tblbarangay.excel_file='$excelfile' ";
		$clerk_results 	= $conn->query($query1);
		if(mysqli_num_rows($clerk_results) == 1){
		    
		    
		       $excelfile=date("Ymdhis");

        $wquery 		= "UPDATE `tblbarangay` SET `excel_file`='$excelfile' WHERE `username`='$busername'";	
        $wresult 	= $conn->query($wquery);
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
//residentsrow data
$res_id=$line[0];
$h_nor= $line[1];
$email= $line[2];
$firstname= $line[3];
$middlename= $line[4];
$lastname= $line[5];
$suffix= $line[6];
$birthdate= $line[7];
$birthplace= $line[8];
$occupation= $line[9];
$citizenship= $line[10];
$civil_status=$line[11];
$religion=$line[12];
$gender=$line[13];
$alive=$line[14];
$relation=$line[15];
$classified_sector=$line[16];
$educational_attainment=$line[17];
$monthly_income=$line[18];
$length_of_stay=$line[19];
$blood_type=$line[20];
$pwd=$line[21];
$vaccine_brand=$line[22];
$vaccine_status=$line[23];
$ailment=$line[24];
$height=$line[25];
$weight=$line[26];
$pregnant=$line[27];
$solo_parent=$line[28];
$contact_no=$line[29];
$emergencyname=$line[30];
$emergencycontact=$line[31];
$username=$line[32];
$verify_status=$line[33];
$remarks=$line[34];
$blocklisted=$line[35];
$created_at=$line[36];



//household data

$h_no=$line[37];
$bar_no=$line[38];
$st_id=$line[39];
$household_no=$line[40];
$hemail=$line[41];
$land_ownership=$line[42];
$house_type=$line[43];
$electricity_source=$line[44];
$energy_source=$line[45];
$waste_disposal=$line[46];
$water_source=$line[47];
$toilet_type=$line[48];
$appliances=$line[49];
$vehicles=$line[50];
$password=$line[51];
            
                
                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM `tbl_residents` WHERE `res_id`='$res_id' ";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tbl_residents` SET  
                       `username`='$username',
                     `h_no`='$h_nor',
                     `firstname`='$firstname',
                    `lastname`='$lastname',
                    `middlename`='$middlename',
                    `suffix`='$suffix',
                    `birthdate`='$birthdate',
                    `birthplace`='$birthplace',
                    `occupation`='$occupation',
                    `citizenship`='$citizenship',
                    `civil_status`='$civil_status',
                    `religion`='$religion',
                    `gender`='$gender',
                    `alive`='$alive',
                    `classified_sector`='$classified_sector',
                    `educational_attainment`='$educational_attainment',
                    `monthly_income`='$monthly_income',
                    `length_of_stay`='$length_of_stay',
                    `blood_type`='$blood_type',
                    `vaccine_brand`='$vaccine_brand',
                    `vaccine_status`='$vaccine_status',
                    `ailment`='$ailment',
                    `height`='$height',
                    `weight`='$weight',
                    `pwd`='$pwd',
                    `contact_no`='$contact_no',
                    `remarks`='$remarks', 
                    `emergencyname`='$emergencyname',
                    `emergencycontact`='$emergencycontact',
                    `pregnant`='$pregnant',
                    `solo_parent`='$solo_parent',
                    `relation`='$relation',
                    `blocklisted`='$blocklisted',
                    `password`='$password'
                    WHERE `res_id`='$res_id' ");

                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../residents.php");
                    
                }else{
                    // Insert member data in the database
                    $barno=$_SESSION['bar_no'];
                    $conn->query("INSERT INTO `tbl_residents`(`res_id`,`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`pregnant`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`email`,`username`,`verify_status`,`password`) 
                    VALUES ('$res_id',$h_nor,$barno,'$firstname','$lastname','$middlename','$suffix','$birthdate','$birthplace','$occupation','$citizenship','$civil_status','$religion','$gender','$classified_sector','$educational_attainment','$monthly_income','$length_of_stay','$blood_type','$pwd','$vaccine_brand','$vaccine_status','$ailment','$height','$weight','$pregnant','$solo_parent','$contact_no','$relation','$emergencyname','$emergencycontact','$email','$username','$verify_status','$password')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../residents.php");
                }


                // Check whether member already exists in the database with the same email
                $prevQuery1 = "SELECT * FROM `tblhousehold` WHERE `h_no`='$h_no'";
                $prevResult1 = $conn->query($prevQuery1);
                
                if($prevResult1->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tblhousehold` SET  `email`='$hemail'  WHERE `h_no`='$h_no'");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                }else{
                    // Insert member data in the database
                    $barno=$_SESSION['bar_no'];
                    $conn->query("INSERT INTO `tblhousehold`(`h_no`,`bar_no`, `st_id`, `household_no`, `email`, `land_ownership`, `house_type`, `electricity_source`, `waste_disposal`, `water_source`, `toilet_type`, `appliances`, `vehicle`, `energy_source`) 
                    VALUES ($h_no,$barno,$st_id,'$household_no','$hemail','$land_ownership','$house_type','$electricity_source','$waste_disposal','$water_source','$toilet_type','$appliances','$vehicles','$energy_source')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../residents.php");

   
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
         
     
        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
       
        }
    }else{
        $_SESSION['message'] = 'Invalid File';
        $_SESSION['success'] = 'danger';
      
    }
		    
		    
		    
		}else{
		    
		        $_SESSION['message'] = 'Incorrect Password or Invalid File';
    $_SESSION['success'] = 'danger';
    header("Location: ../residents.php");
		}


}

}
