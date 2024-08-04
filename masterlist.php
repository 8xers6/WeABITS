
<?php include 'server/server.php' ?> 

<?php


$barno=$_SESSION['bar_no'];
// get Users
$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified'";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$resident = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
?>

<?php



$query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblbarangay.province_id=tblprovince.province_id  WHERE bar_no=$barno";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
	
		$barangayname 		= $row['barangayname'];
        $city 		= $row['City'];
        $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
	  
        $mission= $row['mission'];
        $vision= $row['vision'];
		$bar_no= $row['bar_no'];
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Generate Resident Master List</h2>
							</div>
						</div>
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
										<div class="card-title">Resident Master List</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Report
											</button>
										</div>
									</div>
								</div>
								<div class="card-body " id="printThis">
                                <div class="d-flex flex-wrap justify-content-around" style="border-bottom:3px solid black">
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username']?>/barangayinfo/<?= $citylogo ?>" class="img-fluid" width="80%">
										</div>
										<div class="text-center">
                                            <h1 class="mb-0 fw-bold">Republic of the Philippines</h1>
                                            <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
											<h3 class="mb-0">City of 	<?= ucwords($city) ?></h3>
											<h3 class="mb-0"> Barangay <?= ucwords($barangayname) ?></i></h3>
                                            <p><i>Mobile No. <?= $phone ?></i></p>
                                           
										</div>
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle mb-1" width="80%">
										</div>
									</div>
									<div class=" justify-content-center" style="position:absolute; left: 110px; top: 300px;opacity: 0.2;">
                                          
										  <img src="assets/uploads/<?= $_SESSION['username']?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='800'> 
										</div>
                                    <div class="text-center">
                                    <h1 class="mt-4 fw-bold">Residents Master List</h1>
										</div>
                                   

									
                                   
                                          
                        <table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
						
											<thead>
												<tr>
                                                <th style="  border: 2px solid black;
  text-align: center;
  padding: 8px;">RES. ID</th>
                                               
                                               
													<th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Fullname</th>
                                                    <th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">House No. & Street  </th>
                                                   
												
													<th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Birthdate</th>
                                                   
													<th style="  border: 2px solid black;
  text-align: center;
  padding: 8px;">Age</th>
												
                                                    <th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Gender</th>
                                                 
                                                   
                                                  
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
                                                    <td style="  border: 2px solid black;
  text-align: center;
  padding: 8px;">Brgy-<?= $row['year'] ?>-<?= $row['res_id'] ?> </td>
                                                    
														<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">

                                                          
                                                       

                                                 <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

                                                             
                                             

                                                        </td >

                                                        <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">
                                                           
                                                         
                                                            <?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

                                                            
                                                        </td>
                                                        <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">
                                                          
                                                            <?= $row['birthdate'] ?>
                                                          
                                                        
                                                        </td>
                                                      
														<td style="  border: 2px solid black;
  text-align: center;
  padding: 8px;"><?= $row['age'] ?></td>
                                                        <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['gender'] ?></td>
                                                     
                                        


                                                 
													
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
										
										</table>

                            





                                      
                                       
                                    
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
    <script>
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>