
<?php include 'server/serverhome.php' 

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Password Recovery-  Barangay Management System</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
	

		
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="justify-content-center">
							<div>
							<a type="button" class="btn btn-primary text-white rounded shadow-sm fw-bold border" href="admin">Go back to Loginpage.</a>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					




                        <div class="row mt-5 justify-content-center rounded ">
            
            <div class="col-md-4">

                    

             <div class="card border">
                 <div class="card-header bg-primary-gradient rounded">
                     <div class="card-head-row">
                         <div class="card-title fw-bold text-white">Password Reset</div>
                         <div class="card-tools">
                             
                         </div>
                     </div>
                 </div>
                 <div class="card-body" >
				 <?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? ' text-light' : null ?> " role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>




                 <form method="POST" action="model/forgotpassword_send_email.php">


                 <div class="form-group form-floating-label">
					<input name="email" type="email" class="form-control input-border" autocomplete="off" required>
					<label for="email" class="placeholder">Email Address</label>
				</div>
                     
                  
                  
                     <div class="row justify-content-center m-4">
                     
                         <button type="submit" class="btn btn-primary fw-bold">Submit</button>
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
	<?php include 'templates/footer.php' ?>
</body>
</html>


