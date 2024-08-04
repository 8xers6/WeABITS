<?php include 'server/server.php' ?>
<?php


$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM tblcertificates WHERE bar_no=$barno order by certificate asc";
    $result = $conn->query($query);

    $services = array();
    while($row = $result->fetch_assoc()){
        $services[] = $row; 
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Certification -  Barangay Management System</title>
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
										<div class="card-title"> <i class="icon-docs"></i>  Barangay Certificates</div>
										<div class="card-tools">
										    <!----
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Certificate  
											</a>--->
										</div>
									</div>
								</div>
								<div class="card-body" >


                                <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                    <?php if(!empty($services)): ?>
                                    <?php $no=1; foreach($services as $row): ?>
                                        


                                    <div class="col-md-5 m-2  border  shadow ">

                                          <div class="row bg-primary d-flex flex-row-reverse  " >
                                      
                                         <div class="form-button-action">
                                       
                                            
                                        
                                                                
                                                            </div>
                                          </div>
                                         
                                          

                                          <div class="d-flex flex-column mt-1">
                                        
                                         
                                       
                                            
                                        
                                                              
                                                          

                                          </div>

                                          <div class="row justify-content-center">

                                          <h2 style="font-weight:bolder;"><?= $row['certificate'] ?></h2> 
                                          </div>
                                         


                                    

                                          <div class="row ">
                                          <div class="d-flex flex-column mb-4 mt-1 ml-4 mr-4">
                                           <b>Amount:</b>

                                          </div>
                                          <div class="col-5">
                                         <p style="text-align:justify; text-justify: inter-word;">&#8369 <?=  number_format($row['amount'],2) ?></p>

                                          </div>
                                          
                                           
                                          
                                          
                                           

                                    </div>
                    <div class="d-flex flex-column mb-4 mt-1 ml-4 mr-4">
                                    <a type="button" href="#edit" data-toggle="modal" class="btn btn-link bg-primary " title="Edit Services" 
 
                                                         onclick="editServices(this)"  data-id="<?= $row['cert_id'] ?>" 
                                                         data-ttle="<?= $row['certificate'] ?>"
                                                   
                                                         data-details="<?= $row['details'] ?>"
                                                         data-amount="<?= $row['amount'] ?>"
                                                      
                                                         data-brgy="<?=$_SESSION['username']?>">

                                                                   <b class="text-white">Edit</b>
                                                                </a> 
                                                               

                                          </div>
                                    

                                         
                                       

                                        
                                       
                                                                   
                                                          
                     
                                                                                
                                                                                
                                                              
                                  

                                        
                                        
                                      
                                   </div>
                               <?php $no++; endforeach ?>
                                   <?php else: ?>
   

                           <h1 colspan="4" class="text-center">No Available Data</h1>
                   
                   <?php endif ?>
                              </div>


                                   <!---end table-->


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
                            <h5 class="modal-title" id="exampleModalLabel">Create Services</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_services.php"  enctype="multipart/form-data">
                             

                                <div class="form-group">
									<label>Document Type</label>
										
                                      
												<select class="form-control fw-bold"   name="ttle"  required>
												<option disabled selected>Select Document</option>
												<option value="Barangay Clearance">Barangay Clearance</option>
												<option value="Certificate of Indigency">Certificate of Indigency</option>
												<option value="Business Permit">Business Permit</option>
                                                <option value="Building Permit">Building Permit</option>
										
												</select>

                                   </div> 


                         

                                <div class="form-group">
                                    <label>Details</label>
                              
                                    <textarea class="form-control" name="details" placeholder="Enter Details" ></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount" required>
                                </div>
                                <div class="form-group">
                                    <h4 style="text-align:center;">Add Photo</h4>
                                        <input type="file" class="form-control" name="img" accept="image/*" required>

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
                <div class="modal-dialog  modal-ml" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Certificate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="model/edit_services.php"  enctype="multipart/form-data">
                       

                                <div class="form-group">
									<label>Certificates</label>
										
                                      
							<input type="text" class="form-control" readonly style="font-weight:bolder; color:black;"  id="ttle">	

                                   </div> 



                             

                                <div class="form-group">
                                    <label>Details</label>
                                  
                                    <textarea class="form-control" name="details" id="details" placeholder="Enter Details" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" id="amount" name="amount">
                                </div>
                              

                                                         
                            
                        </div>
                        <div class="modal-footer">
                             <input type="hidden" id="serid"  name="id" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Update this Service?');">Update</button>
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

</body>
</html>