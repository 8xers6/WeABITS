<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    
	$barno=$_SESSION['bar_no'];
	$borno		= $conn->real_escape_string($_POST['bor_no']);
	$id		= $conn->real_escape_string($_POST['resid']);
	$equipno		= $conn->real_escape_string($_POST['equip_no']);


	$quantity  = $conn->real_escape_string($_POST['quantity']);
	$curr_status  = $conn->real_escape_string($_POST['curr_status']);
    $borstatus  = $conn->real_escape_string($_POST['borstatus']);


	
	

		if(!empty($borno) && !empty($borstatus)){

			       

			$query1 = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno AND equip_no=$equipno";
            $result1 = $conn->query($query1);
            $row = $result1->fetch_assoc();
        
            if($row){
            
                $qty 		= $row['quantity'];
                $equipment 		= $row['equipment_name'];
            }

			
		
                     //current status is pending 
              if($curr_status=='pending'){
                     
				
				if($qty==0){

					$_SESSION['message'] = 'Request No.'.$borno. ' cannot be approved the equipment are not available! ';
					$_SESSION['success'] = 'danger';

					header("Location: ../borrowed_item.php");

				}else{
					if($quantity>$qty){

						$_SESSION['message'] = 'Request No.'.$borno. ' cannot be approved the equipment request have a higher quantity than the inventory';
						$_SESSION['success'] = 'danger';
		
						header("Location: ../borrowed_item.php");
					 }else{

				if($borstatus=='cancelled'){



					$query="UPDATE `tblborrow` SET `status`='$borstatus' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){



						$notifname=$equipment;
						$notiftype='borrow';
						$usertype='Resident';
						$message='Your Request has been cancelled';
		 
						 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
						 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
						$result1  = $conn->query($insert1);


	
						$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
						$_SESSION['success'] = 'success';
	
						header("Location: ../borrowed_item.php");
					}


				} 

				if($borstatus=='approved'){



					$query="UPDATE `tblborrow` SET `status`='$borstatus' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){
						$query="UPDATE `tblequipments` SET `quantity`=quantity-$quantity WHERE `equip_no`=$equipno";

						if($conn->query($query) === true){


							$notifname=$equipment;
							$notiftype='borrow';
							$usertype='Resident';
							$message='Your Request has been Approved';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);



	
							$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
							$_SESSION['success'] = 'success';
		
							header("Location: ../borrowed_item.php");
						}
						      
					}


				}

			}
		}

			  }

                
              //when current status is approved
			  if($curr_status=='approved'){


				if($borstatus=='cancelled'){



					$query="UPDATE `tblborrow` SET `status`='$borstatus', `date_received`='0000-00-00' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){
	
						     
						$query="UPDATE `tblequipments` SET `quantity`=quantity + $quantity WHERE `equip_no`=$equipno";

						if($conn->query($query) === true){
	
							$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
							$_SESSION['success'] = 'success';
		
							header("Location: ../borrowed_item.php");
						}
					}


				}

				if($borstatus=='pending'){



					$query="UPDATE `tblborrow` SET `status`='$borstatus' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){
	
						     
						$query="UPDATE `tblequipments` SET `quantity`=quantity + $quantity WHERE `equip_no`=$equipno";

						if($conn->query($query) === true){
	
							$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
							$_SESSION['success'] = 'success';
		
							header("Location: ../borrowed_item.php");
						}
					}


				} 

				if($borstatus=='borrowed'){

					$datenow=date("Y-m-d h:i:s");

					$query="UPDATE `tblborrow` SET `status`='$borstatus',`date_received`='$datenow' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){


						$notifname=$equipment;
						$notiftype='borrow';
						$usertype='Resident';
						$message='Your Request status has been updated Borrowed';
		 
						 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
						 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
						$result1  = $conn->query($insert1);
					         
						$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
						$_SESSION['success'] = 'success';
	
						header("Location: ../borrowed_item.php");
						      
					}


				}



			  }

                 
                  //current status is borrowed
			  if($curr_status=='borrowed'){
                    

				if($borstatus=='approved'){

				

					$query="UPDATE `tblborrow` SET `status`='$borstatus', `date_received`='0000-00-00'  WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){

						
	
						$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
						$_SESSION['success'] = 'success';
	
						header("Location: ../borrowed_item.php");
					}


				} 

				if($borstatus=='returned'){


					$datenow=date("Y-m-d h:i:s");
					$query="UPDATE `tblborrow` SET `status`='$borstatus',`date_return`='$datenow' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){
						$query="UPDATE `tblequipments` SET `quantity`=quantity+$quantity WHERE `equip_no`=$equipno";

						if($conn->query($query) === true){

							$notifname=$equipment;
							$notiftype='borrow';
							$usertype='Resident';
							$message='Your Request successfully returned to Barangay';
			 
							 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
							 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
							$result1  = $conn->query($insert1);
	
							$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
							$_SESSION['success'] = 'success';
		
							header("Location: ../borrowed_item.php");
						}
						      
					}


				}



			  }


			   //current status is returned
			   if($curr_status=='returned'){


				if($borstatus=='borrowed'){

					$datenow=date("Y-m-d h:i:s");

					$query="UPDATE `tblborrow` SET `status`='$borstatus',`date_return`='0000-00-00' WHERE `bor_no`=$borno;";

			    
				
					if($conn->query($query) === true){
	
						$query="UPDATE `tblequipments` SET `quantity`=quantity-$quantity WHERE `equip_no`=$equipno";

						if($conn->query($query) === true){
	
							$_SESSION['message'] = 'Request No.'.$borno. ' status has been Updated to '.$borstatus;
							$_SESSION['success'] = 'success';
		
							header("Location: ../borrowed_item.php");
						}
					}


				} 




			  }





		

				

		}else{

			$_SESSION['message'] = 'Please Select Status';
			$_SESSION['success'] = 'danger';
            header("Location: ../borrowed_item.php");
		}
	
  

	$conn->close();

