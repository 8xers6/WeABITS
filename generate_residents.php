<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tbl_residents WHERE res_id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Generate Resident Profile</h2>
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
										<div class="card-title">Resident Profile</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Report
											</button>
										</div>
									</div>
								</div>
								<div class="card-body m-5" id="printThis">
                                    <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid black">
										<div class="text-center">
                                        
                                            <h3 class="mb-0">Republic of the Philippines</h3>
                                            <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
											<h3 class="mb-0"><?= ucwords($town) ?></h3>
											<h1 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h1>
                                            <p><i>Mobile No. <?= $number ?></i></p>
                                            <h1 class="fw-bold mb-3">Resident Profile</h2>
										</div>
                                        <div class="" style="position:absolute; right:100px;">

                                        <img src="assets/uploads/barangay/<?= $brgy_logo ?>" class="img-fluid" width="150" >  
                                        </div>
									</div>

                                 
                                    <div class="d-flex justify-content-center" style="position:absolute; left: 150px; top: 400px;opacity: 0.2; blur:1px;">
                                          
                                        <img src="assets/uploads/barangay/<?= $brgy_logo ?>" class="img-fluid" width="800" >  
                                        </div>
                                    <div class="row mt-2">
                                       



                      




                                


                                     


                                         
         
<form id="formapps" enctype="multipart/form-data"  method="post">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">

<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>View Residents Information</b></h2>
</div>









</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white  border shadow rounded justify-content-center">

<div class="col-md-4 m-1 p-2 border rounded ">


<div class="form-group  border rounded shadow-sm">
<label>Email:</label>  

<input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly  required name="email" value="<?= $resident['email'] ?>" >
                           <label>Firstname:</label>
                                    
                                              <input type="text" class="form-control fw-bold" style="font-size:18px; color:black;" placeholder="Firstname" value="<?= ucwords($resident['firstname']) ?>" required name="fname" readonly >
                           </div>

                           <div class="form-group mt-2 border rounded shadow-sm">
                           
                           
                           <label>Middlename</label>
                                              <input type="text" class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="Middle" value="<?= ucwords($resident['middlename']) ?>" required name="mname"  >
                           </div>
                           <div class="form-group mt-2 border rounded shadow-sm">
                           
                           
                           <label>Lastname</label>
                                              <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['lastname']) ?>" >
                           </div>


                           <div class="form-group mt-2  border rounded shadow-sm">
                           <label>Suffix</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly required name="" value="<?= ucwords($resident['suffix']) ?>" >
                                    
                                    </div>



</div>




<div class="col-md-4 m-1 p-2 border rounded">


<div class="form-group m-0 mb-2 border rounded shadow-sm">
<label for="housno" class="placeholder">House No.</label>
					<input  name="houseno" type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['household_no']) ?>"   required>
                   
				</div>

                <div class="form-group m-0 border mb-2 rounded shadow-sm">
<label for="housno" class="placeholder">Street </label>
					<input  name="houseno" type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['streetname']) ?>"   required>
				
				</div>
                <div class="form-group m-0 mb-2 border rounded shadow-sm">
<label for="housno" class="placeholder">Barangay </label>
					<input  name="houseno" type="text"   class="form-control fw-bold " style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['barangayname']) ?>"   required>
				
				</div>



               

              

                                



                                                            <div class="form-group mt-2 p-4  border rounded shadow-sm">

<label >Person With Disability(PWD)?</label>
<b> <?php if($resident['pwd']==1): ?>
																<span class="badge  badge-success fw-bold">Yes</span>


                                                                <?php elseif($resident['pwd']==0): ?>
                                                                   
																<span class="badge badge-danger fw-bold">No</span>
															
															
															<?php else: ?>
																
															<?php endif ?> </b>

                                </div>
                                                    
                       

                          

                          
                        
                         

















</div>




<div class="col-md-3 m-1 p-2 border rounded  ">
<div class="form-group mb-2  border rounded shadow-sm">

							
<i class="fas fa-birthday-cake"></i>
<label> Birthdate</label>
<input type="date"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['birthdate']) ?>" placeholder="Enter Birthdate" name="bdate" id="bdate" required >

</div>

<div class="form-group mb-2  border rounded shadow-sm">
                           
                           
                            <label>Place of Birth</label>
                                               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['birthplace']) ?>" placeholder="Enter Birthplace" name="bplace" id="bplace"required >
                      
                            </div>

                            <div class="form-group mt-2 border rounded shadow-sm">
                           
                           <label>Gender</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['gender']) ?>" >
                     
                           </div>  
                           
                           <div class="form-group mt-2 border rounded shadow-sm">
                           
                           
                           <label>Age</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['age']) ?>" >
                     
                           </div>
                        
                                                
                           
                        


</div>


                          

                           <div class="col-md-3 m-1 p-2 border rounded shadow-sm">
                            <label>Civil Status</label>
                            <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['civil_status']) ?>" >
                           
                     
                           </div>

                           <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                           
                           <label>Citizenship</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['citizenship']) ?>" >
                     
                           </div>





                           <div class="col-md-4 m-1 p-2 border rounded shadow-sm">
                           
                           <label>Religion</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="." value="<?= ucwords($resident['religion']) ?>" >
                     
                           </div>


                           

                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Occupation</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['occupation']) ?>" >
                     
                           </div>

                          
                           



                          




                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Classified Sector</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['classified_sector']) ?>" >
                     
                           </div>


                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Highest Educational Attainment</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['educational_attainment']) ?>" >
                         
                           </div>


                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Monthly Income</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['monthly_income']) ?>" >
                     
                           </div>
                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label>Length of Stay(in Months)</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['length_of_stay']) ?>" >
                           </div>



                        

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label>Your Contact Number</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['contact_no']) ?>" >
                           </div>

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact Name</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['emergencyname']) ?>" >
                           </div> 

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact No.</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['emergencycontact']) ?>" >
                           </div>

                       

                        
                       
                         

                       

                               
                               
                               

                                   


                               
                                   


                               <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                               <label>COVID-19 Vaccine Brand </label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['vaccine_brand']) ?>" >

                               </div>


                               <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">
                               <label>Latest COVID-19 Vaccination Status</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['vaccine_status']) ?>" >

                               </div>

                           


                               <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                               <label>Ailments</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['ailment']) ?>" >

                               </div>


                               <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Blood Type</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['blood_type']) ?>" >

                               </div>

                               <div class="col-md-6 m-1 pb-2 border rounded shadow-sm">
                               <label >Height(in cm)</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['height']) ?>" >
                               

                               </div>


                               <div class="col-md-5 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Weight(in Kilograms)</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['weight']) ?>" >

                               </div>


                            

                            
                               <div class="col-md-12 m-0 p-3 rounded fw-bold  text-center bg-primary-gradient ">
                               <b  style="color:white; font-size:18px;">FAMILY MEMBERS</b>
                                 
                                   
                                   
                               </div>

                                 
                               <?php if(!empty($family)): ?>
                                            <?php $no=1; foreach($family as $row): ?>
                               <div class="main-form mt-2">
                                <div class="row border ml-2 mr-2 rounded ">
                                <div class="col-md-12 bg-primary-gradient">
                                        <div class="form-group m-0">
                                            <b for="" style="font-size:20px; color:white;">No.<?= $no  ?></b>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">FirstName</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['firstname'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Middlename</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['middlename'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Lastname</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['lastname'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Suffix</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['suffix'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Gender</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['gender'])  ?>" >
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Birthday</label>
                                            <input type="date"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['birthdate'])  ?>" >
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Age</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['age'])  ?>" >
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Religion</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['religion'])  ?>" >
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Relationship to family</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['relation'])  ?>" >
                                        </div>
                                  </div>
                                  
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Family Members</h1>
                           
                           <?php endif ?>
                        

                               <div class="container">
        
    </div>


                               

<div  class="col-md-4 m-1 pb-2  rounded shadow-sm">


<div id="notiferr" ></div>

  

                                                            
<?php if($resident['verify_status']=='pending'):?>                                                     
      <button type="submit" class="col btn btn-success fw-bold mt-1" id="btnup" value="Submit">Accept Application</button>


      <?php else: ?>
        <div  class="col text-center p-2 fw-bold rounded" style="font-size:18px; background:white; border:solid green 3px; color:green;">Verified </div>
     <?php endif?>

      <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                                

                  
                                                           


</div>
<div class="row-md-5 m-0 pl-0 pr-0 pt-4 pb-3   rounded justify-content-center">

                                                                </div>



					</div>










                   

						
</form>

                              





                                      
                                       
                                    
                                </div>
                                     
							</div>
						</div>
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
</body>
</html>