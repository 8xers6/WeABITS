<?php include 'server/server.php' ?>
<?php
    $query = "SELECT *,lpad(province_id,5,'0')as province_id FROM tblprovince";
    $result = $conn->query($query);

    $barangay = array();
	while($row = $result->fetch_assoc()){
		$barangay[] = $row; 
	}
?>


<?php if(isset($_SESSION['username']) && $_SESSION['role']=='superadmin' ): ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Add Province -  Barangay Management System</title>
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
										<div class="card-title">List of Province</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Add Province
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                   
                                                    <th scope="col">Province Name</th>
                                                 
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($barangay)): ?>
                                                    <?php foreach($barangay as $row): ?>
                                                    <tr>
                                                    
                                                        <td><?= $row['province'] ?></td>
                                                      
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Province" onclick="editProvince(this)" 
                                                                    data-provinceid="<?= $row['province_id'] ?>" 
                                                                    data-province="<?= $row['province'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_province.php?id=<?= $row['province_id'] ?>" onclick="return confirm('Are you sure you want to delete this Province this cant be undone!?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php  endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                            
                                                    <th scope="col">Province Name</th>
                                                 
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Province</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addprovince.php" >
                  
                                <div class="form-group">
                                <label>Province Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Province Name" name="provincename" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Province</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/editprovince.php" >
                  
                                <div class="form-group">
                              
                                <input type="hidden" class="form-control fw-bold" name="provinceid" id="provinceid" readonly style="color:black;" required>
                                <label>Province Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Province Name" name="provincename" id="provincename" required>
                                                            </div>
                                                           

                                 
                            
                        </div>
                        <div class="modal-footer">
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
            $('#streettable').DataTable();
            $('.search_select_box select').selectpicker();



            $('#province').change(function(){


             var prov=$("#province").val();

             $.ajax({
          type: 'POST',
          url: 'model/place.php',
          data: { prov: prov, },
          success: function(response) {
            $('#city').html(response);
            
          }
          
      });

            });
        });
    </script>
</body>
</html>

<?php endif ?>
