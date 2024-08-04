<?php include 'server/server.php' ?>
<?php







$barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM tblequipments WHERE bar_no=$barno";
    $result = $conn->query($query);

    $equipmemt = array();
    while($row = $result->fetch_assoc()){
        $equipmemt[] = $row; 
    }

	$query1 = "UPDATE tblbarangay SET  `cert`='1'  WHERE bar_no=$barno;";

		if($conn->query($query1) === true){

		
				
			
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Equipments -  Barangay Management System</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php //include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php //include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Set Up Equipments</h2>
							</div>
						</div>
							 <a href="model/logout.php" class="text-white" onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        Sign Out
                    </a>
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
										<div class="card-title">Barangay Equipments</div>
                                       
										<div class="card-tools">
 
  
<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm ">
												<i class="fa fa-plus"></i>
												Equipment
											</a>  
                     <a type="button" href="getmed" class="ml-3 btn btn-primary text-white fw-bold" onclick="return confirm('Are you sure you want to proceed?');">Next</a>
											
										</div>
									</div>
									
									
										<div class="card-head-row mt-4">
										<div class="card-title"></div>
                                       
										<div class="card-tools">
 
  
                                        Search: <input type="text" class="border p-2 rounded" id="live_search" placeholder="Search Equipment Name" />
                                        

                     
											
										</div>
									</div>
								</div>
								<div class="card-body" >

                                <div class="row md-12  justify-content-center" id="searchresult"></div>
                                <!--start col-->

                              
                                <div class="container-fluid">
          
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Equipment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addequipment.php"  enctype="multipart/form-data">
                             

                               


                         

                                <div class="form-group">
                                    <label>Equipment Name</label>
                              
                                    <input class="form-control" name="eqname" placeholder="Enter Equipment Name"  required/>
                                </div>


                                <div class="form-group">
                                    <label>Description</label>
                              
                                    <textarea  class="form-control" name="description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                              
                                    <input type="number" class="form-control" name="qty" placeholder="Enter Equipment Name" required />
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control fw-bold"   name="status"  required>
												<option disabled selected>Select Status</option>
												<option value="Available">Available</option>
												<option value="Not Available">Not Available</option>
											
										
												</select>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                              
                                    <input type="file" class="form-control" name="imgeq" accept="image/*" required />
                                </div>
                              

                                                         
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="model/editequipment.php"  enctype="multipart/form-data">
                       
                        <div class="form-group">
                                    <label>Equipment Name</label>
                              
                                    <input class="form-control" name="eqname" placeholder="Enter Equipment Name" id="equipname" required/>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                              
                                    <textarea  class="form-control" name="description" id="description" required></textarea>
                                </div>


                            

                                <div class="form-group">
                                    <label>Quantity</label>
                              
                                    <input class="form-control" id="qty" name="qty" placeholder="Enter Equipment Name" required />
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control fw-bold"   name="status" id="status" required>
												<option disabled selected>Select Status</option>
												<option value="Available">Available</option>
												<option value="Not Available">Not Available</option>
											
										
												</select>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                              
                                    <input type="file" class="form-control" name="imgeq"  accept="image/*" />
                                </div>
                                                         
                            
                        </div>
                        <div class="modal-footer">
                             <input type="hidden" id="id"  name="id" >
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




<script>

$(document).ready(function() {

           

//pending
  $.ajax({

url:"livesearch_equip.php",
method:"POST",
data:{live_search:$(this).val()},

success:function(result ){

$("#searchresult").html(result);


}


});

});



$("#live_search").keyup(function(){


//alert(input);

if($(this).val()!=""){






            $.ajax({

            url:"livesearch_equip.php",
            method:"POST",
            data:{live_search:$(this).val()},

            success:function(result ){

                $("#searchresult").html(result);


            }

    
            });

        }else{

                                            $.ajax({

                url:"livesearch_equip.php",
                method:"POST",
                data:{live_search:$(this).val()},

                success:function(result ){

                    $("#searchresult").html(result);


                }


                });




        }

});

</script>

</body>






</html>