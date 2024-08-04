<?php include 'server/server.php' ?>
<?php 
$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.bar_no=$barno  ORDER BY tblrequested_documents.req_no DESC";
    $result = $conn->query($query);

    $reqdocs = array();
	while($row = $result->fetch_assoc()){
		$reqdocs[] = $row; 
	}

	$query1 = "SELECT * FROM tblrequested_documents LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id   WHERE tblrequested_documents.`status`='pending' AND tbl_residents.bar_no=$barno ORDER BY tblrequested_documents.req_no DESC";
    $result1 = $conn->query($query1);
	$pending = $result1->num_rows;

	$query2 = "SELECT * FROM tblrequested_documents LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tblrequested_documents.`status`='processing' AND tbl_residents.bar_no=$barno ORDER BY tblrequested_documents.req_no DESC";
    $result2 = $conn->query($query2);
	$processing = $result2->num_rows;

	$query3 = "SELECT * FROM tblrequested_documents LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tblrequested_documents.`status`='released' AND tbl_residents.bar_no=$barno ORDER BY tblrequested_documents.req_no DESC";
    $result3 = $conn->query($query3);
	$released = $result3->num_rows;

	$query4 = "SELECT * FROM tblrequested_documents LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tblrequested_documents.`status`='completed' AND tbl_residents.bar_no=$barno ORDER BY tblrequested_documents.req_no DESC";
    $result4 = $conn->query($query4);
	$completed = $result4->num_rows;





	$query6 = "SELECT * FROM tblrequested_documents LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tblrequested_documents.`status`='cancelled' AND tbl_residents.bar_no=$barno ORDER BY tblrequested_documents.req_no DESC";
    $result6 = $conn->query($query6);
	$cancelled = $result6->num_rows;




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Requested Documents -  WeABITS</title>
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
								<h2 class="text-white fw-bold">Request</h2>
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
										<div class="card-title">Requested Certificates</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="blottertable" class="display table table-striped">
											<thead>
												<tr>
												<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
													<th scope="col">ReqNo.</th>
											
													<th scope="col">Full Name</th>
													<th scope="col">Status</th>
                                                    <th scope="col">Certificate</th>
                                                    <th scope="col">Purpose/Details</th>
													<th scope="col">Amount</th>
												
											
                                             

												
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($reqdocs)): ?>
													<?php foreach($reqdocs as $row): ?>

													<tr>
												
												
												<td>		
												
												     <?php if($row['status']=='pending'): ?>
																<a type="button" href="requested_details.php?resid=<?php echo $row['res_id'] ?>&req_no=<?php echo $row['req_no'] ?>"  class="badge badge-primary text-white fw-bold  " style="font-size: 12px;" title="Process Now?"
			onclick="return confirm('Are you sure you want to process this request?');"
			 >  
			 Process now
	 
		</a>
															<?php elseif($row['status']=='processing'): ?>
																<a type="button" href="requested_details.php?resid=<?php echo $row['res_id'] ?>&req_no=<?php echo $row['req_no'] ?>"  class="badge badge-primary text-white fw-bold  " style="font-size: 12px;" title="Process Now?"
			onclick="return confirm('Are you sure you want to process this request?');"
			 >  
			 Process now
	 
		</a>
											
															<?php elseif($row['status']=='released'): ?>
																<a type="button" href="requested_details.php?resid=<?php echo $row['res_id'] ?>&req_no=<?php echo $row['req_no'] ?>"  class="badge badge-primary text-white fw-bold  " style="font-size: 12px;" title="View Details"
		
			 >  
			 View Details
	 
		</a>

																<?php elseif($row['status']=='completed'): ?>
																		<a type="button" href="requested_details.php?resid=<?php echo $row['res_id'] ?>&req_no=<?php echo $row['req_no'] ?>"  class="badge badge-primary text-white fw-bold  " style="font-size: 12px;" title="View Details"
	
			 >  
			 View Details
	 
		</a>

																<?php elseif($row['status']=='cancelled'): ?>
																				<a type="button" href="requested_details.php?resid=<?php echo $row['res_id'] ?>&req_no=<?php echo $row['req_no'] ?>"  class="badge badge-primary text-white fw-bold  " style="font-size: 12px;" title="View Details"
		
			 >  
			 View Details
	 
		</a>
															
															<?php else: ?>
														
															<?php endif ?>
												
												
												
</td>
														<td class="text-center"><?= ucwords($row['req_no']) ?></td>
												
                                                        <td>  <div  style="width:150px;">
                                                          
                                                       


												   <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

															   
																  
																
														  </div>
													</td>
													
													<td>
													
													
													
													        <?php if($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>
															<?php elseif($row['status']=='processing'): ?>
																<span class="badge badge-warning">Processing</span>
											
															<?php elseif($row['status']=='released'): ?>
																<span class="badge badge-success">For Release</span>

																<?php elseif($row['status']=='completed'): ?>
																<span class="badge badge-primary">Completed</span>

																<?php elseif($row['status']=='cancelled'): ?>
																<span class="badge " style="background:gray; color:white;">Cancelled</span>
															
															
															<?php else: ?>
														
															<?php endif ?>


															


															
														
														

														
															

															</td>
													
													
													
														<td><?= ucwords($row['certificate']) ?></td>


                                                        <td><div  style="width:260px;">
                                                            
                                                            
                                                            
														
														<?php 
														
														
														if($row['certificate']=='Business Clearance'){
														    
														    		   $jsonobj =  $row['purpose'];

                                                                    $business = json_decode($jsonobj);
                                                         
														      
														     echo 'Business Name: '.$business->nbusiness.'<br>';
														     echo 'Request Type: '.$business->type.'<br>';
														      echo 'Business Nature: '.$business->bnature.'<br>';
														      
														       echo 'Nature of Business Ownership: '.$business->natureBo.'<br>';
														        echo 'DIT No.: '.$business->dtino.'<br>';
														         echo 'Business Address: '.$business->businessadd.'<br>';
														          echo 'Business Phone#: '.$business->bphone;
														           
														           
														  
														      
														}elseif($row['certificate']=='Certificate of Indigency'){
														    
														   $jsonobj =  $row['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    $target= $obj->resid;
                                                                
                                                                    $querytarget = "SELECT * FROM tbl_residents WHERE res_id='$target' AND bar_no=$barno";
                                                                        $result_target = $conn->query($querytarget);
                                                                    	$resident_target = $result_target->fetch_assoc();
                                                                    	
                                echo 'Requested for: <b>'.$resident_target['firstname'].' '.$resident_target['middlename'].' '.$resident_target['lastname'].' '.$resident_target['suffix'].'</b><br>';
                             echo 'Relation: <b>'.$resident_target['relation'].'</b><br>';
                                                                   echo 'Purpose: <b>'.$obj->purpose.'</b>';
                                                                   
														    
														}elseif($row['certificate']=='Barangay Clearance'){
														     $jsonobj =  $row['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    echo 'Purpose: <b>'.$obj->purpose.'</b>';
                                                                   
														     
														     
														     
														     
														}elseif($row['certificate']=='Building Clearance'){
														   
														     
														     
														     	   $jsonobj =  $row['purpose'];

                                                                    $obj = json_decode($jsonobj);
                                                                    
                                                                    echo 'House#: <b>'.$obj->houseno.'</b><br>';
                                                                    echo 'Street: <b>'.$obj->street.'</b>';
														}
														
													/*
                                                    
                                                    $arr_string = explode(",",$row['purpose'], 7);

                                                    foreach($arr_string as $str){
                                                        echo $str . "<br />";
                                                    }*/
                                                    
                                                    
                                                   ?>
													
													        </div></td>
                                                     
													
													
														<td><b>&#8369</b><?= number_format($row['amount'],2) ?></td>
													
												



														
													</tr>


	



													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
                                                <th scope="col">ReqNo.</th>
												
													<th scope="col">Full Name</th>
													<th scope="col">Status</th>
												
                                                    <th scope="col">Certificate</th>
                                                    <th scope="col">Purpose/Detail</th>
													<th scope="col">Amount</th>
												
											
                                                    
												
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-danger card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category"  style="position:relative; left:-38px;">Pending</p>
												<h4 class="card-title"><?= number_format($pending) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="pending" class="card-link text-light">Pending</a>
								</div>
							</div>
							<div class="card card-stats card-warning card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category"  style="position:relative; left:-40px;">Processing</p>
												<h4 class="card-title"><?= number_format($processing) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="processing" class="card-link text-light">Processing </a>
								</div>
							</div>
							<div class="card card-stats card-success card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category" style="position:relative; width:200px; left:-50px;">For Release</p>
												<h4 class="card-title"><?= number_format($released) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="released" class="card-link text-light">For Release</a>
								</div>
							</div>

							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category" style="position:relative; width:200px; left:-50px;">Completed</p>
												<h4 class="card-title"><?= number_format($completed) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="completed" class="card-link text-light">Completed</a>
								</div>
							</div>







							<div class="card card-stats card-dark card-round" style="background:gray;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category" style="position:relative; left:-50px;">Cancelled</p>
												<h4 class="card-title"><?= number_format($cancelled) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="cancelled" class="card-link text-light">Cancelled</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


					<!-- Modal -->
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Make Official Receipt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php" >
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details" id="docreq"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" name="resid"  id="resid">
							<input type="text" name="reqno"  id="reqno">
                           
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



						<!-- Modal -->
						<div class="modal fade" id="senddoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send Document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/send_docs.php"   enctype="multipart/form-data">

							
							
                                <div class="form-group">
						
                                    <label>Send Document</label>
                                    <input type="file" class="form-control" name="file" accept="application/pdf" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                           
							<input type="hidden" name="reqno"  id="req">
							<input type="text" name="dtype"  id="dtype">
							<input type="text" name="resid"  id="residentid">
                            <button type="submit" class="btn btn-primary">Send</button>
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

	<link rel="stylesheet" href="assets/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
	<script src="assets/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>




    <script>
        $(document).ready(function() {
            var oTable = $('#blottertable').DataTable({
				"order": [[ 4, "asc" ]]


				
            });

			$(document).ready(function() {


				$('.search_select_box select').selectpicker();
            });

			$("#pending").click(function(){
				var textSelected = 'pending';
				oTable.columns(3).search(textSelected).draw();
			});
			$("#released").click(function(){
				var textSelected = 'Release';
				oTable.columns(3).search(textSelected).draw();
			});
			$("#processing").click(function(){
				var textSelected = 'processing';
				oTable.columns(3).search(textSelected).draw();
			});

		

			$("#completed").click(function(){
				var textSelected = 'completed';
				oTable.columns(3).search(textSelected).draw();
			});
			$("#cancelled").click(function(){
				var textSelected = 'Cancelled';
				oTable.columns(3).search(textSelected).draw();
			});

		
        });
    </script>



</body>
</html>