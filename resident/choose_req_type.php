<?php include '../server/server.php' ?>
<?php
   
  $serno  = $conn->real_escape_string($_POST['serno']);
  $doctype  = $conn->real_escape_string($_POST['doctype']);

    $resid=$_SESSION['resid'];

	$query1 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
    $result1 = $conn->query($query1);
	$resident = $result1->fetch_assoc();

?>
 <?php if($resident['username']): ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Services -  Barangay Management System</title>


	<style>
		#nameError {
  display: none;
  font-size: 0.8em;
}

#nameError.visible {
  display: block;
}
	</style>
    
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
							<h1 class="text-white"><?php echo $doctype?></h1>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">

                <div class="row mt--2">
						<div class="col-md-6">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title ">Choose Request Type</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >


                                <!--start col-->

                     
                              
							 
                                <form method="POST" action="submitreq.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
								<div class="col-md-12 m-0 pb-3">
								<span role="alert" id="nameError" aria-hidden="true" style="color:red; font-size:15px;"> field can't be empty </span>
										</div>
									<div class="col-md-12 m-0 p-4  border rounded shadow-sm">
								
									<input type="hidden" name="serno"   value="<?php echo $serno?>"/>


								
									<input type="radio" name="reqtype"   id="online" value="digital" required/>
									<label for="online"><b>Digital Copy </b></label>
									</div>
								
									
									<div class="col-md-12 m-0 mb-3 p-4 mt-2 border rounded shadow-sm">
									<input type="radio" name="reqtype" id="pickup" value="PickUp" required/>
									<label for="pickup" ><b>Pick up at the barangay(hard copy) </b></label>



                            

                           
                  </div>
                 
                  <div class="modal-footer">
                          <button type="button" class="btn btn-danger "  onclick="goBack()">Go Back</button>
                          <?php if(isset($_SESSION['username'])): ?>
                          <button type="submit" class="btn btn-primary">Proceed</button>
                          <?php endif ?>

                          </div>
                   


                            </form>

                                   <!---end table-->


								</div>
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
	<?php include 'templates/footer.php' ?>
</body>

<script>
function validateForm() {
  let x = document.forms["myForm"]["reqtype"].value;
  if (x == "") {
    const nameError = document.getElementById("nameError");
    nameError.classList.add("visible");
  
    
    return false;
  }

}




</script>
</html>



<?php else: header('Location: dashboard.php'); ?>
   

<?php endif ?>