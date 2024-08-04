<?php include '../server/server.php' ?>
<?php 

	
$barno=$_SESSION['barno'];



$resid=$_SESSION['resid'];

$query1 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
$result1 = $conn->query($query1);
$resident = $result1->fetch_assoc();

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title> Changepassword-  Weabits</title>
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
				
				<div class="page-inner mt-2 ">
						<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>

				<div class="row mt--2 justify-content-center">
            
				<div class="col-md-6">

                           

					<div class="card border">
						<div class="card-header bg-primary-gradient">
							<div class="card-head-row">
								<div class="card-title fw-bold text-white">Change Password</div>
								<div class="card-tools">
									
								</div>
							</div>
						</div>
						<div class="card-body" >


 


						<form method="POST" action="model/change_password.php">
						
							<div class="form-group form-floating-label">
								<label>Current Password</label>
								<input type="password" id="cur_pass" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
								<span toggle="#cur_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>