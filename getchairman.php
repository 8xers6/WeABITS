<?php include 'server/server.php' ?>
<?php

$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM `tblchairmanship` WHERE `bar_no`=$barno";
    $result = $conn->query($query);

    $chair = array();
	while($row = $result->fetch_assoc()){
		$chair[] = $row; 
	}
	
	
	
	 	$query1 = "UPDATE tblbarangay SET  `street`='1'  WHERE bar_no=$barno;";

		if($conn->query($query1) === true){

		
				
			
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Chairmanship -  Barangay Management System</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php //include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php //include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="">
			<div class="">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Set Up Chairmanship</h2>
							</div>
							
						</div>
						
							 <a href="model/logout.php" class="text-white" onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        Sign Out
                    </a>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?><?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Chairmanship</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Chairmanship
											</a>
											<a type="button" href="getpersonel" class="ml-3 btn btn-primary text-white fw-bold" onclick="return confirm('Are you sure you want to proceed?');">Next</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
												
													<th scope="col">Title</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($chair)): ?>
													<?php $no=1; foreach($chair as $row): ?>
													<tr>
											
														<td><?= $row['title'] ?></td>
														<td>
															<div class="form-button-action">
																<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" 
																	title="Edit Title" onclick="editChair(this)" data-title="<?= $row['title'] ?>" data-id="<?= $row['id'] ?>">
																	<i class="fa fa-edit"></i>
																</a>
																<a type="button" data-toggle="tooltip" href="model/remove_chair.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this title?');" 
																	class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</td>
													</tr>
													<?php $no++; endforeach ?>
												<?php else: ?>
													<tr>
														<td colspan="3" class="text-center">No Available Data</td>
													</tr>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												
													<th scope="col">Title</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Chairmanship</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_chairmanship.php" >
                                <div class="form-group">
                                    <label>Chairmanship</label>
                                    <input type="text" class="form-control" placeholder="Enter Chairmanship" name="chair" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_chairmanship.php" >
                                <div class="form-group">
                                    <label for="position">Chairmanship</label>
                                    <input type="text" class="form-control" id="chair" placeholder="Chairmanship" name="chair" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="chair_id" name="id">
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
</body>
</html>