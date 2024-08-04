<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];


	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age, COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  GROUP BY tbl_residents.h_no;";
                        $result = $conn->query($query);

    $ticket = array();
	while($row = $result->fetch_assoc()){
		$ticket[] = $row; 
	}



	$query1 = "SELECT * FROM `tbl_residents` WHERE `verify_status`='pending' AND bar_no=$barno";
    $result1 = $conn->query($query1);
	$pending = $result1->num_rows;


    $query2 = "SELECT * FROM `tbl_residents` WHERE `verify_status`='verified' AND bar_no=$barno";
    $result2 = $conn->query($query2);
	$verified = $result2->num_rows;


 


   


  

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Verify Residents -  WeABITS</title>
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
								<h2 class="text-white fw-bold">Population</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
				<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row mt--2">
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title"><i class="fa fa-search"></i>Verify Residents </div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="registrationtable" class="display table table-striped">
											<thead>
												<tr>
												<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												
												
                                             
                                                    
                                                    <th scope="col">HouseHold NO.</th>
                                                    <th scope="col">Street</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Total Members</th>
                                                    <th scope="col">Date & Time Visit</th>
                                             
                                                 

                                                  
                                          

												
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($ticket)): ?>
													<?php foreach($ticket as $row): ?>

													<tr>
                                                    <td>

                                                    <div class="form-button-action">
                                                        <a type="button" href="verify_details?registration=<?= ucwords($row['h_no']) ?>" class="btn btn-link btn-primary" title="View Details"  
                                                                    >
    


 


                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-eye"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
                                                                <a href="#send" data-toggle="modal"  class="btn btn-link btn-primary"  title="Schedule Visit Date" onclick="sendVisit(this)" 
                                                                    data-resid="<?= $row['res_id'] ?>"
                                                                    >  
                                                                        


 




                                                                    <?php if($row['verify_status']=='pending'): ?>
                                                                        <i class="fa fa-envelope"></i>
                                                                    <?php else: ?>
                                                                     
                                                                    <?php endif ?>
                                                                </a>
                                                                    </div>
                                                               
                                                            </td>
													
														
                                                                <td> <div  style="width:100px;"><?= $row['household_no'] ?></div></td>
                                                        <td> <div  style="width:100px;"><?= $row['streetname'] ?></div></td>
                                                        <td>
													
													
													
													        <?php if($row['verify_status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>
															<?php elseif($row['verify_status']=='verified'): ?>
																<span class="badge badge-success">Verified</span>
											
															
															<?php else: ?>
                                                               
															<?php endif ?>


															

  
															
														
														

														
															

															</td>
                                                            <td class='text-center fw-bold'> <div  style="width:100px;"><?= $row['members'] ?></div></td>
                                                   
                                                            <td class='text-center fw-bold'> <div  style="width:100px;">
                                                        
                                                            <?= $row['visit_date'] ?> <?= $row['visit_time'] ?>
                                                        </div></td>
                                                       
                                                       
													
													
													
													
                                                     
                                                     










                                                           
											


														
													</tr>


	



													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                              <?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												
												
                                             
                                                    
                                                    <th scope="col">HouseHold NO.</th>
                                                    <th scope="col">Street</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Total Members</th>
                                                    <th scope="col">Date & Time Visit</th>
                                                
                                                  
                                                
                                                
                                               
												
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-danger card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category"  style="position:relative; left:-38px;">Pending</p>
												<h4 class="card-title"><?= number_format($pending) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="pending" class="card-link text-light">Pending</a>
								</div>
							</div>
							<div class="card card-stats card-success card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-6 col-stats">
										</div>
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category"  style="position:relative; left:-40px;">Verified</p>
												<h4 class="card-title"><?= number_format($verified) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="verified" class="card-link text-light">Verified</a>
								</div>
							</div>
						

					



							
						</div>
					</div>
				</div>
			</div>


                                                    




			
            <!-- Modal -->
            <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Schedule Visit Appointment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="visitform" method="POST" >
                                <div class="form-group">
                                    <label>Date Visit</label>
                                    <input type="date" class="form-control" min="<?= date('Y-m-d')?>" placeholder="Enter Date Visit" name="datevisit" required>
                                </div>
                                <div class="form-group">
                                    <label>Time Visit</label>
                                    <input type="time" class="form-control" placeholder="Enter Time Visit" name="timevisit" required>
                                </div>
                                <div class="form-group">
                                <div id="notiferr" ></div>
                                <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span> 
                                </div>
                               
                            
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" class="form-control"  name="resid" id="resid" required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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

	<link rel="stylesheet" href="assets/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
	<script src="assets/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>




    <script>
        $(document).ready(function() {
            var oTable = $('#registrationtable').DataTable({
				"order": [[ 4, "asc" ]]


				
            });

			$(document).ready(function() {


				$('.search_select_box select').selectpicker();
            });

			$("#pending").click(function(){
				var textSelected = 'pending';
				oTable.columns(3).search(textSelected).draw();
			});
			$("#verified").click(function(){
				var textSelected = 'verified';
				oTable.columns(3).search(textSelected).draw();
			});
			$("#denied").click(function(){
				var textSelected = 'denied';
				oTable.columns(5).search(textSelected).draw();
			});


		
        });
    </script>



<script>


$(document).ready(function (e) {
  $("#visitform").on('submit',(function(e) {
   e.preventDefault();


  
   document.getElementById("loading").style.display = "block";
   $.ajax({
    url: "model/sendappointment.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success: function(data)
       { 
        document.getElementById("loading").style.display = "block";
       
        $('#notiferr').html(data);


        if($.trim(data)=="success"){
      

            document.getElementById("loading").style.display = "none";
            window.location.pathname = ('/verify')
        }
         
     
       },
       
     
     
               
     });
  }));
 }); 





</script>
</body>
</html>