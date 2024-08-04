<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];


	$query = "SELECT * FROM `tblregistration` WHERE `bar_no`=$barno";
                        $result = $conn->query($query);

    $ticket = array();
	while($row = $result->fetch_assoc()){
		$ticket[] = $row; 
	}



	$query1 = "SELECT * FROM `tblregistration` WHERE  status='pending' AND `bar_no`=$barno";
    $result1 = $conn->query($query1);
	$pending = $result1->num_rows;


    $query2 = "SELECT * FROM `tblregistration` WHERE  status='norecord' AND `bar_no`=$barno";
    $result2 = $conn->query($query2);
	$norecord = $result2->num_rows;


    $query2a = "SELECT * FROM `tblregistration` WHERE  status='verification' AND `bar_no`=$barno";
    $result2a= $conn->query($query2a);
	$verification = $result2a->num_rows;

  $query3 = "SELECT * FROM `tblregistration` WHERE  status='completed' AND `bar_no`=$barno";
    $result3 = $conn->query($query3);
	$completed = $result3->num_rows;

 


   


  

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Create Account for Existing Record -  WeABITS</title>
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
										<div class="card-title">  <i class="fas fa-user-edit"></i> Create Account for Residents </div>
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
											
												
												
                                             
                                                    
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Status</th>
                                            	<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>

                                                  
                                          

												
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($ticket)): ?>
													<?php foreach($ticket as $row): ?>

													<tr>
                                                  
													
														
                                                                <td> <div  style="width:100px;"><?= $row['lastname'] ?>, <?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['suffix'] ?></div></td>
                                                                
                                                                
                                                                <td><?= $row['email'] ?> </td>
                                                       
                                                        <td>
													
													
													
													        <?php if($row['status']=='pending'): ?>
																<span class="badge badge-danger">Pending</span>
															<?php elseif($row['status']=='norecord'): ?>
																<span class="badge badge-warning">No existing record</span>
																
																	<?php elseif($row['status']=='verification'): ?>
																<span class="badge badge-success">For Verification</span>
											
																<?php elseif($row['status']=='completed'): ?>
																<span class="badge badge-primary">Completed</span>
															<?php else: ?>
                                                               
															<?php endif ?>


															

  
															
														
												
															

															</td>
                                                          
                                                       
                                                       
													
													
													
													
                                                       <td>

                                                    <div class="form-button-action">
                                                          
                                                          
                                                          
                                                          <?php if($row['status']=='pending'): ?>
                                                               <a type="button" href="#createaccount" data-toggle="modal" class="badge  badge-primary fw-bold mr-3" title="Verify Record" 
                                                               
                                                               onclick="editReg(this)" 
                                                         data-regid="<?= $row['reg_id'] ?>" data-username="<?=$_SESSION['username'] ?>"  data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"   data-suffix="<?= $row['suffix'] ?>" 
                                                         
                                                         data-emailadd="<?= $row['email'] ?>"
                                                         
                                                         data-idimage="<?= $row['id_image'] ?>"
                                                         data-bill="<?= $row['billing_image'] ?>"
                                                     
                                                         >
                                                                  Create Account
                                                                </a>
                                                                 
                                                                 
                                                                 
                                                                 <a type="button" data-toggle="modal" href="#editstatus" class=" btn-link btn-primary" 
                                                                      onclick="editRegStatus(this)" 
                                                                 data-original-title="Change Status"
                                                                 data-emailadd="<?= $row['email'] ?>"
                                                              data-regid="<?= $row['reg_id'] ?>"
                                                                 >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                
                                                                <?php elseif($row['status']=='completed'): ?>
                                                                  <a type="button" href="#view" data-toggle="modal" class="badge  badge-primary fw-bold" title="View Record" 
                                                               
                                                               onclick="editRegView(this)" 
                                                         data-regid="<?= $row['reg_id'] ?>" data-username="<?=$_SESSION['username'] ?>"  data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"   data-suffix="<?= $row['suffix'] ?>" 
                                                         
                                                         data-emailadd="<?= $row['email'] ?>"
                                                         
                                                         data-idimage="<?= $row['id_image'] ?>"
                                                         data-bill="<?= $row['billing_image'] ?>"
                                                     
                                                         >
                                                                  View
                                                                </a>
                                                                
                                                                    <a type="button" data-toggle="modal" href="#editstatus" class=" btn-link btn-primary ml-3" 
                                                                      onclick="editRegStatus(this)" 
                                                                 data-original-title="Change Status"
                                                                 data-emailadd="<?= $row['email'] ?>"
                                                              data-regid="<?= $row['reg_id'] ?>"
                                                                 >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                
                                                                  <?php elseif($row['status']=='norecord'): ?>
                                                                
                                                                  <a type="button" href="#view" data-toggle="modal" class="badge  badge-primary fw-bold" title="View Record" 
                                                               
                                                               onclick="editRegView(this)" 
                                                         data-regid="<?= $row['reg_id'] ?>" data-username="<?=$_SESSION['username'] ?>"  data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"   data-suffix="<?= $row['suffix'] ?>" 
                                                         
                                                         data-emailadd="<?= $row['email'] ?>"
                                                         
                                                         data-idimage="<?= $row['id_image'] ?>"
                                                         data-bill="<?= $row['billing_image'] ?>"
                                                     
                                                         >
                                                                  View
                                                                </a>
                                                                
                                                                 <a type="button" data-toggle="modal" href="#editstatus" class=" btn-link btn-primary ml-3" 
                                                                      onclick="editRegStatus(this)" 
                                                                 data-original-title="Change Status"
                                                                 data-emailadd="<?= $row['email'] ?>"
                                                              data-regid="<?= $row['reg_id'] ?>"
                                                                 >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                
                                                                 <?php elseif($row['status']=='verification'): ?>
                                                                 
                                                                   <a type="button" href="#view" data-toggle="modal" class="badge  badge-primary fw-bold" title="View Record" 
                                                               
                                                               onclick="editRegView(this)" 
                                                         data-regid="<?= $row['reg_id'] ?>" data-username="<?=$_SESSION['username'] ?>"  data-fname="<?= $row['firstname'] ?>"   data-mname="<?= $row['middlename'] ?>"   data-lname="<?= $row['lastname'] ?>"   data-suffix="<?= $row['suffix'] ?>" 
                                                         
                                                         data-emailadd="<?= $row['email'] ?>"
                                                         
                                                         data-idimage="<?= $row['id_image'] ?>"
                                                         data-bill="<?= $row['billing_image'] ?>"
                                                     
                                                         >
                                                                  View
                                                                </a>
                                                                
                                                          <?php endif ?>

 



                                                                    </div>
                                                               
                                                            </td>
                                                     










                                                           
											


														
													</tr>


	



													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                              <th scope="col">Full Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Status</th>
                                            	<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
                                                
                                                  
                                                
                                                
                                               
												
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
							
							
							
							<div class="card card-stats card-warning card-round">
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
												<p class="card-category"  style="position:relative; left:-40px;">No Existing Record</p>
												<h4 class="card-title"><?= number_format($norecord) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="norecord" class="card-link text-light">No Existing Record</a>
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
												<p class="card-category"  style="position:relative; left:-40px;">For Verification</p>
												<h4 class="card-title"><?= number_format($verification) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="verification" class="card-link text-light">For Verification</a>
								</div>
							</div>
							
							
							<div class="card card-stats card-primary card-round">
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
												<p class="card-category"  style="position:relative; left:-40px;">Completed</p>
												<h4 class="card-title"><?= number_format($completed) ?></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="javascript:void(0)" id="verified" class="card-link text-light">Completed</a>
								</div>
							</div>
						

					



							
						</div>
					</div>
				</div>
	
           
   <!-- Modal -->
            <div class="modal fade" id="editstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="statusform"  >
                                
                                
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="emails" class="form-control fw-bold" style="color:black;" readonly name="email"  >
                                </div>
                                
                                <div class="form-group">
                                    <label>Status</label>
                                   <select  name="status" class="form-control" required >
                                         <option value="" disabled selected>--Select Status--</option>
                                       <option value="norecord">No existing record</option>
                                       <option value="cancel">Cancel Registration</option>
                                       
                                       
                                   </select>
                                </div>
                           
                            
                        </div>
                        <div class="modal-footer justify-content-center">
                            <input type="hidden" id="regids" name="regid"  >
                            
                            
                            
                            
                             <div id="notiferrs" ></div>
                         <span role="alert" id="loadings" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>  
                            <button type="submit" class="btn btn-primary" id="statusbtn" onclick="return confirm('Are you sure you want to proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



			
          
                    <!-- Modal -->
<div class="modal fade" id="createaccount" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Verify Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create_form" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Full Name</label>
                                     <input type="hidden" class="form-control fw-bold " name="regid" readonly style="color:black;" id="regid" required>
                                    <input type="text" class="form-control fw-bold " readonly style="color:black;" id="fullname" required>
                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Email Address</label>
                                            <input type="text" class="form-control fw-bold" readonly style="color:black;"  name="email" id="emailadd" required>
                                </div>
                                
                                
                                   <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Valid ID</label>
	<img src="assets/img/uploadimage.png" class="img-fluid" width="100%" style="border-radius:10px;"  id="validid" ><br>
                                </div>
        <div class="form-group  border rounded shadow-sm mb-2">
                                    <label>Billing Address</label> 
                                    	<img src="assets/img/uploadimage.png" class="" width="100%"  height="300"  style="border-radius:10px;"  id="bill" ><br>
                                
                                </div>
                                
                          
                               
                        </div>
                        <div class="col-md-6">
                            
                            
                            
                             <label>Search from Existing Record:</label>
                                 <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Street</label>
                          	<div class="search_select_box">
                                  
								      <select  class="form-control " id="streetid" data-live-search="true" required>
									  <option selected disabled value="">-- Choose Street -- </option>
									  <?php
								
									       
										  $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno; ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                               </div>
                            
                            
                            
                            
                             <div id="houseno"></div>
                             
                             
                              <div id="member"></div>
                              
                               <div id="residentinfo"></div>
                            
                                
                                
                                
                               
                              
                          
                                  
							
                       
                   
            


                            
                           



                           
                        </div>

                      


                    </div>
                   
                   
                    
                    
                   
                  
            </div>
            <div class="modal-footer justify-content-center">
                            <div id="notiferr" ></div>
                         <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>  
                            <button type="submit" class="btn btn-primary fw-bold"  id="acceptbtn" onclick="return confirm('Are you sure you want to proceed?');">Submit</button>
                        </div>
            </form>
        </div>
    </div>
</div>




                    <!-- Modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">View Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create_form" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Full Name</label>
                                     <input type="hidden" class="form-control fw-bold " name="regid" readonly style="color:black;" id="regidv" required>
                                    <input type="text" class="form-control fw-bold " readonly style="color:black;" id="fullnamev" required>
                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Email Address</label>
                                            <input type="text" class="form-control fw-bold" readonly style="color:black;"  name="email" id="emailaddv" required>
                                </div>
                                
                                
                                   <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Valid ID</label>
	<img src="assets/img/uploadimage.png" class="img-fluid" width="100%" style="border-radius:10px;"  id="valididv" ><br>
                                </div>
        <div class="form-group  border rounded shadow-sm mb-2">
                                    <label>Billing Address</label> 
                                    	<img src="assets/img/uploadimage.png" class="" width="100%"  height="300"  style="border-radius:10px;"  id="billv" ><br>
                                
                                </div>
                                
                          
                               
                        </div>
                     
                            
                           
                            
                                
                                
                                
                               
                              
                          
                                  
							
                       
                   
            


                            
                           



                           
                        </div>

                      


                    </div>
                   
                   
                    
                    
                   
                  
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


<script>
    
    
      $(document).ready(function() {
           
			$('.search_select_box select').selectpicker();
        });
</script>




  <script>
  
  
  
     function editRegStatus(that){

 email= $(that).attr('data-emailadd');
    regid = $(that).attr('data-regid');
   
   
   
    $('#regids').val(regid);
     $('#emails').val(email);
     
     
}
      
      
         function editReg(that){

 email= $(that).attr('data-emailadd');
    regid = $(that).attr('data-regid');
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
  
   
     
     fullname= lname+', '+fname+' '+mname;

    $('#regid').val(regid);
    $('#fullname').val(fullname);
     $('#emailadd').val(email);
     
        idimage = $(that).attr('data-idimage');
      
       bill = $(that).attr('data-bill');
   
   
     uname = $(that).attr('data-username');
  
     validid='assets/uploads/'+uname+'/validation/'+email+'/'+idimage;

  bill='assets/uploads/'+uname+'/validation/'+email+'/'+bill;



  $('#validid').attr('src', validid);
  
  
    $('#bill').attr('src', bill);
}




    function editRegView(that){

 email= $(that).attr('data-emailadd');
    regid = $(that).attr('data-regid');
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
  
   
     
     fullname= lname+', '+fname+' '+mname;

    $('#regidv').val(regid);
    $('#fullnamev').val(fullname);
     $('#emailaddv').val(email);
     
        idimage = $(that).attr('data-idimage');
      
       bill = $(that).attr('data-bill');
   
   
     uname = $(that).attr('data-username');
  
     validid='assets/uploads/'+uname+'/validation/'+email+'/'+idimage;

  bill='assets/uploads/'+uname+'/validation/'+email+'/'+bill;



  $('#valididv').attr('src', validid);
  
  
    $('#billv').attr('src', bill);
}
  </script>

    <script>
    
    
    
    $(document).ready(function (e) {
  $("#create_form").on('submit',(function(e) {
   e.preventDefault();


   
   document.getElementById("acceptbtn").style.display = "none";
  
  
   document.getElementById("loading").style.display = "block";
   $.ajax({
    url: "model/createacc.php",
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
     
        if($.trim(data)=="isempty"){
           
   
   document.getElementById("accept").style.display = "block";
           
    
            document.getElementById("loading").style.display = "none";


        }else{


            if($.trim(data)=="success"){
                document.getElementById("loading").style.display = "none";
                window.location.pathname = ('/createaccount')
        //$('#errwarning').html(data);
        
        //$('#notiferr').html(' <b  class="border p-2 rounded border-success fw-bold pl-5 pr-5" style="color:green; letter-spacing:3px;">VERIFIED <b class="bg-success text-white rounded-circle  pl-1 pr-0">&#10003</b></b>');
  

     
  
      }else{
         
       // $('#notiferr').html('<b style="color:green; font-size:14px;">Verified Success!</b>');
         
      }
        }



    
         
     
       },
       
     
     
               
     });
  }));
  
  
  
  
  
  
  
  
    $("#statusform").on('submit',(function(e) {
   e.preventDefault();


   
   document.getElementById("statusbtn").style.display = "none";
  
  
   document.getElementById("loadings").style.display = "block";
   $.ajax({
    url: "model/changestatus.php",
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
        document.getElementById("loadings").style.display = "block";
       
        $('#notiferr').html(data);
     
        if($.trim(data)=="isempty"){
           
   
   
           
    
            document.getElementById("loadings").style.display = "none";


        }else{


            if($.trim(data)=="success"){
                document.getElementById("loading").style.display = "none";
                window.location.pathname = ('/createaccount')
        //$('#errwarning').html(data);
        
        //$('#notiferr').html(' <b  class="border p-2 rounded border-success fw-bold pl-5 pr-5" style="color:green; letter-spacing:3px;">VERIFIED <b class="bg-success text-white rounded-circle  pl-1 pr-0">&#10003</b></b>');
  

     
  
      }else{
         
       // $('#notiferr').html('<b style="color:green; font-size:14px;">Verified Success!</b>');
         
      }
        }



    
         
     
       },
       
     
     
               
     });
  }));
  
  
  
  
 }); 
 
    
    
    
    
    
    
    
    
    
    
    
    
        $(document).ready(function() {
            var oTable = $('#registrationtable').DataTable({
				"order": [[ 1, "asc" ]]


				
            });
            
           
            
            
            

	

			$("#pending").click(function(){
				var textSelected = 'pending';
				oTable.columns(2).search(textSelected).draw();
			});
			$("#norecord").click(function(){
				var textSelected = 'No existing record';
				oTable.columns(2).search(textSelected).draw();
			});
			
			$("#verification").click(function(){
				var textSelected = 'For Verification';
				oTable.columns(2).search(textSelected).draw();
			});
			
				$("#completed").click(function(){
				var textSelected = 'Completed';
				oTable.columns(2).search(textSelected).draw();
			});
	


		
        });
    </script>
    
    
    
    
    <script>
        
        
        
        $('#streetid').change(function(){


var street=$("#streetid").val();

$.ajax({
type: 'POST',
url: 'model/selecthouseno.php',
data: { street: street, },
success: function(response) {
$('#houseno').html(response);

$('#member').html('');
$('#residentinfo').html('');

}

});

});



  




    </script>

</body>
</html>