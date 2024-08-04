<?php include 'server/server.php' ?>
<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>BackUp and Restore -  Barangay Management System</title>
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
										<div class="card-title"><i class="fa fa-database"></i> BackUp and Restore</div>
										<div class="card-tools">


                                     
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                 

                                                <td ><button type="submit" class="btn btn-primary form-control fw-bold" href="#backup"    data-bs-toggle="modal" 
            data-bs-target="#backup"><i class="fa fa-database"></i> BackUp</button> </td>
                                                <td><button type="submit" class="btn btn-primary form-control fw-bold" href="#backup"    data-bs-toggle="modal" 
            data-bs-target="#restore" class="btn btn-info btn-border btn-round btn-sm"><i class="fa fa-database"></i> Restore</button> </td>
                                                </tr>
                                            </thead>
                                        
                                          
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <div class="modal fade" id="restore" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore Database</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/restore.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div class="form-group form-floating-label">
                <label>Super Admin Password</label>
                        <input type="password" id="cur_pass" class="form-control" placeholder="Enter Superadmin Password" name="cur_pass" required >
                        <span toggle="#cur_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <div class="form-group form-floating-label">
                        <label>Upload Sql file</label>
                        <input type="file" class="form-control" accept=".sql" name="backup_file" required>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to restore database this cant be undone?');">Restore</button>
            </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="backup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Backup Database</h5>

            </div>
            <div class="modal-body">
                <form method="POST" action="model/backup.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div class="form-group form-floating-label">
                        <label>Super Admin Password</label>
                        <input type="password" id="cur_passs" class="form-control" placeholder="Enter Super Admin Password" name="cur_pass" required >
                        <span toggle="#cur_passs" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to backup database?');" >BackUp</button>
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



    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
         integrity=
"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#streettable').DataTable();
        });
    </script>
</body>
</html>