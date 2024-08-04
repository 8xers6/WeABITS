<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM `tblblotter` WHERE bar_no=$barno AND department='pno'";
    $result = $conn->query($query);

    $blotter = array();
	while($row = $result->fetch_assoc()){
		$blotter[] = $row; 
	}

	$query1 = "SELECT * FROM `tblblotter`  WHERE `status`='pending' AND bar_no=$barno AND department='pno'";
    $result1 = $conn->query($query1);
	$active = $result1->num_rows;

	$query2 = "SELECT * FROM `tblblotter` WHERE `status`='Scheduled' AND bar_no=$barno AND department='pno'";
    $result2 = $conn->query($query2);
	$scheduled = $result2->num_rows;

	$query3 = "SELECT * FROM `tblblotter` WHERE `status`='Settled' AND bar_no=$barno AND department='pno'";
    $result3 = $conn->query($query3);
	$settled = $result3->num_rows;
	
	
		$query4 = "SELECT * FROM `tblblotter` WHERE `status`='dismissed' AND bar_no=$barno AND department='pno'";
    $result4 = $conn->query($query4);
	$dismissed = $result4->num_rows;
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
								<h2 class="text-white fw-bold">Blotter-Peace & Order</h2>
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
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Blotter/Incident
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
													
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
										
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
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
										

													<td><?= ucwords($row['complainant']) ?></td>
														<td><?= ucwords($row['respondent']) ?></td>
										
														<td><?= ucwords($row['type']) ?></td>
														<td>
															<?php if($row['status']=='Scheduled'): ?>
																<span class="badge badge-warning">Scheduled</span>
															<?php elseif($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>
																	<?php elseif($row['status']=='dismissed'): ?>
																<span class="badge badge-dark">Dismissed</span>
															<?php elseif($row['status']=='Settled'): ?>
																<span class="badge badge-success">Settled</span>
															<?php endif ?>
														</td>
														<?php if(isset($_SESSION['username'])):?>
														<td>
														<div class="form-button-action">
															<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" 
																title="Edit Blotter" onclick="editBlotter1(this)" data-id="<?= $row['id'] ?>" 
																data-complainant="<?= $row['complainant'] ?>" 
																data-com_age="<?= $row['com_age'] ?>" 
																data-comadd="<?= $row['com_address'] ?>" 
																data-comtact="<?= $row['com_contact'] ?>" 
																data-respondent="<?= $row['respondent'] ?>" 
																data-resage="<?= $row['respon_age'] ?>"
																data-resadd="<?= $row['respon_address'] ?>"  
																data-respondent="<?= $row['respondent'] ?>"  data-type="<?= $row['type'] ?>" data-l="<?= $row['location'] ?>" 
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
														
															<a type="button" data-toggle="tooltip" href="model/transfertolupon.php?id=<?= $row['id'] ?>" class="btn btn-link btn-primary" data-original-title="Transfer to Lupon" onclick="return confirm('Are you sure you want to transfer this data to lupon?');">
																	<i class="fas fa-share"></i></a>
														
															<?php if(isset($_SESSION['username'])):?>
															<a type="button" data-toggle="tooltip" href="model/remove_blotter.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this blotter?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
												 
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
												
													<th scope="col">Blotter/Incident</th>
													<th scope="col">Status</th>
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
							
							
								<div class="card card-stats  card-round text-white" style="background-image: linear-gradient(40deg,gray,black);">
								    	<a href="javascript:void(0)" id="dismissed" class="card-link text-light">
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
								Dismissed Case
								</div>
								
								</a>
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
			
			 <!-- Modal -->
			 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Manage Blotter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_blotter.php"    enctype="multipart/form-data" >
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Complainant Name</label>
										
											<input type="text" class="form-control" placeholder="Enter Complainant Name" name="complainant" required>



										</div>
									</div>
									<div class="col-md-6">

									<div class="form-group">
											<label>Complainant Age</label>
											<input type="number" class="form-control" placeholder="Enter Complainant age" name="comage" required>
										</div>
									
									
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
											<label>Complainant Address</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Address" name="comaddress" required>
										</div>
										<div class="form-group">
											<label>Respondent Name</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" name="respondent" required>
										</div>

										<div class="form-group">
											<label>Respondent Age</label>
											<input type="number" class="form-control" placeholder="Enter Respondent age" name="respondentage" required>
										</div>
									</div>
									<div class="col-md-6">

									<div class="form-group">
											<label>Complainant Contact No</label>
											<input type="number" class="form-control" placeholder="Enter Complainant Contact No" name="comcontact" required>
										</div>

										<div class="form-group">
											<label>Respondent Address</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Address" name="resaddress" required>
										</div>
										<div class="form-group">
											<label>Blotter Type</label>
											<select class="form-control" name="type">
												<option disabled selected>Select Blotter Type</option>
												<option value="Slight Physical Injuries">Slight Physical Injuries</option>
												<option value="Domestic Dispute">Domestic Dispute</option>
												<option value="Theft">Theft</option>
												<option value="Malicous Mischief">Malicous Mischief</option>
												<option value="Threat">Threat</option>
												<option value="Oral Defamation">Oral Defamation</option>
											</select>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
								
										<div class="form-group">
											<label>Incident Location</label>
											<input type="text" class="form-control" placeholder="Enter Location" name="location" required>
										</div>
										
											<div class="form-group">
											<label>OR NO</label>
											<input type="number" min="0" class="form-control" name="orno" value=""  required>
										</div>
									</div>
									<div class="col-md-6">
									
														
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status">
												<option disabled selected>Select Blotter Status</option>
												<option value="pending">Pending</option>
												<option value="Settled">Settled</option>
												<option value="Scheduled">Scheduled</option>

											</select>
										</div>
										
											<div class="form-group">
											<label>Amount</label>
											<input type="number" min="0" class="form-control" name="amount" value=""  required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										
									<div class="form-group">
											<label>Time Incident</label>
											<input type="time" class="form-control" name="timeincident" value="" required>
										</div>
										<div class="form-group">
											<label>Date Notice</label>
											<input type="date" class="form-control" name="datenotice" value=""  required>
										</div>
										
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label>Date Incident</label>
											<input type="date" class="form-control" name="dateincident" min="" max="<?=date("Y-m-d")?>" value="" required>
										</div>
										<div class="form-group">
											<label>Time Notice</label>
											<input type="time" class="form-control" name="timenotice" value="" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Details</label>
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." name="details" required></textarea>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										
									<div class="form-group">
											<label>Blotter Image</label>
									<input type="file" class="form-control" name="blotterimg" accept="image/*" required>
										</div>
								
										
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label>Logbook</label>
									<input type="file" class="form-control" name="logbook"  accept="image/*" required>
										</div>
								
									</div>
								</div>
															
                        </div>
                        <div class="modal-footer">
                            	<input type="hidden" class="form-control" name="pno" value="pno" required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

		      	 <!-- Modal -->
			 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_blotter.php"  enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Complainant Name</label>
										
											<input type="text" class="form-control" placeholder="Enter Complainant Name" name="complainant" id="complainant" required>



										</div>
									</div>
									<div class="col-md-6">

									<div class="form-group">
											<label>Complainant Age</label>
											<input type="number" class="form-control" placeholder="Enter Complainant age" name="comage" id="comage" required>
										</div>
									
									
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
											<label>Complainant Address</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Address" name="comaddress" id="comadd" required>
										</div>
										<div class="form-group">
											<label>Respondent Name</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" name="respondent" id="respondent" required>
										</div>

										<div class="form-group">
											<label>Respondent Age</label>
											<input type="number" class="form-control" placeholder="Enter Respondent age" name="respondentage" id="resage" required>
										</div>
									</div>
									<div class="col-md-6">

									<div class="form-group">
											<label>Complainant Contact No</label>
											<input type="number" class="form-control" placeholder="Enter Complainant Contact No" name="comcontact" id="comtact" required>
										</div>

										<div class="form-group">
											<label>Respondent Address</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Address" name="resaddress" id="resadd" required>
										</div>
										<div class="form-group">
											<label>Blotter Type</label>
											<select class="form-control" name="type" id="type">
												<option disabled selected>Select Blotter Type</option>
												<option value="Slight Physical Injuries">Slight Physical Injuries</option>
												<option value="Domestic Dispute">Domestic Dispute</option>
												<option value="Theft">Theft</option>
												<option value="Malicous Mischief">Malicous Mischief</option>
												<option value="Threat">Threat</option>
												<option value="Oral Defamation">Oral Defamation</option>
											</select>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
								
										<div class="form-group">
											<label>Incident Location</label>
											<input type="text" class="form-control" placeholder="Enter Location" name="location" id="location" required>
										</div>
										
											<div class="form-group">
											<label>OR NO</label>
											<input type="number" min="0" class="form-control" name="orno" value="" id="orno" required>
										</div>
									</div>
									<div class="col-md-6">
									
														
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status" id="status">
												<option disabled selected>Select Blotter Status</option>
												<option value="pending">Pending</option>
												<option value="Settled">Settled</option>
												<option value="Scheduled">Scheduled</option>
											    <option value="dismissed">Dismissed</option>
											</select>
										</div>
										
										
											<div class="form-group">
											<label>Amount</label>
											<input type="number" min="0" class="form-control" name="amount" value="" id="amount" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										
									<div class="form-group">
											<label>Time Incident</label>
											<input type="time" class="form-control" name="timeincident" value="" id="timeincident" required>
										</div>
										<div class="form-group">
											<label>Date Notice</label>
											<input type="date" class="form-control" name="datenotice" value=""  id="datenotice" required>
										</div>
										
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label>Date Incident</label>
											<input type="date" class="form-control" name="dateincident" min="" max="<?=date("Y-m-d")?>" value="" id="dateincident" required>
										</div>
										<div class="form-group">
											<label>Time Notice</label>
											<input type="time" class="form-control" name="timenotice" value="" id="timenotice" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Details</label>
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." name="details"  id="details" required></textarea>
								</div>
								
								
								
								<div class="row">
									<div class="col-md-6">
										
									<div class="form-group">
											<label>Current Blotter Image</label>
											
									<img src="assets/img/uploadimage.png" class="img-fluid border rounded"  id="blotterimg" ><br>
                                    <label>Change Image to:</label>
									<input type="file" class="form-control" name="blotterimg" accept="image/*">
										</div>
								
										
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label>Current Logbook Image</label>
									
									<img src="assets/img/uploadimage.png" class="img-fluid border rounded"  id="logbook" ><br>
                                    <label>Change LogBook Image to:</label>
											
											
									<input type="file" class="form-control" name="logbook"  accept="image/*" >
										</div>
								
									</div>
								</div>
                            
                        </div>
                        <div class="modal-footer">
                            	<input type="hidden" class="form-control" name="pno" value="pno" required>
						<input type="hidden" class="form-control" name="id" id="blotter_id" value="" required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
        });
    </script>
</body>
</html>