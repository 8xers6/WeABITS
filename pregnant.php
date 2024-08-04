<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM `tblpregnant` LEFT JOIN tbl_residents on tblpregnant.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbl_residents.pregnant='Yes' AND tbl_residents.bar_no=$barno AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=15   ";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}


?>

<?php





?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Pregnant Information -  Barangay Management System</title>
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
										<div class="card-title">Pregnant Residents</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Add Pregnant
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

                                                <th scope="col">Action</th>
                                                <th scope="col">Resident ID</th>
													<th scope="col">Fullname</th>
                                                    <th scope="col">House No. & Street  </th>
													<th scope="col">Months of pregnant  </th>
													<th scope="col"> No. of Children  </th>
													<th scope="col">Age</th>
													<th scope="col">Date Encoded</th>
                                              
                                                 
                                                   
                                                 
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>

                                          
                                               <td>
															<div class="form-button-action">
                                                              


 




                                                                  
                                                                </a>

                                                                <?php if(isset($_SESSION['username']) ):?>
                                                                    <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Pregnant" onclick="editPregnant(this)" 
                                                                    data-pregno="<?= $row['preg_no'] ?>"  data-mpregnant="<?= $row['months_pregnant'] ?>" data-nochild="<?= $row['no_of_children'] ?>"
																	data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"
                                                                    data-suffix="<?= $row['suffix'] ?>"
																	>
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
																<a type="button" data-toggle="tooltip" href="pregdetails?pregno=<?= $row['preg_no'] ?>" class="btn btn-link btn-info" data-original-title="View Details">
																	<i class="fa fa-eye"></i>
																</a>
																<a type="button" data-toggle="tooltip" href="model/remove_pregnant.php?pregno=<?= $row['preg_no'] ?>" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
                                                                
                                                                <?php endif ?>
															</div>
														</td>
													
                                                    <td >  <div  style="width:160px;">Brgy-<?= $row['year']?> - <?= $row['res_id'] ?></div></td>
                                                    
														<td>
                                                        <div  style="width:210px;">
                                                          
                                                       


                                                        <?php if(!empty($row['res_picture'])): ?>

<img src="<?= preg_match('/data:image/i', $row['res_picture']) ?  $row['res_picture'] : "./assets/uploads/resident_profile/".$row['res_id']."/". $row['res_picture'] ?>" alt="..." class="avatar-img rounded-circle "  style="position: relative;  width:50px; height:50px; border-radius:50px;">
<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
<?php else: ?>
<img src="assets/img/person.png" alt="..." class="img-fluid rounded-circle  " width="40" > <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
<?php endif ?> 
                                                             
                                                                
                                                              
                                                        </div>

                                                        </td>

                                                        <td>
                                                            <div style="width:140px;">
                                                         
                                                            <?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

                                                             </div>
                                                        </td>
                                                        <td>
                                                            <div style="width:90px;">
                                                            <?= $row['months_pregnant'] ?>
                                                              </div>
                                                        
                                                        </td>
														<td><?= $row['no_of_children'] ?></td>
														<td><?= $row['age'] ?></td>
															<td><?= $row['date'] ?></td>
                                                      
                                                     
                                        


                                                     
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
												<th scope="col">Action</th>
                                                <th scope="col">Resident ID</th>
													<th scope="col">Fullname</th>
                                                    <th scope="col">House No. & Street  </th>
													<th scope="col">Months of pregnant  </th>
													<th scope="col"> No. of Children  </th>
													<th scope="col">Age</th>
															<th scope="col">Date Encoded</th>
												
                                               
                                                 
                                                   
                                                
													
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Pregnant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addpregnant.php" >


                            <div class="form-group">
                                <label>Pregnant Resident</label>

								<div class="search_select_box">
                                  
								  <select name="res_id" class="form-control input-sm" data-live-search="true">
								  <option selected="" disabled="">-- Select Resident -- </option>
								  <?php
									  $squery = mysqli_query($conn,"SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno AND tbl_residents.pregnant='Yes' AND tbl_residents.gender='Female' AND tbl_residents.verify_status='verified' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=15;");
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
                                    <label>Months of Pregnancy</label>
                                
                                    <input type="number" class="form-control"  name="mop" required>
                                </div>
                                <div class="form-group">
                                    <label>Number of Children</label>
                                    <input type="number" class="form-control"  name="noc" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Pregnant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_pregnant.php" >


                            <div class="form-group">
                                <label>Pregnant Resident(Lastname, Firstname, Middlename suffix)</label>
								<input type="number" class="form-control"  name="pregno" id="pregno" hidden required>
								<input type="text" class="form-control fw-bold" style="color:black;" readonly  id="fullname" required>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Months of Pregnancy</label>
                                
                                    <input type="number" class="form-control"  name="mop" id="mop" required>
                                </div>
                                <div class="form-group">
                                    <label>Number of Children</label>
                                    <input type="number" class="form-control"  name="noc" id="noc" required>
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