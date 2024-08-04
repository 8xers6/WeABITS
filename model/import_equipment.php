
<?php include '../server/server.php' ?>

<?php
// Load the database configuration file

if(isset($_POST['importSubmit'])){

    $cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);

    $hashcur= hash("sha256",$cur_pass);
    $busername=$_SESSION['username'];
    
    
    $excelfile=$_FILES["file"]["name"];
    
    $check = "SELECT * FROM tblbarangay WHERE username='$busername' AND `password`='$hashcur' AND `equip_excel_file`='$excelfile'";
    $res = $conn->query($check);
    
    if(mysqli_num_rows($res) === 1){
        
         $excelfile=date("Ymdhis");

        $wquery 		= "UPDATE `tblbarangay` SET `equip_excel_file`='$excelfile' WHERE `username`='$busername'";	
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
$equipno=$line[0];
$barno= $line[1];
$equipmentname= $line[2];
$description= $line[3];
$quantity= $line[4];
$status= $line[5];
$image= $line[6];


          
                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM `tblequipments` WHERE `equip_no`=$equipno ";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tblequipments` SET `equipment_name`='$equipmentname',`description`='$description',`quantity`='$quantity',`status`='$status' WHERE `equip_no`=$equipno");

                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../equipment.php");
                }else{
                    // Insert member data in the database

                    $conn->query("INSERT INTO `tblequipments`(`bar_no`, `equipment_name`, `description`, `quantity`, `status`) VALUES ('$barno','$equipmentname','$description','$quantity','$status')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../equipment.php");
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
    header("Location: ../equipment.php");
		


}

}
