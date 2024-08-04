<?php include '../server/server.php' ?>
<?php

  $resid=$_SESSION['resid'];

  if(!empty($_POST['id'])){


  
  $id  = $conn->real_escape_string($_POST['id']);
  $barno=$_SESSION['barno'];

	$query1 = "SELECT * FROM `tblannouncement` WHERE bar_no=$barno AND id=$id";
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
                                       
                                        
                                        <h2 class="text-white" style="text-align:center;"><b>Announcement Details</b></h2>
                                        
                                        </div>
        
                                    
                                    
                                       
        
                            </div>



                            <div class="row    bg-white  ">
                                 <div class="col-md-6 p-2    border rounded shadow-sm">

                                  

                                 <img src="../assets/uploads/<?= $busername ?>/announcement/<?= $detail['picture'] ?>" class="img-fluid rounded" alt="Responsive image" >


 
                                    </div>

                                    <div class="col-md-6 p-2   border rounded shadow-sm">

                                  
                     <h1 style="border-bottom:solid black 2px;"> <?= $detail['activityname']  ?> </h1>
                     <p><?= $detail['description']  ?> </p>
                     <p>Place of Activity : <?= $detail['placeofactivity']  ?> </p>

                     <p>Date of Activity:   <?php $str = $detail['dateofactivity']; $date = date('F j, Y', strtotime($str)); echo $date; ?></p>

                     <p>Organize By: <?= $detail['organizername']  ?> </p>

                 

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


