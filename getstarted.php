
<?php include 'server/server.php' 








?>

<?php



if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'){

    $barno=$_SESSION['bar_no'];
    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id   WHERE bar_no=$barno";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
   
    if($row){
    
        $barangayname 		= $row['barangayname'];
        $city 		= $row['city'];
        $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
      
        $mission= $row['mission'];
        $vision= $row['vision'];
                
         $bct= $row['basic_community_tax'];

        $addtax= $row['additional_tax'];
        $nomonth= $row['no_of_month'];
               $gcashqrcode= $row['gcash_qrcode'];
               
               $getstarted= $row['getstarted'];

        
    }
    
    
    if($getstarted==1){
        
           header("Location: dashboard");
    }
}




?>







<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Info -  Weabits</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="">
		<!-- Main Header -->
		<?php //include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php //include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="">
			<div class="content">
				<div class=" bg-primary-gradient">
					<div class="page-inner">
						<div class="">
							<div>
								<h2 class="text-white fw-bold">Getting Started</h2>
								  
								
							</div>
							
							 <a href="model/logout.php" class="text-white" onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        Sign Out
                    </a>
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

								<div class="col-md-6 m-1">
							   
								
								<h2 class="text-white"><b>Set Up Barangay Information</b></h2>
								</div>

							
							
                               

								</div>

            <form method="POST" action="model/gettingstarted_update.php" enctype="multipart/form-data">
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
                               

                                <input type="file" class='form-control' name="city_logo" accept="image/*" required>
                                 </div>

                               

                              


                                 <div class="col-md-4 m-1 border rounded shadow-sm text-center">
                                     
                                 <label>Barangay Logo</label><br>
                               
                 
                               
                                  <input type="file" class='form-control' name="brgy_logo" accept="image/*" required>
                                 </div>


                                 <div class="col-md-3 m-1 p-1 border rounded shadow-sm text-center">
                                     
                                  
                                     <label>GCash QR Code</label>
                               
 <input type="file" class='form-control' name="gcashqrcode" accept="image/*" required>
                                
                                 </div>



                              



                                

                                     <div class="col-md-3 m-1 p-2 border rounded shadow-sm ">
                                     
                                  
                                     <label>Contact No.</label>
                                   

                                <input type="number" class="form-control" min="0"  placeholder="Enter Contact Number" name="number"  required>
                                 </div>
                                 
                                 
                                 
                                   <div class="col-md-3 m-1 p-1 border rounded shadow-sm ">
                                     
                                  
                                     <label>Mission</label>
                                       <textarea class="form-control" name="mission" required></textarea>
                                    

                                
                                 </div>
                                 
                                 
                                   <div class="col-md-5 m-1 p-1 border rounded shadow-sm  ">
                                     
                                  
                                     <label>Vision</label>
                                      <textarea class="form-control" name="vision" required></textarea>
                                 

                                
                                 </div>
                                 
                         
                                 
                                 
                              
                                 
                                 
       
                             

  
										   
										   

										   
										   
                                 
                                 




                                     <div class="col-md-3 mb-4 mt-4" style="text-align:center;">
						<button type="submit"  class="btn btn-link bg-primary text-white "  onclick="return confirm('Are you sure you want to proceed?');"
					
                      
					                                          >
																	<b>Next</b>
																</button>

					  </div>
					  
					  </form>



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
	
	
	
	
	
	
	<script>
	    
	    
	    
	    
	    
	    
	    
	    
	    
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>

