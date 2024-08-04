<?php include 'server/server.php' ?>
<?php 

    $id = $_GET['id'];
    $reqno = $_GET['reqno'];
    $barno=$_SESSION['bar_no'];
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tblbuilding_permit.or_no,6,'0') as or_no,lpad(tblbuilding_permit.bp_no,6,'0') as bclno FROM `tblbuilding_permit` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbuilding_permit.res_id LEFT JOIN tblhousehold On tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id  WHERE tbl_residents.bar_no=$barno AND tbl_residents.res_id='$id' AND tblbuilding_permit.req_no=$reqno";
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
	<title><?= ucwords($resident['res_id'].''.$resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?> -Building Clearance -  Barangay Management System</title>
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
										<div class="card-title">Barangay Certificate</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>


								<div class="card-body " id="printThis" >

                                      
                                <div class="d-flex  justify-content-around" style="border-bottom:3px solid black;" >
                               <!--- <img src="assets/img/green.png"  style="position:absolute;   height:300px; width:100%;  opacity:0.1;"> --->  
                                        <div class="text-center ">
										<img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width="170">
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
										<img src="assets/uploads/<?= $_SESSION['username'] ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid rounded-circle" width="170">
										</div>
                                       




                                      
									</div>
                                   
                                
                                    
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="text-center p-3" style="margin-top:0px; color:black;">

                                                 
                                                <?php if(!empty($officials)):?>

                                                    <?php foreach($officials as $row): ?>
                                                        <div style="border:solid red 1px; color:black; ">
                                                        <h3 class="mt-3 fw-bold mb-0 text-uppercase" style=""><?= ucwords($row['name']) ?></h3>
                                                        <h5 class="mb-2 text-uppercase"><?= ucwords($row['position']) ?></h5>
                                                        
                                                    </div>
                                                    <br><br><br>

                                                    <?php endforeach ?>
                                                <?php endif ?>

                                            </div>
                                        </div>
                                        <div class="col " style=" position: relative; top:-10px; border-left:solid black 3px; height:1100px;">
                                            <div class="text-center">
                                               
                                            </div>
                                            <div class="d-flex justify-content-center" style="position:absolute; right: 30px; top: 300px;opacity: 0.2;">
                                          
                                            <img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='900'> 
                                          </div>
                                            <div class="text-center" >
                                                <h1 class="fw-bold mt-5" style="font-size:50px; color:black; font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif; ">BUILDING CLEARANCE</h1>

                                        
                                            </div>
                                       <br><br><br><br><br>
                                            <p class=" " style=" text-align: justify; text-indent: 0px; font-size:25px;  line-height: 2.8; color:black;">This is to certify that  <span class="fw-bold ml-2 " style="font-size:25px">  <?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?> </span>,<span class="fw-bold ml-2 "style="font-size:25px"><?= ucwords($resident['age'])?></span> years old and is a  resident of 
                                            <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['household_no']) ?>  <?= ucwords($resident['streetname']) ?>  <?= ucwords($barangayname) ?>,   <?= ucwords($city) ?> , <?= ucwords($province) ?></span> and rightful and lawful owner of a  <b class="fw-bold"><?=$resident['bhouseno'].' '.$resident['bstreet'] ?></b> is cleared to construct building located at Brgy. 
                                            <?= ucwords($barangayname) ?>, 	<?= ucwords($city) ?>,	<?= ucwords($province) ?>.


                                            
                                            <p class="" style="text-align: justify; text-indent: 0px; font-size:25px;  line-height: 2.8;  color:black;">Given this<span class="fw-bold ml-2 mr-1" style="font-size:25px"> 
                                            <?php $str = $resident['applied']; $date = date('F j, Y', strtotime($str)); echo $date; ?></span>   in Barangay <span class="fw-bold" style="font-size:25px"> <?= ucwords($barangayname) ?>,   <?= ucwords($city) ?> , <?= ucwords($province) ?> </span>to use on  <span class="fw-bold" style="font-size:25px"> BUILDING PERMIT/ELECTRICAL PERMIT</span> .</p>
                                            
                                         
 <br><br><br>
                                        <div class="row ">
                                            <div class=" col-3 p-3 text-center">
                                                <h2 class="fw-bold mb-0 text-uppercase" style=" opacity: 0.0 ;position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                              
                                            </div>
                                            <div class=" col-4 p-3 text-center">
                                                <h2 class="fw-bold mb-0 text-uppercase" style="opacity: 0.0 ; position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                              
                                            </div>
                   
                                            <div class=" col-4 p-3 text-center">
                                                <h2 class="fw-bold mb-0 text-uppercase" style="position: relative; right:10px; color:black; " ><?= ucwords($captain['name']) ?></h2>
                                                <p class="mr-3 fw-bold" style=" color:black;">PUNONG BARANGAY</p>
                                            </div>
                                           

       
                                          


                                        </div>

                           

                                     
                            

                                        <div class="row m-0 p-1 "style="position:relative; top:40px; color:black;   ">
                                            <div class=" col-3  text-left">
                                                <h2 class="fw-bold mb-0 text-uppercase" style=" opacity: 0.0 ;position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                                <h4 class="mb-0">Clerance No. :</h4>
                                               
                                                <h4 class="mb-0">OR No. : </h4>
                                                <h4 class="mb-0">CTC No. : </h4>
                                            </div>
                                            <div class=" col-3 text-left">
                                            <h2 class="fw-bold mb-0 text-uppercase" style=" opacity: 0.0 ;position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                            <h4 class="mb-0"><b ><?=  ucwords($resident['bclno']) ?></b></h4>
                                              
                                                <h4 class="mb-0"><b ><?=  ucwords($resident['or_no']) ?></b></h4>
                                                <h4 class="mb-0"> <b ><?=  ucwords($resident['ctc_no']) ?></b></h4>
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
                                            </div>
<!---
                                            <div class=" col-6 text-right" style="pointer-events: none;">
                                            <img src='https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl= <?= ucwords($resident['or_no']) ?><?=  ucwords($resident['ctc_no']) ?><?=  ucwords($resident['bclno']) ?>&choe=UTF-8'class="img-fluid shadow" style="" width=200>
                                            </div>---->
                                           

       
                                          


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