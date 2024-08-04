<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];
	$query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblcedula` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblcedula.res_id WHERE tbl_residents.bar_no=$barno";
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
	<title>Cedula -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Community Tax Certificate</h2>
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
										<div class="card-title">CTC</div>
										<?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
										
											
                                            <a href="#add" data-toggle="modal" class="btn btn-primary btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
											  Cedula
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
								
												<th scope="col">Fullname</th>
												<th scope="col">CTC No.</th>
												
												<th scope="col">Amount</th>
												<!----
												<th scope="col">Cedula Image</th>---->
                                                <th scope="col">Date Issued</th>

                                                 
												
												
                                            
                                                 
                                                   
                                                 
                                            
                                                  
                                                    <th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
												
											
													
												
														<td>
														<div  style="width:250px;">
                                                          
                                                       
<?= $row['res_id'] ?> -  <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

													
															   
																  
											
															</div> 
                                                        </td>
														<td><?= $row['ctc_no'] ?></div></td>
														<td><div  style="width:100px;">	&#8369; <?= $row['amount'] ?>.00</div></td>
														
														<!------
														<td>
														<div  style="width:210px;">
                                                          
                                                       


														  <?php if(!empty($row['cedula_image'])): ?>
  
															<img src="<?= preg_match('/data:image/i', $row['cedula_image']) ?  $row['cedula_image'] : "assets/uploads/".$_SESSION['username']."/cedula/". $row['cedula_image'] ?>" alt="..." class="" width="70%" height='100' >

  <?php else: ?>
 
  <?php endif ?> 
															   
																  
											
															</div> 
                                                        </td>---->
														<td><div  style="width:100px;"><?= $row['date_issued'] ?></div></td>
                                                    
														
                                                      
                                                 
                                                       
                                                  


                                                  
														<td>
															<div class="form-button-action">

															<a type="button" href="#edit"  data-toggle="modal" class="btn btn-link btn-primary" title="Edit Document" onclick="editCedula(this)" 
															data-ctc_id="<?= $row['ctc_id']?>" data-ctcno="<?= $row['ctc_no']?>" data-amount="<?= $row['amount']?>"  data-date="<?= $row['date_issued']?>" 
															data-resid="<?= $row['res_id'] ?>" data-cedulaimage="<?= $row['cedula_image'] ?>" data-username="<?=$_SESSION['username'] ?>"  data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
															

																<a type="button" data-toggle="tooltip" href="model/remove_cedula.php?id=<?= $row['ctc_id'] ?>" onclick="return confirm('Are you sure you want to delete this Cedula?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</td>
													
                                                       
                                                      



														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
										
												<th scope="col">Fullname</th>
                                                <th scope="col">CTC No.</th>
											
												<th scope="col">Amount</th>
												<!----
												<th scope="col">Cedula Image</th>---->
                                                <th scope="col">Date Issued</th>
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
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Cedula</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_cedula.php" autocomplete="off" enctype="multipart/form-data">

						

						
                             

							
								
								

							


                                <div class="form-group">
                                    <label>Select Resident</label>


									<div class="search_select_box">
                                  
								      <select name="resid" class="form-control " id="resid" data-live-search="true">
									  <option selected="" disabled="">-- Select Resident -- </option>
									  <?php
									  $basiccommunitytax= $bct;
									  $amount=$addtax;
									  $monthly=$nomonth;
									  
										  $squery = mysqli_query($conn,"SELECT Format((`monthly_income`*$monthly/$amount+$basiccommunitytax),2) as monthly_income,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=18 AND tbl_residents.verify_status='verified'; ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['res_id'].'">RES ID:'.$row['res_id'].' | '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].' '.$row['suffix'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
							         	<div class="form-group">
                                    <label>CTC No.</label>
                                    <input type="number" class="form-control" placeholder="Enter CTC No." min="0" name="ctcno"  required>
                                </div>


									 <div class="form-group">
                                    <label>Amount(Peso)</label>
							 <input type="text"  class="form-control fw-bold" id="cedulatotal"  placeholder="Amount" name="amount"  required>
                                   
                                </div>

								<div class="form-group">
                                    <label>Cedula Image</label>
                                    <input type="file" class="form-control"  name="cedulaimage" accept="image/*" required>
                                </div>


									 <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control"  name="date" value="<?= date('Y-m-d') ?>" required>
                                </div>

						


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
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Cedula</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_cedula.php"  enctype="multipart/form-data">
						            
                 
						
						
							<div class="form-group">
                                    <label>Resident</label>
                                    <input type="text" id="fullname" readonly style="color:black" class="form-control fw-bold" placeholder="Enter CTC No."  required>
                             
								
							         </div>

							<div class="form-group">
                                    <label>CTC No.</label>
                                    <input type="number" class="form-control" placeholder="Enter CTC No." id="ctcno" name="ctcno" required>
                                </div>

								
								

							


                              
							

									 <div class="form-group">
                                    <label>Amount</label>
									
                                    <input type="number" class="form-control" id="amount" placeholder="Amount" name="amount" min="0" value="" required>
                                </div>
								<div class="form-group">
								<label>Current Cedula Image</label><br>
									<img src="assets/img/uploadimage.png" class="img-fluid" width="100%" style="border-radius:10px;"  id="cedulapic" ><br>
                                    <label>Change Cedula to:</label>
                                    <input type="file" class="form-control mt-1"  name="cedulaimage" accept="image/*" >
                                </div>

									 <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control" id="date"  name="date" value="" required>
                                </div>

                        </div>
                        <div class="modal-footer">
						<input type="number" class="form-control"  name="ctcid" value="" id="ctcid" hidden  required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
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
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <script>
    
    
    
    
$('#resid').change(function(){


var resid=$("#resid").val();

$.ajax({
type: 'POST',
url: 'model/cedula_amount.php',
data: { resid: resid, },
success: function(response) {

$('#cedulatotal').val(response);

}

});

});
    
    
    
    
    
        $(document).ready(function() {
            $('#residenttable').DataTable();

			$('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>