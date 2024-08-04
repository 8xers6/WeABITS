<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];


$resid=$_GET['id'];
  
	$query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.res_id='$resid' ";
    $result = $conn->query($query);
	$resident = $result->fetch_assoc();
     

    $hno 		= $resident['h_no'];



    $query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Head' ";
    $result = $conn->query($query);
	$father = $result->fetch_assoc();


    $query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Wife' ";
    $result = $conn->query($query);
	$mother = $result->fetch_assoc();





    $query = "SELECT * FROM `tblpatient`  WHERE res_id=$resid;";
                        $result = $conn->query($query);

    $patient = array();
	while($row = $result->fetch_assoc()){
		$patient[] = $row; 
	}
	
	
	$query2= "SELECT *FROM tblreqmedicine LEFT join tbl_residents on tblreqmedicine.res_id=tbl_residents.res_id  LEFT JOIN tblmedicine on tblmedicine.med_no=tblreqmedicine.med_no WHERE tbl_residents.res_id=$resid";
$result2= $conn->query($query2);

$reqmed= array();
while($row = $result2->fetch_assoc()){
$reqmed[] = $row; 
}

	
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Patient Record - Weabits</title>
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

							</div>
						</div>
					</div>
				</div>
				
				<div class="page-inner mt--2">

              

           <!-- Modal -->
		
                   
         

<input type="hidden" name="size" value="1000000">
<div class="col-md-12">

<div class="row  p-3 bg-primary-gradient shadow-sm rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>Patient Information</b></h2>
</div>









</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white  border shadow-sm rounded justify-content-start">
<div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Resident ID</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['res_id']) ?>" >

                               </div>

<div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Firstname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['firstname']) ?>" >

                               </div>

                               <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label >Middlename</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['middlename']) ?>" >
                               

                               </div>


                               <div class="col-md-3   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Lastname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['lastname']) ?>" >

                               </div>




                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>suffix</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['suffix'] ?>" >

                               </div>

                               <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               <label >Gender</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['gender']) ?>" >
                               

                               </div>

                               <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               <label >Birth Date</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="  <?php $str = $resident['birthdate']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                               

                               </div>

                        

                               <div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               <label >Address</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['household_no']) ?> <?= ucwords($resident['streetname']) ?>" >
                               

                               </div>


                            

                            






      

                               






					</div>


					</div>



                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?> mt-2" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>


                            <div class="card mt-3 border">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Consultation Record</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                      
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Consultation
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

                                                <th scope="col">Reason of consultation</th>
													<th scope="col">Diagnosis</th>
														<th scope="col">Instruction</th>
                                                    <th scope="col">Date Encoded</th>
												
												
                                                    <th scope="col">Action</th>
												
                                              
                                                 
                                                   
                                                 
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($patient)): ?>
													<?php $no=1; foreach($patient as $row): ?>
													<tr>

                                          
                                             
													
													
                                                        		<td><?= $row['consultation_reason'] ?></td>
                                                        
                                                 
												
                                                        		<td><?= $row['diagnosis'] ?></td>
                                                        
                                                        		<td><?= $row['instruction'] ?></td>
                                                        
                                                 
                                                        		<td><?= $row['created_at'] ?></td>
                                                        
                                                 
                                                                <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit instruction" onclick="editinstruction(this)" 
                                                                    data-pno="<?= $row['patient_no'] ?>"
                                                                    data-reason="<?= $row['consultation_reason'] ?>"
                                                                    data-diagnosis="<?= $row['diagnosis'] ?>"
                                                                    data-pres="<?= $row['instruction'] ?>"
                                                                    
                                                                    
                                                                    
                                                                    >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/manageprescription.php?id=<?= $row['res_id'] ?>&state=remove&pno=<?=$row['patient_no']?>" onclick="return confirm('Are you sure you want to delete this street?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                      
                                                     
                                        


                                                     
														
													</tr>
													<?php $no++; endforeach ?>

                                                    <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No  Record</td>
                                                    </tr>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                                <th scope="col">Reason of consultation</th>
													<th scope="col">Diagnosis</th>
														<th scope="col">instruction</th>
                                                    <th scope="col">Date Encoded</th>
												
												
                                                    <th scope="col">Action</th>
										
                                                 
                                                   
                                                
													
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								
								
								
								
								
								
								
								
								
								
								

                                </div>
                                
                                 <?php if(isset($_SESSION['messager'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?> mt-2" role="alert">
                                    <?php echo $_SESSION['messager']; ?>
                                </div>
                            <?php unset($_SESSION['messager']); ?>
                            <?php endif ?>
                                
                            <div class="card border">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Requested Medicine</div>
										<div class="card-tools">
											<a href="#stockout" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Request Medicine
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="request">
                                            <thead>
                                                <tr>
                                               
                              
                                                    <th scope="col" class="text-left">Medicine</th>
                                                    <th scope="col" class="text-center">Quantity</th>
                                                  
                                                    <th scope="col" class="text-center">Date Received</th>
                                                    <th scope="col" class="text-center">Username</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($reqmed)): ?>
                                                    <?php $no=1; foreach($reqmed as $row): ?>
                                                    <tr>
                                                    
                                                     
                                                   
                                                        <td><?= $row['med_name'] ?> <sup><?php echo $row['measurement'] ?></sup></td>
                                                        <td class="text-center"><?= $row['qty'] ?></td>
                                                      
                                                        <td class="text-center"><?= $row['date_received'] ?></td>
                                                        <td class="text-center"><?= $row['user_name'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#editstockinoutexp" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Request Medicine" onclick="editReqMed(this)" 
                                                         data-username="<?= $_SESSION['username'] ?>" 
                                                         data-reqmedno="<?= $row['reqmed_no'] ?>" 

                                                         data-medno="<?= $row['med_no'] ?>"
                                                         data-medname="<?= $row['med_name'] ?>" 
                                                         data-pres="<?= $row['prescription_image'] ?>" 
                                                         data-medqty="<?= $row['qty'] ?>" 
                                                         data-fname="<?= $row['firstname'] ?>"   
                                                         data-mname="<?= $row['middlename'] ?>"   
                                                         data-lname="<?= $row['lastname'] ?>"
                                                         data-suffix="<?= $row['suffix'] ?>"
                                                         >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_reqmed.php?reqno=<?= $row['reqmed_no'] ?>&resid=<?=$resident['res_id']?>" onclick="return confirm('Are you sure you want to delete this Medicine?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                      
                                                    <th scope="col">Medicine</th>
                                                    <th scope="col">Quantity</th>
                                                  
                                                    <th scope="col">Date Received</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
                            
                                
						</div>


                    



                      <!-- Modal -->
                      <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Consultation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/manageprescription.php" >


                            <input type="hidden" value="addprescription"  name="state">
                      <input type="hidden" value="<?= $resident['res_id']?>"  name="id">
                                <div class="form-group">
                                    <label>Reason of Consultation</label>
                                    <textarea type="text" class="form-control" required name="reason" placeholder="Enter Reason of Consultation"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Diagnosis</label>
                                    <textarea type="text" class="form-control" required name="diagnosis" placeholder="Enter Diagnosis"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <textarea type="text" class="form-control" required name="instruction" placeholder="Enter instruction"></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                    
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>









         <!-- Modal -->
         <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Consultation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/manageprescription.php" >


                            <input type="hidden" value="editprescription"  name="state">
                            <input type="hidden" id="pno"  name="pno">
                      <input type="hidden" value="<?= $resident['res_id']?>"  name="id">
                                <div class="form-group">
                                    <label>Reason of Consultation</label>
                                    <textarea type="text" id="reason" class="form-control" required name="reason" placeholder="Enter Reason of Consultation"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Diagnosis</label>
                                    <textarea type="text" class="form-control" id="diagnosis" required name="diagnosis" placeholder="Enter Diagnosis"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <textarea type="text" class="form-control" id="pres" required name="instruction" placeholder="Enter instruction"></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                    
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            
            
              <!-- Modal  stock-->
             <div class="modal fade" id="stockout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Medicine Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php"  enctype="multipart/form-data">
                               


                          
                            <div class="form-group">
                                <label>Choose  Medicine</label>
                                    <div class="search_select_box" >
                                  
                                  <select name="medno" class="form-control"  data-live-search="true" required >
                                  <option selected disabled value="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_no'].'">'.$row['med_name'].'   '.$row['measurement'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>
                                    
                                     <input type="hidden" value="<?=$resident['res_id']?>" class="form-control"  name="resid" required>

                                    <input type="hidden" value="stockout" class="form-control"  name="state" required>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" min="1"  name="qty" required>
                                </div>


                                <div class="form-group">
                                    <label>Prescription Image</label>
                                    <input type="file" class="form-control"   name="image" accept="image/*" required>
                                </div>

                                
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


             <!-- Modal  stock-->
             <div class="modal fade" id="editstockinoutexp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Medicine Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php"  enctype="multipart/form-data">
                               
                         <input type="hidden" value="<?=$resident['res_id']?>" class="form-control"  name="resid" required>


                                <div class="form-group">
                                    <label>Medicine</label>
                                    <input type="text" readonly class="form-control fw-bold" style="color:black;"  id="reqmedname" required>
                                </div>

                        
                                    
                                <input type="hidden" class="form-control" name="medno"  id="editmedno" required>
                                <input type="hidden"  class="form-control"  name="reqmedno" id="reqmedno" required>
                                    <input type="hidden" value="editstockout" class="form-control"  name="state" required>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control"  name="qty" id="reqqty" required>
                                </div>


                               
                                <div class="form-group">
                                <label>Prescription Image</label><br>
                                <img src="assets/img/weabitlogo.png" alt="..." class="img-fluid"   id="prescription"> 

                            <br>
                                <label>Change to:</label>
                                    <input type="file" class="form-control"   name="image" accept="image/*">
                                </div>
                                
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Submit</button>
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
        $(document).ready(function() {
            
            $('.search_select_box select').selectpicker();
        });
    </script>


<script>

function editinstruction(that){
   
   
  
   patientno = $(that).attr('data-pno');
    reason = $(that).attr('data-reason');
   diagnosis = $(that).attr('data-diagnosis');
    pres = $(that).attr('data-pres');

 
 
     $('#pno').val(patientno);
     $('#reason').val(reason);
     $('#diagnosis').val(diagnosis);
     $('#pres').val(pres);
     
 
 
 
 
 }
 
 
 function editReqMed(that){
   
   
   reqmedno= $(that).attr('data-reqmedno');
    bhw = $(that).attr('data-bhw');
    medname = $(that).attr('data-medname');
    medqty = $(that).attr('data-medqty');
   
    datereq = $(that).attr('data-datereq');
  
    medno= $(that).attr('data-medno');
 
    $('#editmedno').val(medno);
    $('#reqmedno').val(reqmedno);

      $('#reqmedname').val(medname);
      $('#reqqty').val(medqty);

      $('#bhwname').val(bhw);


    


           fname = $(that).attr('data-fname');
           mname = $(that).attr('data-mname');
           lname = $(that).attr('data-lname');
           suffix = $(that).attr('data-suffix');
         
         
        
             
             fullname=fname+'   '+mname+'   '+lname+'   '+suffix;
        
             $('#fullname').val(fullname);

             pres = $(that).attr('data-pres');

             username= $(that).attr('data-username');
             var str = pres;
    var n = str.includes("data:image");
    if(!n){
        pres = 'assets/uploads/'+username+'/prescription/'+pres;
    }
    $('#prescription').attr('src',pres);
  
  
  
  }


</script>

</body>
</html>

