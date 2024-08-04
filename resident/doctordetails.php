<?php include '../server/server.php' ?>
<?php

  $resid=$_SESSION['resid'];

  if(!empty($_POST['id'])){


  
  $id  = $conn->real_escape_string($_POST['id']);
  $barno=$_SESSION['barno'];

	$query1 = "SELECT * FROM `tbldoctors` WHERE bar_no=$barno AND doc_id=$id ";
    $result1 = $conn->query($query1);
	$detail = $result1->fetch_assoc();









}else{

    header('Location: dashboard.php');
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Details -  Barangay Management System</title>
    
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
								<h2 class="text-white fw-bold"><button type="button" class="btn btn-primary shadow-sm fw-bold border "  onclick="goBack()">Go back</button></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">

                <div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								
								<div class="card-body" >

        


               
                            <div class="row p-3 pt-1 bg-primary-gradient rounded border">
                                        
     
                                        <div class="col-md-12 ">
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Doctor Details</b></h2>
                                        
                                        </div>
        
                                    
                                    
                                       
        
                            </div>



                            <div class="row    bg-white m-1  ">
                                 <div class="col-md-4 p-2   border rounded shadow-sm">

                                  

                                 <img src="../assets/uploads/<?= $busername ?>/doctor/<?= $detail['image'] ?>" class="img-fluid rounded" width="100%" alt="Responsive image" >


 
                                    </div>

                                    <div class="col-md-7 p-2   border rounded shadow-sm">

                                  
                     <h1 style="border-bottom:solid black 2px;">Dr.  <?= $detail['firstname']  ?>  <?= $detail['lastname']  ?> </h1>
                     <p>Specialization <b style="color:green;"><?= $detail['specialization']  ?></b> </p>
                     <p>Availability: <?= $detail['timeavailable']  ?> </p>


                     <p>About  <?= $detail['aboutdoc']  ?> </p>

                 

   </div>


                                   

                            </div>
                                        


                              


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
</html>


