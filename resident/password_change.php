<?php include 'server/serverhome.php' 

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>notif-  Barangay Management System</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
	

		
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="justify-content-center">
							<div>
								<h2 class="text-white text-center fw-bold"></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? ' text-light' : null ?> " role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>




                        <div class="row mt--2 justify-content-center">
            
            <div class="col-md-4">

                    

             <div class="card border">
                 <div class="card-header bg-primary-gradient">
                     <div class="card-head-row">
                         <div class="card-title fw-bold text-white">Change Password</div>
                         <div class="card-tools">
                             
                         </div>
                     </div>
                 </div>
                 <div class="card-body" >





                 <form method="POST" action="model/password_change_token.php">
                     <div class="form-group">
                         <input type="email" class="form-control" name="email" style="color:black; font-weight:bolder;" readonly  value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" required >
                         <input type="hidden" class="form-control"  name="emailtoken" value="<?php if(isset($_GET['email'])){echo $_GET['token'];} ?>" >
                     </div>
                     
                     <div class="form-group form-floating-label">
                         <label>New Password</label>
                         <input type="password" id="new_pass" class="form-control" placeholder="Enter New Password" name="new_pass" required >
                         <span toggle="#new_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                     </div>
                     <div class="form-group form-floating-label">
                         <label>Confirm Password</label>
                         <input type="password" id="con_pass" class="form-control" placeholder="Confirm Password" name="con_pass" required >
                         <span toggle="#con_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                     </div>
                     </div>
                     <div class="row justify-content-center m-4">
                     
                         <button type="submit" class="btn btn-primary">Change</button>
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


