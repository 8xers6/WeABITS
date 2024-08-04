<?php include 'server/server.php' ?>
<?php 




$barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";
    $result = $conn->query($query);

    $permit = array();
	while($row = $result->fetch_assoc()){
		$permit[] = $row; 
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Building Permit -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Certificates</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Building Clearance</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Building Permit
												</a>
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">BP no</th>
													<th scope="col">O.R. No.</th>
												<th scope="col">CTC No.</th>
									
													<th scope="col">Full Name</th>
													<th scope="col">Resident Address</th>
													<th scope="col">Age</th>
                                                    <th scope="col">Date Applied</th>
                                                   
                                                    <th scope="col">Building Location</th>
                                                   		<th scope="col">Amount</th>


													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($permit)): ?>
													<?php foreach($permit as $row): ?>
													<tr>
														<td><?= $row['bp_no'] ?></td>
														<td><?=  $row['or_no'] ?></td>
													<td><?=  $row['ctc_no'] ?></td>
														
														

														<td>

														<div  style="width:200px;">
                                                          
                                                       


													  <?= $row['res_id'] ?>-<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
															   
																  
																
														  </div>
														</td>
                                                        <td>           <div style="width:150px;">
                                                         
														 <?= ucwords($row['household_no'].'    '.$row['streetname']).' ' ?>

														  </div></td>

														  <td><?= $row['age'] ?></td>
                                                        <td>
															<div style="width:100px;">
															<?= $row['applied'] ?>

													        </div>
															
														</td>
                                                      
                                                        <td> <div  style="width: 150px;"><?= $row['bhouseno'] ?>, <?= $row['bstreet'] ?>
                                                        
                                                        
                                                        		<td><div  style="width:130px;"><b>&#8369</b><?= number_format($row['amounts'],2) ?></div></td>

												  	</div>
													
													</td>
												
                                                        <?php if(isset($_SESSION['username'])):?>
														<td>
															<div class="form-button-action">
															<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Business Permit" onclick="editBuildingPermit(this)" 
                                                                 data-bpno="<?= $row['bp_no'] ?>" 
															 data-house="<?= $row['bhouseno'] ?>"
															 data-bstreet="<?= $row['bstreet'] ?>"
														 data-amount="<?= $row['amounts'] ?>"
																 data-applied="<?= $row['applied'] ?>"  
																 data-orno="<?= $row['or_no'] ?>" data-ctcno="<?= $row['ctc_no'] ?>"
															 data-fname="<?= $row['firstname'] ?>"  data-mname="<?= $row['middlename'] ?>"
                                                                        data-lname="<?= $row['lastname'] ?>"
																 >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
							
																<a type="button" data-toggle="tooltip" href="generate_buildingpermit.php?id=<?= $row['res_id'] ?>&reqno=<?=$row['req_no']?>" class="btn btn-link btn-primary" data-original-title="Generate Permit">
																	<i class="fas fa-file-alt"></i>
																</a>
																<?php if(isset($_SESSION['username']) ): ?>
																<a type="button" data-toggle="tooltip" href="model/remove_building.php?id=<?= $row['bp_no'] ?>" onclick="return confirm('Are you sure you want to delete this building permit?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
																<?php endif ?>
															</div>
														</td>
														<?php endif ?>
														
													</tr>
													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												<th scope="col">BP no</th>
													<th scope="col">O.R. No.</th>
												<th scope="col">CTC No.</th>
												
													<th scope="col">Full Name</th>
													<th scope="col">Resident Address</th>
													<th scope="col">Age</th>
                                                    <th scope="col">Date Applied</th>
                                                   
                                                    <th scope="col">Building Location</th>
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
					</div>
				</div>
			</div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

			<!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Building Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_building.php" >
                                <div class="form-group">
                                    <label>Resident Name</label>
								
									<div class="search_select_box">
                                  
								      <select name="resid" class="form-control input-sm" required data-live-search="true">
									  <option selected="" disabled="" value="">-- Select Resident -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT res_id,lastname,firstname,middlename from tbl_residents WHERE  bar_no=$barno ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['res_id'].'">'.$row['res_id'].', '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                                </div>
                              
								

								<div class="form-group">
                                    <label>House No.</label>
                                    <input type="text" class="form-control" name="bhouseno" placeholder="Enter House No"  required>
                                </div>

								<div class="form-group">
                                    <label>Street</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
								      <select name="bstreet" class="form-control input-sm" required data-live-search="true">
									  <option selected value=""  disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE bar_no=$barno");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['streetname'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
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
                                    <input type="number" min='0' class="form-control" name="amount"  required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied </label>
                                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>







<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Building Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_building.php" >
                                <div class="form-group">
                                    <label>Resident Name</label>
									<input type="text" class="form-control"   id="fullname" required>
								
                                </div>
                              
								

								<div class="form-group">
                                    <label>House No.</label>
                                    <input type="text" class="form-control" name="bhouseno" id="bhouseno" required>
                                </div>

								<div class="form-group">
                                    <label>Street</label>
									<input type="text" class="form-control"  id="bstreet" required>
									<label>Change to:</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
								      <select name="bstreet" class="form-control input-sm"  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE  bar_no=$barno ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['streetname'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                                </div>
								<div class="form-group">
                                    <label>OR No.</label>
								

						
						 <input type="number" class="form-control" placeholder="Enter OR No." id="orno" name="orno" required>



                                </div>

								<div class="form-group">
                                    <label>CTC No.</label>
                                    <input type="number" class="form-control" placeholder="Enter CTC No." id='ctcno' name="ctcno" required>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" min='0' class="form-control" name="amount"  id="amount" required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied</label>
                                    <input type="date" class="form-control" name="applied"  id="applied" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
						<input type="hidden" class="form-control" name="bpno" id="bpno" required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>














		</div>
	</div>
	<?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();

			$('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>