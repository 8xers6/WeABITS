<?php include 'server/server.php' ?>
<?php

$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM tblstreet WHERE bar_no=$barno ORDER BY `streetname` ASC";
    $result = $conn->query($query);

    $streets = array();
	while($row = $result->fetch_assoc()){
		$streets[] = $row; 
	}
	
	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Streets -  Barangay Management System</title>
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
										<div class="card-title">Barangay Streets</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Street
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                    
                                                    <th scope="col">Street Name</th>
                                                    <th scope="col">Details</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  <?php if(!empty($streets)): ?>
                                                    <?php $no=1; foreach($streets as $row): ?>
                                                    <tr>
                                                      
                                                        <td><?= $row['streetname'] ?></td>
                                                        <td><?= $row['details'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Street" onclick="editStreet(this)" 
                                                                    data-stname="<?= $row['streetname'] ?>" data-details="<?= $row['details'] ?>" data-stid="<?= $row['st_id'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_street.php?id=<?= $row['st_id'] ?>" onclick="return confirm('Are you sure you want to delete this street?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                           
                                                    <th scope="col">Street Name</th>
                                                    <th scope="col">Details</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Street</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_street.php" >
                                <div class="form-group">
                                    <label>Street Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Street Name" name="streetname" required>
                                </div>
                                <div class="form-group">
                                    <label>Street Details</label>
                                    <textarea class="form-control" placeholder="Set Bounderies for each Street" name="details" required></textarea>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Street</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_street.php" >
                                <div class="form-group">
                                    <label>Street Name</label>
                                    <input type="text" class="form-control" id="streetname" placeholder="Enter Street Name" name="streetname" required>
                                </div>
                                <div class="form-group">
                                    <label>Street Details</label>
                                    <textarea class="form-control" id="details" placeholder="Set " name="details" required></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="text" id="st_id" name="stid" hidden >
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
            $('#streettable').DataTable();
        });
    </script>
</body>
</html>