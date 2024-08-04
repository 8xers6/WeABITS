<?php include 'server/server.php' ?>
<?php 




    

if(!empty($_POST['cert_id'])){
    
    
    $certid=$_POST['cert_id'];
	$query = "SELECT * FROM tblcertificates WHERE cert_id='$certid'";
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
	<title>Request Certificates -  Barangay Management System</title>

	
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
                      	<h2 class="text-white fw-bold"><button type="button" class="btn btn-primary shadow-sm fw-bold border "  onclick="goBack()">Go back</button></h2>
                      	
                      	<h2 class="text-white fw-bold ml-3"></h2>
						</div>
					</div>
				</div>
                <div id="success">
              
				<div class="page-inner mt--2">
                <div class="row mt--2">
						<div class="col-md-6">
						
 
                   

                            <div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
									     <?php if($service['certificate']!='Certificate of Indigency'): ?>
										<div class="card-title fw-bold text-white">Pay GCash Here</div>
										
<?php  endif ?>
	
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >

						
								
								  <?php if($service['certificate']!='Certificate of Indigency'): ?>
								  <button class="btn btn-primary mt-1" type="button" data-toggle="collapse" data-target="#collapsegcash" aria-expanded="false" aria-controls="collapsegcash">
    GCash Qr Code
  </button>

<div class="collapse" id="collapsegcash">
  <div class="card card-body">
  	<img src="../assets/uploads/<?=$busername?>/barangayinfo/<?= $gcashqrcode?>" class="img-fluid  mt-3 rounded " alt="Responsive image" width="100%">
  </div>
</div>

<?php  endif ?>
								
                  
                  
                                                  
							
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
                             

	   <form  id="serviceform"  method="POST"  enctype="multipart/form-data" >
                            <input type="hidden" name="size" value="10000000000">
                            <div class="row">
                            
                                <div class="col-md-12">



								<div class="row  pt-2 m-0 pb-3  bg-white rounded  justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
								<h1><?=$service['certificate'] ?></h1>
							
                                                    <input type="hidden" class="form-control" value="<?=$service['certificate'] ?>"  name="certificate" >

										

						    </div>
                            

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Details:</b></h3>
							<p style="text-align:justify;"><?=$service['details'] ?></p>
							
                                                    <input type="hidden" class="form-control"value="<?=$service['details'] ?>" name="details"  >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Amount:</b></h3>
							<h1>&#8369 <?=  number_format($service['amount'],2) ?></h1>
							
                                         <input type="hidden" class="form-control" value="<?=$service['amount'] ?>"  name="amount"  >
						
                                   </div>

								   <?php if($service['certificate']=='Barangay Clearance'): ?>
								   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm" >
							
							<h3><b>Resident(2x2 picture):</b></h3>
							<input type="file" id="respic" class="resphoto" name="respic" onchange="previewrespic()" accept="image/*" hidden>
                    <img src="../assets/img/uploadimage.png" class="residentphoto img-fluid rounded mb-1"   alt="Image preview">
                    <button type="button" class="front-btn  btn btn-primary rounded fw-bold text-white form-control" onclick="respicbtn()">Attach Resident Picture</button>
                 

						    </div>

							<?php endif ?>

                                   <?php if($service['certificate']=='Barangay Clearance'): ?>
                                   <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Purpose:</b></h3>
							
									<select name="purpose"  class="form-control" onchange="otherbclearance(this);" required >
									<option disabled selected value="">Select Purpose</option>
                                                    <option value="Local Employment">Local Employment</option>
                                                    <option value="Excavation permit(Prime Water)">Excavation permit(Prime Water) </option>
                                                    <option value="requirement for Driver License">Requirement for Driver License</option>
													<option value="Motor Cycle Loan ">Motor Cycle Loan </option>
													<option value="Tricycle Mayors Permit / Prankisa">Tricycle Mayors Permit / Prankisa</option>
													<option value="Day Care Registration">Day Care Registration</option>
													<option value="Electrical Installation (Meralco Requirement)">Electrical Installation (Meralco Requirement)</option>
													<option value="Others">Others</option>
										
											</select>
											<!----<div id="div1"><b>If Other:</b> <input  class="form-control" type="text"  name="purpose_other" value="none" required></div>----->

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm" id="otherbclearance" style="display:none;">
							
							<h3><b>Others:</b></h3>
							<input type="text" class="form-control"  name="opurpose" placeholder="Enter other purpose"  >
                                                   

						    </div>

						
                            <?php endif ?>

                            <?php if($service['certificate']=='Certificate of Indigency'): ?>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
                                
                                  <h3>Request For: </h3>

                                  
                                  <select name="target" class="form-control" required>
                                  <option selected="" disabled="" value="">-- Select Family Members -- </option>
                                  <?php

                                  $hno=$resident['h_no'];
                                      $squery = mysqli_query($conn,"SELECT *,tbl_residents.res_id as res_id,YEAR(created_at)as `year`,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.bar_no,5,'0') as bar_no,tbl_residents.email as emails FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id   WHERE tblhousehold.bar_no=$barno AND tbl_residents.h_no=$hno");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['res_id'].'">Resident ID:'.$row['res_id'].' | '.$row['firstname'].'  '.$row['middlename'].'  '.$row['lastname'].' | Relation:'.$row['relation'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                            
							
							<h3><b>Purpose:</b></h3>
							<select class="form-control"  name="purpose" required onchange="otherbclearance(this);" >
                                                    <option disabled selected value="">Select Purpose</option>
                                                    <option value="Medical Assistance">Medical Assistance</option>
                                                    <option value="Financial Assistance">Financial Assistance</option>
                                                    <option value="Food Assistance">Food Assistance</option>
													<option value="Others">Others</option>
													
                                                         </select>

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm" id="otherbclearance" style="display:none;">
							
							<h3><b>Others:</b></h3>
							<input type="text" class="form-control"  name="opurpose" placeholder="Enter other purpose"  >
                                                   

						    </div>

							

                            <?php endif ?>

                            <?php if($service['certificate']=='Business Clearance'): ?>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Request Type:</b></h3>
							<select class="form-control"  name="type" required >
                                                    <option disabled selected value="">Select Request type</option>
                                                    <option value="New Business">New Business</option>
                                                    <option value="Renewal">Renewal</option>
                                                   

													
                                                        </select>

						    </div>


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							
							<h3><b>Registered Name of Business:</b></h3>
                                                    <input type="text" class="form-control" placeholder="Enter Name Business" name="nbusiness" required >

						    </div>

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Location</b></h3>
                                                    
                                <select  name="businessadd" class="form-control input-sm"  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet 	WHERE bar_no=$barno");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['streetname'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Nature of Business Ownership</b></h3>
							
							<select  class="form-control"  name="natureBO" required >
							<option disabled selected value="">Select Nature of Business Ownership</option>
											<option value="Sole-proprietorship">Sole Proprietorship</option>
											<option value="Partnership">Partnership</option>
											<option value="Corporation">Corporation</option>
											<option value="LLC">Limited Liability Company (LLC)</option>
											<option value="Cooperative">Cooperative</option>
											<option value="Store">Store</option>
											<option value="Tiangge">Tiangge</option>
											<option value="Talipapa">Talipapa</option>
											</select>

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Nature:</b></h3>
							
                                                    <input type="text" class="form-control" placeholder="Enter Business Nature" name="bnature" required >

						    </div>


							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>SEC/ DTI Registration Number</b></h3>
							
                                                    <input type="number" min="1" class="form-control" placeholder="Enter SEC/ DTI Registration Number" name="dtino" required >

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Business Phone No.:</b></h3>
							
                                                    <input type="number" class="form-control" placeholder="Enter Phone number" name="bphone" required >

						    </div>

							<div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<h3><b>Picture of Business</b></h3>
							
                                                    <input type="file"  class="bphoto" id="buspic"  placeholder="Enter Phone number" name="bpicture"  onchange="previewbusinesspic()" required  accept="image/*" >
													<!---<img src="../assets/img/uploadimage.png" class="busphoto img-fluid rounded mb-1"   alt="Image preview">
                    <button type="button" class="front-btn  btn btn-primary rounded fw-bold text-white form-control" onclick="businesspicbtn()">Attach Picture of Business</button>
                 ---->
						    </div>

					
							<?php endif ?>


                            <?php if($service['certificate']=='Building Clearance'): ?>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>House#:</b></h3>
							
							<input type="text" class="form-control" placeholder="Enter House#" name="houseno" required >
								<h3><b>Street:</b></h3>
							 <select  name="street" class="form-control "  data-live-search="true">
									  <option selected="" disabled="">-- Select Street -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet 	WHERE bar_no=$barno");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['streetname'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
						</div>	
                    

					

							<?php endif ?>


                    

							
                     
						<?php if($service['certificate']=='Business Clearance' || $service['certificate']=='Building Clearance' || $service['certificate']=='Barangay Clearance'): ?>
                        <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							
							<h3><b>Payment Method:</b></h3>
					 <select class="form-control" id="pmethod"  name="pmethod"  required  onchange="yesnoCheck(this);" >
											 <option disabled selected value="">Select Payment Method</option>
											 <option value="GCash">Gcash</option>
                                             <option value="Cash Only">Cash Only</option>
											
										   

											 
												 </select>


 <?php endif ?>
                       
                  

					

		
                     <div id="gcash" style="display: none;"  class="col-md-11 m-1 pb-2 border rounded shadow-sm">

<span role="alert" id="nameError" aria-hidden="true" style="color:red; font-size:15px;"> Please Enter Gcash Reference no. & Screenshot </span>


       <h3><b>Gcash Receipt(screenshot):</b></h3>

       
                    <input type="file" id="greceipt" class="gphoto" name="gpayment" onchange="previewGreceipt()" accept="image/*" hidden>
                    <img src="../assets/img/uploadimage.png" class="gcashphoto img-fluid rounded mb-1"   alt="Image preview">
                    <button type="button" class="front-btn  btn btn-primary rounded fw-bold text-white form-control" onclick=" gcashreceipt()">Attach GCash Receipt</button>

   
   </div>

                             


						

						</div>

                     


						<div class="col m-1 pb-2 rounded  text-center">
   <div  id="errwarning" class="col-md-11 m-1 border bg-danger fw-bold text-center" style="color:white; "></div>

<input type="checkbox" class=""  name="terms" id="terms" value="accepted"/>
                <label for="terms">I have read and agree to the </label>
                <a  href="#view" data-toggle="modal" class="fw-bold"
                                                                   >terms of service and conditions
                                                                </a>
                                             </div>
                         

                          

                             </div>

                        </div>


                     </div>
                            

                        <div class="modal-footer justify-content-center">
							
                           <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>  
                    
                            <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want submit this Request');" id="reqbtn" >Request</button>
                            <?php endif ?>
                        </div>
                        </form>
                       

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
	
	
	
	   <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Terms of Service and Conditions</h5>
                          
                        </div>
                        <div class="modal-body">
                       
                                 <p>

                                 Republic Act No. 10173, also known as the Data Privacy Act of 2012 (DPA), aims to protect personal data in information and communications systems both in the government and the private sector. The DPA created the National Privacy Commission (NPC) which is tasked to monitor its implementation.









                                 </p>
                                 
                                 
                                   <p>
       Gcash Payments are non-refundable so be sure to provide accurate information.








                                 </p>
                                 
                                     <p>
                    Once your request has reached the processing stage. visit your barangay. For Barangay Clearance, Building Clearance, and Business Clearance the barangay will demand you to see your vali cedula. if you dont have a cedula the barangay will issue one for you.Note! ensure that you have a cash on you.






                                 </p>
                            
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="disagree">
                                 Disagree
                            </button>
                            <button type="button" class="btn btn-primary" id="checkterms" data-dismiss="modal">Agree</button>
                        
                        </div>
               
                    </div>
                </div>
            </div>
	<?php include 'templates/footer.php' ?>


</body>


<script>

$("#checkterms").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");
  $("#terms").prop("checked", true); 
});

$("#disagree").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");
           $("#terms").prop("checked", false); 

});

</script>

</html>


