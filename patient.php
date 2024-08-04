<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM `tbl_residents`  LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE    tbl_residents.bar_no=$barno; ";
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
	<title>Resident Information -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Health Center</h2>
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
										<div class="card-title">Patient List</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                            <!---
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Patient
											</a>--->
										</div>
                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>

                                            
													<th scope="col">Fullname</th>
														<th scope="col">Age</th>
                                                    <th scope="col">House No. & Street  </th>
												
												
												
                                                <th scope="col">Action</th>
                                              
                                                 
                                                   
                                                 
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>

                                          
                                             
										
                                                    
														<td>
                                                        <div  style="width:210px;">
                                                          
                                                       


                                                      	 <?= $row['res_id'] ?>-  <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                             
                                                                
                                                              
                                                        </div>

                                                        </td>
                                                        		<td><?= $row['age'] ?></td>
                                                        
                                                        

                                                        <td>
                                                            <div style="width:140px;">
                                                         
                                                            <?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

                                                             </div>
                                                        </td>
                                                 
												
                                                      
                                                       <td>
															<div class="form-button-action">
                                                              


 




                                                                  
                                                                </a>

                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ||$_SESSION['role']=='BHW'):?>
                                                                    <a type="button" data-toggle="tooltip" href="patientrecord?id=<?= $row['res_id'] ?>" class="btn btn-link btn-info" data-original-title="View Details">
																	<i class="fa fa-eye"></i>
																</a>
													
															
                                                                
                                                                <?php endif ?>
															</div>
														</td>
                                        


                                                     
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
								
                        
													<th scope="col">Fullname</th>
														<th scope="col">Age</th>
                                                    <th scope="col">House No. & Street  </th>
										
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Patient Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addpatient.php" >


                            <div class="form-group">
                                <label>Patient</label>

								<div class="search_select_box">
                                  
								  <select name="res_id" class="form-control input-sm" data-live-search="true">
								  <option selected="" disabled="">-- Select Resident -- </option>
								  <?php
									  $squery = mysqli_query($conn,"SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno AND tbl_residents.verify_status='verified';");
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
                                    <label>Findings</label>
                                
                                    <input type="text" class="form-control"  name="findings" placeholder="Enter Findings" required>
                                </div>
                                <div class="form-group">
                                    <label>Treatment</label>
                                    <input type="text" class="form-control"  name="treatment" placeholder="Enter Treatment" required>
                                </div>
                                
                                
                                  <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control"  name="date" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_pregnant.php" >


                            <div class="form-group">
                                <label>Patient(Lastname, Firstname, Middlename suffix)</label>
								<input type="number" class="form-control"  name="pregno" id="pno" hidden required>
								<input type="text" class="form-control fw-bold" style="color:black;" readonly  id="fullname" required>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Findings</label>
                                
                                    <input type="text" class="form-control"  name="findings" id="findings" required>
                                </div>
                                <div class="form-group">
                                    <label>Treatment</label>
                                    <input type="text" class="form-control"  name="treatment" id="treatment" required>
                                </div>
                                
                                    <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control"  name="noc" id="date" required>
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
            $('#residenttable').DataTable();
            $('.search_select_box select').selectpicker();
        });
    </script>


<script>

const customBtn = document.querySelector('.custom-btn');
const file = document.querySelector('.addphoto');

function defaultBtnActive(){
    
    file.click();
 
    
 
 }
 


</script>


<script >
    
    function previewFile() {
const preview = document.querySelector('.photo_preview');



const file = document.querySelector('.addphoto').files[0];
const reader = new FileReader();

reader.addEventListener("load", () => {
// convert image file to base64 string
preview.src = reader.result;
}, false);

if (file) {
reader.readAsDataURL(file);
}
}





</script>
</body>
</html>