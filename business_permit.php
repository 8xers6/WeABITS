<?php include 'server/server.php' ?>
<?php







$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
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
	<title>Business Clearance -  Barangay Management System</title>

	

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
										<div class="card-title">Barangay Business Clearance Issuance</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
							
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Business Clearance
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
												<th scope="col">BP NO</th>
												<th scope="col">O.R. No.</th>
												<th scope="col">CTC No.</th>
												
												
													<th scope="col">Business Owner</th>
													<th scope="col">Name of Business</th>
													<th scope="col">Business Owner Address</th>

													<th scope="col">Nature</th>
													<th scope="col">Business Address</th>
													<th scope="col">Business Contact Number</th>
													<th scope="col">Date Applied</th>
													<th scope="col">Date Expired</th>
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
													<td><?= ucwords($row['busp_no']) ?></td>
													<td><?=  $row['or_no'] ?></td>
													<td><?=  $row['ctc_no'] ?></td>
													
														<td>   <div  style="width:210px;">
                                                          
                                                       <?=  ucwords($row['res_id']) ?>-

  <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
															   
																  
																
														  </div>
													</td>


													<td><?= ucwords($row['businessname']) ?></td>
													<td>
                                                            <div style="width:180px;">
                                                         
                                                            <?= ucwords($row['household_no'].'    '.$row['streetname']).' ' ?>

                                                             </div>
                                                        </td>
														

														<td><?= $row['nature'] ?></td>

														<td>
                                                            <div style="width:150px;">
                                                         
                                                            <?= ucwords($row['bstreet']) ?> 

                                                             </div>
                                                        </td>
														<td><?=  $row['bcontact_no'] ?></td>
														
														
														<td>
															<div style="width:80px;">
														
														<?= $row['applied'] ?></div>
													
													</td>
													<td>
															<div style="width:80px;">
														
														<?= $row['expired_date'] ?></div>
													
													</td>

													<td>
															<div style="width:80px;">
														
															<b> &#8369 </b><b ><?= number_format($row['amounts'],2) ?></div>
													
													</td>
                                                        <?php if(isset($_SESSION['username'])):?>
														<td>
															<div class="form-button-action">

															<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Business Permit" onclick="editBusinessPermit(this)" 
                                                                 data-busno="<?= $row['busp_no'] ?>" data-bname="<?= $row['businessname'] ?>" 

																 data-BO="<?= $row['nature_of_business_ownership'] ?>" 
																 data-dtino="<?= $row['dti_registration_no'] ?>"
																 data-bnature="<?= $row['nature'] ?>"  data-bstreet="<?= $row['bstreet'] ?>"
																 data-bcontact="<?= $row['bcontact_no'] ?>"
																 data-applied="<?= $row['applied'] ?>"  data-expired="<?= $row['expired_date'] ?>"
																 data-orno="<?= $row['or_no'] ?>" data-ctcno="<?= $row['ctc_no'] ?>" data-amount="<?= $row['amounts'] ?>" 
															 data-fname="<?= $row['firstname'] ?>"  data-mname="<?= $row['middlename'] ?>"
                                                                        data-lname="<?= $row['lastname'] ?>"
																 >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
																<a type="button" data-toggle="tooltip" href="generate_business_permit.php?id=<?= $row['res_id'] ?>&reqno=<?=$row['req_no']?>&busp=<?=$row['busp_no']?>" class="btn btn-link btn-primary" data-original-title="Generate Permit">
																	<i class="fas fa-file-alt"></i>
																</a>
																<?php if(isset($_SESSION['username']) ): ?>
																<a type="button" data-toggle="tooltip" href="model/remove_business.php?bpid=<?= $row['busp_no'] ?>" onclick="return confirm('Are you sure you want to delete this business permit?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
												<th scope="col">BP NO</th>
												<th scope="col">O.R. No.</th>
												<th scope="col">CTC No.</th>
												
												
													<th scope="col">Business Owner</th>
													<th scope="col">Name of Business</th>
													<th scope="col">Business Owner Address</th>

													<th scope="col">Nature</th>
													<th scope="col">Business Address</th>
													<th scope="col">Business Contact Number</th>
													<th scope="col">Date Applied</th>
													<th scope="col">Date Expired</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_business.php" >
							<input type="hidden" name="size" value="1000000">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Business Name" name="bname" required>
                                </div>
								

							


								<div class="form-group">
                                    <label>Owner</label>

									<div class="search_select_box">
                                  
								      <select name="owner1" class="form-control " data-live-search="true">
									  <option selected="" disabled="">-- Select Resident -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT res_id,lastname,firstname,middlename from tbl_residents WHERE  bar_no=$barno ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['res_id'].'">Res ID:'.$row['res_id'].' | '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>

						


                                </div>

								

								<div class="form-group">
                                    <label>Business Nature</label>
                                    <input type="text" class="form-control" placeholder="Sari-Sari Store/Warter Refill Station" name="nature" required>
                                </div>
								<div class="form-group">
								<label> Nature of Business Ownership</label>
								<select  class="form-control"  name="natureBO" required >
							<option disabled selected value="">Select Nature of Business Ownership</option>
												<option value="Sole-proprietorship">Sole Proprietorship</option>
											<option value="Partnership">Partnership</option>
											<option value="Corporation">Corporation</option>
											<option value="LLC">Limited Liability Company (LLC)</option>
											<option value="Cooperative">Cooperative</option>
											<option value="Store">Store</option>
											<option value="Tiangge">Tiangge</option>
											<option value="Talipapa">Talipapa</option>
											</select>

										</div>


								<div class="form-group">
                                    <label>Business Street Location</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
								      <select name="bstreet" class="form-control input-sm"  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet 	WHERE bar_no=$barno");
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
							<label>SEC/ DTI Registration Number</label>
							
                                                    <input type="number" min="1" class="form-control" placeholder="Enter SEC/ DTI Registration Number" name="dtino" required >

						    </div>
								<div class="form-group">
                                    <label>Business Contact No.</label>
                                    <input type="number" class="form-control" placeholder="Enter Business Contact No." name="bcontact" required>
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
                                    <label>Amount.</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Enter Amount"   required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_business.php" >
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" id="bname" placeholder="Enter Business Name" name="bname" required>
                                </div>
								
							
							

                                 
                                <div class="form-group">

                                    <label>Business Owner</label><br>
									<input type="text" class="form-control" placeholder="" id='fullname' name="" required>

									

						


                                </div>

								<div class="form-group">
								<label> Nature of Business Ownership</label>
								<select  class="form-control"  name="natureBO" id="natureBO" required >
							<option disabled selected value="">Select Nature of Business Ownership</option>
												<option value="Sole-proprietorship">Sole Proprietorship</option>
											<option value="Partnership">Partnership</option>
											<option value="Corporation">Corporation</option>
											<option value="LLC">Limited Liability Company (LLC)</option>
											<option value="Cooperative">Cooperative</option>
											<option value="Store">Store</option>
											<option value="Tiangge">Tiangge</option>
											<option value="Talipapa">Talipapa</option>
											</select>

										</div>

								<div class="form-group">
                                    <label>Business Nature</label>
                                    <input type="text" class="form-control" id="bnature" placeholder="Sari-Sari Store/Warter Refill Station" name="nature" required>
                                </div>


								<div class="form-group">
						

                                    <label>Business Street Location</label>
								
									<input type="text" class="form-control" placeholder="" id='bstreet'>

									<label>Change to:</label>

                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
								      <select name="bstreet" class="form-control input-sm"  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
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
							<label>SEC/ DTI Registration Number</label>
							
                                                    <input type="number" min="1" class="form-control" id="dtino" placeholder="Enter SEC/ DTI Registration Number" name="dtino" required >

						    </div>
								<div class="form-group">
                                    <label>Business Contact No.</label>
                                    <input type="number" class="form-control" placeholder="Enter Business Contact No." name="bcontact" id="bcontact" required>
                                </div>


								<div class="form-group">
                                    <label>OR No.</label>
									<input type="number" class="form-control" id='orno' name="orno" required>
							
								

						


                                </div>

								<div class="form-group">
                                    <label>CTC No.</label>
                                    <input type="number" name="ctcno" class="form-control" placeholder="Enter CTC No." id='ctcno'  required>
                                </div>
                                
                                
                                	<div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class="form-control" placeholder="Enter Amount" id='amount'  required>
                                </div>



								<div class="form-group">
                                    <label>Date Applied Nature</label>
                                    <input type="date" class="form-control" name="applied" id="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>

								<div class="form-group">
                                    <label>Date Expired</label>
                                    <input type="date" class="form-control" name="expired" id="expired" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
						<input type="hidden" class="form-control" id="busno" name="buspno" required>
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
        });

		$('.search_select_box select').selectpicker();


    </script>

	
</body>
</html>