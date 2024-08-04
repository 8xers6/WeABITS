<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tblchildren  LEFT JOIN tbl_residents on tbl_residents.res_id=tblchildren.res_id  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tbl_residents.verify_status='verified'";
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
	<title>Children -  Barangay Management System</title>
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
										<div class="card-title">New Born Babies</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Add Newborn
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
                                                   
												
													<th scope="col">Birthdate</th>
                                                   
													<th scope="col">Age</th>
												
                                                    <th scope="col">Gender</th>
                                                 
                                                   
                                                 
													
                                                   
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
                                                                  
																<a type="button" data-toggle="tooltip" href="newborndetails?id=<?= $row['res_id'] ?>" class="btn btn-link btn-info" data-original-title="View Details">
																	<i class="fa fa-eye"></i>
																</a>
																
																	<a type="button" data-toggle="tooltip" href="model/remove_newborn.php?id=<?= $row['child_id'] ?>" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
<img src="assets/img/person.png" alt="..." class="img-fluid rounded-circle  " width="50" > <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
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
                                                            <?= $row['birthdate'] ?>
                                                              </div>
                                                        
                                                        </td>
                                                      
														<td><?= $row['age'] ?></td>
                                                        <td><?= $row['gender'] ?></td>
                                                     
                                        


                                                     
														
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
                                                   
												
													<th scope="col">Birthdate</th>
                                                   
													<th scope="col">Age</th>
												
                                                    <th scope="col">Gender</th>
                                                 
                                                   
                                                
													
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
                            <h5 class="modal-title" id="exampleModalLabel">Add NewBorn</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addnewborn.php" >


                            <div class="form-group">
                                <label>New Born Baby</label>

								<div class="search_select_box">
                                  
								  <select name="res_id" class="form-control input-sm" data-live-search="true">
								  <option selected="" disabled="">-- Select NewBorn -- </option>
								  <?php
									  $squery = mysqli_query($conn,"SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE tbl_residents.bar_no=$barno AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=0 AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')<=6  AND tbl_residents.verify_status='verified';");
									  while ($row = mysqli_fetch_array($squery)){
										  echo '
											  <option value="'.$row['res_id'].'">'.$row['res_id'].' - '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].' | Age: '.$row['age'].'</option>    
										  ';
									  }
								  ?>
											  </select>
								 </div>
                                   
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
<div class="modal fade " id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content ">
                        <div class="modal-header" >
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit/View Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <form method="POST" action="model/edit_residents.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">

                                    
                            <div class="row m-0 p-2 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 m-1">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Update Resident Information</b></h2>
                                        
                                        </div>
        
                                    
                                    
                                       
        
                            </div>



                            <div class="row m-0 pl-1 pr-2 pt-2 pb-3  bg-white rounded border justify-content-center">
                                 <div class="col-md-5 m-1 pt-3  pb-2 border rounded shadow-sm">
                                 <!---
                                    <div id="my_camera1" class="text-center">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid border border-dark rounded shadow" width="200" id="image" >
                                    </div> -->
                                    <?php if(isset($_SESSION['username'])):?>
                                        <!---
                                    <div class="form-group d-flex justify-content-center " >
                                        <button type="button" class="btn btn-primary btn-sm mr-2" id="open_cam1"><i class="fas fa-camera"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2 fw-bold" onclick="save_photo1()">Capture</button>   
                                    </div>
                                
                                    <div id="profileImage1">
                                        <input type="hidden" name="profileimg">
                                    </div>
                                    <div class="form-group  text-center" >
                                        <label>choose from device</label>
                                        <input type="file" class="addphoto" name="file"  onchange="previewFile()" accept="image/*" hidden>

                                        <button type="button" class="custom-btn btn btn-primary rounded fw-bold" onclick="defaultBtnActive()">CHOOSE A IMAGE</button>
                                        <img src="assets/img/uploadimage.png" class="photo_preview mt-2 rounded border"  width="70%" alt="Image preview">

                                    </div>

                                    --->

                                    <div class="form-group border rounded" >
                                    <h5 class="fw-bold">Resident ID</h5>
                                    <input type="text" class="form-control fw-bold" readonly name="id" id="resid">




                                    </div>


                                    <div class="form-group border rounded mt-2" >
                                    <h5 class="fw-bold">Username*</h5>
                                                    <input type="text" class="form-control" placeholder="" name="ename" id="username"  readonly>




                                    </div>


                                    <div class="form-group border rounded mt-2" >
                                    <h5 class="fw-bold">Email Address</h5>
                                                    <input type="text" class="form-control" placeholder=""  id="email"  readonly>




                                    </div>

                                    <div class="form-group border rounded mt-2">

<label class=" fw-bold">Firstname</label>
     <input type="text" class="form-control"  placeholder="Enter Firstname" name="fname" id="fname" required>
</div>

<div class="form-group border rounded mt-2">
                                           <label class=" fw-bold">Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" required>
                                           </div>


                                           <div class="form-group border rounded mt-2">
                                                <label class=" fw-bold">Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" required>
                                           </div>
                                           <div class="form-group border rounded mt-2">
                                                <label class=" fw-bold">Suffix</label>
                                                <select class="form-control" name="suffix" id="suffix" >
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                           </div>


                                   

                                   




                                    <?php endif ?>

                                    </div>

                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm ">
                                                    <div class="col-md-12 mt-3 pb-2 pt-2 border rounded shadow-sm">
                                                            <h4 class=" fw-bold">STATUS</h4>
                                                            <div class="selectgroup selectgroup-primary selectgroup-pills" >
                                                            <label class="selectgroup-item">
                                                                <input type="radio" name="alive" value="1" class="selectgroup-input" checked="" id="alive">
                                                                <span class="selectgroup-button selectgroup-button-icon"  style="color:green;"><i class="fa fa-walking"></i></span>
                                                            </label><p class="mt-1 mr-3"><b>Alive</b></p>
                                                            <label class="selectgroup-item">
                                                                <input type="radio" name="alive" value="0" class="selectgroup-input" id="dead">
                                                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-people-carry"></i></i></span>
                                                            </label><p  class="mt-1 mr-2"><b>Deceased</b></p>
                                                             </div>
                                                    </div>




                                                


                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">PWD?</h3>
                                                            <div class="selectgroup selectgroup-primary selectgroup-pills" >
                                                                    <label class="selectgroup-item">
                                                                    <input type="radio" name="pwd" value="1" class="selectgroup-input" checked="" id="pwdyes" >
                                                                    <span class="selectgroup-button selectgroup-button-icon " style="color:green;"><b>&#10003</b></span>
                                                                    </label><p class="mt-1 mr-3"><b>Yes</b></p>
                                                                    <label class="selectgroup-item">
                                                                    <input type="radio" name="pwd" value="0" class="selectgroup-input" id="pwdno">
                                                                    <span class="selectgroup-button selectgroup-button-icon"  style="color:red;"><b>X</b></span>
                                                                    </label><p  class="mt-1 mr-3"><b>No</b></p>
                                                                
                                                            </div>
                                                             

                                                    </div>

                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                  <label class=" fw-bold">Contact Number</label>
                                                  <input type="text" class="form-control" placeholder="Enter Contact Number" name="contact_no" id="number">
                                         
                                            </div>

                                                    <div class="col-md-12 mb-1 mt-1 pb-1 pt-1 border rounded shadow-sm">
                                                    <h4 class="text-danger" style="font-weight:bolder;">IN CASE OF EMERGENCY CONTACT:</h4>

                                                    <div class="col-md-12 mb-2 mt-2 pb-1 pt-1   ">
                                                    <h5 class="fw-bold">Contact Person Name</h5>
                                                    <input type="text" class="form-control  mb-2" placeholder="" name="ename" id="ename" required>
                                        

                                                     <h5 class="fw-bold">Emergency Contact No. </h5>
                                                     <h5 class="fw-bold">ex:(0900-000-0000)</h5>
                                                    <input type="tel" class="form-control fw-bold" style="letter-spacing: 2px;" name="eno" id="eno"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"maxlength = "14" required>
                                   
                                                  </div>

                                                   </div>


                                                   <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                            <label class=" fw-bold">Gender</label>
                                                <select class="form-control"  required name="gender" id="gender">
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                               
                                         
                                            </div>



                                        
                                    </div>

                                   

                            </div>


                            <div class="row m-0 pl-1 pr-1 pt-2 pb-3 mt-2  bg-white rounded border justify-content-center">
                                 
                                         


                                        


                                           <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                <label class=" fw-bold">Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                                
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                                                
                                         
                                            </div>


                                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                <label class=" fw-bold">Age</label>
                                                <input type="number" class="form-control" placeholder="Enter Age"  id="age" >
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                     <label class=" fw-bold">Civil Status</label>
                                                       <select class="form-control" required name="cstatus" id="cstatus">
                                                    <option disabled selected>Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow">Widow</option>
                                                        </select>
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Citizenship</label>
                                                   <input type="text" class="form-control" name="citizenship" id="cship" placeholder="Enter citizenship" required>
                                              
                                         
                                            </div>
                                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Religion</label>
                                          
                                            <input class="form-control" name="religion" placeholder="Enter religion" id="religion">
                                            </div>


                                         
                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">House no & Street</label>
                                                   <input type="text" class="form-control" style="color:black; font-weight:bolder;"  id="address" readonly>
                                              
                                         
                                            </div>
                                           

                                      


                                       

                                       


                                          


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                                <label class=" fw-bold">Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occu">
                                         
                                            </div>


                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Length of Stay(in Months)</label>
                                                   <input type="number" class="form-control" required name="los" placeholder="Enter Length of stay" id="los">
                                            </div>


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Classified Sector</label>
                                                       <select class="form-control"  required name="class_sec" id="c_sec" >
                                                    <option disabled selected>Select Classified Sector</option>
                                                    <option value="Labor Force/Employed">Labor Force/Employed</option>
                                                    <option value="Self-Employed">Self-Employed</option>
                                                    <option value="Unemployed">Unemployed</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Out-of-School Youth(OSY">Out-of-School Youth(OSY)</option>
                                                    <option value="Out-of-School Children(OSC)">Out-of-School Children(OSC)</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                             
                                                
                                                    
                                                        </select>
                                         
                                            </div>



                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Highest Educational Attainment</label>
                                                       <select class="form-control"required name="educ" id="educ" >
                                                    <option disabled selected>Select Highest Educational Attainment</option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                    <option value="Post Graduate">Post Graduate</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                             
                                                
                                                    
                                                        </select>
                                            </div>


                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Monthly Income</label>
                                                       <select class="form-control" required name="m_income" id="mincome" >
                                                    <option disabled selected>Select Monthly Income</option>
                                                    <option value="5,000 Below">5,000 Below</option>
                                                    <option value="5,000-12,000">5,000-12,000</option>
                                                    <option value="12,000-18,000">12,000-18,000</option>
                                                    <option value="18,000-30,000">18,000-30,000</option>
                                                    <option value="30,000-50,000">30,000-50,000</option>
                                                    <option value="50,000 Above">50,000 Above</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                    
                                                    
                                                        </select>
                                            </div>


                                            


                                            <div class="col-md-11 p-2  border rounded shadow-sm">

                                            <label class=" fw-bold">Remarks</label>
                                           <textarea class="form-control" name="remarks" placeholder="Enter remarks" id="remarks"></textarea>
                                           
                                            </div>
                                            




                            </div>



                            <div class="row m-0 p-1 mt-3 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 m-1">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Health Information</b></h2>
                                        
                                        </div>
        
                                    
                                    
                                       
        
                            </div>


                            <div class="row m-0 pl-1 pr-1 pt-2 pb-3   bg-white rounded border justify-content-center">

                                    <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">COVID-19 Vaccine Brand</label>
                                            <input type="text" class="form-control"placeholder="Enter Vaccine Brand" name="vbrand" id="v_brand" required>

                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Latest COVID-19 Vaccination Status</label>
                                                    <select class="form-control" required name="vstatus" id="v_status"   >
                                                    <option disabled selected>Select Latest Vaccination Status</option>
                                                    <option value="1st Dose">1st Dose</option>
                                                    <option value="2nd Dose">2nd Dose</option>
                                                    <option value="1st Booster">1st Booster</option>
                                                    <option value="2nd Booster">2nd Booster</option>
                                                   
                                                    <option value="Not Vaccinated">Not Vaccinated</option>
                                                    

                                            </select>
                                    
                                    </div>


                                    <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">

                                         <label class=" fw-bold">Ailments</label>
                                            <select class="form-control"required name="ailment" id="ailment" >
                                            <option disabled selected>Select Ailments</option>
                                            <option value="Not Applicable">Not Applicable</option>
                                            <option value="TB Respiratory">TB Respiratory</option>
                                            <option value="High Cholesterol">High Cholesterol</option>
                                            <option value="Kidney Disease">Kidney Disease</option>
                                            <option value="Hypertension">Hypertension</option>
                                            <option value="Diabetes Mellitus">Diabetes Mellitus</option>
                                            <option value="Heart Disease">Heart Disease</option>
                                            <option value="Broncial Asthma">Broncial Asthma</option>
                                            
                                            <option value="Cancer">Cancer</option>




                                            </select>
                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">

                                    <label class=" fw-bold">Blood Type</label>
                                            <select class="form-control" required name="bloodtype" id="bloodtype" >
                                                    <option disabled selected>Select Blood Type</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="Unknown">Unknown</option>




                                            </select>
                       
                                    </div>


                                    <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">

                                    <label class=" fw-bold">Height(in cm)</label>
                                     <input type="number"  oninput="calculate()"  class="form-control" step=".01" placeholder="example: 180" name="height" id="height" >                
                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Weight(in Kilograms)</label>
                                                    <input type="number" oninput="calculate()"    class="form-control" step=".01" placeholder="example: 60" name="weight" id="weight" >
                                   
                                    </div>


                                

                               




                            </div>





                 </div>


                        <div class="modal-footer">
                           
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Update</button>
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