<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM `tbl_indigency` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_indigency.res_id  WHERE tbl_residents.bar_no=$barno";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}

 

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Certificate of Indigency -  Barangay Management System</title>
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
										<div class="card-title">Certificate of Indigency</div>
										<?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
										
											
                                            <a href="#add" data-toggle="modal" class="btn btn-primary btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
											  Create Indigency
											</a>
										</div>
                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
												<th scope="col">Control No.</th>
											
											
												<th scope="col">Fullname</th>
												<th scope="col">Purpose</th>
                                                 
												<th scope="col">Date Issued</th>
												
                                            
                                                 
                                                   
                                                 
                                            
                                                  
                                                    <th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
													<td><?= $row['control_no'] ?></div></td>
												
												
														<td>
														<div  style="width:210px;">
                                                          
                                                       


									<?= $row['res_id'] ?> -  <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?> 
															   
																  
																
														  </div>
															</div> 
                                                        </td>
														<td><div  style="width:130px;"><?= $row['purpose'] ?></div></td>
                                                    
														<td><div  style="width:130px;"><?= $row['date_issued'] ?></div></td>
                                                      
                                                 
                                                       
                                                  


                                                  
														<td>
															<div class="form-button-action">

															<a type="button" href="#edit"  data-toggle="modal" class="btn btn-link btn-primary" title="Edit Document" onclick="editCerts(this)" 
															data-controlno="<?= $row['control_no'] ?>" data-purpose="<?= $row['purpose'] ?>"
															 data-fname="<?= $row['firstname'] ?>"  data-mname="<?= $row['middlename'] ?>"  data-date="<?= $row['date_issued'] ?>"
                                                                        data-lname="<?= $row['lastname'] ?>"
                                                               >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
																<a type="button" data-toggle="tooltip" href="generate_indigency_cert.php?id=<?= $row['res_id'] ?>&reqno=<?= $row['req_no'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Certificate">
																	<i class="fas fa-file-alt"></i>
																</a>

																<a type="button" data-toggle="tooltip" href="model/remove_indigency.php?controlno=<?= $row['control_no'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</td>
													
                                                       
                                                      



														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												<th scope="col">Control No.</th>
												
												
												<th scope="col">Fullname</th>
												<th scope="col">Purpose</th>
                                                 
												<th scope="col">Date Issued</th>
												
                                            
                                                 
                                                   
                                                 
                                            
                                                  
                                                    <th scope="col">Action</th>
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




			<!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Certificate of Indigency</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_indigency.php" autocomplete="off">

                             


							


                                <div class="form-group">
                                    <label>Select Resident</label>

									<div class="search_select_box">
                                  
								      <select name="resid" class="form-control " data-live-search="true">
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
								<label>Purpose</label>
								<input type="text" placeholder="enter purpose" class="form-control" name="purpose" value="" required>
										</div>


										<div class="form-group">
                                    <label>Date Issue</label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d'); ?>" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Certificate of Indigency</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_indigency.php" >
							<div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter CTC No." id='fullname' name="ctcno" required>
                                </div>
								
							<div class="form-group">
                                    <label>Control No.</label>
                                    <input type="number" style='color:black;' class="form-control fw-bold" placeholder="Enter CTC No." name="controlno" id="controlno" required readonly>
                                </div>


								<div class="form-group">
								<label>Purpose</label>
								<input type="text" placeholder="enter purpose" class="form-control" name="purpose" id="purpose" required>
										</div>


										<div class="form-group">
                                    <label>Date Issue</label>
                                    <input type="date" class="form-control" name="date"  id="date" required>
                                </div>

                        </div>
                        <div class="modal-footer">
						
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
            $('#residenttable').DataTable();

			$('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>