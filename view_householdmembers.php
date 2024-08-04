<?php include 'server/server.php' ?>
<?php 



    $id = $_GET['id'];
    $barno=$_SESSION['bar_no'];
   
      $query = "SELECT *,lpad(tbl_residents.res_id,6,'0') as res_id,YEAR(created_at)as `year`,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.bar_no,5,'0') as bar_no,tbl_residents.email as emails FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id   WHERE tblhousehold.bar_no=$barno AND tbl_residents.h_no=$id ";
      $result = $conn->query($query);
  
      $house = array();
      while($row = $result->fetch_assoc()){
          $house[] = $row; 
      }


  
      $query = "SELECT * FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet ON tblhousehold.st_id=tblstreet.st_id   WHERE tblhousehold.bar_no=$barno AND tblhousehold.h_no=$id";
      $result = $conn->query($query);
      $household = $result->fetch_assoc();



   
   
      $query = "SELECT * FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no  WHERE tblhousehold.bar_no=$barno AND tbl_residents.h_no=$id ";
      $result = $conn->query($query);
      $total = $result->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>HouseHold Members -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">HouseHold Members</h2>
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

										<div class="card-title">
                                            
                                        
                                        
                                                <div class="row">
                                                    <div class="col" style="width:700px;">
                                                    <lable>House No.:</label>
                                      
                                                            <?= ucwords($household['household_no'])?> 

                                                    </div>

                                                    


                                                    <div class="col">
                                                   
                                                    <lable>Street Name  :</label>

                                                   <?= ucwords($household['streetname'])?>

                                                 

                                                    </div>
                                                    <div class="col">
                                                   
                                                    <lable>Total Family Members:</label> <?= number_format($total) ?>

                                                

                                                   </div>

                                                   
                                        
                                                    

                                               </div>
                                   </div>
										<div class="card-tools">
                                          

                                       
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Member
											</a>
                                         
                                        
                                       
                                       
                                  
                                      
										
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Resident ID</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Relation To Family</th>
                                                   
                                                    <th scope="col">Action</th>
                                                  
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($house)): ?>
                                                    <?php  foreach($house as $row): ?>
                                                    <tr>
                                                    <td >  <div  style="width:140px;">BAR-<?= $row['year']?>-<?= $row['res_id'] ?></div></td>
                                                        <td>
                                                        <div  style="width:250px;">
                                                          
                                                       


                                               <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename'].''.$row['suffix']) ?>
                                                             
                                                                
                                                              
                                                        </div>
                                                        </td>
                                                        <td><?= $row['gender'] ?></td>
                                                       
                                                        <td><?= $row['age'] ?></td>
                                                        <td><?= $row['relation'] ?></td>
                                                      

                                                        <td>
                                                            <div class="form-button-action">
                                                            <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" data-original-title="View Resident Info" onclick="editResidents(this)" 
                                                                    data-resid="<?= $row['res_id'] ?>" data-username="<?= $row['username'] ?>"  data-email="<?= $row['emails'] ?>"   data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"
                                                                    data-suffix="<?= $row['suffix'] ?>"
                                                                    data-bdate="<?= $row['birthdate'] ?>" data-bplace="<?= $row['birthplace'] ?>" data-age="<?= $row['age'] ?>"
                                                                    data-cstatus="<?= $row['civil_status'] ?>" data-citizenship="<?= $row['citizenship'] ?>" data-gender="<?= $row['gender'] ?>"  
                                                                    
                                                                   data-religion="<?= $row['religion'] ?>"
                                                                 
                                                                    data-number="<?= $row['contact_no'] ?>"  data-occu="<?= $row['occupation'] ?>"
                                                                   
                                                                    data-educ="<?= $row['educational_attainment'] ?>" 
                                                                    data-los="<?= $row['length_of_stay'] ?>"
                                                                    data-mincome="<?= $row['monthly_income'] ?>"   data-bloodtype="<?= $row['blood_type'] ?>"
                                                                    
                                                                 
                                                                    
                                                                    data-remarks="<?= $row['remarks'] ?>" data-dead="<?= $row['alive']?>"
                                                                    data-pwd="<?= $row['pwd']?>"
                                                                  
                                                                    
                                                                  
                                                                    data-csector="<?= $row['classified_sector'] ?>"


                                                                    data-ename="<?= $row['emergencyname'] ?>"
                                                                    data-eno="<?= $row['emergencycontact'] ?>"
                                                                    
                                                                    data-vbrand="<?= $row['vaccine_brand'] ?>"
                                                                    data-vstatus="<?= $row['vaccine_status'] ?>" 
                                                                    data-ailment="<?= $row['ailment'] ?>" 
                                                                    data-height="<?= $row['height'] ?>" 
                                                                    data-weight="<?= $row['weight'] ?>"
                                                                    data-relation="<?= $row['relation'] ?>"

                                                                    data-houseno="<?= $row['household_no'] ?>" 
                                                                    data-street="<?= $row['streetname'] ?>"

                                                                    data-pregnant="<?= $row['pregnant'] ?>" 
                                                                    data-soloparent="<?= $row['solo_parent'] ?>"
                                                                    data-hno="<?= $row['h_no'] ?>"
                                                                     data-blocklisted="<?= $row['blocklisted'] ?>"
                                                                    >
    


 




                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
                                                            
                                                                <a type="button" data-toggle="tooltip" href="model/remove_residents.php?id=<?= $row['res_id'] ?>&member=view&hno=<?= $row['h_no'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
																

                                                               
                                                            </div>
                                                        </td>

                                                 
                                                
                                                    </tr>
                                                    <?php  endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Resident ID</th></th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Relation To Family</th>
                                                   
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
       <div class="modal fade " id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content ">
                        <div class="modal-header" >
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Add New Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <form method="POST" action="model/save_residents.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">

                                    
                            <div class="row m-0 p-2 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 m-1">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Add Resident Information</b></h2>
                                        
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

                                   
                                    <div class="form-group border rounded mt-2">

<label class=" fw-bold">Firstname</label>
     <input type="text" class="form-control"  placeholder="Enter Firstname" name="fname"  required>
</div>

<div class="form-group border rounded mt-2">
                                           <label class=" fw-bold">Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                           </div>


                                           <div class="form-group border rounded mt-2">
                                                <label class=" fw-bold">Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname"  required>
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


                                   

                                                   <div class="form-group border rounded mt-2">
                                            <label class=" fw-bold">Gender</label>
                                                <select class="form-control"  required name="gender" >
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                               
                                         
                                            </div>

                                   




                                    <?php endif ?>

                                    </div>
                                   

                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm ">
                                        
                                        
                                        <!--
                                    <div class="col-md-12 mt-3 pb-2 pt-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Blocklist Status</label>
                                                <select class="form-control"  required name="blocklisted">
                                                    <option disabled selected value="">Select Status</option>
                                                    <option value="Blocklisted">Blocklisted</option>
                                                    <option value="No Record">No Record</option>
                                                </select>
                                               
                                         
                                            </div>--->




                                                


                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">PWD?</h3>
                                                    <select class="form-control" name="pwd" required>
<option disabled selected value="">Select Disability</option>
<option value="Not Applicable">Not Applicable</option>
  <option value="Blindness or Visual Impairment">Blindness or Visual Impairment</option>
  <option value="Deafness or Hearing Impairment">Deafness or Hearing Impairment</option>
  <option value="Mobility Impairment">Mobility Impairment</option>
  <option value="Cognitive Impairment">Cognitive Impairment</option>
  <option value="Neurological Impairment">Neurological Impairment</option>
  <option value="psychiatric">Psychiatric Impairment</option>
  <option value="Psychiatric Impairment">Speech Impairment</option>
  <option value="Learning Disabilities">Learning Disabilities</option>
  <option value="Developmental Disabilities">Developmental Disabilities</option>
  <option value="Chronic Illnesses">Chronic Illnesses</option>
  <option value="Autoimmune Disorders">Autoimmune Disorders</option>
  <option value="Intellectual Disabilities">Intellectual Disabilities</option>
  <option value="Mental Health Disabilities">Mental Health Disabilities</option>
  <option value="Physical Disabilities">Physical Disabilities</option>
  <option value="Sensory Disabilities">Sensory Disabilities</option>
</select>
                                                             

                                                    </div>

                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                  <label class=" fw-bold">Contact Number</label>
                                                  <input type="number" class="form-control" placeholder="Enter Contact Number" name="contact_no" >
                                         
                                            </div>

                                                    <div class="col-md-12 mb-1 mt-1 pb-1 pt-1 border rounded shadow-sm">
                                                    <h4 class="text-danger" style="font-weight:bolder;">IN CASE OF EMERGENCY CONTACT:</h4>

                                                    <div class="col-md-12 mb-2 mt-2 pb-1 pt-1   ">
                                                    <h5 class="fw-bold">Contact Person Name</h5>
                                                    <input type="text" class="form-control  mb-2" placeholder="" name="ename"  required>
                                        

                                                     <h5 class="fw-bold">Emergency Contact No. </h5>
                                                  
                                                    <input type="number" class="form-control fw-bold" style="letter-spacing: 2px;" name="eno"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"maxlength = "14" required>
                                   
                                                  </div>

                                                   </div>




                                        
                                    </div>

                                   

                            </div>


                            <div class="row m-0 pl-1 pr-1 pt-2 pb-3 mt-2  bg-white rounded border justify-content-center">
                                 
                                         


                                        
                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                                 
                            <label class=" fw-bold">Relationship to Family</label>
                                            <select class="form-control"  name="relation"  required>
                                                   <option disabled selected value="">Select Relationship</option>
                                                   <option value="Head">Head</option>
                                                   <option value="Spouse">Spouse</option>
                                                   <option value="Child">Child</option>
                                                   <option value="Sibling">Sibling</option>
                                                   <option value="Grand Child">Grand Child</option>
                                                   <option value="Brother-in-law or Sister-in-law">Brother-in-law or Sister-in-law</option>
                                                   <option value="Cousin">Cousin</option>
                                                   <option value="Friend">Friend</option>
                                                   <option value="Mother">Mother</option>
                                                   <option value="Father">Father</option>
                                        </select>
                                     
                                        </div>

                                           <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                <label class=" fw-bold">Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" required>
                                                
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" required>
                                                
                                         
                                            </div>




                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                     <label class=" fw-bold">Civil Status</label>
                                                       <select class="form-control" required name="cstatus" >
                                                    <option disabled selected>Select Civil Status</option>
                                          
                                                    <option value="Single">Single</option>
                                                       <option value="Married">Married</option>
                                                       <option value="Widow">Widowed</option>
                                                       <option value="Separated">Separated</option>
                                                       <option value="Divorced">Divorced</option>
                                                       <option value="Live-In">Live-In</option>
                                                        </select>
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Citizenship</label>
                                                   <input type="text" class="form-control" name="citizenship"  placeholder="Enter citizenship" required>
                                              
                                         
                                            </div>
                                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Religion</label>
                                          
                                            <input class="form-control" name="religion" placeholder="Enter religion" >
                                            </div>


                                         
                                           
                                           

                                      


                                       

                                       


                                          


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                                <label class=" fw-bold">Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" >
                                         
                                            </div>


                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Length of Stay(in Months)</label>
                                                   <input type="text" class="form-control" required name="los" placeholder="Enter Length of stay" >
                                            </div>


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Classified Sector</label>
                                                       <select class="form-control"  required name="class_sec" >
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
                                                       <select class="form-control"required name="educ"  >
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
                                            <input type="number" class="form-control" placeholder="Enter monthly income" min='0'  name="m_income" required >
                                 
                                                    
                                                    
                                                        </select>
                                            </div>

                                            
                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label>Pregnant (for Female)</label>
                                               <select class="form-control"  name="pregnant"   required>
                                                       <option disabled selected value="">--Pregnant?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>

                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                         
                               <label>Solo Parent?</label>
                                               <select class="form-control"  name="soloparent"  required>
                                                       <option disabled selected value="">--Solo Parent?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>



                                            


                                            <div class="col-md-8  p-2 border rounded shadow-sm">

                                            <label class=" fw-bold">Remarks</label>
                                           <textarea class="form-control" name="remarks" placeholder="Enter remarks" ></textarea>
                                           
                                            </div>
                                            




                            </div>



                            <div class="row m-0 p-1 mt-3 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 m-1">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Health Information</b></h2>
                                        
                                        </div>
        
                                    
                                    
                                       
        
                            </div>


                            <div class="row m-0 pl-1 pr-1 pt-2 pb-3   bg-white rounded border justify-content-center">

                                    <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">
                                                <label>COVID-19 Vaccine Brand </label>
                                                     
                                                       <select class="form-control"  name="vbrand"  required   >
                                                       <option disabled selected value="">Select Latest Vaccine Brand</option>
                                                       <option value="Pfizer">Pfizer</option>
                                                       <option value="Janssen">Janssen</option>
                                                       <option value="Sinovac">Sinovac</option>
                                                       <option value="Moderna">Moderna</option>
                                                      
                                                   
                                                       <option value="Not Vaccinated">Not Vaccinated</option>
                                                       

                                               </select>

                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Latest COVID-19 Vaccination Status</label>
                                                    <select class="form-control" required name="vstatus"   >
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
                                            <select class="form-control"required name="ailment"  >
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
                                            <select class="form-control" required name="bloodtype" >
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
                                     <input type="number"  oninput="calculate()"  class="form-control" step=".01" placeholder="example: 180" name="height"  >                
                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Weight(in Kilograms)</label>
                                                    <input type="number" oninput="calculate()"    class="form-control" step=".01" placeholder="example: 60" name="weight" >
                                   
                                    </div>


                                

                               




                            </div>





                 </div>


                        <div class="modal-footer">
                        <input type="hidden" name="hno"  value="<?= $id ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Add</button>
                            <?php endif ?>
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
                                            <label class=" fw-bold">Blocklist Status</label>
                                                <select class="form-control"  required name="blocklisted" id="blocklisted">
                                                    <option disabled selected value="">Select Status</option>
                                                    <option value="Blocklisted">Blocklisted</option>
                                                    <option value="No Record">No Record</option>
                                                </select>
                                               
                                         
                                            </div>
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
                                                    <select id="disability" class="form-control" name="pwd" required>
<option disabled selected value="">Select Disability</option>
<option value="Not Applicable">Not Applicable</option>
  <option value="Blindness or Visual Impairment">Blindness or Visual Impairment</option>
  <option value="Deafness or Hearing Impairment">Deafness or Hearing Impairment</option>
  <option value="Mobility Impairment">Mobility Impairment</option>
  <option value="Cognitive Impairment">Cognitive Impairment</option>
  <option value="Neurological Impairment">Neurological Impairment</option>
  <option value="psychiatric">Psychiatric Impairment</option>
  <option value="Psychiatric Impairment">Speech Impairment</option>
  <option value="Learning Disabilities">Learning Disabilities</option>
  <option value="Developmental Disabilities">Developmental Disabilities</option>
  <option value="Chronic Illnesses">Chronic Illnesses</option>
  <option value="Autoimmune Disorders">Autoimmune Disorders</option>
  <option value="Intellectual Disabilities">Intellectual Disabilities</option>
  <option value="Mental Health Disabilities">Mental Health Disabilities</option>
  <option value="Physical Disabilities">Physical Disabilities</option>
  <option value="Sensory Disabilities">Sensory Disabilities</option>
</select>
                                                             

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
                                                  
                                                    <input type="number" class="form-control fw-bold" style="letter-spacing: 2px;" name="eno" id="eno"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"maxlength = "14" required>
                                   
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
                                 
                                         


                                        
                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                                 
                            <label class=" fw-bold">Relationship to Family</label>
                                            <select class="form-control"  name="relation" id="relation" required>
                                                   <option disabled selected value="">Select Relationship</option>
                                                   <option value="Head">Head</option>
                                                   <option value="Spouse">Spouse</option>
                                                   <option value="Child">Child</option>
                                                   <option value="Sibling">Sibling</option>
                                                   <option value="Grand Child">Grand Child</option>
                                                   <option value="Brother-in-law or Sister-in-law">Brother-in-law or Sister-in-law</option>
                                                   <option value="Cousin">Cousin</option>
                                                   <option value="Friend">Friend</option>
                                                   <option value="Mother">Mother</option>
                                                   <option value="Father">Father</option>
                                        </select>
                                     
                                        </div>

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
                                                <input type="number" readonly class="form-control fw-bold" style="color:black;" placeholder="Enter Age"  id="age" >
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                     <label class=" fw-bold">Civil Status</label>
                                                       <select class="form-control" required name="cstatus" id="cstatus">
                                                    <option disabled selected>Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                       <option value="Married">Married</option>
                                                       <option value="Widow">Widowed</option>
                                                       <option value="Separated">Separated</option>
                                                       <option value="Divorced">Divorced</option>
                                                       <option value="Live-In">Live-In</option>
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
                                                   <input type="text" class="form-control" style="color:black; font-weight:bolder;"  id="curradd" readonly>
                                              
                                         
                                            </div>
                                           

                                      


                                       

                                       


                                          


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                                <label class=" fw-bold">Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occu">
                                         
                                            </div>


                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Length of Stay(in Months)</label>
                                                   <input type="text" class="form-control" required name="los" placeholder="Enter Length of stay" id="los">
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


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Monthly Income</label>
                                            <input type="number" class="form-control" placeholder="Enter monthly income" min='0'  name="m_income" id="mincome" required >
                                 
                                                    
                                                    
                                                        </select>
                                            </div>

                                            
                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label>Pregnant (for Female)</label>
                                               <select class="form-control"  name="pregnant" id="pregnant"  required>
                                                       <option disabled selected value="">--Pregnant?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>

                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                         
                               <label>Solo Parent?</label>
                                               <select class="form-control"  name="soloparent" id="soloparent"  required>
                                                       <option disabled selected value="">--Solo Parent?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>



                                            


                                            <div class="col-md-10  p-2 border rounded shadow-sm">

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
                                             <label>COVID-19 Vaccine Brand </label>
                                                     
                                                       <select class="form-control"  name="vbrand"  required  id="v_brand"  >
                                                       <option disabled selected value="">Select Latest Vaccine Brand</option>
                                                       <option value="Pfizer">Pfizer</option>
                                                       <option value="Janssen">Janssen</option>
                                                       <option value="Sinovac">Sinovac</option>
                                                       <option value="Moderna">Moderna</option>
                                                     
                                                   
                                                       <option value="Not Vaccinated">Not Vaccinated</option>
                                                       

                                               </select>

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
                           <input type="hidden" class="form-control" name="member" value="member" >
                              <input type="hidden" class="form-control" name="hno" value="<?=$id  ?>" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>




<!---add resident--->


            <!-- Modal -->
<div class="modal fade " id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content ">
                        <div class="modal-header" >
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Add New Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <form method="POST" action="model/save_residents.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">

                                    
                            <div class="row m-0 p-2 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 m-1">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Add Resident Information</b></h2>
                                        
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

                                   
                                    <div class="form-group border rounded mt-2">

<label class=" fw-bold">Firstname</label>
     <input type="text" class="form-control"  placeholder="Enter Firstname" name="fname"  required>
</div>

<div class="form-group border rounded mt-2">
                                           <label class=" fw-bold">Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                           </div>


                                           <div class="form-group border rounded mt-2">
                                                <label class=" fw-bold">Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname"  required>
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


                                   

                                                   <div class="form-group border rounded mt-2">
                                            <label class=" fw-bold">Gender</label>
                                                <select class="form-control"  required name="gender" >
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                               
                                         
                                            </div>

                                   




                                    <?php endif ?>

                                    </div>
                                   

                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm ">
                                    <div class="col-md-12 mt-3 pb-2 pt-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Blocklist Status</label>
                                                <select class="form-control"  required name="blocklisted">
                                                    <option disabled selected value="">Select Status</option>
                                                    <option value="Blocklisted">Blocklisted</option>
                                                    <option value="No Record">No Record</option>
                                                </select>
                                               
                                         
                                            </div>




                                                


                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                    <h3  class=" fw-bold">PWD?</h3>
                                                    <select class="form-control" name="pwd" required>
<option disabled selected value="">Select Disability</option>
<option value="Not Applicable">Not Applicable</option>
  <option value="Blindness or Visual Impairment">Blindness or Visual Impairment</option>
  <option value="Deafness or Hearing Impairment">Deafness or Hearing Impairment</option>
  <option value="Mobility Impairment">Mobility Impairment</option>
  <option value="Cognitive Impairment">Cognitive Impairment</option>
  <option value="Neurological Impairment">Neurological Impairment</option>
  <option value="psychiatric">Psychiatric Impairment</option>
  <option value="Psychiatric Impairment">Speech Impairment</option>
  <option value="Learning Disabilities">Learning Disabilities</option>
  <option value="Developmental Disabilities">Developmental Disabilities</option>
  <option value="Chronic Illnesses">Chronic Illnesses</option>
  <option value="Autoimmune Disorders">Autoimmune Disorders</option>
  <option value="Intellectual Disabilities">Intellectual Disabilities</option>
  <option value="Mental Health Disabilities">Mental Health Disabilities</option>
  <option value="Physical Disabilities">Physical Disabilities</option>
  <option value="Sensory Disabilities">Sensory Disabilities</option>
</select>
                                                             

                                                    </div>

                                                    <div class="col-md-12 mb-2 mt-2 pb-3 pt-3 border rounded shadow-sm">
                                                  <label class=" fw-bold">Contact Number</label>
                                                  <input type="text" class="form-control" placeholder="Enter Contact Number" name="contact_no" >
                                         
                                            </div>

                                                    <div class="col-md-12 mb-1 mt-1 pb-1 pt-1 border rounded shadow-sm">
                                                    <h4 class="text-danger" style="font-weight:bolder;">IN CASE OF EMERGENCY CONTACT:</h4>

                                                    <div class="col-md-12 mb-2 mt-2 pb-1 pt-1   ">
                                                    <h5 class="fw-bold">Contact Person Name</h5>
                                                    <input type="text" class="form-control  mb-2" placeholder="" name="ename"  required>
                                        

                                                     <h5 class="fw-bold">Emergency Contact No. </h5>
                                                  
                                                    <input type="number" class="form-control fw-bold" style="letter-spacing: 2px;" name="eno"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"maxlength = "14" required>
                                   
                                                  </div>

                                                   </div>




                                        
                                    </div>

                                   

                            </div>


                            <div class="row m-0 pl-1 pr-1 pt-2 pb-3 mt-2  bg-white rounded border justify-content-center">
                                 
                                         


                                        
                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                                 
                            <label class=" fw-bold">Relationship to Family</label>
                                            <select class="form-control"  name="relation"  required>
                                                   <option disabled selected value="">Select Relationship</option>
                                                   <option value="Head">Head</option>
                                                   <option value="Spouse">Spouse</option>
                                                   <option value="Child">Child</option>
                                                   <option value="Sibling">Sibling</option>
                                                   <option value="Grand Child">Grand Child</option>
                                                   <option value="Brother-in-law or Sister-in-law">Brother-in-law or Sister-in-law</option>
                                                   <option value="Cousin">Cousin</option>
                                                   <option value="Friend">Friend</option>
                                                   <option value="Mother">Mother</option>
                                                   <option value="Father">Father</option>
                                        </select>
                                     
                                        </div>

                                           <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                <label class=" fw-bold">Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" required>
                                                
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" required>
                                                
                                         
                                            </div>




                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                                 
                                                     <label class=" fw-bold">Civil Status</label>
                                                       <select class="form-control" required name="cstatus" >
                                                    <option disabled selected>Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow">Widow</option>
                                                        </select>
                                         
                                            </div>


                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Citizenship</label>
                                                   <input type="text" class="form-control" name="citizenship"  placeholder="Enter citizenship" required>
                                              
                                         
                                            </div>
                                            <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Religion</label>
                                          
                                            <input class="form-control" name="religion" placeholder="Enter religion" >
                                            </div>


                                         
                                            <div class="col-md-4 m-1 pb-2 border rounded shadow-sm">
                                            <label class=" fw-bold">House no & Street</label>
                                                   <input type="text" class="form-control" style="color:black; font-weight:bolder;"   readonly>
                                              
                                         
                                            </div>
                                           

                                      


                                       

                                       


                                          


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                                <label class=" fw-bold">Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" >
                                         
                                            </div>


                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label class=" fw-bold">Length of Stay(in Months)</label>
                                                   <input type="text" class="form-control" required name="los" placeholder="Enter Length of stay" >
                                            </div>


                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            <label class=" fw-bold">Classified Sector</label>
                                                       <select class="form-control"  required name="class_sec" >
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
                                                       <select class="form-control"required name="educ"  >
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
                                            <input type="number" class="form-control" placeholder="Enter monthly income" min='0'  name="m_income" required >
                                 
                                                    
                                                    
                                                        </select>
                                            </div>

                                            
                                            <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                                            
                                            <label>Pregnant (for Female)</label>
                                               <select class="form-control"  name="pregnant"   required>
                                                       <option disabled selected value="">--Pregnant?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>

                                            <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                                            
                                         
                               <label>Solo Parent?</label>
                                               <select class="form-control"  name="soloparent"  required>
                                                       <option disabled selected value="">--Solo Parent?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>
                                            </div>



                                            


                                            <div class="col-md-4  p-2 border rounded shadow-sm">

                                            <label class=" fw-bold">Remarks</label>
                                           <textarea class="form-control" name="remarks" placeholder="Enter remarks" ></textarea>
                                           
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
                                            <input type="text" class="form-control"placeholder="Enter Vaccine Brand" name="vbrand"  required>

                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Latest COVID-19 Vaccination Status</label>
                                                    <select class="form-control" required name="vstatus"   >
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
                                            <select class="form-control"required name="ailment"  >
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
                                            <select class="form-control" required name="bloodtype" >
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
                                     <input type="number"  oninput="calculate()"  class="form-control" step=".01" placeholder="example: 180" name="height"  >                
                                    </div>


                                    <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                                    <label class=" fw-bold">Weight(in Kilograms)</label>
                                                    <input type="number" oninput="calculate()"    class="form-control" step=".01" placeholder="example: 60" name="weight" >
                                   
                                    </div>


                                

                               




                            </div>





                 </div>


                        <div class="modal-footer">
                             
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Add</button>
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
    <script>
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>


<script>
        $(document).ready(function() {
            $('#streettable').DataTable();
            $('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>