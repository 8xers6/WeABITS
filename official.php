<?php include 'server/server.php' ?>
<?php 

$barno=$_SESSION['bar_no'];

	if(isset($_SESSION['role'])){
  
		if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'){
          
			$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials  LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE  tblofficials.bar_no=$barno  ";
		}else{
			$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE  bar_no=$barno ";
		}
	}else{
		$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials  LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE bar_no=$barno  ";
	}
	
	$res_o = $conn->query($off_q);

	$official = array();
	while($row = $res_o->fetch_assoc()){
		$official[] = $row; 
	}
    



    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Brgy Officials and Staff -  Barangay Management System</title>
</head>
<body>
	<?php //include 'templates/loading_screen.php' ?>

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
								<h2 class="text-white fw-bold">Barangay Officials</h2>
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
						
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex flex-wrap pb-2 justify-content-center">
										
									
										<div class="col text-center">
                                       
                                        <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?=$brgylogo ?>" class=" rounded-circle" height="300" width="300" >
                                        <h2 class="fw-bold ">Brgy. <?= ucwords($barangayname)  ?>, <?= ucwords($city) ?>, <?= ucwords($province) ?>   </h2>
										</div>
										
									</div>
								</div>
							</div>
							

                                 

                          <!-----start card--->

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Current Barangay Officials</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
                                            <?php if($_SESSION['role']=='administrator'):?>
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm fw-bold">
													<i class="fa fa-plus"></i>
													Official
												</a>
                                                <?php endif?>
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
                                        <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($official)): ?>
                                            <?php $no=1; foreach($official as $row): ?>
                                                
        
        
                                              <div class="row-md-5 m-1  mb-3 border  rounded shadow " style="width:300px;">
        
                                             
                                                  
        
                                                  <div class="row-md-10 ">
                                                    
                                               
                                                 

                                                            <div class="row  justify-content-center p-4  ml-0  mr-0   rounded bg-primary-gradient">


                                                            
                                                            <?php if(!empty($row['picture'])): ?>

<img src="<?= preg_match('/data:image/i', $row['picture']) ?  $row['picture'] : 'assets/uploads/'.$_SESSION['username'].'/official/'. $row['picture'] ?>" alt="..." class="avatar-img rounded "  style="position: relative; top:40px; width:180px; height:180px; border-radius:0px;">
<?php else: ?>
<img src="assets/img/person.png" alt="..." class="avatar-img rounded " style="position: relative; top:40px; width:180px; height:180px; ">
<?php endif ?> </td>

                                                            
                                                                               

                                                                                    </div>
                                                                                    <div class="row justify-content-center mt-3">


                                                                                    <h3><b><?= $row['name'] ?></b></h3>


                                                                                    </div>

                                                                                    <div class="row  justify-content-center ">


                                                            
                                                                                    <h4><?= $row['position'] ?></h4>

                                                                                    </div>
             
                                                
                                                 
         

           
                                                    
                                            
                                                                      
                                                                  
        
                                                  </div>


                                                  <div class="row justify-content-center ">

                                               
                                                  <div class="col-5 justify-content-center mb-3 ml-3 ">


                                                                    <b>Status:</b>                                                                                                                            
                                                                       <b><?= $row['status']=='Active' ? '<span class="badge badge-success">Active</span>' :'<span class="badge badge-danger">Inactive</span>' ?>
                                                                    </b>
                                                            </div>
                                                          
                                                            <?php if($_SESSION['role']=='administrator'):?>

                                                                <div class="col-3 mb-3">
                                                              

                                                                                                                                                                                                                                                                                
                                                                                    
                                                                              
                                                                        <a type="button" href="#edit" data-toggle="modal" class="btn   btn-primary" 
																		title="Edit Position" onclick="editOfficial(this)" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>" 
																		data-chair="<?= $row['chair_id'] ?>" data-pos="<?= $row['position'] ?>" data-start="<?= $row['termstart'] ?>" 
																		data-end="<?= $row['termend'] ?>" data-status="<?= $row['status'] ?>"  data-official="<?= $row['picture'] ?>"
                                                                        >
                                                                        <b>View</b>
																	</a>

                                                                    


                                                                

                                                                                    </div>


                                                                                    <div class="col-3 ">
                                                                                  
																	<a type="button" data-toggle="tooltip" href="model/remove_official.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this official?');" class="btn text-danger fw-bold " data-original-title="Remove">
																		<i class="fa fa-times "></i>
																	</a>
																
                                                                                            </div>
                                                                                            <?php endif ?>
                                                                        

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


                 <!--end card-->



					
					</div>
				</div>
			</div>
			
			 <!-- Modal -->
			 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Official</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_official.php"  enctype="multipart/form-data"  >
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" placeholder="Enter Fullname" name="name" required>
                                </div>
								<div class="form-group">
                                    <label>Chairmanship</label>
                                    <select class="form-control" id="pillSelect" name="chair" >
                                        <option disabled selected value="">Select Official Chairmanship</option>
                                        <?php foreach($chair as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
										<?php endforeach ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control" id="pillSelect"  name="position" required>
                                        <option disabled selected value="">Select Official Position</option>
                                        
                                        <option value="Captain">Captain</option>
                                        <option value="Councilor 1">Councilor 1</option>
                                        <option value="Councilor 2">Councilor 2</option>
                                        <option value="Councilor 3">Councilor 3</option>
                                        <option value="Councilor 4">Councilor 4</option>
                                        <option value="Councilor 5">Councilor 5</option>
                                        <option value="Councilor 6">Councilor 6</option>
                                        <option value="Councilor 7">Councilor 7</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Treasurer">Treasurer</option>
                                        
										
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Term Start</label>
                                    <input type="date" class="form-control" name="start" required>
                                </div>
								<div class="form-group">
                                    <label>Term End</label>
                                    <input type="date" class="form-control" name="end" required>
                                </div>
								<div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="pillSelect" required name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <h4 style="text-align:center;">Add Profile Picture</h4>
                                        <input type="file" class="form-control" name="img" accept="image/*" required>
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="pos_id" name="id">
                           
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_official.php" enctype="multipart/form-data">

                           
                                <div class="form-group">
                               
                                    <label>Fullname</label>
                                   
                                    <input type="text" class="form-control" id="name" placeholder="Enter Fullname" name="name" required>
                                </div>
								<div class="form-group">
                                    <label>Chairmanship</label>
                                    <select class="form-control" id="chair"  name="chair">
                                        <option disabled selected>Select Official Chairmanship</option>
                                        <?php foreach($chair as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
										<?php endforeach ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control" id="position" required name="position">
                                        <option disabled selected>Select Official Position</option>
                                        <option value="Captain">Captain</option>
                                        <option value="Councilor 1">Councilor 1</option>
                                        <option value="Councilor 2">Councilor 2</option>
                                        <option value="Councilor 3">Councilor 3</option>
                                        <option value="Councilor 4">Councilor 4</option>
                                        <option value="Councilor 5">Councilor 5</option>
                                        <option value="Councilor 6">Councilor 6</option>
                                        <option value="Councilor 7">Councilor 7</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Treasurer">Treasurer</option>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Term Start</label>
                                    <input type="date" class="form-control" id="start" name="start" required>
                                </div>
								<div class="form-group">
                                    <label>Term End</label>
                                    <input type="date" class="form-control" id="end" name="end" required>
                                </div>
								<div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" required name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <h4 style="text-align:center;">Change Profile Picture</h4>
                                        
                                  
                                     
                                        <input type="file" class="form-control" name="img" accept="image/*" >
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="off_id" name="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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