<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tblcity LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id";
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
	<title>Add Cities/Municipalities -  Barangay Management System</title>
</head>
<body>
<?php //include 'templates/loading_screen.php' ?>
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
										<div class="card-title">List of Cities/Municipalities</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												City/Municipality
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                   
                                                    <th scope="col">Municipality Name</th>
                                                    <th scope="col">Zip Code</th>
                                                    <th scope="col">Province Name</th>
                                               
                                                 
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($barangay)): ?>
                                                    <?php foreach($barangay as $row): ?>
                                                    <tr>
                                                       
                                                        <td><?= $row['city'] ?></td>
                                                          <td><?= $row['zipcode'] ?></td>
                                                        <td><?= $row['province'] ?></td>
                                                    
                                                    
                                                        <td>  
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Municipality" onclick="editCity(this)" 
                                                                    data-cityid="<?= $row['city_id'] ?>" data-cityname="<?= $row['city'] ?>"  data-zipcode="<?= $row['zipcode'] ?>" 
                                                                     data-province="<?= $row['province'] ?>"
                                                                    
                                                                >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_city.php?id=<?= $row['city_id'] ?>" onclick="return confirm('Are you sure you want to delete this City this cant be undone?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php  endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="2" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                         
                                              
                                                    <th scope="col">Municipality Name</th>
                       <th scope="col">Zip Code</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Municipality</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addcity.php" >
                  
                                <div class="form-group">
                                <label>Municipality Name</label>
                                <input type="text" class="form-control"  placeholder="Enter City Name" name="cityname" required>
                                                            </div>
                                                            <div class="form-group">
                                <label>Zip Code:</label>
                                <input type="number" min='1' class="form-control"  placeholder="Enter Zip Code" name="zipcode" required>
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="provinces">Select a Province:</label>
                                                                                    
                      
                                <div class="search_select_box" style="border:solid blue 1px; border-radius:5px;">   
                                                            
                                                            <select name="province" class="form-control input-sm"   data-live-search="true" required>
                                                            <option  disabled selected="" value="" >-- Select Province -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblprovince");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['province_id'].'">'.$row['province'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Municipality</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_city.php" >
                  
                                <div class="form-group">
                                <input type="text" class="form-control"  placeholder="Enter Province Name" name="cityid" id="cityid" required>
                                <label>City Name</label>
                                <input type="text" class="form-control"  placeholder="Enter City Name" name="cityname" id="cityname" required>
                                                            </div>
                                                            
                                                            
                                                                                      <div class="form-group">
                                <label>Zip Code:</label>
                                <input type="text"  class="form-control"  placeholder="Enter Zip Code" name="zipcode" id="zipcode" required>
                                                            </div>
                                                           <div class="form-group">
                                                                <input type="text" class="form-control"    id="province" readonly>
                                                            <label for="provinces">Change Province:</label>
                                                                                           <div class="search_select_box" style="border:solid blue 1px; border-radius:5px;">   
                                                            
                                                            <select name="province" class="form-control input-sm"   data-live-search="true" >
                                                            <option  disabled selected="" value="" >-- Select Province -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblprovince");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['province_id'].'">'.$row['province'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
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
