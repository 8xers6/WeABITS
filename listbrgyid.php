<?php include 'server/server.php' ?>
<?php

$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id WHERE tbl_residents.bar_no=$barno ";
    $result = $conn->query($query);

    $brgyid = array();
	while($row = $result->fetch_assoc()){
		$brgyid[] = $row; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay ID's -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold"></h2>
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
										<div class="card-title">Barangay Resident ID</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Brgy ID
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID NO</th>
                                                    <th scope="col">Resident ID</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Date Issued</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($brgyid)): ?>
                                                    <?php $no=1; foreach($brgyid as $row): ?>
                                                    <tr>
                                                        <td><?= $row['id_no'] ?></td>
                                                        <td><?= $row['res_id'] ?></td>
                                                        
                                                        <td><?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?></td>


                                                        <td>₱<?=$row['amounts']?></td>

                                                        <td><?= $row['date_issued'] ?></td>
                                                    
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit ID" onclick="editBarangayID(this)" 
                                                         data-idno="<?= $row['id_no'] ?>"
                                                         data-resid="<?= $row['res_id'] ?>"
                                                         data-fname="<?= $row['firstname'] ?>"   
                                                         data-mname="<?= $row['middlename'] ?>"   
                                                         data-lname="<?= $row['lastname'] ?>"
                                                         data-suffix="<?= $row['suffix'] ?>"
                                                              data-amount="<?= $row['amounts'] ?>"
  data-orno="<?= $row['or_no'] ?>"
                                                         data-username="<?=$_SESSION['username'] ?>"

                                                         data-idpic="<?= $row['id_picture'] ?>"
                                                         data-date="<?= $row['date_issued'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                               
																<a type="button" data-toggle="tooltip" href="barangayid.php?id=<?= $row['id_no'] ?>" class="btn btn-link btn-info" data-original-title="Generate Barangay ID">
																	<i class="fa fa-file"></i>
																</a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_barangayid.php?id=<?= $row['id_no'] ?>" onclick="return confirm('Are you sure you want to Remove this?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                    <th scope="col">ID NO</th>
                                                    <th scope="col">Resident ID</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Amount</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Barangay ID</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_barangayid.php"    enctype="multipart/form-data" >
                            <div class="form-group">
                                <label>Resident</label>

								<div class="search_select_box">
                                  
								  <select name="resid" class="form-control input-sm" data-live-search="true">
								  <option selected="" disabled="">-- Select Resident -- </option>
								  <?php
									  $squery = mysqli_query($conn,"SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno  AND tbl_residents.verify_status='verified';");
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
								<label>OR No</label>
								
								<input type="number" min="0" class="form-control" name="orno" placeholder="Enter OR NO"   required>

										</div>
                                     <div class="form-group">
								<label>Amount</label>
								
								<input type="number" min="0" class="form-control" name="amount" placeholder="Enter Amount"   required>

										</div>
                                <div class="form-group">
								<label>Resident Image</label>
								
								<input type="file" class="form-control" name="respic"  accept="image/*"  required>

										</div>

                                        <div class="form-group">
								<label>Date Issue</label>
								
								<input type="date" class="form-control" name="dateissue" value="<?php echo date('Y-m-d'); ?>"  required>

										</div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Barangay ID</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_barangayid.php"    enctype="multipart/form-data" >
                            <div class="form-group">
                                <label>Resident Name</label>

                                <input type="text" class="form-control fw-bold " style="color:black;" name="" id="fullname" readonly  required>

                                   
                                </div>
                                            <div class="form-group">
								<label>OR No</label>
								
								<input type="number" min="0" class="form-control" name="orno" placeholder="Enter OR NO" id="orno"  required>

										</div>
                                         <div class="form-group">
								<label>Amount</label>
								
								<input type="number" min="0" class="form-control" name="amount" id="amount" placeholder="Enter Amount"  required>

										</div>
                                <div class="form-group">
                                <label>Current Picture:</label><br>
                                <img src="assets/img/person.png" alt="..." class="img-fluid " id="idpic"> <br>
								<label>Change Resident Picture to:</label>
								
								<input type="file" class="form-control" name="respic"  accept="image/*"  >

										</div>

                                        <div class="form-group">
								<label>Date Issued</label>
								
								<input type="date" class="form-control" name="dateissue" id="date"  required>

										</div>
                            
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" class="form-control" name="idno" id="idno"  required>
                        <input type="hidden" class="form-control" name="resid" id="resid"  required>
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
        });




        function editBarangayID(that){
   
   
    idno= $(that).attr('data-idno');
    resid= $(that).attr('data-resid');
  
    date = $(that).attr('data-date');
    amount = $(that).attr('data-amount');
     orno = $(that).attr('data-orno');


    idpic = $(that).attr('data-idpic');
  
 
    uname 		= $(that).attr('data-username');

    idpicsrc='assets/uploads/'+uname+'/resident/'+resid+'/'+idpic;
  
    $('#idpic').attr('src', idpicsrc);


    $('#idno').val(idno);
    $('#resid').val(resid);
    $('#date').val(date);
    $('#amount').val(amount);

     
 $('#orno').val(orno);

           fname = $(that).attr('data-fname');
           mname = $(that).attr('data-mname');
           lname = $(that).attr('data-lname');
           suffix = $(that).attr('data-suffix');
         
         
        
             
             fullname=lname+' , '+fname+'  '+mname+'  '+suffix;
        
             $('#fullname').val(fullname);

    
  
  
  
  
  }
    </script>
</body>
</html>