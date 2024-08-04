
<?php include 'server/server.php' 








?>

<?php



        
        
	


?>







<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Info -  Weabits</title>
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
				<div class="page-inner mt--2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>


                        <div class="card">
							
							

                                <div class="row m-0 p-3 bg-primary-gradient rounded border">
						      <div class="col-md-4 m-1">
                             
							
								
						
								</div>

								<div class="col-md-4 m-1">
							   
								
								<h2 class="text-white"><b>Barangay Information</b></h2>
								</div>

							
							
                               

								</div>


                                <div class="row m-0  rounded  mb-3 mt-2 justify-content-center">

                                <div class="col-md-4 m-1 border rounded shadow-sm">
                                     
                                     <label>Barangay Name</label>
                                 <h2> <?= ucwords($barangayname)  ?> </h2>
                                 </div>

                                <div class="col-md-4 m-1 border rounded shadow-sm ">
                                     
                                     <label>City</label>
                                 <h2><?= ucwords($city) ?></h2>
                                 </div>
                                              

                                <div class="col-md-3 m-1 border rounded shadow-sm">
                                     
                                     <label>Province</label>
                                 <h2><?=ucwords($province)  ?></h2>
                                 </div>



                                        <div class="col-md-4 m-1 border rounded shadow-sm text-center">
                                     
                                  
                                     <label>Municipality/City Logo</label><br>
                                <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid  rounded-circle" >

                                
                                 </div>

                               

                              


                                 <div class="col-md-4 m-1 border rounded shadow-sm text-center">
                                     
                                 <label>Barangay Logo</label><br>
                               
                 
                                 <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?=$brgylogo ?>" class="img-fluid rounded-circle" >
                                
                                 </div>


                                 <div class="col-md-3 m-1 p-1 border rounded shadow-sm text-center">
                                     
                                  
                                     <label>GCash QR Code</label>
                                <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $gcashqrcode ?>" class="img-fluid rounded"  >

                                
                                 </div>



                              



                                 
                                 <div class="col-md-5 m-1 border rounded shadow-sm ">
                                     
                                  
                                     <label>Email Address:</label><br>
                                     <h2><?= $email ?></h2>

                                
                                 </div>

                                     <div class="col-md-6 m-1 border rounded shadow-sm ">
                                     
                                  
                                     <label>Contact No.:</label><br>
                                     <h2><?= $phone ?></h2>

                                
                                 </div>
                                 
                                 
                                 
                                   <div class="col-md-6 m-1 border rounded shadow-sm ">
                                     
                                  
                                     <h1>Mission</h1>
                                     <h3 style="line-height:2; text-align:justify;"><b><?= $mission ?></b></h3>

                                
                                 </div>
                                 
                                 
                                   <div class="col-md-5 m-1 border rounded shadow-sm  ">
                                     
                                  
                                     <h1>Vision</h1>
                                   <h3  style="line-height:1.5; text-align:justify;" ><b><?= $vision ?></b></h3>

                                
                                 </div>
                                 
                         
                                 
                                 
                               
                                        <div class="row border rounded  shadow-sm m-1" style="display:none;">
                          
                            <div class="col-md-12 bg-primary-gradient ">
                            <div class="form-group ">
                                <label class="text-white">Cedula Computation</label>
                              
                            </div>
                        </div>
                          
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Basic Community Tax</label>
                                <input type="number" min="1" class="form-control fw-bold"  style="color:black;" readonly  value="<?= $bct ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Additional Tax</label>
                                <input type="number" min="1"  class="form-control fw-bold" readonly  style="color:black;" value="<?= $addtax ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No of Month</label>
                                <input type="number" class="form-control fw-bold" min="1"  style="color:black;" readonly placeholder="No of months"  required value="<?=$nomonth?>">
                            </div>
                        </div>
                       
                    </div>
                         
                                 
                                 
       
                             

  
										   
										   

										   
										   
                                 
                                 




                                     <div class="col-md-3 mb-4 mt-4" style="text-align:center;">
						<a type="button"  href="#edit" data-toggle="modal" class="btn btn-link bg-primary text-white " data-original-title="Edit Profile" 
					
                      
					                                          >
																	<b><i class="fa fa-edit">Edit Barangay Info</i></b>
																</a>

					  </div>



                                 </div>

								</div>
							
				
				
					
				</div>
			</div>



<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Barangay Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_brgy_info.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province Name</label>
                                <input type="text" class="form-control" readonly placeholder="Enter Province Name"  required value="<?= $province ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City Name</label>
                                <input type="text" class="form-control" readonly placeholder="Enter Town Name" required value="<?= $city ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barangay Name</label>
                                <input type="text" class="form-control" readonly placeholder="Enter Barangay Name"  required value="<?= $barangayname ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="number" class="form-control" placeholder="Enter Contact Number" name="number" required value="<?= $phone ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" readonly placeholder="Enter Contact Number" name="email" required value="<?=$email?>">
                            </div>
                        </div>
                       
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <label>Mission</label>
                        <textarea class="form-control" name="mission" required><?= $mission ?></textarea>
                    </div>


                    <div class="form-group">
                        <label>Vision</label>
                        <textarea class="form-control" name="vision" required><?= $vision ?></textarea>
                    </div>
                    
                    
                    
                    
                     
                      <div class="row border rounded shadow-sm m-3" style="display:none;">
                          
                            <div class="col-md-12 bg-primary-gradient ">
                            <div class="form-group ">
                                <label class="text-white">Cedula Computation</label>
                              
                            </div>
                        </div>
                          
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Basic Community Tax</label>
                                <input type="number" min="1" class="form-control"  placeholder="Basic Community Tax" name="bct"  required value="<?= $bct ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Additional Tax</label>
                                <input type="number" min="1"  class="form-control" placeholder="Additional Tax" name="addtax" required value="<?= $addtax ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No of Month</label>
                                <input type="number" class="form-control" min="1"  placeholder="No of months" name="nomonth" required value="<?=$nomonth?>">
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Current Municipality/City Logo</label><br>
                                <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid  rounded-circle" >
                                <br>   <label>Change to:</label><br>
                                <input type="file" class='form-control' name="city_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Current Barangay Logo</label><br>
                                <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?=$brgylogo ?>" class="img-fluid rounded-circle" >
                                <br>  <label>Change to</label><br>
                                <input type="file" class='form-control' name="brgy_logo" accept="image/*">
                            </div>
                        </div>
                        
                        
                         <div class="col-md-3">
                            <div class="form-group">
                                <label>GCash Qr Code</label><br>
                                <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $gcashqrcode ?>"class=" rounded" height="230" width="200" >
                                <br>   <label>Change to:</label><br>
                                <input type="file" class='form-control' name="gcashqrcode" accept="image/*">
                            </div>
                        </div>
                    </div>

                  
                 
                    <small class="form-text text-muted">Note: pls upload only image and not more than 20MB.</small>
                    
                   
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
</body>
</html>

