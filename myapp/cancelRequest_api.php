

<?php include 'serverapi/server_api.php'  ?>
<?php 
	

	$reqno		= $conn->real_escape_string($_POST['reqno']);

	
	

		if(!empty($reqno)){

			


				$query="UPDATE `tblrequested_documents` SET `status`='cancelled'  WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){

                    echo json_encode(array("success"=>true));

              
				}

			}else{
                echo json_encode(array("success"=>false));
	
		}
	
  

	$conn->close();