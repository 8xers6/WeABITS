<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbldaycare LEFT JOIN tbl_residents ON tbldaycare.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbldaycare.bar_no=$barno ORDER BY tbldaycare.stud_no;";
    $result = $conn->query($query);

    $daycare = array();
	while($row = $result->fetch_assoc()){
		$daycare[] = $row; 
	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Day Care -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Day Care</h2>
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
										<div class="card-title">Day Care</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Student
												</a>
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Student No.</th>
													<th scope="col">Student Name</th>
													<th scope="col">Gender</th>
												    <th scope="col">Age</th>
                                                    <th scope="col">Student Address</th>
													<th scope="col">School Year</th>
													<th scope="col">Parents/Guardians</th>
													
                                                   


													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($daycare)): ?>
													<?php foreach($daycare as $row): ?>
													<tr>
														<td><?= $row['stud_no'] ?></td>
														
													
														<td>

														<div  style="width:210px;">
                                                          
                                                       


					<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
															   
																  
																
														  </div>
														</td>
														
														
															<td><?= $row['gender'] ?></td>
																<td><?= $row['age'] ?></td>
														
														
                                                        <td>           <div style="width:150px;">
                                                         
														<?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

														  </div></td>

                                                          <td><?= $row['schoolyear'] ?>
                                                            
                                                         </td>
                                                      	<td>

														<div  style="width:300px;">
                                                          
                                                       
												
									  <?php
									       
									          $hno=$row['h_no'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno  AND (tbl_residents.relation='Head' OR tbl_residents.relation='Spouse')  AND tbl_residents.h_no=$hno");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$rows['res_id'].'">'.$rows['firstname'].'  '.$rows['middlename'].'  '.$rows['lastname'].'   Relationship:'.$rows['relation'].' </option>    
											  ';
										  }
									  ?>
								             
														</td>
                                                       

												  	</div>
													
													</td>
												
                                                        <?php if(isset($_SESSION['username'])):?>
														<td>
															<div class="form-button-action">
                                                            <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit/View Student" onclick="editDaycare(this)" 
                                                                        data-studno="<?= $row['stud_no'] ?>"  data-fname="<?= $row['firstname'] ?>"  data-mname="<?= $row['middlename'] ?>"
                                                                        data-lname="<?= $row['lastname'] ?>"    data-sy="<?= $row['schoolyear'] ?>"   data-parent="<?= $row['parentname'] ?>"
                                                                   >
    


 




                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
														
																<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ||  $_SESSION['role']=='Population' ): ?>
																<a type="button" data-toggle="tooltip" href="model/remove_daycare.php?id=<?= $row['stud_no'] ?>" onclick="return confirm('Are you sure you want to remove student from the Daycare?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
																<?php endif ?>
															</div>
														</td>
														<?php endif ?>
														
													</tr>
													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                                <th scope="col">Student No.</th>
													<th scope="col">Student Name</th>
															<th scope="col">Gender</th>
															 <th scope="col">Age</th>
                                                    <th scope="col">Student Address</th>
													<th scope="col">School Year</th>
													<th scope="col">Parents/Guardians</th>
                                
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
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

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

			<!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_daycare.php" >
                                <div class="form-group">
                                    <label>Student Name</label>
									<div class="search_select_box">
                                  
								      <select name="resid" class="form-control input-sm" data-live-search="true">
									  <option selected="" disabled="">-- Select Resident -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=3 AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')<=5 AND tbl_residents.verify_status='verified';");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['res_id'].'">'.$row['res_id'].': '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].'| Age: '.$row['age'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                                </div>
                              
								

								<div class="form-group">
                                    <label>School Year(example: 2023-2024)*</label>
                                    <input type="text" name="sy" class="form-control" placeholder="Enter School Year" required>
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


            	<!-- Modal Edit-->
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/View Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_daycare.php" >
                                <div class="form-group">
                                    <label>Student Name</label>

                                    <div class="row">
                                        <div class="col">
                                        <label>Last Name</label>
                                       

                                       </div>

                                       <div class="col">
                                       <label>First Name</label>
                                      


                                       </div>

                                       <div class="col">
                                       <label>Middle Name</label>
                                      


                                       </div>


                                    </div>
                                           
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" style="color:black; font-weight:bolder;" id="lname" readonly >


                                       </div>

                                       <div class="col">
                                       <input type="text" class="form-control" style="color:black; font-weight:bolder;" id="fname" readonly  >


                                       </div>

                                       <div class="col">
                                       <input type="text" class="form-control" style="color:black; font-weight:bolder;" id="mname" readonly >


                                       </div>


                                    </div>
                                        
									      
                                        
                                       
                                      
                                      
                                      
                                       
                                        
                                </div>
                              
								

								<div class="form-group">
                                    <label>School Year(Example:2023-2024)*</label>  <input type="text" name="sy" class="form-control" style="color:black; font-weight:bolder;"  id="sy" >
                                    

                                </div>

								

							
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="studno" id="studno">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

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
  




</body>
</html>