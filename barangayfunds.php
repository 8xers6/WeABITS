<?php include 'server/server.php' ?>
<?php

$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM `tblproject` Where bar_no=$barno";
    $result = $conn->query($query);

    $project = array();
	while($row = $result->fetch_assoc()){
		$project[] = $row; 
	}




    $barno=$_SESSION['bar_no'];
    $query1 = "SELECT * FROM `tblfunds` WHERE bar_no=$barno";
    $result1 = $conn->query($query1);
    $funds = $result1->fetch_assoc();

    $query2 = "SELECT SUM(budget) as totalamount FROM `tblproject` Where bar_no=$barno AND fund_by='Barangay'";
    $result2 = $conn->query($query2);
    $totalamount = $result2->fetch_assoc();


     $remaining_funds= $funds['Funds']-$totalamount['totalamount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Funds and Expenses -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Barangay Funds</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                        
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Barangay Funds</div>
										<div class="card-tools">
											<a href="#editfund" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-edit"></i>
												Edit Funds
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                          
                                <div class="row  pl-2 pr-2 pt-1 pb-3  bg-whiterounded justify-content-center">
<div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Original Funds</label> 
                                   <?php if(!empty($funds['Funds'])):?>
                               <h1 class="ml-5">&#8369 <?= number_format($funds['Funds'],2)?></h1> 
                                   <?php else: ?>
                                    <h1 class="ml-5">No funds </h1> 

                                    <?php endif ?>
                               </div>


                               <div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Remaining Funds</label>
                               <h1 class="ml-5">&#8369 <?= number_format($remaining_funds,2)?></h1> 
     
                               </div>
                               <div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Date Approved</label>

                               <?php if(!empty($funds['date_approved'])):?>
                                <h1 class="ml-5"> <?php $str = $funds['date_approved']; $date = date('F j, Y', strtotime($str)); echo $date; ?></h1>
                                   <?php else: ?>
                                    <h1 class="ml-5">No data available </h1> 

                                    <?php endif ?>
                             
                               </div>
                               <div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               <label>Date Received</label>
                               <?php if(!empty($funds['date_received'])):?>
                                <h1 class="ml-5"> <?php $str = $funds['date_received']; $date = date('F j, Y', strtotime($str)); echo $date; ?></h1>
                                   <?php else: ?>
                                    <h1 class="ml-5">No data available </h1> 

                                    <?php endif ?>
                            </div>

                                 
								</div>
							</div>


                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card ">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Funds</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Add Project
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="expensestable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Project No</th>
                                                    <th scope="col">Project Name</th>
                                                    <th scope="col">Funded By</th>
                                                    <th scope="col">Sponsor Name</th>
                                                    <th scope="col">Approved Date</th>
                                                    <th scope="col">End Date</th>
                                                    <th scope="col">Project Status</th>
                                                    <th scope="col">Budget</th>
                                                    <th scope="col">Project Description</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($project)): ?>
                                                    <?php $no=1; foreach($project as $row): ?>
                                                    <tr>
                                                        <td><?= $row['proj_no'] ?></td>
                                                        <td><?= $row['project_name'] ?></td>
                                                        <td><?= $row['fund_by'] ?></td>
                                                        <td><?= $row['sponsor_name'] ?></td>
                                                        <td><?= $row['approved_date'] ?></td>
                                                        <td><?= $row['end_date'] ?></td>
                                                        <td><?= $row['project_status'] ?></td>
                                                        <td><b>&#8369</b><?=  number_format($row['budget'],2)?></td>
                                                        <td><?= $row['proj_description'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Project" onclick="editProject(this)" 
                                                                    data-projno="<?= $row['proj_no'] ?>" data-projectname="<?= $row['project_name'] ?>" data-fundby="<?= $row['fund_by'] ?>"
                                                                    data-budget="<?= $row['budget'] ?>" data-approveddate="<?= $row['approved_date'] ?>"
                                                                    data-enddate="<?= $row['end_date'] ?>" data-projstatus="<?= $row['project_status'] ?>"
                                                                    data-projectdes="<?= $row['proj_description'] ?>" 
                                                                    data-sponsorname="<?= $row['sponsor_name'] ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_project.php?projno=<?= $row['proj_no'] ?>" onclick="return confirm('Are you sure you want to delete this project?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Project No</th>
                                                    <th scope="col">Project Name</th>
                                                    <th scope="col">Funded By</th>
                                                    <th scope="col">Sponsor Name</th>
                                                    <th scope="col">Approved Date</th>
                                                    <th scope="col">End Date</th>
                                                    <th scope="col">Project Status</th>
                                                    <th scope="col">Budget</th>
                                                    <th scope="col">Project Description</th>
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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="projectform"  enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Funded By</label>
                                    <select class="form-control" onchange="fundedby(this);"  required name="fundby">
                                    <option disabled selected value="">--Select Funded By---</option>
                                        <option value="Sponsored">Sponsored</option>
                                        <option value="Barangay">Barangay</option>
                                    </select>
                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm" id="sponsorname" style="display:none;">
                                <div id="sempty"></div>
                                    <label>Sponsor Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Sponsor Name"  name="sponsorname" >
                                </div>
                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Project Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Project Name"  name="projname"  required>
                                </div>
                                <div class="form-group  border rounded  shadow-sm mb-2">
                                    <label>Budget</label>
                                            <input type="number" class="form-control" placeholder="Enter Budget" min="1"   name="budget" required>



                                            <input type="hidden" class="form-control"  value="<?= $remaining_funds ?>"  name="remainingfund" required>
                                </div>
                             
                        </div>
                        <div class="col-md-6">
                        <div class="form-group border rounded mb-2 shadow-sm">
                                    <label>Approved Date</label>
                                    <input type="date" class="form-control"  name="approveddate"  required>
                                </div>
                                <div class="form-group border rounded mb-2 shadow-sm">
                                    <label>End Date</label>
                                    <input type="date" class="form-control"  name="enddate"  required>
                                </div>
                     

              <div class="form-group  border rounded shadow-sm mb-2">
                                    <label>Project Status</label>
                                    <select class="form-control"  required name="projstatus" required>
                                    <option disabled selected value="">--Select Project Status---</option>
                                        <option value="Pending">Pending</option>
                                        <option value="On-going">On-going</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>


                            


                                <div class="form-group  border rounded  shadow-sm mb-2">
                                    <label>Project Description</label>
                                            <textarea type="number" class="form-control" placeholder="Enter Description"    name="projdescription" required></textarea>
                                </div>

                            



                           
                        </div>

                      


                    </div>
                   
                   
                    
                    
                   
                  
            </div>
            <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary fw-bold  " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary fw-bold" onclick="return confirm('Are you sure you want to Add this project?');">Add</button>
                        </div>
            </form>
        </div>
    </div>
</div>





                          <!-- Modal -->
                          <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="projectformedit"  enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                        <label>Funded By</label>
                        <input type="text" class="form-control fw-bold" placeholder="Enter Sponsor Name" name="currentfundby" style="color:black;" readonly  id="fundby" >
                        <label>Sponsor Name</label>
                                            <input type="text" class="form-control fw-bold" placeholder="Enter Sponsor Name" style="color:black;" readonly  id="spname" >
                        <label>Change Funded By to:</label>
                                    <select class="form-control" onchange="fundedbyedit(this);"  name="fundby">
                                    <option disabled selected value="">--Select Funded By---</option>
                                        <option value="Sponsored">Sponsored</option>
                                        <option value="Barangay">Barangay</option>
                                    </select>

                                    <input type="hidden" class="form-control"   name="projno" id="projno" required>

                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm" id="sponsoredit" style="display:none;">
                                <div id="semptyedit"></div>
                                    <label>Sponsor Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Sponsor Name"  name="sponsorname" >
                                </div>
                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Project Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Project Name"  name="projname"  id="projectname" required>
                                </div>
                                <div class="form-group  border rounded  shadow-sm mb-2">
                                    <label>Budget</label>
                                            <input type="number" class="form-control" placeholder="Enter Budget" min="1"   name="budget" id="budget" required>



                                            <input type="hidden" class="form-control"  value="<?= $remaining_funds ?>"  name="remainingfund" required>
                                </div>
                             
                        </div>
                        <div class="col-md-6">
                        <div class="form-group border rounded mb-2 shadow-sm">
                                    <label>Approved Date</label>
                                    <input type="date" class="form-control"  name="approveddate" id="approveddate" required>
                                </div>
                                <div class="form-group border rounded mb-2 shadow-sm">
                                    <label>End Date</label>
                                    <input type="date" class="form-control"  name="enddate" id="enddate" required>
                                </div>
                     

              <div class="form-group  border rounded shadow-sm mb-2">
                                    <label>Project Status</label>
                                    <select class="form-control"  required name="projstatus" id="projstatus" required>
                                    <option disabled selected value="">--Select Project Status---</option>
                                        <option value="Pending">Pending</option>
                                        <option value="On-going">On-going</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>


                            


                                <div class="form-group  border rounded  shadow-sm mb-2">
                                    <label>Project Description</label>
                                            <textarea type="number" class="form-control" id="projectdes"     placeholder="Enter Description"    name="projdescription" required></textarea>
                                </div>

                            



                           
                        </div>

                      


                    </div>
                   
                   
                    
                    
                   
                  
            </div>
            <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary fw-bold  " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary fw-bold" onclick="return confirm('Are you sure you want to edit this project?');">Save Changes</button>
                        </div>
            </form>
        </div>
    </div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="editfund" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Barangay Funds</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/editbarangayfunds.php" >
                                <div class="form-group">
                                    <label>Original Funds</label>
                                    <input type="hidden" class="form-control"   name="fundno" value="<?= $funds['fund_no'] ?>" required>
                                    <input type="text" class="form-control"  placeholder="Enter Funds" name="funds" value="<?php if(!empty($funds['Funds'])){ echo $funds['Funds']; }else{}?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Approved</label>
                                    <input type="date" class="form-control"   name="dateapproved" value="<?php if(!empty($funds['date_approved'])){ echo $funds['date_approved']; }else{}?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Date Received</label>
                                    <input type="date" class="form-control"   name="datereceived"value="<?php if(!empty($funds['date_received'])){ echo $funds['date_received']; }else{}?>"required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="text" id="st_id" name="stid" hidden >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Update Funds ?');">Save Changes</button>
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
            $('#expensestable').DataTable();
        });



        function fundedby(that){



    if (that.value == "Sponsored") 
      {
          document.getElementById("sponsorname").style.display = "block";
      }
      else
      {
          document.getElementById("sponsorname").style.display = "none";
      }
        }

        function fundedbyedit(that){



if (that.value == "Sponsored") 
  {
      document.getElementById("sponsoredit").style.display = "block";
  }
  else
  {
      document.getElementById("sponsoredit").style.display = "none";
  }
    }


        $("#projectform").on('submit',(function(e) {
   e.preventDefault();
 

   $.ajax({
          url: "model/addproject.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success:  function(data)
       { 
      
       
        //$('#sempty').html(data);

        if($.trim(data)=='empty'){

          
            $('#sempty').html('<b style="color:red;">Sponsor name is empty!</b>');
        }else{


            window.location.pathname = ('/barangayfunds.php')                   
              
        }
	
    
         
     
       },
       
     
     
               
     });
  }));

  $("#projectformedit").on('submit',(function(e) {
   e.preventDefault();
 

   $.ajax({
          url: "model/edit_project.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success:  function(data)
       { 
      
       
        //$('#sempty').html(data);

        if($.trim(data)=='empty'){

          
            $('#semptyedit').html('<b style="color:red;">Sponsor name is empty!</b>');
        }else{


            window.location.pathname = ('barangayfunds.php')                   
              
        }
	
    
         
     
       },
       
     
     
               
     });
  }));




    </script>
</body>
</html>