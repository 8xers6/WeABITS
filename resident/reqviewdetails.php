<?php include 'server/server.php' ?>
<?php


$resid  = $_SESSION['resid'];

$reqno  = $conn->real_escape_string($_POST['req_no']);
$barno=$_SESSION['barno'];

	$query1 = "SELECT * FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tbl_residents.bar_no=$barno AND tblrequested_documents.req_no=$reqno";
    $result1 = $conn->query($query1);
	$detail = $result1->fetch_assoc();




	$query2 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
    $result2 = $conn->query($query2);
	$resident = $result2->fetch_assoc();

  


   


?>


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

                <div class="row mt--2">
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
                                    
                                    
                                    <div class="form-group  text-left " >
                                      	<?php if($detail['status']=='processing'): ?>
                                      	
                                      	<h1>Note!:</h1>
                                      	
                                      	<h4 style="color:green;">Please visit barangay hall to process your certificate</h4>
                                        <h4 style="color:green;">Monday-Friday 8:00am - 5:00pm</h4>
                                      	
                                      	<?php endif ?>
                                      	
                                      	
                                      	<?php if($detail['status']=='pending'): ?>
                                      	<!----
                                    <a href="model/cancelrequest.php?reqno=<?=$detail['req_no']?>"  onclick="return confirm('Are you sure you want to cancel this request');" class="btn btn-danger form-control fw-bold ">
											
											  Cancel Request
											</a>
                                      --->
                                      	
                                      	<?php endif ?>
                                 
                                    </div>

   <div class="col-md-12  pb-2 pt-2 border rounded shadow-sm">
                                                            <h4 class=" fw-bold">Request No: <?= ucwords($detail['req_no']) ?></h4>

                                                             
                                                    </div>
                                                    
                                                       <div class="col-md-12 mt-2 pb-3 pt-3 border rounded shadow-sm">

                                                            <h4 class=" fw-bold"><?= ucwords($detail['certificate']) ?></h4>
                                                          

                                                    </div>
                                                    
                                                    
                                                    
                                                        <div class="col-md-12 mt-2 pb-3 pt-3 border rounded shadow-sm">

                                                        <h4 class=" fw-bold">Status: <?php if($detail['status']=='pending'): ?>
																<span class="badge badge-danger fw-bold" style="font-size:13px;">Pending</span>
															<?php elseif($detail['status']=='processing'): ?>
																<span class="badge badge-warning fw-bold" style="font-size:13px;">Processing</span>
											
															<?php elseif($detail['status']=='released'): ?>
																<span class="badge badge-success fw-bold" style="font-size:13px;">For Release</span>

																<?php elseif($detail['status']=='completed'): ?>
																<span class="badge badge-primary fw-bold"style="font-size:13px;">Completed</span>

                                                                <?php elseif($detail['status']=='cancelled'): ?>
                                                                    <span class="badge " style="background:gray; color:white;">Cancelled</span>
															
															
															<?php else: ?>
																<span class="badge badge-secondary fw-bold" style="font-size:13px;">Received</span>
															<?php endif ?></h4>


                                                        </div>
                                                        
                                                        
                                                          <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Amount:  <b style="font-weight: bold;">&#8369 </b> <?= ucwords($detail['amount']) ?></h3>
                                                           
                                                             

                                                    </div>


                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Purpose & Detail: </h3>
                                                    <h4 class="fw-bold">	<?php 
														
														
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
                                                    
                                                    
                                                   ?></h4>
                                                           
                                                             

                                                    </div>
                                                 <?php if($detail['certificate']!='Certificate of Indigency'): ?>
  <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">Payment Method: <?= ucwords($detail['paymentmethod']) ?></h3>
                                                           
                                                             

                                                    </div>
                                                    
                                                      <?php if($detail['paymentmethod']=='GCash'): ?>
                                                      <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm ">
                                                    <h3  class=" fw-bold">Gcash Receipt(Screenshot): </h3>
                                                    <?php if(!empty($detail['greceipt_screenshot'])): ?>

<img src="<?= preg_match('/data:image/i',$detail['greceipt_screenshot']) ?  $detail['greceipt_screenshot'] : "../assets/uploads/".$busername."/resident/".$detail['res_id']."/". $detail['greceipt_screenshot'] ?>" alt="..." class="img-fluid" >

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
                                                                                   <h3  class=" fw-bold">Business Picture: </h3>
                                                 

<img src="<?="../assets/uploads/".$busername."/resident/".$detail['res_id']."/".$business->image ?>" alt="..." class=" " height="500" width="100%" >
                                                    <?php endif ?> 


                                                    <?php if($detail['certificate']=='Barangay Clearance'): ?>
                                                     <h3  class=" fw-bold">Resident Picture: </h3>
<img src="<?="../assets/uploads/".$busername."/resident/".$detail['res_id']."/".$obj->image ?>" alt="..." class="img-fluid rounded"  >
                                                    <?php endif ?> 
                                 


                                  
                                   

                                   

                            </div>
                            </div>
                                     
                                        


                              
                 
                                                   

								</div>
							</div>
						</div>
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

