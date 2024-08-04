<?php include 'server/server.php' ?>
<?php


$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM tblhousehold LEFT JOIN tblstreet  on tblstreet.st_id=tblhousehold.st_id WHERE tblhousehold.bar_no=$barno ORDER BY `household_no`";
    $result = $conn->query($query);

    $street = array();
	while($row = $result->fetch_assoc()){
		$street[] = $row; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay HouseHold -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Settings</h2>
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
										<div class="card-title">Barangay HouseHold </div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												HouseHold
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                
                                                    <th scope="col">HouseHold NO./buildingname/lotnumber.</th>
                                                    <th scope="col">Street</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($street)): ?>
                                                    <?php $no=1; foreach($street as $row): ?>
                                                    <tr>
                                                        
                                                        <td><?= $row['household_no'] ?></td>
                                                        <td><?= $row['streetname'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit HouseHold" onclick="editHousehold(this)" 
                                                                    data-householdno="<?= $row['household_no'] ?>" data-street="<?= $row['streetname'] ?>" data-id="<?= $row['h_no'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_household.php?id=<?= $row['h_no'] ?>" onclick="return confirm('Are you sure you want to delete this Household?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
                                         
                                                    <th scope="col">HouseHold No.-Buildingname-lotnumber.</th>
                                                    <th scope="col">Street</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create HouseHold</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_household.php" >
                                <div class="form-group">
                                    <label>Household No. *if has(building name -lot no.)</label>
                                    <input type="text" class="form-control" placeholder="Household No. building name -lot no." name="householdno" required>
                                </div>
                                <div class="form-group">
                                    <label>Street</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="street" class="form-control input-sm"  data-live-search="true">
                                  <option selected="" disabled="">-- Select Street -- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE bar_no=$barno");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit HouseHold</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edithousehold.php" >
                                <div class="form-group">
                                    <label>HouseHold No.</label>
                                    <input type="text" class="form-control fw-bold"style="color:black; " id="hhno" placeholder="Enter Street Name" name="householdno" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Street</label>
                                    <input type="text" class="form-control fw-bold" style="color:black; " id="street"  readonly>

                                    <label>Change to:</label>

                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
								      <select name="street" class="form-control input-sm"  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE bar_no=$barno");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="id" name="id" >
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
            $('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>