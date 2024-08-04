<?php include '../server/server.php' ?>
<?php

if(!empty($_SESSION['resid'])){
$resid=$_SESSION['resid'];

$barno=$_SESSION['barno'];
    $query = "SELECT * FROM tblcertificates WHERE bar_no=$barno";
    $result = $conn->query($query);

    $services = array();
    while($row = $result->fetch_assoc()){
        $services[] = $row; 
    }



    

	$query1 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
    $result1 = $conn->query($query1);
	$resident = $result1->fetch_assoc();







}



?>
  <?php if($_SESSION['role']=='Resident'): ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Services -  Barangay Management System</title>
    
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
								<h2 class="text-white fw-bold">Barangay Services</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">

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
										<div class="card-title "> </div>
										<div class="card-tools">
											
										</div>  
									</div>
								</div>
								<div class="card-body" >


                                <!--start col-->

                                <div class="row  justify-content-center" >
                                            
                       
                        
                                    <?php if(!empty($services)): ?>
                                    <?php $no=1; foreach($services as $row): ?>
                                        


                                      <div class="col-md-5 m-2   border pl-4 pr-4  shadow " >

                                   
                                          <img src="../assets/uploads/<?= $busername ?>/services/<?php echo $row['image']; ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%" >
                                          <div class="d-flex flex-column mt-1">
                                          

                            <form method="POST" action="choose_req_type.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">

                            <input type="hidden" class="form-control" value="<?=$row['ser_no'] ?>"  name="serno" >
                            <input type="hidden" class="form-control" value="<?=$row['document_type'] ?>"  name="doctype" >
                            <?php if($resident['blocklisted']=='No Record'): ?>
                                <?php if($row['document_type']=='Certificate of Indigency'): ?>
                                    <?php if($resident['monthly_income']<9000): ?>
                            <button  class= "form-control btn  bg-primary text-white  fw-bold" type="submit">Request </button>
                            <?php else: ?>

                                <p class="text-center fw-bold" style="color:red;" > your not eligible to request this document!</p>
                            <?php endif ?>
                                            <?php endif ?>


                                            <?php if($row['document_type']=='Barangay Clearance' || $row['document_type']=='Business Permit'  || $row['document_type']=='Building Permit'): ?>
                                       
                                       <button  class= "form-control btn  bg-primary text-white  fw-bold" type="submit">Request </button>
                                                       <?php endif ?>
                                                       <?php else: ?>
                                                        <h1 class="text-center fw-bold" style="color:red;" >Blocklisted</h1>
                                                       <?php endif ?>




                                    </form>
                                          </div>

                                          <div class="row justify-content-center">

                                          <h2 style="font-weight:bolder;"><?= $row['document_type'] ?></h2> 

                                          </div>
                                           
                                         
 

                                          <div class="row">
                                          <div class="d-flex flex-column mt-1 ml-4 mr-4">
                                        <!--  <b>Details:</b>
                                          <p style="text-align:justify; text-justify: inter-word;"> </?=//$row['details'] ?/></p> --->

                                          </div>
                                        
                                        

                                        

                                          </div>
            
                                          <div class="row ">
                                          <div class="d-flex flex-column mb-4 mt-1 ml-4 mr-4">
                                           <b>Amount:</b>

                                          </div>
                                          <div class="col-5">
                                         <p style="text-align:justify; text-justify: inter-word;">&#8369 <?= $row['amount'] ?></p>

                                          </div>

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
		   <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="modal-title" id="exampleModalLabel" >Edit/View Health Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_request.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                            
                                <div class="col-md-12">

								<div class="row m-0 p-3 bg-primary-gradient rounded border">
						      <div class="col-md-12 m-1">
							
								
						
								</div>

								<div class="col-md-12 m-1">
							   
								
								<h2 class="text-white" style="text-align:center;"><b>Request Documents</b></h2>
								</div>

							
							
                               

								</div>


								<div class="row  pt-2 m-0 pb-3  bg-white rounded border justify-content-center">
                                


                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<label>Doc rested</label>
                                                    <input type="text" class="form-control" placeholder="Enter Vaccine Brand" name="docreq" >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<label>purpose</label>
                                                    <input type="text" class="form-control" placeholder="Enter Vaccine Brand" name="purpose"  >

						    </div>

                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<label>details</label>
                                                    <input type="text" class="form-control" placeholder="Enter Vaccine Brand" name="details"  >

						    </div>
                            <div class="col-md-11 m-1 pb-2 border rounded shadow-sm">
							<label>Amount</label>
                                         <input type="number" class="form-control" placeholder="Enter Vaccine Brand" name="amount"  >

                                   </div>

                            



							


						

						</div>


						
                         

                           

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
</body>
</html>



<?php else: header('Location: ../dashboard.php'); ?>
   

<?php endif ?>