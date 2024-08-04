
<?php include '../server/server.php' ?>

<?php
// Load the database configuration file

if(isset($_POST['importSubmit'])){

    $cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);

    $hashcur= hash("sha256",$cur_pass);
    $busername=$_SESSION['username'];
    
    
    $excelfile=$_FILES["file"]["name"];
    
    $check = "SELECT * FROM tblbarangay WHERE username='$busername' AND `password`='$hashcur' AND `med_excel_file`='$excelfile'";
    $res = $conn->query($check);
    
    if(mysqli_num_rows($res) === 1){
        
         $excelfile=date("Ymdhis");

        $wquery 		= "UPDATE `tblbarangay` SET `med_excel_file`='$excelfile' WHERE `username`='$busername'";	
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
$id=$line[0];
$qty= $line[1];
$expirydate= $line[2];
$date_updated= $line[3];
$medno= $line[4];
$bar_no= $line[5];
$med_name= $line[6];
$measurement= $line[7];
$description= $line[8];
$sku= $line[9];
$category_id= $line[10];
$categoryname=$line[11];
$typeid=$line[12];
$typename=$line[13];

          
                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM `med_category` WHERE `category_id`=$category_id ";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `med_category` SET `category_name`='$categoryname' WHERE `category_id`=$category_id ");

                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database

                    $conn->query("INSERT INTO `med_category`(`category_id`,`bar_no`, `category_name`) VALUES ('$category_id','$bar_no','$categoryname')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");
                }


                // Check whether member already exists in the database with the same id
                $prevQuery1 = "SELECT * FROM `type_list` WHERE `type_id`=$typeid";
                $prevResult1 = $conn->query($prevQuery1);
                
                if($prevResult1->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `type_list` SET `type_name`='$typename' WHERE `type_id`=$typeid");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                  
                    $conn->query("INSERT INTO `type_list`(`type_id`,`bar_no`, `type_name`) VALUES ('$typeid','$bar_no','$typename')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
                }
                
                  // Check whether member already exists in the database with the same id
                $prevQuery2 = "SELECT * FROM `tblmedicine` WHERE `med_no`=$medno";
                $prevResult2 = $conn->query($prevQuery2);
                
                if($prevResult2->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tblmedicine` SET `med_name`='$med_name',`measurement`='$measurement',`description`='$description',`category_id`='$category_id',`type_id`='$typeid',`sku`='$sku' WHERE `med_no`=$medno");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                   
                    $conn->query("INSERT INTO `tblmedicine`(`bar_no`, `med_name`, `measurement`, `description`, `category_id`, `type_id`, `sku`) VALUES ('$barno','$med_name','$measurement','$description','$category_id','$typeid','$sku')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
                }
                
                
                
                    // Check whether member already exists in the database with the same id
                $prevQuery3 = "SELECT * FROM `inventory` WHERE `id`=$id";
                $prevResult3 = $conn->query($prevQuery3);
                
                if($prevResult3->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `inventory` SET `qty`='$qty' WHERE `id`=$id");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                    header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                 
                    $conn->query("INSERT INTO `inventory`(`med_no`, `qty`,`expiry_date`) VALUES ('$medno','$qty','$expirydate')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
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
       	$query1		= "SELECT tblbarangay.username as busername ,tblbarangay.bar_no as barno,tblbarangay.barangayname as barangayname,tbl_users.username as username, tbl_users.user_type as user_type,tbl_users.avatar FROM `tbl_users` LEFT JOIN tblbarangay on tbl_users.bar_no=tblbarangay.bar_no WHERE tbl_users.username='$clerkusername' AND tbl_users.password='$hashcur' AND tblbarangay.med_excel_file='$excelfile' ";
		$clerk_results 	= $conn->query($query1);
		if(mysqli_num_rows($clerk_results) == 1){
		    
		    
		       $excelfile=date("Ymdhis");

        $wquery 		= "UPDATE `tblbarangay` SET `med_excel_file`='$excelfile' WHERE `username`='$busername'";	
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
$id=$line[0];
$qty= $line[1];
$expirydate= $line[2];
$date_updated= $line[3];
$medno= $line[4];
$bar_no= $line[5];
$med_name= $line[6];
$measurement= $line[7];
$description= $line[8];
$sku= $line[9];
$category_id= $line[10];
$categoryname=$line[11];
$typeid=$line[12];
$typename=$line[13];
                
                
                
                  // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM `med_category` WHERE `category_id`=$category_id ";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `med_category` SET `category_name`='$categoryname' WHERE `category_id`=$category_id ");

                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database

                    $conn->query("INSERT INTO `med_category`(`category_id`,`bar_no`, `category_name`) VALUES ('$category_id','$bar_no','$categoryname')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");
                }


                // Check whether member already exists in the database with the same id
                $prevQuery1 = "SELECT * FROM `type_list` WHERE `type_id`=$typeid";
                $prevResult1 = $conn->query($prevQuery1);
                
                if($prevResult1->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `type_list` SET `type_name`='$typename' WHERE `type_id`=$typeid");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                  
                    $conn->query("INSERT INTO `type_list`(`type_id`,`bar_no`, `type_name`) VALUES ('$typeid','$bar_no','$typename')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
                }
                
                  // Check whether member already exists in the database with the same id
                $prevQuery2 = "SELECT * FROM `tblmedicine` WHERE `med_no`=$medno";
                $prevResult2 = $conn->query($prevQuery2);
                
                if($prevResult2->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `tblmedicine` SET `med_name`='$med_name',`measurement`='$measurement',`description`='$description',`category_id`='$category_id',`type_id`='$typeid',`sku`='$sku' WHERE `med_no`=$medno");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                     header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                   
                    $conn->query("INSERT INTO `tblmedicine`(`bar_no`, `med_name`, `measurement`, `description`, `category_id`, `type_id`, `sku`) VALUES ('$barno','$med_name','$measurement','$description','$category_id','$typeid','$sku')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
                }
                
                
                
                    // Check whether member already exists in the database with the same id
                $prevQuery3 = "SELECT * FROM `inventory` WHERE `id`=$id";
                $prevResult3 = $conn->query($prevQuery3);
                
                if($prevResult3->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `inventory` SET `qty`='$qty' WHERE `id`=$id");
                    $_SESSION['message'] = 'Imported Succesfully';
                    $_SESSION['success'] = 'success';
                    header("Location: ../medicine.php");
                }else{
                    // Insert member data in the database
                 
                    $conn->query("INSERT INTO `inventory`(`med_no`, `qty`,`expiry_date`) VALUES ('$medno','$qty','$expirydate')");

$_SESSION['message'] = 'Imported Succesfully';
$_SESSION['success'] = 'success';
 header("Location: ../medicine.php");

   
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
    header("Location: ../medicine.php");
		}


}

}
