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


    $query50 = "SELECT * FROM tbl_residents WHERE solo_parent='Yes' AND alive=1   AND  verify_status='verified' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y')>=18  AND  bar_no=$barno";
    $result50 = $conn->query($query50);
	$soloparent = $result50->num_rows;

	$query51 = "SELECT * FROM tbl_residents WHERE relation='Head' AND alive=1  AND  verify_status='verified' AND  bar_no=$barno ";
    $result51 = $conn->query($query51);
	$headoffamily = $result51->num_rows;


	$query52 = "SELECT * FROM tbl_residents WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0 AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND alive=1  AND  verify_status='verified' AND  bar_no=$barno ";
    $result52 = $conn->query($query52);
	$children = $result52->num_rows;


   	$query52a = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,tbl_residents.email as emails FROM `tblpatient` LEFT JOIN tbl_residents on tblpatient.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE    tbl_residents.bar_no=$barno; ";
    $result52a = $conn->query($query52a);
	$patient = $result52a->num_rows;

	$query4 = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
$result4= $conn->query($query4);
$business= $result4->num_rows;

$query5 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";
$result5= $conn->query($query5);
$building= $result5->num_rows;


$query6 = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id  WHERE tbl_residents.bar_no=$barno";
$result6= $conn->query($query6);
$barangayclearance= $result6->num_rows;



$query71 = "SELECT * FROM `tbl_indigency` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_indigency.res_id  WHERE tbl_residents.bar_no=$barno";
$result71= $conn->query($query71);
$certificateofindigency= $result71->num_rows;

$query72 = "SELECT * FROM tbldaycare LEFT JOIN tbl_residents ON tbldaycare.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbldaycare.bar_no=$barno ORDER BY tbldaycare.stud_no;";
$result72= $conn->query($query72);
$daycare= $result72->num_rows;


$query73 = "SELECT tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.bar_no=$barno AND tblborrow.status='returned' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";
$result73= $conn->query($query73);
$equipment= $result73->num_rows;


$query74 = "SELECT * FROM tblequipments WHERE bar_no=$barno";
$result74= $conn->query($query74);
$vaccination= $result74->num_rows;

	
	$query7 = "SELECT * FROM tblblotter WHERE bar_no=$barno";
	$blotter = $conn->query($query7)->num_rows;
 
  

	$query12 = "SELECT * FROM tblrequested_documents WHERE `status`='pending' OR `status`='processing'";
    $result12 = $conn->query($query12);
	$reqdocs= $result12->num_rows;

	$query13 = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' GROUP BY tbl_residents.h_no;";
    $result13 = $conn->query($query13);
	$household= $result13->num_rows;


	$query14 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tblchildren  LEFT JOIN tbl_residents on tbl_residents.res_id=tblchildren.res_id  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tbl_residents.verify_status='verified'";
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


<?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Report-  Barangay Management System</title>




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
								<h2 class="text-white fw-bold">Generate Reports</h2>
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
					    
					    
					    
					    <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Population'): ?>
						<div class="col-md-4">
							<div class="card card-stats bg-primary-gradient card-round">
								<div class="card-body">
									<div class="row">
									    
									    
									    
										<div class="col-3">
											<div class="icon-big text-center text-white">
                                            <i class="flaticon-users"></i>   <h3 class="fw-bold text-uppercase text-white"  style="position:relative; "><?= number_format($total) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												
												<h2 class="fw-bold text-uppercase" style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right; color:white;">All Residents</h2>
                                                <a href="print_report.php?state=all" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
                             
                              
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats bg-success-gradient card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="flaticon-user"></i><h3 class="fw-bold" style="position:relative; "><?= number_format($male) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4 ">
												<h2 class="fw-bold text-uppercase text-center text-white" >Male</h2>
                                                <a href="print_report.php?state=male" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>
												
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
								
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats bg-danger-gradient card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="icon-user-female"></i><h3 class="fw-bold text-uppercase" ><?= number_format($female) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-center text-white">Female</h2>
                                                <a href="print_report.php?state=female" class="rounded btn fw-bold" style="color:white; border:solid white 1px; ">Print  <i class="icon-docs"></i></a>
												
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">

								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats card-round bg-warning-gradient" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="fab fa-jenkins"></i>	<h3 class="fw-bold text-uppercase" ><?= number_format($senior) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Senior Citizen</h2>
                                                <a href="print_report.php?state=senior" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>
											
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">

								</div>
							</div>
						</div>


					


						<div class="col-md-4">
							<div class="card card-stats card-round bg-secondary-gradient" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="fas fa-wheelchair"></i>	<h3 class="fw-bold text-uppercase" ><?= number_format($pwd) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4 ">
                                            <h2 class="fw-bold text-uppercase text-center text-white">PWD </h2>
                                            <a href="print_report.php?state=pwd" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">

								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats card-round " style="background-image: linear-gradient(90deg,gray, black); color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-people-carry"></i>								<h3 class="fw-bold text-uppercase"><?= number_format($deceased) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-center">Deceased</h2>
                                                <a href="print_report.php?state=deceased" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>
				
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>

						


					


						<div class="col-md-4">
							<div class="card card-stats  bg-primary-gradient card-round shadow"  style=" color:white" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center ">
										<i class="flaticon-users"></i><h3 class="fw-bold" style="position:relative; "><?= number_format($soloparent) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase "style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Solo Parent</h2>
                                                <a href="print_report.php?state=soloparent" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats  bg-success-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
												<i class="flaticon-user"></i><h3 class="fw-bold text-uppercase" ><?= number_format($headoffamily) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Head of Families</h2>
												<a href="print_report.php?state=head" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#00C198; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class="fa fa-child"></i><h2 class="fw-bold text-uppercase" ><?= number_format($children) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >Children</h2>
												<a href="print_children.php?state=children" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#00C198; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class='fas fa-home'></i><h2 class="fw-bold text-uppercase" ><?= number_format($household) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >Household</h2>
												<a href="print_report.php?state=household" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>


				
						
						
<?php endif ?>


 <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='BHW'): ?>

		<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#00C198; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class='fas fa-baby-carriage'></i></i><h2 class="fw-bold text-uppercase" ><?= number_format($newborn) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >New Born</h2>
												<a href="print_report.php?state=newborn" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>
						
						
							<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color: orange; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class='fas fa-baby-carriage'></i></i><h2 class="fw-bold text-uppercase" ><?= number_format($patient) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >Patient</h2>
												<a href="print_report.php?state=patient" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="card card-stats  bg-danger-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="fas fa-syringe"></i><h3 class="fw-bold text-uppercase" ></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:16px; width:500px; position:relative; left:-370px; text-align:right;">Covid Vaccination Status</h2>
												<a href="print_report.php?state=vaccstatus" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>


						
<?php endif ?>
 <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Lupon' || $_SESSION['role']=='Peace & Order'  ): ?>
 <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Lupon'): ?>
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#c41b1b; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class='fas fa-user-alt-slash'></i></i><h2 class="fw-bold text-uppercase" ><?= number_format($blocklisted) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >Blocklisted</h2>
												<a href="print_report.php?state=blocklisted" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>
						
						<?php endif ?>
						
						
							<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:#c41b1b; color:#fff">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
											<i class='icon-layers'></i></i><h2 class="fw-bold text-uppercase" ><?=$blotter  ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
											
												<h2 class="fw-bold text-uppercase text-center" >Blotter</h2>
												<a href="print_report.php?state=Blotter" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											
									     	</div>
										</div>
									</div>
								</div>
								<div class="card-body">
							
								</div>
							</div>
						</div>

<?php endif ?>

 <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'): ?>


						<div class="col-md-4">
							<div class="card card-stats  bg-success-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="fas fa-briefcase"></i><h3 class="fw-bold text-uppercase" ><?= number_format($business) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Business Clearance</h2>
												<a href="print_report.php?state=business" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>
						

						<div class="col-md-4">
							<div class="card card-stats  bg-dark-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="far fa-building"></i><h3 class="fw-bold text-uppercase" ><?= number_format($building) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Building Clearance</h2>
												<a href="print_report.php?state=building" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>



						<div class="col-md-4">
							<div class="card card-stats  bg-primary card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="icon-docs"></i><h3 class="fw-bold text-uppercase" ><?= number_format($barangayclearance) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Barangay Clearance</h2>
												<a href="print_report.php?state=bclearance" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>




						<div class="col-md-4">
							<div class="card card-stats  bg-primary-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="icon-docs"></i><h3 class="fw-bold text-uppercase" ><?= number_format($certificateofindigency) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-370px; text-align:right;">Certificate of Indigency</h2>
												<a href="print_report.php?state=coi" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>
						
								
							<div class="col-md-4">
							<div class="card card-stats  bg-primary-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="icon-layers"></i><h3 class="fw-bold text-uppercase" ></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-410px; text-align:right;">PAYMENTS</h2>
												<a href="print_payments.php?state=payments" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>
						
<?php endif ?>


 <?php if($_SESSION['role']=='administrator' ): ?>

						<div class="col-md-4">
							<div class="card card-stats  bg-warning-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="	fas fa-graduation-cap"></i><h3 class="fw-bold text-uppercase" ><?= number_format($daycare) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-400px; text-align:right;">Day Care</h2>
												<a href="print_report.php?state=daycare" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<div class="card card-stats  bg-secondary-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
										<i class="icon-layers"></i><h3 class="fw-bold text-uppercase" ><?= number_format($equipment) ?></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-380px; text-align:right;">Returned Equipment</h2>
												<a href="print_report.php?state=equipment" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>



					


						<div class="col-md-4">
							<div class="card card-stats  bg-success-gradient card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center text-white">
											<i class="icon-layers"></i><h3 class="fw-bold text-uppercase" ></h3>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase text-white"style=" font-size:18px; width:500px; position:relative; left:-410px; text-align:right;">Projects</h2>
												<a href="print_report.php?state=projects" class="rounded btn fw-bold" style="color:white; border:solid white 1px;">Print  <i class="icon-docs"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									
								</div>
							</div>
						</div>
						
						
				





					
<?php endif ?>


					


				

				
						



					




						

					
				
				</div>
			</div>


	
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>





 
	

<script>
        $(document).ready(function () {
            showGraph();

			showPie();
        });


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


						
                        type: 'bar',
                        data: chartdata,
						options: {
                  
                    title: {
                        display: true,
                        text: 'Covid-19 Vaccination Status',
                        fontSize: 20
                    },


					scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Vaccination Status',
								fontSize: 18
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'No. of Population',
								fontSize: 18
                            },
                            ticks: {
                                beginAtZero: true,
								min:0,
								max:<?php echo $total  ?>,
								
                            }
                        }]
				}
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



<?php endif ?>




