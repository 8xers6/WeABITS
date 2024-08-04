<?php include 'server/server.php' ?>
<?php 

$document = $_GET['document'];


if(!empty($document)){
	$query = "SELECT * FROM tblservices WHERE document_type='$document'";
	$result = $conn->query($query);
	$service = $result->fetch_assoc();


}else{

	//header('Location: reqdocs.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Pick up -  Barangay Management System</title>

	
</head>
<body >
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
								<h2 class="text-white fw-bold">Request Document</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
                <div class="row mt--2">
						<div class="col-md-6">
						

						   <?php if($document=='Barangay Clearance'): ?>

                            <div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">Preview</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


                             
                             


								<img src="../assets/uploads/services/<?= $service['image'] ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%">


                                    
                         

                                                         
                                        
                                    </div>
                               
                                  



							
							</div>
						</div>


                        <div class="col-md-6">

                           

                           

								

							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">REQUEST CERTIFICATE</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >




								<form method="POST" action="model/save_request.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">



								<div class="row  pt-2 m-0 pb-3  bg-white rounded  justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Document:</b></h3>
								<h1><?=$service['document_type'] ?></h1>
							
                                                    <input type="hidden" class="form-control" value="<?=$service['document_type'] ?>"  name="doctype" >

													<input type="hidden" class="form-control" value="<?=$service['ser_no'] ?>"  name="serno" >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Purpose:</b></h3>
							
									<select name="purpose"  class="form-control" required  onchange="showfield(this.options[this.selectedIndex].value)">
									<option disabled selected value="">Select Purpose</option>
                                                    <option value="Local Employment">Local Employment</option>
                                                    <option value="Excavation permit(Prime Water)">Excavation permit(Prime Water) </option>
                                                    <option value="requirement for Driver License">Requirement for Driver License</option>
													<option value="Motor Cycle Loan ">Motor Cycle Loan </option>
													<option value="Tricycle Mayors Permit / Prankisa">Tricycle Mayors Permit / Prankisa</option>
													<option value="Day Care Registration">Day Care Registration</option>
													<option value="Electrical Installation (Meralco Requirement)">Electrical Installation (Meralco Requirement)</option>
										
											</select>
											<!----<div id="div1"><b>If Other:</b> <input  class="form-control" type="text"  name="purpose_other" value="none" required></div>----->

						    </div>

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Details:</b></h3>
							<p style="text-align:justify;"><?=$service['details'] ?></p>
							
                                                    <input type="hidden" class="form-control"value="<?=$service['details'] ?>" placeholder="Enter Vaccine Brand" name="details"  >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Amount:</b></h3>
							<h1>&#8369 <?=$service['amount'] ?></h1>
							
                                         <input type="hidden" class="form-control" value="<?=$service['amount'] ?>"  name="amount"  >

                                   </div>


                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Payment Method:</b></h3>
					 <select class="form-control"  name="pmethod" required >
											 <option disabled selected value="">Select Payment Method</option>
											 <option value="Gcash">Gcash</option>
											
										   

											 
												 </select>

					 </div>

					 <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Reference No.:</b></h3>
					
							
                                         <input type="number" class="form-control" value="" placeholder="Enter Gcash Reference no." name="refno" required >

                                   </div>

                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Proof of Payment.:</b></h3>
					
							
                                         <input type="file" class="form-control"value="" name="h" required  >

                                   </div>

                            



							


						

						</div>


						
                         

                           

                             </div>

                        </div>


                     </div>


                        <div class="modal-footer">
							
                          
                            <button type="button" class="btn btn-danger"  onclick="goBack()">Cancel</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Submit this request');">Request</button>
                            <?php endif ?>
                        </div>
                        </form>


							</div>
							</div>
						
						<?php elseif($document=='Certificate of Indigency'): ?>

							
							 <div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">Preview</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


                             
                             


								<img src="../assets/uploads/services/<?= $service['image'] ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%">



                         
                               
                             

                                                         
                                        
                                    </div>
                               
                                  



							
							</div>
						</div>
						<div class="col-md-6">

							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">REQUEST CERTIFICATE</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


							<form method="POST" action="model/save_request.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">

							


								<div class="row  pt-2 m-0 pb-3  bg-white rounded justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Document:</b></h3>
								<h3><b><?=$service['document_type'] ?></b></h3>
							
                                                    <input type="hidden" class="form-control" value="<?=$service['document_type'] ?>"  name="doctype" >
													<input type="hidden" class="form-control" value="<?=$service['ser_no'] ?>"  name="serno" >

						    </div>
                          

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Details:</b></h3>
							<p style="text-align:justify;"><?=$service['details'] ?></p>
							
                                                    <input type="hidden" class="form-control"value="<?=$service['details'] ?>" placeholder="Enter Vaccine Brand" name="details"  >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Amount:</b></h3>
							<h1>&#8369 <?=$service['amount'] ?></h1>
							
                                         <input type="hidden" class="form-control"value="<?=$service['amount'] ?>" placeholder="Enter Vaccine Brand" name="amount"  >

                                   </div>
                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Purpose:</b></h3>
							<select class="form-control"  name="purpose" required >
                                                    <option disabled selected value="">Select Purpose</option>
                                                    <option value="Medical Assistance">Medical Assistance</option>
                                                    <option value="Financial Assistance">Financial Assistance</option>
                                                    <option value="Food Assistance">Food Assistance</option>
													
													
                                                        </select>

						    </div>

						<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Payment Method:</b></h3>
					 <select class="form-control"  name="pmethod" required >
											 <option disabled selected value="">Select Payment Method</option>
											 <option value="Gcash">Gcash</option>
											 <option value="cash-on-pickup">Cash on Pickup</option>
										   

											 
												 </select>

					 </div>

					 <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Reference No.:</b></h3>
					
							
                                         <input type="number" class="form-control" value="" placeholder="Enter Gcash Reference no." name="refno" required >

                                   </div>

                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Proof of Payment.:</b></h3>
					
							
                                         <input type="file" class="form-control"value="" name="h" required  >

                                   </div>


							


						
                         

                           

                             </div>

                        </div>


                     </div>


                        <div class="modal-footer">
                          
                            <a type="button" href="reqdocs" class="btn btn-danger"  onclick="goBack()">Cancel</a>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Request</button>
                            <?php endif ?>
                        </div>
                        </form>
							</div>
							</div>
                            </div>



						<?php elseif($document=='Business Permit'): ?>
							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">Preview</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


                             
                             


								<img src="../assets/uploads/services/<?= $service['image'] ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%">



                         
                               
                             

                                                         
                                        
                                    </div>
                               
                                  



							
							</div>
						</div>

							<div class="col-md-6">

							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">REQUEST CERTIFICATE</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >



							<form method="POST" action="model/save_request.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">

							


								<div class="row  pt-2 m-0 pb-3  bg-white rounded  justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Document:</b></h3>
								<h1><?=$service['document_type'] ?></h1>
							
                                                    <input type="hidden" class="form-control" value="<?=$service['document_type'] ?>"  name="doctype" >
													<input type="hidden" class="form-control" value="<?=$service['ser_no'] ?>"  name="serno" >

						    </div>
							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Details:</b></h3>
							<p style="text-align:justify;"><?=$service['details'] ?></h1>
							
                                                

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Request Type:</b></h3>
							<select class="form-control"  name="reqtype" required >
                                                    <option disabled selected value="">Select Request type</option>
                                                    <option value="new">New Business</option>
                                                    <option value="Renewal">Renewal</option>
                                                   

													
                                                        </select>

						    </div>

							

						    

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							
							<h3><b>Name of Business:</b></h3>
                                                    <input type="text" class="form-control" placeholder="Enter Name Business" name="nbusiness" required >

						    </div>

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Address:</b></h3>
							
                                                    <input type="text" class="form-control" placeholder="Enter Business Address" name="businessadd" required >

						    </div>



							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Nature:</b></h3>
							
                                                    <input type="text" class="form-control" placeholder="Enter Business Nature" name="bnature" required >

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Phone No.:</b></h3>
							
                                                    <input type="text" class="form-control" placeholder="Enter Phone number" name="bnumber" required >

						    </div>


						



                           
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Amount:</b></h3>
							
							<h1> &#8369 <?=$service['amount'] ?></h1>
							
                                         <input type="hidden" class="form-control"value="<?=$service['amount'] ?>" placeholder="Enter Vaccine Brand" name="amount"  >

                                   </div>


                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Payment Method:</b></h3>
					 <select class="form-control"  name="pmethod" required >
											 <option disabled selected value="">Select Payment Method</option>
											 <option value="Gcash">Gcash</option>
											
										   

											 
												 </select>

					 </div>

					 <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Reference No.:</b></h3>
					
							
                                         <input type="number" class="form-control" value="" placeholder="Enter Gcash Reference no." name="refno" required >

                                   </div>

                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Proof of Payment.:</b></h3>
					
							
                                         <input type="file" class="form-control"value="" name="h" required  >

                                   </div>

						</div>
						
                         

            

                        </div>

                        </div>


                    	</div>


                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-danger"  onclick="goBack()">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Request</button>
                            <?php endif ?>
                        </div>
                        </form>

							</div>
							</div>

  

						<?php elseif($document=='Building Permit'): ?>
							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">Preview</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


                             
                             


								<img src="../assets/uploads/services/<?= $service['image'] ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%">



                         
                               
                             

                                                         
                                        
                                    </div>
                               
                                  



							
							</div>
						</div>
							<div class="col-md-6">

							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">REQUEST CERTIFICATE</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


							<form method="POST" action="model/save_request.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">

								


								<div class="row  pt-1 m-0 pb-1  bg-white rounded  justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Document:</b></h3>
								<h1><?=$service['document_type'] ?></h1>
							
                                                    <input type="hidden" class="form-control" value="<?=$service['document_type'] ?>"  name="doctype" >
													<input type="hidden" class="form-control" value="<?=$service['ser_no'] ?>"  name="serno" >

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Building Location:</b></h3>
                                                    <input type="text" class="form-control" placeholder="Enter Building Address" name="location" required >

						</div>	

						



                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Details:</b></h3>
							<p  style="text-align:justify;"><?=$service['details'] ?></p>
							
                                                    <input type="hidden" class="form-control"value="<?=$service['details'] ?>" placeholder="Enter Vaccine Brand" name="details"  >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Amount:</b></h3>
							<h1>&#8369 <?=$service['amount'] ?></h1>
							
                                         <input type="hidden" class="form-control"value="<?=$service['amount'] ?>" placeholder="Enter Vaccine Brand" name="amount"  >

                                   </div>




                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Payment Method:</b></h3>
					 <select class="form-control"  name="pmethod" required >
											 <option disabled selected value="">Select Payment Method</option>
											 <option value="Gcash">Gcash</option>
											 <option value="cash-on-pickup">Cash on Pickup</option>
										   

											 
												 </select>

					 </div>

					 <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Reference No.:</b></h3>
					
							
                                         <input type="number" class="form-control" value="" placeholder="Enter Gcash Reference no." name="refno" required >

                                   </div>

                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Gcash Proof of Payment.:</b></h3>
					
							
                                         <input type="file" class="form-control"value="" name="h" required  >

                                   </div>

							

					 </div>

						</div>
						
                         

            

                        </div>

                        </div>


                  


                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-danger"  onclick="goBack()">Close</button>
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Request</button>
                            <?php endif ?>
                        </div>
                        </form>

							</div>



                            

                          
						

  

							
							</div>

							<?php else:   echo '<div class="alert alert-danger ">
							<b class="text-danger">Invalid url go back. </b><a type="button" class="" href="reqdocs">click here!</a>
							</div>  ' ;?>

					  <?php endif ?>
					
					
				
				
				
				





				
				
					
				</div>
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
<!----
	<script type="text/javascript">
  function showfield(name){
    if(name=='Other')document.getElementById('div1').style.display="block";
    else document.getElementById('div1').style.display="none";
  }
 
 function hidefield() {
 document.getElementById('div1').style.display='none';
 }
  </script>--->
</body>
</html>