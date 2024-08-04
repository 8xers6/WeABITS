<?php include 'server/server.php' ?>
<?php 
	$user = $_SESSION['username'];
	$barno=$_SESSION['bar_no'];
	$query = "SELECT * FROM tbl_users WHERE bar_no=$barno  ORDER BY `created_at` DESC";
    $result = $conn->query($query);

    $users = array();
	while($row = $result->fetch_assoc()){
		$users[] = $row; 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>User Management -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Maintenance</h2>
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
										<div class="card-title">User Management</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												User
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped " id="usertable">
											<thead>
												<tr>
												
														<th scope="col">Name</th>
													<th scope="col">Username</th>
													<th scope="col">User Type</th>
													<th scope="col">Created At</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($users)): ?>
													<?php $no=1; foreach($users as $row): ?>
													<tr>
												
														
															<td><?= $row['name'] ?></td>
														<td>
														
                                                            <?= ucwords($row['username']) ?>
														</td>
														<td><?= $row['user_type'] ?></td>
														<td><?= $row['created_at'] ?></td>
														<td>
															<div class="form-button-action">
															          <a type="button" href="#edits" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Street" onclick="editUsers(this)" 
															          data-clerkid="<?=$row['id'] ?>"
															          data-username="<?=$row['username'] ?>"
                                                                    >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
																<a type="button" data-toggle="tooltip" href="model/remove_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</td>
														
													</tr>
													<?php $no++; endforeach ?>
												<?php else: ?>
													<tr>
														<td colspan="6" class="text-center">No Available Data</td>
													</tr>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												
															<th scope="col">Name</th>
													<th scope="col">Username</th>
													<th scope="col">User Type</th>
													<th scope="col">Created At</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_user.php" enctype="multipart/form-data">
							<input type="hidden" name="size" value="1000000">

							<!----
								<div class="text-center">
                                    <div id="my_camera" style="height: 250;" class="text-center">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                    </div>
                                    <div id="profileImage">
                                        <input type="hidden" name="profileimg">
                                    </div>LELEFT JOIN tblprovince on tblbarangay.province_id=tblprovince.province_idFT JOIN tblprovince on tblbarangay.province_id=tblprovince.province_id
                                    <div class="form-group">
                                        <inpss="form-group">
                                        <input type="file" class="form-control" name="img" accept="image/*">
                                    </div>

                                </div>

							--->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                                </div>
                        
                             
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" id="pillSelect" required name="user_type">
                                        <option disabled selected>Select User Type</option>
                                        <option value="Clerk">Clerk</option>
                                        <option value="Population">Population</option>
                                        <option value="BHW">Barangay Health Worker</option>
                                        <option value="Peace & Order">Peace and Order</option>
                                        <option value="Lupon">Lupon</option>
                                        
                                    </select>
                                </div>
                                      <div class="form-group form-floating-label">
                        <label> Password</label>
                        <input type="password" id="new_passs" class="form-control" placeholder="Enter New Password" name="pass" required >
                        <span toggle="#new_passs" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
<div class="modal fade" id="edits" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/changepass_clerk.php">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="hidden" class="form-control" placeholder="Enter Name" readonly name="id" id="clerkid" required >
                        <input type="text" class="form-control" placeholder="Enter Name" readonly  id="userclerk" required >
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Admin Password</label>
                        <input type="password" id="cur_pass" class="form-control" placeholder="Enter Admin Password" name="cur_pass" required >
                        <span toggle="#cur_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>New Password</label>
                        <input type="password" id="new_pass" class="form-control" placeholder="Enter New Password" name="new_pass" required >
                        <span toggle="#new_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Confirm Password</label>
                        <input type="password" id="con_pass" class="form-control" placeholder="Confirm Password" name="con_pass" required >
                        <span toggle="#con_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Change</button>
                            <?php endif ?>
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
            $('#usertable').DataTable();
        });
    </script>
</body>
</html>