<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
    $barno=$_SESSION['bar_no'];
    $reqno = $_GET['reqno'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_indigency.control_no,6,'0') as ctrlno FROM `tbl_indigency` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_indigency.res_id  LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id  WHERE tbl_residents.res_id='$id' AND tbl_indigency.req_no=$reqno";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();
    $query1 = "SELECT * FROM tblofficials  WHERE position   NOT IN ('Secretarys','Treasurers')
    AND `status`='Active'  AND tblofficials.bar_no=$barno ";
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
	<title><?= ucwords($resident['res_id'].''.$resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>Indigency</title>
    <style>
        @page  
        { 
            size: auto;   /* auto is the initial value */ 

            /* this affects the margin in the printer settings */ 
            margin: 20mm 20mm 20mm 20mm;  
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
								<h2 class="text-white fw-bold">Generate Certificate</h2>
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
										<div class="card-title">Certificate of Indigency</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body m-5" id="printThis" >
                                    <div class="d-flex flex-wrap justify-content-around" style="border-bottom:1px solid red">
                                    <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width="170">
										</div>
										<div class="text-center" style=" color:black;">
                                            <h2 class="mb-0 fw-bold">Republic of the Philippines</h2>
                                            <h2 class="mb-0 fw-bold">Province of <?= ucwords($province) ?></h2>
											<h2 class="mb-0 fw-bold">City of 	<?= ucwords($city) ?></h2>
											<h2 class="mb-0 fw-bold"> Barangay <?= ucwords($barangayname) ?></i></h2>
                                            <p  class="fw-bold" style=" color:black;"><i>Mobile No. <?= $phone ?></i></p>
                                            <h1 class="mb-0 fw-bold " style="font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif; "> Office of the Barangay Captain </i></h1>
                                           
										</div>
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username']  ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid rounded-circle" width="170">
										</div>
									</div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="text-center mt-5">
                                               
                                            </div>
                                            <div class="d-flex" style="position:absolute; left:100px; top: 200px;opacity: 0.2;">
                                          
                                          <img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='800'> 
                                        </div>
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="font-size:38px;color:darkblue">CERTIFICATE OF INDIGENCY</h1>
                                            </div>
                                            <h2 class="mt-5 fw-bold" style="color:black;">TO WHOM IT MAY CONCERN:</h2>
                                            <h2 class="mt-3" style=" text-align: justify; text-indent: 40px; font-size:25px;  line-height: 1.8; color:black;">This is to certify that <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span> 
                                             , <span class="fw-bold"><?= ucwords($resident['age']) ?></span> years of age , <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['gender']) ?></span>, <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['civil_status']) ?></span>,
                                            and Filipino is a resident of  <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['household_no']) ?>  <?= ucwords($resident['streetname']) ?>  <?= ucwords($barangayname) ?>,   <?= ucwords($city) ?> , <?= ucwords($province) ?></span> and that he/she is one of indigents in our barangay.</h2>
                                            <h2 class="mt-3" style=" text-align: justify; text-indent: 40px; font-size:25px;  line-height: 1.8; color:black;">This certification/clearance is hereby issued to the above-named person and requirements for <span class="fw-bold"><?= ucwords($resident['purpose']) ?></span>.</h2>
                                            <h2 class="mt-5 " style=" text-align: justify; text-indent: 0px; font-size:25px;  line-height: 1.8; color:black;">Given this <span class="fw-bold" style="font-size:25px"><?php $str = $resident['date_issued']; $date = date('F j, Y', strtotime($str)); echo $date; ?></span> at the office of the Punong Barangay, <span class="fw-bold" style="font-size:25px"><?= ucwords($barangayname) ?></span>
                                            this Municipality, Philippines.</h2>
                                        </div>
                                     
                                    </div>

                                    <div class="row">
                                            <div class=" col p-3 text-center " style="margin-top:100px;  opacity: 0.0;">
                                                <h1 class="fw-bold mb-0 text-uppercase"><?= ucwords($captain['name']) ?></h1>
                                                <p class="">PUNONG BARANGAY</p>
                                            </div>
                                            <div class="col p-3 text-center " style="margin-top:100px; opacity: 0.0;">
                                                <h1 class="fw-bold mb-0 text-uppercase" ><?= ucwords($captain['name']) ?></h1>
                                                <p class="">PUNONG BARANGAY</p>
                                            </div>

                                            <div class=" col p-3 text-center " style="margin-top:100px; color:black;">
                                                <h1 class="fw-bold mb-0 text-uppercase"><?= ucwords($captain['name']) ?></h1>
                                                <p class="" style="color:black;">PUNONG BARANGAY</p>
                                            </div>
                                        </div>


                                    <div class="row" style="color:black">
                                            <div class=" col-3 p-2 text-left  " >
                                               
                                                <h4 class="mb-0">Clerance No. :</h4>
                                         
                                            </div>
                                            <div class="col-3 p-2 text-left " >
                                            <h4 class="mb-0"><b ><?=  ucwords($resident['ctrlno']) ?></b></h4>
                                              
                                         
                                            </div>

                                             <div class=" col-3 mt-3 " style="pointer-events: none;">
                                                
                                     <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
       <?=$_SESSION['name']?>
          <div class="ml-4">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
<!----
                                            <div class=" col p-3 text-center "style="pointer-events: none;">
                                            <img src='https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl= <?= ucwords($resident['control_no'].''.$resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>&choe=UTF-8'class="img-fluid shadow" style="" width=200>
                                            </div>---->
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
	<?php include 'templates/footer.php' ?>
    <script>
            function openModal(){
                $('#pment').modal('show');
            }
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