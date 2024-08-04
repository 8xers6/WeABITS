<?php include 'server/server.php' ?>
<?php


$resid  = $conn->real_escape_string($_GET['resid']);

$reqno  = $conn->real_escape_string($_GET['req_no']);
$barno=$_SESSION['bar_no'];

	$query1 = "SELECT * FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tbl_residents.bar_no=$barno AND tblrequested_documents.req_no=$reqno";
    $result1 = $conn->query($query1);
	$detail = $result1->fetch_assoc();


 



	$query2 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
    $result2 = $conn->query($query2);
	$resident = $result2->fetch_assoc();

  



  
   


?>


<?php   ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Details -  Barangay Management System</title>
    
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold"><button type="button" class="btn btn-primary shadow-sm fw-bold border "  onclick="goBack()">Go back</button></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">

                <div class="row ">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								
								<div class="card-body" >

        


               
                            <div class="row p-3 pt-1 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 ">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Request Details</b></h2>
                                        
                                        
                                   
                                        </div>
        
                                    
                                    
                                       
        
                            </div>



                            <div class="row    pb-3 pt-1 bg-white  justify-content-center">
                                 <div class="col-md-5 m-1  pb-2 border rounded shadow-sm">

                                    <?php if(isset($_SESSION['username'])):?>
                                        <!---
                                    <div class="form-group d-flex justify-content-center " >
                                        <button type="button" class="btn btn-primary btn-sm mr-2" id="open_cam1"><i class="fas fa-camera"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2 fw-bold" onclick="save_photo1()">Capture</button>   
                                    </div>
                                    ----->
                                  
                                    <div class="form-group  text-center" >
                                        
                                        
                                        
                                        
                                        
                                        <?php
                                         if($detail['status']=='processing' || $detail['status']=='released' || $detail['status']=='pending' || $detail['status']=='completed'  ){
                                        
                                        if($detail['certificate']=='Barangay Clearance'){
                                        
                                        
                                              $sql2="SELECT * FROM `tbl_barangayclearance` WHERE `req_no`=$reqno";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
   
   
   echo '  <a href="generate_brgy_certs.php?id='.$resid.'&reqno='.$reqno.'" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Certificate is ready to print
											</a>';

}else{
    
     echo '  <a href="#addbarangayclerance" data-toggle="modal" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											   Create '.$detail['certificate'].'
											</a>';
    
}
                                        
                                        
                                        
                                        
                                        
                                        }elseif($detail['certificate']=='Certificate of Indigency'){
                                            
                                            
                                                                           $sql2="SELECT * FROM `tbl_indigency` WHERE `req_no`=$reqno";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
    
    
    
									 $jsonobj =  $detail['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                    $residente= $obj->resid;
                                                                
                                                                 
   
   
   echo '  <a href="generate_indigency_cert.php?id='.$residente.'&reqno='.$reqno.'" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Certificate is ready to print
											</a>';

}else{
    
    
     echo '
     <a href="#indigency" data-toggle="modal" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Create '.$detail['certificate'].'
											</a>
											';
    
  
    
}
                                            
                                        
                                        }elseif($detail['certificate']=='Building Clearance'){
                                            
                                            
                                                                           $sql2="SELECT * FROM `tblbuilding_permit` WHERE `req_no`=$reqno";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
   
   
   echo '  <a href="generate_buildingpermit.php?id='.$resident['res_id'].'&reqno='.$reqno.'" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Certificate is ready to print
											</a>';

}else{
    
     echo '
     <a href="#buildingclearance" data-toggle="modal" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Create '.$detail['certificate'].'
											</a>
											';
    
}
                                            
                                        
                                        }elseif($detail['certificate']=='Business Clearance'){
                                            
                                            
                                                                           $sql2="SELECT * FROM `tblbusinesspermit` WHERE `req_no`=$reqno";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
   
   
   echo '  <a href="generate_business_permit.php?id='.$resident['res_id'].'&reqno='.$reqno.'" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Certificate is ready to print
											</a>';

}else{
    
     echo '
     <a href="#businessclearance" data-toggle="modal" class="btn btn-success form-control fw-bold ">
												<i class="fas fa-file-alt"></i>
											  Create '.$detail['certificate'].'
											</a>
											';
    
}
                                            
                                        
                                        }
                                        
                                        
                                         }
                                        
                                        
                                        ?> 
                                        
                            
                                        
                                         <?php if($detail['status']=='pending'|| $detail['status']=='processing' ): ?>
                                        
                                        
                                    
                                        <a href="#cancelrequest" data-toggle="modal" class="mt-2 btn btn-danger form-control fw-bold ">
											
											Cancel Request
											</a> 
                                               <?php  endif ?>  
                                               
                                                 <?php if($detail['status']=='released' ): ?>
                                        
                                        
                                    
                                        <a href="model/transactioncomplete.php?resid=<?= $detail['res_id'] ?>&reqno=<?= $detail['req_no'] ?>&cert=<?= $detail['certificate'] ?>"  class="mt-2 btn btn-primary form-control fw-bold " onclick="return confirm('Are you sure you want to finish this transaction');">
											Finish Transaction
											
											</a> 
                                               <?php  endif ?> 
                                                    
											
									
                                    
                                    </div>

   <div class="col-md-12  pb-2 pt-2 border rounded shadow-sm">
                                                            <h4 class=" fw-bold">Request No: <?= ucwords($detail['req_no']) ?></h4>

                                                             
                                                    </div>
                                                     <div class="col-md-12  pb-2 pt-2 border rounded shadow-sm">
                                                            <h4 class=" fw-bold">Request Date: 
                                                            <?php $str = $detail['req_date']; $date = date('F j, Y', strtotime($str)); echo $date; ?>
                                                            </h4>

                                                             
                                                    </div>
                                                    
                                                       <div class="col-md-12 mt-2 pb-3 pt-3 border rounded shadow-sm">

                                                            <h4 class=" fw-bold"><?= ucwords($detail['certificate']) ?></h4>
                                                          

                                                    </div>
                                                    
                                                    
                                                    
                                                        <div class="col-md-12 mt-2 pb-3 pt-3 border rounded shadow-sm">

                                                        <h4 class=" fw-bold">Status: <?php 
                                                        
                                                        
                if($detail['status']=='pending'){
                    
                    
             $queryst="UPDATE `tblrequested_documents` SET `status`='processing' WHERE `req_no`=$reqno;";
            $resultst = $conn->query($queryst);
            
            
            if($resultst==true){
                
                 echo '	<span class="badge badge-warning fw-bold" style="font-size:13px;">Processing</span>';
                         
            }
                    
                    
                }
                                                        
                                                     
               
                 if($detail['status']=='processing'){
                     
                     echo '	<span class="badge badge-warning fw-bold" style="font-size:13px;">Processing</span>';
                    
                }elseif($detail['status']=='released'){
                    echo '<span class="badge badge-success fw-bold" style="font-size:13px;">Released</span>';
                    
                }elseif($detail['status']=='completed'){
                    echo'	<span class="badge badge-primary fw-bold"style="font-size:13px;">Completed</span>
';
                    
                    
                }elseif($detail['status']=='cancelled'){
                    echo' <span class="badge " style="background:gray; color:white;">Cancelled</span>';
                    
                    
                }
            
            
          
          
  
                                                        
                                                        ?>
													
																

															
															
															
													</h4>


                                                        </div>
                                                        
                                                        
                                                          <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Amount:  <b style="font-weight: bold;">&#8369 </b> <?= ucwords($detail['amount']) ?></h3>
                                                           
                                                             

                                                    </div>


                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Purpose & Detail: </h3>
                                                    <h4 class="">
                                                        
                                                        
                                                        		
														<?php 
														
														
														if($detail['certificate']=='Business Clearance'){
														    
														      
															   $jsonobj =  $detail['purpose'];

                                                                    $business = json_decode($jsonobj);
                                                         
														      
														     echo 'Business Name: '.$business->nbusiness.'<br>';
														     echo 'Request Type: '.$business->type.'<br>';
														      echo 'Business Nature: '.$business->bnature.'<br>';
														      
														       echo 'Nature of Business Ownership: '.$business->natureBo.'<br>';
														        echo 'DIT No.: '.$business->dtino.'<br>';
														         echo 'Business Address: '.$business->businessadd.'<br>';
														          echo 'Business Phone#: '.$business->bphone;
														           
														           
														  
														      
														}elseif($detail['certificate']=='Certificate of Indigency'){
														    
														   $jsonobj =  $detail['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    $target= $obj->resid;
                                                                
                                                                    $querytarget = "SELECT * FROM tbl_residents WHERE res_id='$target' AND bar_no=$barno";
                                                                        $result_target = $conn->query($querytarget);
                                                                    	$resident_target = $result_target->fetch_assoc();
                                                                    	
                            echo 'Requested for: <b>'.$resident_target['firstname'].' '.$resident_target['middlename'].' '.$resident_target['lastname'].' '.$resident_target['suffix'].'</b><br>';
                             echo 'Relation: <b>'.$resident_target['relation'].'</b><br>';
                                                                   echo 'Purpose: <b>'.$obj->purpose.'</b>';
                                                                   
														    
														}elseif($detail['certificate']=='Barangay Clearance'){
														      $jsonobj =  $detail['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    echo 'Purpose: <b>'.$obj->purpose.'</b>';
														     
														     
														     
														     
														}elseif($detail['certificate']=='Building Clearance'){
														     $jsonobj =  $detail['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    echo 'House#: <b>'.$obj->houseno.'</b><br>';
                                                                    echo 'Street: <b>'.$obj->street.'</b>';
														}
														
													/*
                                                    
                                                    $arr_string = explode(",",$detail['purpose'], 7);

                                                    foreach($arr_string as $str){
                                                        echo $str . "<br />";
                                                    }*/
                                                    
                                                    
                                                   ?>
                                                    </h4>
                                                           
                                                             

                                                    </div>
                                                 <?php if($detail['certificate']!='Certificate of Indigency'): ?>
  <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Payment Method: <?= ucwords($detail['paymentmethod']) ?></h3>
                                                           
                                                             

                                                    </div>
                                                    
                                                      <?php if($detail['paymentmethod']=='GCash'): ?>
                                                      <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm ">
                                                    <h3  class=" fw-bold">Gcash Receipt(Screenshot): </h3>
                                                    <?php if(!empty($detail['greceipt_screenshot'])): ?>

<img src="<?= preg_match('/data:image/i',$detail['greceipt_screenshot']) ?  $detail['greceipt_screenshot'] : "assets/uploads/".$_SESSION['username']."/resident/".$detail['res_id']."/". $detail['greceipt_screenshot'] ?>" alt="..." class="img-fluid" >

<?php else: ?>
<img src="assets/img/person.png" alt="..." class="avatar-img  " style="position: relative; top:40px; width:200px; height:130px; border-radius:70px; border:solid gray 1px; ">
<?php endif ?> 
                                                             

                                                    </div>

	    
															<?php endif ?>

															    
															<?php endif ?>


                                                           
                                                           
                                                             



                                 




               

                                    </div>	<?php endif ?>

                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm ">
                                                   


 

                                               
                                                



                                                            <?php if($detail['certificate']!='Certificate of Indigency'): ?>
                                                  

                                                        <?php if($detail['paymentmethod']=='GCash'): ?>
                                                  
                                                    <?php endif ?> 
                                                    <?php endif ?> 





                                                    
                                                    <?php if($detail['certificate']=='Barangay Clearance' || $detail['certificate']=='Business Permit' ||$detail['certificate']=='Building Permit'): ?>
                                             
                                                    <?php endif ?>   
                                                    <?php if($detail['certificate']=='Business Clearance'): ?>
                                                 
                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm ">
                                                    <h3  class=" fw-bold">Business Picture: </h3>
                                                 

<img src="<?="assets/uploads/".$_SESSION['username']."/resident/".$detail['res_id']."/".$business->image ?>" alt="..." class="img-fluid rounded avatar-img" >

                                                             

                                                    </div>
                                                
                                         
                                                    <?php endif ?> 


                                                    <?php if($detail['certificate']=='Barangay Clearance'): ?> 
                                                    
                                                    
                                                         
                      
                                                    
                                             
                                                    
                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm  ">
                                                    <h3  class=" fw-bold">Resident Picture: </h3>
                                                 

<img src="<?="assets/uploads/".$_SESSION['username']."/resident/".$detail['res_id']."/".$obj->image ?>" alt="..." class="img-fluid rounded"  >
 <a href="<?="assets/uploads/".$_SESSION['username']."/resident/".$detail['res_id']."/".$obj->image ?>" download class="btn btn-primary m-1">
                                                   
  Download Image
</a>



                                             
                                                    
                                                   
                                                    <?php endif ?> 
                                 
    

                                  
                                   

                                   

                            </div>
                            
                       
                            </div>
                                     
                                        
  

                              
                 
                                                   

								</div>
							</div>
						</div>
					</div>
                    
				
				
					
				</div>
			</div>



            <!-- Modal -->
            <div class="modal fade" id="cancelrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancel Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_reqstatus.php" >
                                
                                
                                
                       
									<input type="hidden" class="form-control"  value="<?=$detail['certificate']?>" name="certificate" required>
									<input type="hidden" class="form-control"  value="<?=$resident['res_id']?>" name="resid" required>
									
										<input type="hidden" class="form-control"  value="<?=$detail['req_no']?>" name="reqno" required>
							
                         
                                <div class="form-group">
                                    <label>Reason to Cancel</label>
                                    <textarea class="form-control" placeholder="Enter Reason" name="reason" required></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary" 	onclick="return confirm('Are you sure you want to cancel this request?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
               <!-- Modal -->
            <div class="modal fade" id="indigency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Ceritifcate of Indigency </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/printcertificate.php" >
                                
                                
                                
                       
									<div class="form-group">
	    
								<label>Requested for: </label>
									<input type="hidden" class="form-control"  value="<?=$detail['certificate']?>" name="state" required>
									<input type="hidden" class="form-control"  value="<?php 
									 $jsonobj =  $detail['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                echo $obj->resid;
                                                                
                                                                  ?>" name="resid" required>
									
										<input type="hidden" class="form-control"  value="<?=$detail['req_no']?>" name="reqno" required>
<input type="text" class="form-control fw-bold" readonly style="color:black;"  value="<?php 
									 $jsonobj =  $detail['purpose'];
                                     $obj = json_decode($jsonobj);
                                     $target1= $obj->resid;
                                                                    $querytarget1 = "SELECT * FROM tbl_residents WHERE res_id='$target1' AND bar_no=$barno";
                                                                        $result_target1 = $conn->query($querytarget1);
                                                                    	$resident_target1 = $result_target1->fetch_assoc();
                                                                    	
                            echo $resident_target1['firstname'].' '.$resident_target1['middlename'].' '.$resident_target1['lastname'].' '.$resident_target1['suffix'];
                
									?>"  required>
										</div>
							
                         	<div class="form-group">
								<label>Purpose</label>
								<input type="text" class="form-control" name="purpose" value="<?php 
									
								
                                                    
                                                                   echo $obj->purpose;
									
									
									
									?>"  required>
										</div>
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary" 	onclick="return confirm('Are you sure you want to proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


	<!-- Modal -->
            <div class="modal fade" id="addbarangayclerance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Barangay Clearance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/printcertificate.php" autocomplete="off"   enctype="multipart/form-data">





	<div class="form-group">
	    
								<label>Full Name</label>
									<input type="hidden" class="form-control"  value="<?=$detail['certificate']?>" name="state" required>
									<input type="hidden" class="form-control"  value="<?=$resident['res_id']?>" name="resid" required>
									
										<input type="hidden" class="form-control"  value="<?=$detail['req_no']?>" name="reqno" required>
								<input type="text" class="form-control fw-bold" readonly style="color:black;"  value="<?=$resident['firstname']?> <?=$resident['middlename']?> <?=$resident['lastname']?><?=$resident['suffix']?>"  required>
										</div>

										
							<div class="form-group">
                                    <label>OR No.</label>

								
															<input type="number" class="form-control" name="orno" min="1"  required>
															


                                </div>


								<div class="form-group">
                                    <label>CTC No.</label>


									<input type="number" class="form-control" name="ctcno" min="1"  required>


                                </div>
                             

								
								

							


                              

								<div class="form-group">
								<label>Purpose</label>
								<input type="text" class="form-control" name="purpose" value="<?=$obj->purpose?>"  required>
										</div>
										
											<div class="form-group">
								<label>Amount</label>
								<input type="number" class="form-control fw-bold " style="color:black;" name="amount"  value="<?=$detail['amount']?>" readonly  required>
										</div>
										<div class="form-group">
								<label>Resident Image</label>
								
								<input type="file" class="form-control" name="respic"  accept="image/*"  required>

										</div>
									

								


								
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary" 	onclick="return confirm('Are you sure you want to proceed?');">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            
            	<!-- Modal -->
            <div class="modal fade" id="buildingclearance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Building Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/printcertificate.php" >
                               
                               
                               
                               	<div class="form-group">
	    
								<label>Full Name</label>
									<input type="hidden" class="form-control"  value="<?=$detail['certificate']?>" name="state" required>
									<input type="hidden" class="form-control"  value="<?=$resident['res_id']?>" name="resid" required>
									
										<input type="hidden" class="form-control"  value="<?=$detail['req_no']?>" name="reqno" required>
								<input type="text" class="form-control fw-bold" readonly style="color:black;"  value="<?=$resident['firstname']?> <?=$resident['middlename']?> <?=$resident['lastname']?><?=$resident['suffix']?>"  required>
										</div>
                              
								

								<div class="form-group">
                                    <label>House No.</label>
                                    <input type="text" class="form-control" name="bhouseno" value="<?=$obj->houseno?>" placeholder="Enter House No." required>
                                </div>

								<div class="form-group">
                                    <label>Street</label>
                                    <input type="text" class="form-control" name="bstreet" value="<?=$obj->street?>" placeholder="Enter House No." required>
							         
                                </div>
								<div class="form-group">
                                    <label>OR No.</label>


						 <input type="number" class="form-control" placeholder="Enter OR No." name="orno" required>


                                </div>
								<div class="form-group">
                                    <label>CTC No.</label>
                                    <input type="number" min="0" class="form-control" placeholder="Enter CTC No." name="ctcno" required>
                                </div>
	<div class="form-group">
                                    <label>Amount</label>
                                   	<input type="number" class="form-control fw-bold " style="color:black;" name="amount"  value="<?=$detail['amount']?>" readonly  required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied </label>
                                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary" 	onclick="return confirm('Are you sure you want to proceed?');">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            	<!-- Modal -->
            <div class="modal fade" id="businessclearance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/printcertificate.php" >
							<input type="hidden" name="size" value="1000000">
							
							
							 	<div class="form-group">
	    
								<label>Business Owner Name</label>
									<input type="hidden" class="form-control"  value="<?=$detail['certificate']?>" name="state" required>
									<input type="hidden" class="form-control"  value="<?=$resident['res_id']?>" name="resid" required>
									
										<input type="hidden" class="form-control"  value="<?=$detail['req_no']?>" name="reqno" required>
								<input type="text" class="form-control fw-bold" readonly style="color:black;"  value="<?=$resident['firstname']?> <?=$resident['middlename']?> <?=$resident['lastname']?><?=$resident['suffix']?>"  required>
										</div>
										
										
											<div class="form-group">
                                    <label>OR No.</label>

									<input type="number" class="form-control" placeholder="Enter OR No."name="orno" required>
						


                                </div>
								
								<div class="form-group">
                                    <label>CTC No.</label>


									<input type="number" class="form-control" name="ctcno" placeholder="Enter CTC NO" min="1"  required>


                                </div>
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Business Name" name="bname" value="<?=$business->nbusiness ?>" required>
                                </div>
								


								

								<div class="form-group">
                                    <label>Business Nature</label>
                                    <input type="text" value="<?=$business->bnature ?>"  class="form-control" placeholder="Sari-Sari Store/Warter Refill Station" name="nature" required>
                                </div>
								<div class="form-group">
								<label> Nature of Business Ownership</label>
								<input type="text" class="form-control" placeholder="Enter Business Name" name="natureBO" value="<?=$business->natureBo ?>" required>
							</div>
						


								<div class="form-group">
                                    <label>Business  Location</label>
                                   	<input type="text" class="form-control" placeholder="Enter Business Name" name="bstreet" value="<?=$business->businessadd ?>" required>
                                </div>

								<div class="form-group">
							<label>SEC/ DTI Registration Number</label>
							
                                                    <input type="number" value="<?=$business->dtino ?>"  min="1" class="form-control" placeholder="Enter SEC/ DTI Registration Number" name="dtino" required >

						    </div>
								<div class="form-group">
                                    <label>Business Contact No.</label>
                                    <input type="number" value="<?=$business->bphone ?>" class="form-control" placeholder="Enter Business Contact No." name="bcontact" required>
                                </div>

							
                                
                                  	<div class="form-group">
                                    <label>Amount.</label>
                                    <input type="number" name="amount" value="<?=$detail['amount'] ?>" class="form-control" placeholder="Enter Amount"   required>
                                </div>

							

							
                            
                        </div>
                        <div class="modal-footer">
                        
                            <button type="submit" class="btn btn-primary" 	onclick="return confirm('Are you sure you want to proceed?');">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


    

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>

