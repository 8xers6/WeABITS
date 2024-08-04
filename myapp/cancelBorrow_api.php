
<?php include 'serverapi/server_api.php'  ?>
<?php 
	
    
	
	$borno= $conn->real_escape_string($_POST['borno']);
  


	
	

		if(!empty($borno)){

			


				$query="UPDATE `tblborrow` SET `status`='cancelled' WHERE `bor_no`=$borno";

			    
				
				if($conn->query($query) === true){

				    echo json_encode(array("success"=>true));

				}

			}else{

		
		}
	
  

	$conn->close();

