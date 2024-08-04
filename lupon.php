<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM `tblblotter` WHERE bar_no=$barno AND department='lupon'";
    $result = $conn->query($query);

    $blotter = array();
	while($row = $result->fetch_assoc()){
		$blotter[] = $row; 
	}

	$query1 = "SELECT * FROM `tblblotter`  WHERE `status`='pending' AND bar_no=$barno AND department='lupon'";
    $result1 = $conn->query($query1);
	$active = $result1->num_rows;

	$query2 = "SELECT * FROM `tblblotter` WHERE `status`='Scheduled' AND bar_no=$barno AND department='lupon'";
    $result2 = $conn->query($query2);
	$scheduled = $result2->num_rows;

	$query3 = "SELECT * FROM `tblblotter` WHERE `status`='Settled' AND bar_no=$barno AND department='lupon'";
    $result3 = $conn->query($query3);
	$settled = $result3->num_rows;
	
	
		$query4 = "SELECT * FROM `tblblotter` WHERE `status`='cfa' AND bar_no=$barno AND department='lupon'";
    $result4 = $conn->query($query4);
	$cfa = $result4->num_rows;
	
	
	
		$query5 = "SELECT * FROM `tblblotter` WHERE `status`='dismissed' AND bar_no=$barno AND department='lupon'";
    $result5 = $conn->query($query5);
	$dismissed= $result5->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Blotter/Incident Complaint -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Blotter-Lupon ng Tagapamayapa</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
				<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row mt--2">
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Blotter/Incident</div>
									 <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='pno'): ?>
											<div class="card-tools">
											  
												<a href="blotter_archived"  class="btn btn-primary">
													
													Archived
												</a>
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="blottertable" class="display table table-striped">
											<thead>
												<tr>
												      <th scope="col">Blotter No.</th>
													
													<th scope="col">Complainant<sup>(type)</sup> </th>
													<th scope="col">Respondent<sup>(type)</sup> </th>
										
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
														<th scope="col">Amount</th>
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($blotter)): ?>
													<?php foreach($blotter as $row): ?>
													<tr>
													<td><?= ucwords($row['id']) ?></td>
										
	   <?php
										                
										                $datenotice=$row['date_notice'];
										                
										                
										                $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($datenotice)) . " + 365 day"));
				
										              $datenow=date("Y-m-d");
										               
										               
										              
										                if($datenow>=$newEndingDate){
										                    $bid=$row['id'];
										                    
						$querystat="UPDATE `tblblotter` SET `status`='archive' WHERE `id`=$bid";
			    
				
				if($conn->query($querystat) === true){
				    
				    
				    
				}
										                    
										                    
										                }
										               
										               
										               
										            
										             ?>
												
													<td>
													    
													    <div style="width:250px;">
												
														       <?php if($row['complainant_type']=='Resident'): ?>
														    
														     	  <?php
									       
									          $resid=$row['complainant'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												      $clname=$rows['lastname'];
												    $cfname=$rows['firstname'];
												    $cmname=$rows['middlename'];
												    $csuffix=$rows['suffix'];
												     $cage=$rows['age'];
												      $ccontact=$rows['contact_no'];
												       $caddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														     
														     
														     
														      <sup style="color:green;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['complainant_type']=='Non-resident'): ?>
														     
														      <?php  $jsonobj =  $row['complainant'];

                                                                    $complainant = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $complainant->lastname.', '.$complainant->firstname.' '.$complainant->middlename.' '.$complainant->suffix;
                                                                      $cnlname=$complainant->lastname;
												    $cnfname=$complainant->firstname;
												    $cnmname=$complainant->middlename;
												    $cnsuffix=$complainant->suffix;
                                                                     
														    ?>
														    
														     <sup style="color:red;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>
													     
													    
													    
													    </div>
													   
													    
													    
													    
													    
													    </td>
														<td>
														    
														       <div style="width:250px;">
														    
														       <?php if($row['respondent_type']=='Resident'): ?>
														  	     	  <?php
									       
									          $resid=$row['respondent'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												    
												    
												    $rlname=$rows['lastname'];
												    $rfname=$rows['firstname'];
												    $rmname=$rows['middlename'];
												    $rsuffix=$rows['suffix'];
												    
												    $rage=$rows['age'];
												    $rcontact=$rows['contact_no'];
												     $raddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														  
														  
														  
														    <sup style="color:green;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['respondent_type']=='Non-resident'): ?>
														     <?php  $jsonobj =  $row['respondent'];

                                                                    $respondent = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $respondent->lastname.', '.$respondent->firstname.' '.$respondent->middlename.' '.$respondent->suffix;
                                                                     
                                                                     
                                                                            $rnlname=$respondent->lastname;
												    $rnfname=$respondent->firstname;
												    $rnmname=$respondent->middlename;
												    $rnsuffix=$respondent->suffix;
														    ?>
														    <sup style="color:red;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    
														       </div>
														    
														  </td>
														<td><?= ucwords($row['blotter_type']) ?> </td>
														
														<td>
															<?php if($row['status']=='Scheduled'): ?>
																<span class="badge badge-warning">Scheduled</span>
															<?php elseif($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>
																	<?php elseif($row['status']=='cfa'): ?>
																<span class="badge badge-primary pl-3 pr-3">CFA</span>
																	<?php elseif($row['status']=='dismissed'): ?>
																<span class="badge badge-dark">Dismissed</span>
															<?php else: ?>
																<span class="badge badge-success">Settled</span>
															<?php endif ?>
														</td>
														
																<td>
																    <div style="width:80px;">
																
																    <b>&#8369 </b><?= number_format($row['amounts'],2) ?>
																    
																    
																    
																    	
																    	</div>
																    </td>
														<?php if(isset($_SESSION['username'])):?>
														<td>
														<div class="form-button-action">
														<a type="button" href="#editblotter" data-toggle="modal" class="btn btn-link btn-primary" 
																title="Edit Blotter" onclick="editBlotters(this)" data-id="<?= $row['id'] ?>" 
																
																
	data-complainants="<?php if($row['complainant_type']=='Resident'): ?><?=$clname.','.$cfname.' '.$cmname.' '.$csuffix?><?php endif ?><?php if($row['complainant_type']=='Non-resident'): ?><?=$cnlname.','.$cnfname.' '.$cnmname.' '.$cnsuffix?><?php endif ?>
	"
																	data-respondent="<?php if($row['respondent_type']=='Resident'): ?><?=$rlname.','.$rfname.' '.$rmname.' '.$csuffix?><?php endif ?><?php if($row['respondent_type']=='Non-resident'): ?><?=$rnlname.','.$rnfname.' '.$rnmname.' '.$rnsuffix?><?php endif ?>"
																
																
																
																
																	data-respondenttype="<?= $row['respondent_type'] ?>" 
																		data-complainanttype="<?= $row['complainant_type'] ?>"
																		
																		
																				<?php if($row['complainant_type']=='Resident'): ?>
															 
																data-com_age="<?= $cage?>" 
																data-comadd="<?= $caddress.', '.$barangayname.', '.$city.', '.$province ?>" 
																data-comtact="<?= $ccontact ?>" 
															
														
																<?php endif ?>
																
																
																
																	<?php if($row['complainant_type']=='Non-resident'): ?>
															 
																data-com_age="<?= $row['com_age'] ?>" 
																data-comadd="<?= $row['com_address'] ?>" 
																data-comtact="<?= $row['com_contact'] ?>" 
															
														
																<?php endif ?>
																
																	<?php if($row['respondent_type']=='Resident' ): ?>
															 
															
															
																data-resage="<?= $rage ?>"
																data-resadd="<?= $raddress.', '.$barangayname.', '.$city.', '.$province ?>"
																data-rescontact="<?= $rcontact ?>"
																<?php endif ?>
																
																
																<?php if($row['respondent_type']=='Non-resident' ): ?>
															 
															
															
																data-resage="<?= $row['respon_age'] ?>"
																data-resadd="<?= $row['respon_address'] ?>"
																data-rescontact="<?= $row['respon_contact'] ?>"
																<?php endif ?>
																
															  data-type="<?= $row['blotter_type'] ?>" data-l="<?= $row['location'] ?>" 
																data-dateincident="<?= $row['date_incident'] ?>" 
																data-timeincident="<?= $row['time_incident'] ?>" 
																data-datenotice="<?= $row['date_notice'] ?>" 
																data-timenotice="<?= $row['time_notice'] ?>" 
																data-details="<?= $row['details'] ?>" 
																data-status="<?= $row['status'] ?>"
																data-bimage="<?= $row['blotter_image'] ?>" 
																data-limage="<?= $row['log_image'] ?>"
																	data-username="<?=$_SESSION['username']  ?>"
																	
																		data-amount="<?= $row['amounts'] ?>" 
																		
																		data-orno="<?= $row['or_no'] ?>"
																>
																<?php if(isset($_SESSION['username'])): ?>
																<i class="fa fa-edit"></i>
																<?php else: ?>
																<i class="fa fa-eye"></i>
																<?php endif ?>
															</a>
															<a type="button" data-toggle="tooltip" href="model/transfertopno.php?id=<?= $row['id'] ?>" class="btn btn-link btn-primary" data-original-title="Transfer to Peace & Order" onclick="return confirm('Are you sure you want to transfer this data to Peace& Order??');">
																	<i class="fas fa-share"></i></a>
															<?php if(isset($_SESSION['username']) ):?>
															<a type="button" data-toggle="tooltip" href="model/remove_blotter.php?id=<?= $row['id'] ?>&lupon=lupon" onclick="return confirm('Are you sure you want to delete this blotter?');" class="btn btn-link btn-danger" data-original-title="Remove">
																<i class="fa fa-times"></i>
															</a>

															</div>
															<?php endif ?>
														</td>
														<?php endif ?>
													</tr>
													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												     <th scope="col">Blotter No.</th>
												 
													<th scope="col">Complainant<sup>(type)</sup> </th>
													<th scope="col">Respondent<sup>(type)</sup> </th>
												
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
															<th scope="col">Amount</th>
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats text-white bg-danger-gradient card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category text-white"  style="position:relative; left:-30px;">Pending</p>
												<h4 class="card-title text-white"><?= number_format($active) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="pendingCase" class="card-link text-light">Pending Case </a>
								</div>
							</div>
							<div class="card card-stats bg-success-gradient text-white card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category text-white"  style="position:relative; left:-34px;">Settled</p>
												<h4 class="card-title text-white"><?= number_format($settled) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="settledCase" class="card-link text-light">Settled Case </a>
								</div>
							</div>
							<div class="card card-stats bg-warning-gradient text-white card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category text-white"  style="position:relative; left:-50px;">Scheduled</p>
												<h4 class="card-title text-white"><?= number_format($scheduled) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="scheduledCase" class="card-link text-light">Scheduled Case </a>
								</div>
							</div>
							
							
														<div class="card card-stats bg-primary-gradient text-white card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category text-white"  style="position:relative; left:-50px;">CFA</p>
												<h4 class="card-title text-white"><?= number_format($cfa) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="certfileaction" class="card-link text-light">Certificate to File Action</a>
								</div>
							</div>
							
							
								<div class="card card-stats  card-round text-white" style="background-image: linear-gradient(40deg,gray,black);">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats text-white">
											<div class="numbers">
												<p class="card-category text-white"  style="position:relative; left:-50px;">Dismissed</p>
												<h4 class="card-title text-white"><?= number_format($dismissed) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="dismissed" class="card-link text-light">Dismissed Case </a>
								</div>
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
			
				
						     <!-- Modal -->
<div class="modal fade" id="editblotter" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Blotter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editblotter_form" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                       
                        <div class="col-md-4">
                             
                                <div class="form-group  border rounded mb-2 shadow-sm">
                            	<label>Complainant Type:</label>
										<input type="text" class="form-control fw-bold" style="color:black;"  id="complainanttype" readonly>
                            </div>
                             <div class="form-group  border rounded mb-2 shadow-sm">
                            	<label>Complainant:</label>
										<input type="text" class="form-control fw-bold" style="color:black;" readonly  id="complainant" >
                            </div>
                           <div class="form-group">
											<label>Complainant Age</label>
											<input type="number" class="form-control fw-bold" style="color:black;" readonly  placeholder="Enter Complainant age" name="comage" id="comage" required>
										</div>
                         	<div class="form-group">
											<label>Complainant Contact No</label>
											<input type="number"class="form-control fw-bold" style="color:black;" readonly  placeholder="Enter Complainant Contact No" name="comcontact" id="comtact" required>
										</div>
                                
                                	<div class="form-group">
											<label>Complainant Address</label>
											<input type="text" class="form-control fw-bold" style="color:black;" readonly  placeholder="Enter Complainant Address" name="comaddress" id="comadd" required>
										</div>
                                
                               
                              
                         	<div class="form-group">
											<label>Current Blotter Image</label>
											
									<img src="assets/img/uploadimage.png" class="img-fluid border rounded"  id="blotterimg" ><br>
                                    <label>Change Image to:</label>
									<input type="file" class="form-control" name="blotterimg" accept="image/*">
										</div>
								
                                  
							
                       
                   
            


                            
                           



                           
                        </div>

                        <div class="col-md-4">
                          
                               <div class="form-group  border rounded mb-2 shadow-sm">
                            	<label>Respondent Type:</label>
											<input type="text" class="form-control fw-bold" style="color:black;"  id="respondenttype" readonly>
                            </div>
                            <div class="form-group  border rounded mb-2 shadow-sm">
                            	<label>Respondent:</label>
											<input type="text" class="form-control fw-bold" style="color:black;"  id="respondent" readonly>
                            </div>
                            
                            
                            
                                
                                	<div class="form-group">
											<label>Respondent Age</label>
											<input type="number"class="form-control fw-bold" style="color:black;" readonly  placeholder="Enter Respondent age" name="respondentage" id="resage" required>
										</div>
                                
                               
                              	<div class="form-group">
											<label>Respondent Contact No</label>
											<input type="number"class="form-control fw-bold" style="color:black;" readonly placeholder="Enter Complainant Contact No" name="rescontact" id="rescontact" required>
										</div>
                          
                                  
								<div class="form-group">
											<label>Respondent Address</label>
											<input type="text" class="form-control fw-bold" style="color:black;" readonly  placeholder="Enter Respondent Address" name="resaddress" id="resadd" required>
										</div>
                       
                   
            


                            		<div class="form-group">
											<label>Current Logbook Image</label>
									
									<img src="assets/img/uploadimage.png" class="img-fluid border rounded"  id="logbook" ><br>
                                    <label>Change LogBook Image to:</label>
											
											
									<input type="file" class="form-control" name="logbook"  accept="image/*" >
										</div>
                           



                           
                        </div>
                        
                        
                         <div class="col-md-4">
                            
                                  
                                  
                             
                              	<div class="form-group">
											<label>Blotter Type</label>
										<input type="text" class="form-control" placeholder="Enter Blotter" name="type" id="type" required>
										</div>
                              <div id="blotterothers"></div>
                              
                              	<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status" id="status">
												<option disabled selected>Select Blotter Status</option>
												<option value="pending">Pending</option>
												<option value="Settled">Settled</option>
												<option value="Scheduled">Scheduled</option>
													<option value="cfa">CFA</option>
														<option value="dismissed">Dismissed</option>

											</select>
										</div>
                										<div class="form-group">
											<label>Incident Location</label>
											<input type="text" class="form-control" placeholder="Enter Location" name="location" id="location" required>
										</div>
                
                          	<div class="form-group">
											<label>Date Incident</label>
											<input type="date" class="form-control" name="dateincident" min="" max="<?=date("Y-m-d")?>" value="" id="dateincident" required>
										</div>
											<div class="form-group">
											<label>Time Incident</label>
											<input type="time" class="form-control" name="timeincident" value="" id="timeincident" required>
										</div>
										
											<div class="form-group">
											<label>Date Notice</label>
											<input type="date" class="form-control" name="datenotice" value="" id="datenotice"  required>
										</div>
										
											<div class="form-group">
											<label>Time Notice</label>
											<input type="time" class="form-control" name="timenotice" value=""   id="timenotice" required>
										</div>
										
										
										
											<div class="form-group">
											<label>OR NO</label>
											<input type="number" min="0" class="form-control" name="orno" value="" id="orno" required>
										</div>
											<div class="form-group">
											<label>Amount</label>
											<input type="number" min="0" class="form-control" name="amount" value="" id="amount"  required>
										</div>
										
										
										
										
										
                               
                        </div>
                        
                        
                          <div class="col-md-12">
                              	<div class="form-group">
									<label>Details</label>
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." name="details" id="details" required></textarea>
								</div>
                    
                              </div>

	     
                    </div>
                    
								
                   
                   
                    
      
                   
                  
            </div>
            <div class="modal-footer justify-content-center">
                <input type="hidden" class="form-control" name="pno" value="pno" required>
                	<input type="hidden" class="form-control" name="id" id="blotter_id" value="" required>
                            <div id="notiferrs" ></div>
                         <span role="alert" id="loadings" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>  
                            <button type="submit" class="btn btn-primary fw-bold"  id="acceptbtns" onclick="return confirm('Are you sure you want to proceed?');">Update</button>
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
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>




    <script>
        $(document).ready(function() {
            var oTable = $('#blottertable').DataTable({
				"order": [[ 5, "asc" ]]


				
            });

			$(document).ready(function() {


				$('.search_select_box select').selectpicker();
            });

			$("#pendingCase").click(function(){
				var textSelected = 'Pending';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#settledCase").click(function(){
				var textSelected = 'Settled';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#scheduledCase").click(function(){
				var textSelected = 'Scheduled';
				oTable.columns(4).search(textSelected).draw();
			});
			
		
			
				$("#dismissed").click(function(){
				var textSelected = 'dismissed';
				oTable.columns(4).search(textSelected).draw();
			});
			
			$("#certfileaction").click(function(){
				var textSelected = 'cfa';
				oTable.columns(4).search(textSelected).draw();
			});
        });
    </script>
     <script>
    
    
    
    $(document).ready(function (e) {
  $("#editblotter_form").on('submit',(function(e) {
   e.preventDefault();


   
   document.getElementById("acceptbtns").style.display = "none";
  
  
   document.getElementById("loadings").style.display = "block";
   $.ajax({
    url: "model/edit_blotter.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success: function(data)
       { 
     
       
        $('#notiferr').html(data);
     
        

            if($.trim(data)=="success"){
                document.getElementById("loadings").style.display = "none";
                window.location.pathname = ('/lupon')
        //$('#errwarning').html(data);
        
        //$('#notiferr').html(' <b  class="border p-2 rounded border-success fw-bold pl-5 pr-5" style="color:green; letter-spacing:3px;">VERIFIED <b class="bg-success text-white rounded-circle  pl-1 pr-0">&#10003</b></b>');
  

     
  
      }else{
         
       // $('#notiferr').html('<b style="color:green; font-size:14px;">Verified Success!</b>');
         
      }
        



    
         
     
       },
       
     
     
               
     });
  }));
  
  
  
  

  
  
  
  
 }); 
 
    
    
    
    
    
    
    
    
    
    

    </script>
    
     
    <script>
        
        
        function editBlotters(that){
    id          = $(that).attr('data-id');
     complainanttype = $(that).attr('data-complainanttype');
    complainant = $(that).attr('data-complainants');
   
    comage = $(that).attr('data-com_age');
    comadd= $(that).attr('data-comadd');
    comcontact= $(that).attr('data-comtact');

   respondenttype 		= $(that).attr('data-respondenttype');
    respondent 		= $(that).attr('data-respondent');
	resage 		= $(that).attr('data-resage');

    resadd 		= $(that).attr('data-resadd');
    rescon 		= $(that).attr('data-rescontact');


    type 		= $(that).attr('data-type');
	l 		= $(that).attr('data-l');
    dateincident 	    = $(that).attr('data-dateincident');
	timeincident 		= $(that).attr('data-timeincident');

    datenotice 	    = $(that).attr('data-datenotice');
	timenotice 		= $(that).attr('data-timenotice');

    details 		= $(that).attr('data-details');
    status 	= $(that).attr('data-status');
    
    
     amount 	= $(that).attr('data-amount');
     
     orno 	= $(that).attr('data-orno');
    
    
    
      uname 		= $(that).attr('data-username');
    bimage = $(that).attr('data-bimage');
    limage = $(that).attr('data-limage');

    bsrc='assets/uploads/'+uname+'/blotter/'+bimage;
     lsrc='assets/uploads/'+uname+'/blotter/'+limage;
     
        $('#blotterimg').attr('src', bsrc);
          $('#logbook').attr('src', lsrc);
    

    $('#blotter_id').val(id);
        $('#complainanttype').val(complainanttype);
    $('#complainant').val(complainant);
    
    $('#comage').val(comage);
    $('#comadd').val(comadd);
    $('#comtact').val(comcontact);
  
    $('#respondenttype').val(respondenttype);
    $('#respondent').val(respondent);
    $('#resage').val(resage);
    $('#resadd').val(resadd);
    $('#rescontact').val(rescon);
    $('#type').val(type);
    $('#location').val(l);
    $('#dateincident').val(dateincident);
    $('#timeincident').val(timeincident);

    $('#datenotice').val(datenotice);
    $('#timenotice').val(timenotice);
    $('#details').val(details);
    $('#status').val(status);
    
    
     $('#amount').val(amount);
     $('#orno').val(orno);
}
        
        
        
        
        
        
        
        
        
        
        
        
    </script>
</body>
</html>