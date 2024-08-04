<?php include 'server/server.php' ?>
<?php 
    

	$barno=$_SESSION['bar_no'];
	$query = "SELECT *,tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result = $conn->query($query);

    $borrow = array();
	while($row = $result->fetch_assoc()){
		$borrow[] = $row; 
	}

	$query1 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='pending' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result1 = $conn->query($query1);
	$pending = $result1->num_rows;

	$query2 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='cancelled' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result2 = $conn->query($query2);
	$disapp = $result2->num_rows;

	$query3 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='approved' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result3 = $conn->query($query3);
	$approve = $result3->num_rows;

	$query4 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='returned' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result4 = $conn->query($query4);
	$return = $result4->num_rows;


	$query5 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='borrowed' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
    $result5 = $conn->query($query5);
	$received = $result5->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Borrow Items -  WeABITS</title>
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
								<h2 class="text-white fw-bold">Borrow Items</h2>
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
										<div class="card-title">Borrow Items</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="borrow" class="display table table-striped">
											<thead>
												<tr>
												<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
													<th scope="col">Borrow No.</th>
													
												
													<th scope="col">Full Name</th>
													<th scope="col">Equipment name</th>
                                                    <th scope="col">Purpose/detail</th>
													<th scope="col">Status</th>
                                                    <th scope="col">Qty.</th>
                                                   
                                                    <th scope="col">Request Date</th>
													<th scope="col">Date To Return</th>
													<th scope="col">Received Date</th>
													<th scope="col">Return Date</th>

												
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($borrow)): ?>
													<?php foreach($borrow as $row): ?>

													<tr>
														<td>

														<div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">


				<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-edit"></i>
                    </a>

				                                    

                 


                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        
					
                            <form method="POST" action="model/edit_borstatus.php" enctype="multipart/form-data" >
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">

								    <div class="row m-0 p-2 bg-primary-gradient rounded border">
						      
									<h4 class="text-white  fw-bold">Borrowed No. <?= ucwords($row['bor_no']) ?></h4>	

								
								      

							
									
                               

								    </div>
							
						
                                                  
									<div class="form-group">
									<?= ucwords($row['equipment_name']) ?>
							
									<h5>Current Status: 
													        <?php if($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>

																<?php elseif($row['status']=='approved'): ?>
																<span class="badge badge-success">Approved</span>

															<?php elseif($row['status']=='returned'): ?>
																
																<span class="badge badge-secondary">Returned</span>
											
														
																<?php elseif($row['status']=='borrowed'): ?>
																<span class="badge badge-primary">Borrowed</span>
															
															<?php else: ?>
																<span class="badge badge-danger" style="background:gray;">Cancelled</span>
															<?php endif ?></h5>

															<label>Quantity: <?= $row['quantity'] ?></label><br>
															<input type="hidden" class="form-control" value="<?= $row['equip_no'] ?>"  name="equip_no" >
									<input type="hidden" class="form-control" value="<?= $row['bor_no'] ?>"  name="bor_no" >
									<input type="hidden" class="form-control" value="<?= $row['res_id'] ?>"  name="resid" >
									<input type="hidden" class="form-control" value="<?= $row['quantity'] ?>"  name="quantity" >
									<input type="hidden" class="form-control" value="<?= $row['status'] ?>"  name="curr_status" >

									<?php if($row['status']=='pending' || $row['status']=='approved' || $row['status']=='borrowed' || $row['status']=='returned' ): ?>
									<label>Change Request Status: </label>
										
								
												<select class="form-control fw-bold"   name="borstatus"  required>
												<option disabled selected>Select Status</option>
												 <?php if($row['status']=='pending'): ?>

													<option value="approved">Approved</option>
												<option value="cancelled">Cancelled</option>
											     <?php elseif($row['status']=='approved'): ?>
												<option value="pending">Pending</option>
												<option value="borrowed">Borrowed</option>
											    <option value="cancelled">Cancelled</option>

												<?php elseif($row['status']=='borrowed'): ?>
											    <option value="approved">Approved</option>
												<option value="returned">Returned</option>
										        
												<?php elseif($row['status']=='returned'): ?>
												<option value="borrowed">Borrowed</option>
													<?php endif ?>
												</select>
												<?php endif ?>
                                     
                                   </div> 
						
						

					

						
                         

                           

                                </div>

                            </div>


                        <div class="modal-footer">
					
						<?php if($row['status']=='pending' || $row['status']=='approved' || $row['status']=='borrowed' || $row['status']=='returned' ): ?>
                             
                            <button type="submit" class="btn btn-primary fw-bold" onclick="return confirm('Are you sure you want to update this request');">Update</button>
							<?php endif ?>
                        </div>
                        </form>


						
						                                     
						
                    
                        
                    </ul>
                </li>
            </ul>



			
		
        </div>





														</td>

															<td><?= ucwords($row['bor_no']) ?></td>
															
															
														
													
                                                        <td>  <div  style="width:250px;">
                                                          
                                                       
														<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
		
															   
																  
																
														  </div>
													</td>


													<td><?= ucwords($row['equipment_name']) ?></td>
														<td><?= ucwords($row['purpose']) ?></td>
														
													
													<td>
													
													
													
													        <?php if($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>

																<?php elseif($row['status']=='approved'): ?>
																<span class="badge badge-success">Approved</span>

															<?php elseif($row['status']=='returned'): ?>
																
																<span class="badge badge-secondary">Returned</span>
											
														
																<?php elseif($row['status']=='borrowed'): ?>
																<span class="badge badge-primary">Borrowed</span>
															
															<?php else: ?>
																<span class="badge badge-danger" style="background:gray;">Cancelled</span>
															<?php endif ?>


															


															
														
														

														
															

															</td>
															<td><?= ucwords($row['quantity']) ?></td>
													
													
													
													


                                                     
													
													

                                                        <td><?= ucwords($row['date_req']) ?></td>
														<td><?= $row['date_to_return'] ?></td>
														<td><?= $row['date_received'] ?></td>
														<td><?= $row['date_return'] ?></td>


														
													</tr>


	



													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
                                              
													<th scope="col">Borrow No.</th>
												
													
												
													<th scope="col">Resident ID & Full Name</th>
													<th scope="col">Equipment name</th>
                                                    <th scope="col">Purpose/detail</th>
													<th scope="col">Status</th>
                                                    <th scope="col">Qty.</th>
                                                   
                                                    <th scope="col">Request Date</th>
                                                    	<th scope="col">Date To Return</th>
													<th scope="col">Received Date</th>
													<th scope="col">Return Date</th>
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
												<i class="flaticon-users"></i>
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
							
							<div class="card card-stats card-success card-round">
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
												<p class="card-category" style="position:relative; left:-50px;">Approved</p>
												<h4 class="card-title"><?= number_format($approve) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="app" class="card-link text-light">Approved</a>
								</div>
							</div>

					


							<div class="card card-stats card-primary card-round">
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
												<p class="card-category" style="position:relative; left:-50px;">Borrowed</p>
												<h4 class="card-title"><?= number_format($received) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="borrowed" class="card-link text-light">Borrowed</a>
								</div>
							</div>


							<div class="card card-stats card-secondary card-round">
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
												<p class="card-category" style="position:relative; left:-20px;">Returned</p>
												<h4 class="card-title"><?= number_format($return) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="return" class="card-link text-light">Returned</a>
								</div>
							</div>


							<div class="card card-stats  card-round"  style="background:gray;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category"  style="position:relative; left:-40px; color:white;">Cancelled</p>
												<h4 class="card-title text-white" ><?= number_format($disapp) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="cancelled" class="card-link text-light">Cancelled </a>
								</div>
							</div>





						</div>
					</div>
				</div>
			</div>


					<!-- Modal -->
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " role="document">
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
                           
							<input type="text" name="reqno"  id="req">
                           
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


<!-- Modal -->
<div class="modal fade" id="viewdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Document</h5>
                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
												</button>
                        </div>
                        <div class="modal-body">
                           
					
                               
						    <div class="form-group">
							<label>Request No.</label>
						    <input type="text" class="form-control" id="req_no">
							</div>
								

                                <div class="form-group">
							
											<div class="text-center mb-2"  style="visibility:hidden;">
												
											<button id="pdf-prev"  class="btn btn-primary mr-3"><i class="fas fa-arrow-left"></i> Prev</button>
												<label id="pdf-current-page"></label> 
											    of <label id="pdf-total-pages"></label>
												<button id="pdf-next"  class="btn btn-primary ml-3"> Next <i class="fas fa-arrow-right"></i></button>

												</div>

											
								<canvas id="pdf-canvas" width="800" class="rounded img-fluid"  style="border:solid black 1px;"></canvas>

								<button id="show-pdf-button" style="visibility:hidden;"  class="btn btn-primary">Show PDF</button> 
								<div id="pdf-loader" ></div>
									<div id="pdf-contents">
										<div id="pdf-meta">
										
											
											
											
										</div>
										
										
										<div id="page-loader" ></div>
									
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
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>

	<link rel="stylesheet" href="assets/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
	<script src="assets/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>




    <script>
        $(document).ready(function() {
            var oTable = $('#borrow').DataTable({
				"order": [[ 9, "asc" ]]


				
            });

			$(document).ready(function() {


				$('.search_select_box select').selectpicker();
            });

			$("#pending").click(function(){
				var textSelected = 'pending';
				oTable.columns(5).search(textSelected).draw();
			});
			$("#app").click(function(){
				var textSelected = 'approved';
				oTable.columns(5).search(textSelected).draw();
			});
			$("#cancelled").click(function(){
				var textSelected = 'cancelled';
				oTable.columns(5).search(textSelected).draw();
			});

			$("#return").click(function(){
				var textSelected = 'return';
				oTable.columns(5).search(textSelected).draw();
			});

			$("#borrowed").click(function(){
				var textSelected = 'borrowed';
				oTable.columns(5).search(textSelected).draw();
			});

		
        });
    </script>



</body>
</html>