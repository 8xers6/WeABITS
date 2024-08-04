
<?php include 'serverapi/server_api.php'  ?>
<?php 
	

    $username 	= $conn->real_escape_string($_POST['username']);
 
    $new_pass	= $conn->real_escape_string($_POST['new_pass']);
   





            
            $hash= hash("sha256",$new_pass);
           

              
                $query 		= "UPDATE tbl_residents SET `password`='$hash' WHERE username='$username'";	
                $result 	= $conn->query($query);

                if($result === true){
                    
                    echo json_encode(array("successpass"=>true));

                }else{

                    echo json_encode(array("successpass"=>false));
                }
            

       

        
	$conn->close();
    ?>