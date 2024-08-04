<?php include 'server/server.php' ?>
<?php 





$barno=$_SESSION['bar_no'];
    $id = $_GET['id'];
	$query = "SELECT *,LEFT(`middlename`, 1) AS middlename,YEAR(`date_issued`) as year,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND id_no=$id";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();


	/*
	$query2 = "SELECT LPAD(res_id, 6,0) AS resid FROM tbl_residents WHERE res_id=$id";
    $result2 = $conn->query($query2);
    $myid = $result2->fetch_assoc();

	$query3 = "SELECT LEFT(`middlename`, 1) AS middlename FROM tbl_residents WHERE res_id=$id";
    $result3 = $conn->query($query3);
    $middlename = $result3->fetch_assoc();
    

    
	

	$sql = "SELECT YEAR(`createdAt`) as Year FROM tbl_residents WHERE res_id='$id'";
    $results = $conn->query($sql);
    $year = $results->fetch_assoc();
*/





    $query1 = "SELECT * FROM tblofficials  WHERE 
              `status`='Active' ";
    $result1 = $conn->query($query1);
    $officials = array();
	while($row = $result1->fetch_assoc()){
		$officials[] = $row; 
	}

    $c = "SELECT * FROM tblofficials  WHERE position='Captain' AND tblofficials.bar_no=$barno";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials  WHERE position='Secretary' AND tblofficials.bar_no=$barno";
    $sec = $conn->query($s)->fetch_assoc();

    $s = "SELECT * FROM tblofficials  WHERE position='Treasurer' AND tblofficials.bar_no=$barno";
    $tre = $conn->query($s)->fetch_assoc();






?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay ID -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Generate Barangay ID</h2>
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
										<div class="card-title">Barangay Resident ID</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Barangay ID
											</button>
										</div>
									</div>
								</div>

								<!--startprint-->
								<div class="card-body m-5" id="printThis">

                                    
                                 <div class="row  ml-4">
								
								
							<div class="card card-stats card-round shadow border">
								<div class="card-body">
									<div  style="position:absolute; left:150px; top:100px; opacity: 0.2;">

									<img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class=" rounded-circle" width="180" height="180">


									</div>
									   <div class="row pt-3" style="position:relative; border-bottom:solid black 3px;  top:-10px;height:80px; width:500px;">
										<div class="col pl-4">
										<img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid rounded-circle" width="50">
							           </div>
                                         <!--start--->
									   <div class="col-m-12 pl-5 pr-5">
									   <div class="text-center">
                                            <p style="font-size:12px; font-weight:bolder;">REPUBLIC OF THE PHILIPPINES</p>
                                            <p style="font-size:11px; position:relative; top:-25px; font-weight:bolder;">Province of <?= ucwords($province) ?></p>
											<p  style="font-size:11px; position:relative; top:-48px; font-weight:bolder;">City of <?= ucwords($city) ?>, Barangay  <?= ucwords($barangayname) ?></p>
										
										
										
                                            <p style="font-size:11px; position:relative; top:-70px; font-weight:bolder;">Mobile No.:	<?= $phone ?></p>
                                           
										</div>
							           </div>

									   <div class="col pl-5">
									   <img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width="50">
							           </div>


                                       
							           </div>
									     <!-- end--->
     

									   <div class="row  ml-0 mr-0 " style="position:relative; top:-10px;height:20px;">
										

									  
									
                                            <p style="position: relative; left: 100px;font-size:18px;  font-weight:bolder; font-family:times new roman;">BARANGAY RESIDENT'S CARD</p>
                                             
										
                                           
								
							        

									   <div class="col-m-3">
									
							           </div>



							           </div>




									   <div class="row  ml-0 mr-0 mt-2" style="position:relative; top:-10px;height:150px;">
										<div class="col-m-3 mt-2  ml-1">
										<?php if(!empty($resident['id_picture'])): ?>

<img src="<?= preg_match('/data:image/i', $resident['id_picture']) ?  $resident['id_picture'] : "assets/uploads/".$_SESSION['username']."/resident/".$resident['res_id']."/". $resident['id_picture'] ?>" alt="..." width="140" class="rounded border" >

<?php else: ?>
<img src="assets/img/person.png" alt="..." class="avatar-img  " style="position: relative; width:50px; height:50px; border-radius:70px; border:solid gray 1px; "> 
<?php endif ?> 
									
											
							           </div>

									   <div class="col-m-6 pl-3 pr-4 pt-2 text-uppercase">
										<div class="row  pl-2">
										<b style="font-size:11px;">Brgy-<?= ucwords($resident['year'])?>-<?= ucwords($resident['res_id']) ?>-<?= ucwords($resident['id_no']) ?></b>
                                        </div>

										<div class="row  pl-2 ">
										<b style="font-size:11px;">Lastname: <?= ucwords($resident['lastname'])?></b>
                                        </div>
										
										<div class="row  pl-2">
										<b style="font-size:11px;">Firstname: <?= ucwords($resident['firstname'])?></b>
                                        </div>
										
										<div class="row  pl-2">
										<b style="font-size:11px;">MI.: <?= ucwords($resident['middlename'])?></b>
                                        </div>

										<div class="row  pl-2">
										<b style="font-size:11px;">Date of birth: <?= ucwords($resident['birthdate'])?></b>
                                        </div>
										<div class="row  pl-2">
										<b style="font-size:11px;">Civil Status <?= ucwords($resident['civil_status'])?></b>
                                        </div>
									
										<div class="row  pl-2">
										<b style="font-size:11px;">Citizenship:<?= ucwords($resident['citizenship'])?></b>
                                        </div>
										<div class="row  pl-2">
										<b style="font-size:12px;">Age: <?= ucwords($resident['age'])?></b>
                                        </div>
									
								
                                           
									
										
										
										
                                     
										
                                           
									
							           </div>

									   <div class="col-m-1 mt-1 pl-0 " >
									
									
													
										<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl= Brgy-<?= ucwords($resident['year'])?>-<?= ucwords($resident['res_id']) ?>-<?= ucwords($resident['id_no']) ?>&choe=UTF-8'class="img-fluid " style="border:solid black 1px; height:1s0px;">
										<p  style="font-size:10px; position:relative; font-weight:bolder; ">VALID UNTIL: <?=date('M d, Y', strtotime('+1 year')); ?></p>

							           </div>

									 

                                        

							           </div>
									



								</div>
								
					
						</div>
							</div>

                            <!---back-->
							<div class="row  ml-4">
                             
						<div class="card card-stats card-round shadow border pl-2   pt-2 pr-2">
								<div class="card-body ">
									<div  style="position:absolute; left:130px; top:20px; opacity: 0.2;">

									<img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class=" rounded-circle" width="250" height="250">

									</div>
									   <div class="row " style="position:relative; border:solid black 1px;  border-radius:5px; top:-10px; height:250px; width:480px;">
										<div class="col ">
										
							           </div>
                                         <!--start--->
									   <div class="col-m-12 ">
									   <div class="text-center ">
									   <p  style="font-size:12px; position:relative; font-weight:bolder; top:5px;">ADDRESS</p>
											<p  style="font-size:14px; position:relative; font-weight:bolder; border-bottom:solid black 1px;  width:320px;  top:-15px;  line-height: 1.2;">#<?= ucwords($resident['household_no']) ?>   <?= ucwords($resident['streetname']) ?>, <?= $barangayname?> ,<?= $city?>, <?= $province?></p>


											<p  style="font-size:14px; position:relative; font-weight:bolder; top:-35px;">Contact No.: <?= ucwords($resident['contact_no']) ?></p>
														
											<p style="font-size:13px; position:relative; top: -55px;px; font-weight:bolder;">if found, please return this ID to:</p>
											<p style="font-size:15px; position:relative; top: -80px;px; font-weight:bolder;">Brgy. Hall <?= ucwords($barangayname) ?> , <?= ucwords($city) ?>, <?= ucwords($province) ?> </p>
											
											<p style="font-size:15px; position:relative; top: -100px;px; font-weight:bolder; color:red;">INCASE OF EMERGENCY NOTIFY!</p>
											<p style="font-size:14px; position:relative; top: -120px;px; border-bottom:solid black 1px;  font-weight:bolder;"><?= ucwords($resident['emergencyname']) ?></p>
                                            <p style="font-size:13px; position:relative; top: -140px;px;  font-weight:bolder; ">Name</p>
											<p style="font-size:14px; position:relative; top: -160px;px;  border-bottom:solid black 1px;  font-weight:bolder;"><?= ucwords($resident['emergencycontact']) ?></p>

											<p  style="font-size:13px; position:relative; top:-180px;  font-weight:bolder;">Contact No</p>



											<p class="fw-bold mb-0 text-uppercase" style="font-size:13px; position:relative;  top:-195px; font-weight:bolder;"><?= ucwords($captain['name']) ?></p>
											<p  style="font-size:13px; position:relative; top:-205px; font-weight:bolder;">Punong Barangay</p>
								
										
                                       
                                           
										</div>
							           </div>

									   <div class="col ">
										<img src="assets/uploads/barangay/<?= $city_logo ?>" class="img-fluid rounded-circle" style="visibility:hidden;" width="50">
							           </div>


                                       
							           </div>
									     <!-- end--->
     

									   
									



								</div>
								
					
						</div>


						 


							</div>
							  <!---back-->



                                   
                                  
								</div>

								<!----endprint-->
							</div>
						</div>
					</div>
				</div>
			</div>

          

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			<?php if(!isset($_GET['closeModal'])){ ?>
            
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
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