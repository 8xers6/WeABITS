<?php include 'server/server.php' ?>
<?php 
      $id = $_GET['id'];
    
  
     
     if(!empty($_GET['busp'])){
         
         $busp = $_GET['busp'];
     }else{
         
         $busp = '';
     }
     
     if(!empty($_GET['reqno'])){
               $reqno = $_GET['reqno'];
     }else{
         
         
         $reqno='';     }
     


    $barno=$_SESSION['bar_no'];
    $query = "SELECT  *,LPAD(tblbusinesspermit.or_no, 5,0) as or_no,tblbusinesspermit.businessname,tblbusinesspermit.bstreet,
    tbl_residents.firstname,tbl_residents.middlename,tbl_residents.lastname,ctc_no,lpad(tblbusinesspermit.busp_no,6,'0') as busp_no
    
    
      FROM tblbusinesspermit  LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE (tblbusinesspermit.req_no='$reqno' OR tblbusinesspermit.busp_no='$busp')  AND tblbusinesspermit.res_id=$id";
    $result = $conn->query($query);
    $permit = $result->fetch_assoc();





    $c = "SELECT * FROM tblofficials WHERE position='Captain' AND tblofficials.bar_no= $barno";
    $captain = $conn->query($c)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Business Permit -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Generate Permit</h2>
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
										<div class="card-title">Barangay Business Permit</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body m-5" id="printThis" style="color:black;">
                                    <div class="d-flex flex-wrap justify-content-around" style="border-bottom:1px solid red">
                                    <div class="text-center">
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
										<img src="assets/uploads/<?= $_SESSION['username']  ?>/barangayinfo/<?= $citylogo ?>" class="img-fluid rounded-circle" width="170">
										</div>
									</div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            
                                               
                                            
                                            <div class="text-center">
                                                <h1 class=" fw-bold mb-5" style="font-size:38px;color:darkblue">BARANGAY BUSINESS CLEARANCE</h1>
                                            </div>
                                            <div class="d-flex" style="position:absolute; left:100px; top: 200px;opacity: 0.2;">
                                          
                                          <img src="assets/uploads/<?=  $_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='800'> 
                                        </div>
                                          
                                            <div class="text-center ">
                                                <h1 class=" fw-bold mb-0"><?= ucfirst($permit['businessname']) ?></h1>
                                                <hr class=" mt-0 mb-0" style="border-top: 2px solid black; width:70%;">
                                                <h2 class="mt-0">(Name of Business or Establishment)</h2>
                                            </div>

                                            <div class="text-center " >
                                                <h1 class="mt-4 fw-bold mb-0" ><?= ucfirst($permit['bstreet']) ?>,<?= ucwords($barangayname) ?>, <?= ucwords($city) ?>,  <?= ucwords($province) ?></h1>
                                                <hr class=" mt-0 mb-0"  style="border-top: 2px solid black; width:70%;">
                                                <h2 class="mt-0"> (Business Address)</h2>
                                            </div>

                                            <div class="text-center  ">
                                                <h1 class="fw-bold mb-0"><?=  ucwords($permit['firstname']) ?>  <?=  ucwords($permit['middlename']) ?>  <?=  ucwords($permit['lastname']) ?></h1>
                                                <hr class=" mt-0 mb-0" style="border-top: 2px solid black; width:70%;">
                                                <h2 class="mt-0">(Business Owner)</h2>
                                            </div>

                                            <div class="text-center  mb-5">
                                                <h1 class="mt-1 fw-bold mb-0"><?=  ucwords($permit['household_no']) ?> <?=  ucwords($permit['streetname']) ?>, <?= ucwords($barangayname) ?>, <?= ucwords($city) ?>,  <?= ucwords($province) ?> </h1>
                                                <hr class="mt-0 mb-0" style="border-top: 2px solid black; width:70%;">
                                                <h2 class="mt-0">(Owner Address)</h2>
                                            </div>
                                            <h2 class="mt-4 p-2" style="text-align:justify; text-justify: inter-word; text-indent:0px;  line-height: 1.6; color:black;">Proposed to be establised in this Barangay and is being applied for Barangay Business Clearance to be used in securing a corresponding Mayor's Permit has found 
                                                       to be in conformity with the provision of existing  Barangay Ordinances, Rules and Regulation being enforced in this Barangay.</h2>
                                            <h2 class="mt-3 p-2"style="text-align:justify; text-justify: inter-word; text-indent:0px;  line-height: 1.8; color:black;">This is non-transferable and shall be deemed null and void upon failure by the owner to follow the said rules and regulations set forth by the Local Government Unit of <span style="font-size:22px"><?= ucwords($city) ?>.</h2>
                                            <h2 class="mt-3 p-2"  style="font-size:20px; color:black">Given this <span class="fw-bold pl-1 pr-1" style="font-size:20px; color:black">  <?php $str = $permit['applied']; $date = date('F j, Y', strtotime($str)); echo $date; ?> </span> at <span style="font-size:20px"><?= ucwords($barangayname.', '.$city.', '.$province) ?></span>.</h2>

     <br><br><br>        


                                            <div class="row pl-5 ">
                                            <div class=" col-3 p-3 text-center">
                                                <h2 class="fw-bold mb-0 text-uppercase" style=" opacity: 0.0 ;position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                              
                                            </div>
                                            <div class=" col-4 p-3 text-center">
                                                <h2 class="fw-bold mb-0 text-uppercase" style="opacity: 0.0 ; position: relative; right:10px; text-decoration: underline;" ><?= ucwords($captain['name']) ?></h2>
                                              
                                            </div>
                   
                                            <div class=" col-4 p-2 mt-5  text-center">
                                                <h2 class="mr-4 fw-bold mb-0 text-uppercase" style=" color:black; " ><?= ucwords($captain['name']) ?></h2>
                                                <p class="mr-3 " style=" color:black;">PUNONG BARANGAY</p>
                                            </div>
                                           

       
                                          


                                        </div>

 

                                        <div class="row  mt-5 p-1"style=" color:black;   ">
                                            <div class=" col-3 ml-5  p-2 text-left">
                                            <h4 class="mb-0">Business No.: <b ></b></h4>
                                            <h4 class="mb-0">CTC No.: <b ></b></h4>
                                            <h4 class="mb-0">OR No. : <b ></b></h4>
                                            <h4 class="mb-0">Amount: : </h4>

                                            <h4 class="mb-0">Issued On: </h4>
                                            <h4 class="mb-0">Isuued at: </h4>
                                           
                                       
                                            </div>
                                            <div class=" col-3  p-2 text-left">
                                           
                                            <h4 class="mb-0"><b ><?=   ucwords($permit['busp_no']) ?></b></h4>
                                            <h4 class="mb-0"> <b ><?= $permit['ctc_no'] ?></b></h4>
                                                <h4 class="mb-0"><b ><?=   ucwords($permit['or_no'])  ?></b></h4>
                                                <h4 class="mb-0"> <b> &#8369 </b><b ><?= number_format($permit['amounts'],2) ?></b></h4>
                                                <h4 class="mb-0"><b><?=$permit['applied'] ?></b></h4>
                                                <h4 class="mb-0"> <b><?= ucwords($barangayname.','.$city) ?></b></h4>
                                               
                                            </div>
                                            <div class=" col-3 text-left" style="pointer-events: none;">
                                            
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
                                            <img src='https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=<?= $permit['busp_no'] ?><?= $permit['ctc_no'] ?><?=   ucwords($permit['or_no'])  ?>&choe=UTF-8'class="img-fluid shadow" style="" width=200>
                                            </div>--->
                                           

       
                                          


                                        </div>
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