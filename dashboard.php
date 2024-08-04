<?php include 'server/server.php' ?>




<?php 
$barno=$_SESSION['bar_no'];
$query = "SELECT * FROM tbl_residents WHERE alive=1 AND verify_status='verified' AND bar_no=$barno";
$result = $conn->query($query);
$total = $result->num_rows;

$query1 = "SELECT * FROM tbl_residents WHERE gender='Male' AND alive=1 AND verify_status='verified' AND bar_no=$barno ";
$result1 = $conn->query($query1);
$male = $result1->num_rows;

$query2 = "SELECT * FROM tbl_residents WHERE gender='Female' AND alive=1 AND  verify_status='verified' AND  bar_no=$barno";
$result2 = $conn->query($query2);
$female = $result2->num_rows;



$query3 = "SELECT *FROM tbl_residents WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=60 AND  alive=1 AND verify_status='verified' AND bar_no=$barno";
$result3 = $conn->query($query3);
$senior= $result3->num_rows;


$query10= "SELECT * FROM tbl_residents WHERE pwd NOT IN ('NOt Applicable') AND alive=1 AND bar_no=$barno ";
$result10 = $conn->query($query10);
$pwd= $result10->num_rows;


$query11 = "SELECT * FROM tbl_residents WHERE alive=0 AND bar_no=$barno";
$result11 = $conn->query($query11);
$deceased= $result11->num_rows;


$query50 = "SELECT * FROM tbl_residents WHERE solo_parent='Yes' AND alive=1  AND  verify_status='verified' AND  bar_no=$barno";
$result50 = $conn->query($query50);
$soloparent = $result50->num_rows;

$query51 = "SELECT * FROM tbl_residents WHERE relation='Head' AND alive=1  AND  verify_status='verified' AND  bar_no=$barno ";
$result51 = $conn->query($query51);
$headoffamily = $result51->num_rows;


$query52 = "SELECT * FROM tbl_residents WHERE  DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=12 AND alive=1  AND  verify_status='verified' AND  bar_no=$barno ";
$result52 = $conn->query($query52);
$children = $result52->num_rows;


$query4 = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
$result4= $conn->query($query4);
$business= $result4->num_rows;


$query5 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";
$result5= $conn->query($query5);
$building= $result5->num_rows;


$query7 = "SELECT * FROM tblblotter where bar_no = $barno";
$blotter = $conn->query($query7)->num_rows;



$query12 = "SELECT * FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.bar_no=$barno AND (tblrequested_documents.status='pending' OR tblrequested_documents.status='processing')  ORDER BY tblrequested_documents.req_no DESC";
$result12 = $conn->query($query12);
$reqdocs= $result12->num_rows;

$query13 = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' GROUP BY tbl_residents.h_no;";
$result13 = $conn->query($query13);
$household= $result13->num_rows;


$query14 = "SELECT *FROM tbl_residents WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')=0 AND  alive=1 AND verify_status='verified' AND bar_no=$barno";
$result14 = $conn->query($query14);
$newborn= $result14->num_rows;



$query15 = "SELECT *FROM tbl_residents WHERE blocklisted='Blocklisted' AND bar_no=$barno";
$result15 = $conn->query($query15);
$blocklisted= $result15->num_rows;









$sql ="SELECT gender,COUNT(*)as number FROM `tbl_residents` WHERE alive=1  GROUP BY gender ";
$result9 = mysqli_query($conn,$sql);




$sql1 ="SELECT vaccine_status,COUNT(*)as num1 FROM `tbl_residents` WHERE  alive=1  GROUP BY vaccine_status ";
$result10 = mysqli_query($conn,$sql1);
	



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard -  Barangay Management System</title>




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
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt-2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row">

					<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'||$_SESSION['role']=='Population' ): ?>
                



						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'||$_SESSION['role']=='Population' ): ?>
					    <div class="col-md-12 pl-3 pr-3"  id="printThis">
							<div class="card">
								<div class="card-header bg-primary rounded">
									<div class="card-head-row ">
										<div class="card-title fw-bold pl-5 text-white"> <i style="font-size:24px" class="fa">&#xf080;</i> DATA ANALYTICS </div>
										
									</div>
								</div>


								<div class="card-body">

								<div class="row">
                  
								<div class="col " >
								<canvas id="graphCanvasgender" class="graphCanvasgender  border rounded p-3" style="width:100%; max-width:600px; "></canvas>

					           </div>
								
								<div class="col">
							   <canvas id="graphCanvas" class="border rounded p-3" style="width:100%; max-width:600px"></canvas>

					           </div>
					           </div>
							   
								
							
								</div>

										

										
							


									
																
								
							</div>
						</div>


					
						
<?php endif?>	
						<div class="col-md-4">
							<div class="card card-stats bg-primary-gradient card-round text-white">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												
												<h2 class="fw-bold text-uppercase" style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Population</h2>
												<h3 class="fw-bold text-uppercase"  style="position:relative; left:-390px; text-align:right;"><?= number_format($total) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=all" class="card-link text-light">Total Population </a>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats bg-success-gradient text-white card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-user"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Male</h2>
												<h3 class="fw-bold" style="position:relative; left:-390px; text-align:right;"><?= number_format($male) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=male" class="card-link text-light">Total Male </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats bg-danger-gradient text-white card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-user-female"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Female</h2>
												<h3 class="fw-bold text-uppercase"  style="position:relative; left:-390px; text-align:right;"><?= number_format($female) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=female" class="card-link text-light">Total Female </a>
								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats card-round bg-warning-gradient" style="background-color:#5bc0de; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fab fa-jenkins"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Senior Citizen</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-390px; text-align:right;"><?= number_format($senior) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=senior" class="card-link text-light">Total Senior Citizen </a>
								</div>
							</div>
						</div>


					


						<div class="col-md-4">
							<div class="card card-stats card-round text-white bg-secondary-gradient" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-wheelchair"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">PWD</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-390px; text-align:right;"><?= number_format($pwd) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=pwd" class="card-link text-light">Total PWD </a>
								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-image: linear-gradient(90deg,gray, black); color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-people-carry"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Deceased</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-390px; text-align:right;"><?= number_format($deceased) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="residents_info.php?state=deceased" class="card-link text-light">Total Deceased </a>
								</div>
							</div>
						</div>

						<?php endif ?>

					
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'||$_SESSION['role']=='Clerk' ): ?>

						<div class="col-md-4">
							<div class="card card-stats card-success card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-briefcase"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Business Permit</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-390px; text-align:right;"><?= number_format($business) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="business_permit.php" class="card-link text-light"> Business Permit </a>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats  card-round" style="background-color:gray; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="far fa-building"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Building Permit</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-390px; text-align:right;" ><?= number_format($building) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="building_permit.php" class="card-link text-light">Building Permit </a>
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#00C198; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style=" font-size:18px; width:500px; position:relative; left:-380px; text-align:right;">Requested Documents</h2>
												
											<h2 class="fw-bold text-uppercase" style="position:relative; left:-380px; text-align:right;"><?= number_format($reqdocs) ?></h3>
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="requested_docs.php" class="card-link text-light">Requested Documents</a>
								</div>
							</div>
						</div>
            <?php  endif ?>
         <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Population' ): ?>

						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#6082b6; color:#fff" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class="fas fa-home"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="position:relative; left:-90px; width:200px; text-align:right;">HouseHolds</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-90px; text-align:right;"><?= number_format($household) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="household_records.php" class="card-link text-light">Total HouseHold Records</a>
								</div>
							</div>
						</div>
      <?php endif  ?>
	  <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='justice' ): ?>
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#c41b1b; color:#fff" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="position:relative; left:-90px; width:200px; text-align:right;">Blotter</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-90px; text-align:right;"><?= number_format($blotter) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="blotter.php" class="card-link text-light">Blotter Information</a>
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#c41b1b; color:#fff" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class="fas fa-user-alt-slash"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="position:relative; left:-90px; width:200px; text-align:right;">Blocklisted</h2>
												<h3 class="fw-bold text-uppercase" style="position:relative; left:-90px; text-align:right;"><?= number_format($blocklisted) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="blocklisted" class="card-link text-light">Blocklisted</a>
								</div>
							</div>
						</div>
               
               <?php endif?>
<!----
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#3E9C35; color:#fff">
								<div class="card-body">

									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<b>&#8369</b>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase"style="position:relative; left:-90px; width:200px; text-align:right;">Revenue by day</h2>
										

                                               
												
												<?php if(!empty($revenue['am'])): ?>
													<h3 class="fw-bold text-uppercase" style="position:relative; left:-100px; text-align:right;"><b>&#8369</b> 
 													<?=number_format($revenue['am'],2)?>   </h3>
													<?php  else:?>
														<h3 class="fw-bold text-uppercase" style="position:relative; left:-100px; text-align:right;"><b>&#8369</b> 0 </h3>
														<?php  endif ?>
                                            
                                                      

													

											
											</div>
										</div>
									</div>
								</div>


							
								<div class="card-body">
									<a href="revenue.php" class="card-link text-light">All Revenues</a>
								</div>
							</div>

					</div>

			--->
					


					




						

					

				</div>
			</div>


	
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>





	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	

<script>
        $(document).ready(function () {
            showGraph();

			showPie();
        });

		function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }

        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var vaccine_status = [];
                    var number = [];
					

                    for (var i in data) {
                        vaccine_status.push(data[i].vaccine_status);
                        number.push(data[i].number);
                    }

                    var chartdata = {
                        labels: vaccine_status,
                        datasets: [
                            {
                                label: '',
                                backgroundColor: ['orange','blue','green','purple','red'],
                                
                             
                             
							
								data:number,
								fontSize: 20,

								
								

								
								
                            }
							
                        ]
                    };


					

				
					

					

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {


						
                        type: 'pie',
                        data: chartdata,
						options: {
                  
                    title: {
                        display: true,
                        text: 'Covid-19 Vaccination Status',
                        fontSize: 20
                    },


			}




						
                    });
					
                });
            }
        }



		function showPie()
        {
            {
                $.post("data_gender.php",
                function (data)
                {
                    console.log(data);
                     var gender = [];
                    var number = [];
					

                    for (var i in data) {
                        gender.push(data[i].gender);
                        number.push(data[i].number);
                    }

                    var chartdata = {
                        labels: gender,
                        datasets: [
                            {
                                label: 'Gender',
                                backgroundColor: ['rgb(54, 162, 235)','rgb(255, 99, 132)'],
                            
                             
                             
							
								data:number,
								fontSize: 20,

								
								

								
								
                            }
							
                        ],

					
                    };


					

				
					

					

                    var graphTarget = $("#graphCanvasgender");

                    var barGraph = new Chart(graphTarget, {


						
                        type: 'doughnut',
                        data: chartdata,
						options: {
                  
				  title: {
					  display: true,
					  text: 'Male and Female Population',
					  fontSize: 20
				  },


		
		  }
					




						
                    });
					
                });
            }
        }



		
        </script>



</body>
</html>




