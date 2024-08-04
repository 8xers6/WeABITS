<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];


$resid=$_GET['id'];
  
	$query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.res_id='$resid' ";
    $result = $conn->query($query);
	$resident = $result->fetch_assoc();
     

    $hno 		= $resident['h_no'];
     $birthdate		= $resident['birthdate'];



    $query1 = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Head'";
    $result1 = $conn->query($query1);
	$father = $result1->fetch_assoc();


    $query2 = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Spouse' ";
    $result2 = $conn->query($query2);
	$mother = $result2->fetch_assoc();





    $query3 = "SELECT * FROM `tblimmunization` LEFT JOIN tbl_residents on tblimmunization.res_id=tbl_residents.res_id WHERE tblimmunization.res_id=$resid;";
                        $result3 = $conn->query($query3);

    $family = array();
	while($row = $result3->fetch_assoc()){
		$family[] = $row; 
	}
	
	
	//BCG
	$check = "SELECT * FROM tblimmunization WHERE immun_type='BCG' AND dose='1st Dose' AND res_id= $resid";
    $res = $conn->query($check);
    $BCG1 = $res->fetch_assoc();
	
	//hepb
	$check1 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='1st Dose' AND res_id= $resid";
    $res1 = $conn->query($check1);
   $HepB1 = $res1->fetch_assoc();
   
   
   
   	$check2 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='2nd Dose' AND res_id=$resid ";
    $res2 = $conn->query($check2);
   $HepB2 = $res2->fetch_assoc();
   
   
   	$check3 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='3rd Dose' AND res_id=$resid";
    $res3 = $conn->query($check3);
    $HepB3 = $res3->fetch_assoc();
    
    
    
    //rota
    
    $check4 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='1st Dose' AND res_id= $resid";
    $res4 = $conn->query($check4);
   $RV1 = $res4->fetch_assoc();
   
   
   
   	$check5 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='2nd Dose' AND res_id=$resid ";
    $res5 = $conn->query($check5);
   $RV2 = $res5->fetch_assoc();
   
   
   	$check6 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='3rd Dose' AND res_id=$resid";
    $res6 = $conn->query($check6);
    $RV3 = $res6->fetch_assoc();
    
    
    
    
    //DTaP
    
       $check7 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='1st Dose' AND res_id= $resid";
    $res7= $conn->query($check7);
   $DTaP1 = $res7->fetch_assoc();
   
   
   
   	$check8 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='2nd Dose' AND res_id=$resid ";
    $res8 = $conn->query($check8);
   $DTaP2= $res8->fetch_assoc();
   
   
   	$check9 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='3rd Dose' AND res_id=$resid";
    $res9 = $conn->query($check9);
    $DTaP3 = $res9->fetch_assoc();
    
    
    
     	$check10 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='4th Dose' AND res_id=$resid";
    $res10 = $conn->query($check10);
  $DTaP4= $res10->fetch_assoc();
  
  	$check10a = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='5th Dose' AND res_id=$resid";
    $res10a = $conn->query($check10a);
  $DTaP5= $res10a->fetch_assoc();
  
  
  
  //Hib
  
    	$check11 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='1st Dose' AND res_id=$resid ";
    $res11 = $conn->query($check11);
   $Hib1= $res11->fetch_assoc();
   
   
   	$check12 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='2nd Dose' AND res_id=$resid";
    $res12 = $conn->query($check12);
    $Hib2 = $res12->fetch_assoc();
    
    
    
    $check13 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='3rd Dose' AND res_id=$resid";
    $res13 = $conn->query($check13);
    $Hib3= $res13->fetch_assoc();
    
     $check13a = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='4th Dose' AND res_id=$resid";
    $res13a = $conn->query($check13a);
    $Hib4= $res13a->fetch_assoc();
  
  
    //PCV
    
    
           $check14 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='1st Dose' AND res_id= $resid";
    $res14= $conn->query($check14);
   $PCV1 = $res14->fetch_assoc();
   
   
   
   	$check15 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='2nd Dose' AND res_id=$resid ";
    $res15 = $conn->query($check15);
   $PCV2= $res15->fetch_assoc();
   
   
   	$check16 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='3rd Dose' AND res_id=$resid";
    $res16 = $conn->query($check16);
    $PCV3 = $res16->fetch_assoc();
    
    
    
     	$check17 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='4th Dose' AND res_id=$resid";
    $res17 = $conn->query($check17);
  $PCV4= $res17->fetch_assoc();
  

    
    //IPV
    
    
     $check18 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='1st Dose' AND res_id= $resid";
    $res18= $conn->query($check18);
   $IPV1 = $res18->fetch_assoc();
   
   
   
   	$check19 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='2nd Dose' AND res_id=$resid ";
    $res19 = $conn->query($check19);
   $IPV2= $res19->fetch_assoc();
   
   
   	$check20 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='3rd Dose' AND res_id=$resid";
    $res20 = $conn->query($check20);
    $IPV3 = $res20->fetch_assoc();
    
    
    
     	$check21 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='4th Dose' AND res_id=$resid";
    $res21 = $conn->query($check21);
  $IPV4= $res21->fetch_assoc();
    
    
    
    
    //Flu
    
    
    	$check22 = "SELECT * FROM tblimmunization WHERE immun_type='Flu' AND dose='1st Dose' AND res_id=$resid";
    $res22 = $conn->query($check22);
  $Flu1= $res22->fetch_assoc();
    
    
    
    
    //MMR
    
    $check23 = "SELECT * FROM tblimmunization WHERE immun_type='MMR' AND dose='1st Dose' AND res_id= $resid";
    $res23= $conn->query($check23);
   $MMR1 = $res23->fetch_assoc();
   
   
   
   	$check24 = "SELECT * FROM tblimmunization WHERE immun_type='MMR' AND dose='2nd Dose' AND res_id=$resid ";
    $res24 = $conn->query($check24);
   $MMR2= $res24->fetch_assoc();
    
    
    
    
    
    
    
    //Varicella
    
      $check25 = "SELECT * FROM tblimmunization WHERE immun_type='Varicella' AND dose='1st Dose' AND res_id= $resid";
    $res25= $conn->query($check25);
   $Varicella1 = $res25->fetch_assoc();
   
   
   
   	$check26 = "SELECT * FROM tblimmunization WHERE immun_type='Varicella' AND dose='2nd Dose' AND res_id=$resid ";
    $res26 = $conn->query($check26);
   $Varicella2= $res26->fetch_assoc();
    
    
    
    
    //HepA
  
      $check27 = "SELECT * FROM tblimmunization WHERE immun_type='HepA' AND dose='1st Dose' AND res_id= $resid";
    $res27= $conn->query($check27);
   $HepA1 = $res27->fetch_assoc();
   
   
   
   	$check28 = "SELECT * FROM tblimmunization WHERE immun_type='HepA' AND dose='2nd Dose' AND res_id=$resid ";
    $res28 = $conn->query($check28);
   $HepA2= $res28->fetch_assoc();
  
  
    
    

	
	
    
    $date1 = new DateTime($birthdate);
$date2 = new DateTime(date('Y-m-d'));
$interval = $date1->diff($date2);
$months = ($interval->y * 12) + $interval->m;


$age=$months.' Months'




    
    
 

	
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>New Born Details - Weabits</title>
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

							</div>
						</div>
					</div>
				</div>
				
				<div class="page-inner mt--2">

              

           <!-- Modal -->
		
                   
         
<form id="formapps" enctype="multipart/form-data"  method="post">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">

<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>Children Information</b></h2>
</div>









</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white  border shadow rounded justify-content-start">
<div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Resident ID</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['res_id']) ?>" >

                               </div>

<div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Firstname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['firstname']) ?>" >

                               </div>

                               <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label >Middlename</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['middlename']) ?>" >
                               

                               </div>


                               <div class="col-md-3   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Lastname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['lastname']) ?>" >

                               </div>




                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>suffix</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['suffix'] ?>" >

                               </div>

                               <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label >Gender</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['gender']) ?>" >
                               

                               </div>

                               <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               <label >Birth Date</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="  <?php $str = $resident['birthdate']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                               

                               </div>
                               
                               <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label >Age</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="  <?php echo $age; ?>" >
                               

                               </div>

                        

                               <div class="col-md-4 m-1 p-1 border rounded shadow-sm">
                               <label >Address</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['household_no']) ?> <?= ucwords($resident['streetname']) ?>" >
                               

                               </div>


                               <div class="col-md-4   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Parent Name /Guardian Name</label>
                               <?php  if(!empty($father)): ?>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($father['firstname']) ?> <?= ucwords($father['middlename']) ?> <?= ucwords($father['lastname']) ?>" >
                               <?php  endif ?>
                               </div>

                               <div class="col-md-4 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Parent Name/ Guardian</label>
                               <?php  if(!empty($mother)): ?>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($mother['firstname']) ?> <?= ucwords($mother['middlename']) ?> <?= ucwords($mother['lastname']) ?>" >
                               <?php  endif   ?>        
                               </div>

                            






      

                               






					</div>


					</div>



                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?> mt-2" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>


                    <div class="card border mt-2">
                               <div class="card-header">
									<div class="card-head-row">
										<div class="card-title">
										    <a href="#">Recommended Immunizations for Children from Birth Through 6 Years Old</a>
										    
										    										    	
											
										    
										    
										    </div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">

											
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Immunization
											</a>
										</div>
                                        <?php endif ?>
									</div>
								</div>
                       
                       
                       
                       <div class="ml-4">
                           
                           
                           <a class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Vaccinated</a>
                                       	<a class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Not Vaccinated</a>
											<a class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Ready for Vaccination</a>
                       </div>
                               <div class="card-body">
                             
                                 <div class="table-responsive text-center  ">
<table class=" table-bordered  border border-secondary " style="width:100%;" >
<caption class="sr-only caption-top">2023 Recommended Immunizations for Children from Birth Through 6 Years Old</caption>
<thead class=" ">
<tr >
<th id="vaccine" class="text-align-center" border="1">Vaccine</th>
<th id="birth" class="text-align-center">
<div class="circle">
<div class=" bg-primary rounded text-white p-3 ">Birth</div>
</div>
<div style="color:white;"> Birth</div>
</th>
<th id="month1" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">1</div>
</div>
<div>Month</div>
</th>
<th id="months2" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">2</div>
</div>
<div>Months</div>
</th>
<th id="months4" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">4</div>
</div>
<div>Months</div>
</th>
<th id="months6" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">6</div>
</div>
<div>Months</div>
</th>
<th id="months12" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">12</div>
</div>
<div>Months</div>
</th>
<th id="months15" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">15</div>
</div>
<div>Months</div>
</th>
<th id="months18" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">18</div>
</div>
<div>Months</div>
</th>
<th id="months19" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">19-23</div>
</div>
<div>Months</div>
</th>
<th id="years2" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3">2-3</div>
</div>
<div>Years</div>
</th>
<th id="years4" class="text-align-center">
<div class="circle">
<div class="bg-success rounded text-white p-3 text-center">4-6</div>
</div>
<div>Years</div>
</th>
</tr>
</thead>
<tbody>
    
    <!---bcg--->
    
    <tr>
<th id="hepb" class="" >BCG
<div class="fs0875">Bacillus Calmette-Guérin</div>
</th>
<td headers="hepb birth  " >
<div class="rectangle-red ">
    
     <?php if(empty($BCG1) && $months==0): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">BCG</div>
     
     
     <?php else: ?>
    <?php if(!empty($BCG1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">BCG</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">BCG</div>

<?php endif ?>



<?php endif ?>



</div>

</td>
<td class="right-border-none" colspan="2" headers="hepb month1 months2">
<div class="rectangle-red percent-100">

     



</div>
</td>
<td headers="hepb months4"></td>
<td colspan="4" headers="hepb months6 months12 months15 months18">
<div class="rectangle-red percent-100">


</div>
</td>
<td headers="months19"></td>
<td headers="years2"></td>
<td headers="years4"></td>
</tr>



<!--bcg-->
<tr>
<th id="hepb" class="" >HepB
<div class="fs0875">Hepatitis B</div>
</th>
<td headers="hepb birth  " >
<div class="rectangle-red ">
    
     <?php if(empty($HepB1) && $months==0): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>
     
     
     <?php else: ?>
    <?php if(!empty($HepB1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php endif ?>



<?php endif ?>



</div>

</td>
<td class="right-border-none" colspan="2" headers="hepb month1 months2">
<div class="rectangle-red percent-100">
     <?php if(empty($HepB2) && $months>=1 && $months<=2): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>
     
     
     <?php else: ?>
     
     
     <?php if(!empty($HepB2) ): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php endif ?>



<?php endif ?>
     



</div>
</td>
<td headers="hepb months4"></td>
<td colspan="4" headers="hepb months6 months12 months15 months18">
<div class="rectangle-red percent-100">

 <?php if(empty($HepB3)&& $months>=6 && $months<=18): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>
     
     
     <?php else: ?>

<?php if(!empty($HepB3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">HepB</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="months19"></td>
<td headers="years2"></td>
<td headers="years4"></td>
</tr>
<tr>
<th id="rv" class="border-left-pink">RV<sup class="font-size-14">*</sup>
<div class="fs0875">Rotavirus</div>
</th>
<td headers="rv birth"></td>
<td headers="rv month1"></td>
<td headers="rv months2">
<div class="rectangle-pink">
    
    
 <?php if(empty($RV1)&& $months==2 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">RV</div>
     
     
     <?php else: ?>

<?php if(!empty($RV1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="rv months4">
<div class="rectangle-pink">
 <?php if(empty($RV2)&& $months==4 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">RV</div>
     
     
     <?php else: ?>

<?php if(!empty($RV2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="rv months6">
<div class="rectangle-pink">
 <?php if(empty($RV3)&& $months==6 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">RV</div>
     
     
     <?php else: ?>

<?php if(!empty($RV3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">RV</div>

<?php endif ?>

<?php endif ?></div>
</div>
</td>
<td headers="rv months12"></td>
<td headers="rv months15"></td>
<td headers="rv months18"></td>
<td headers="rv months19"></td>
<td headers="rv years2"></td>
<td headers="rv years4"></td>
</tr>
<tr>
<th id="DTaP" class="border-left-purple">DTaP
<div class="fs0875">Diphtheria, Pertussis, &amp; Tetanus</div>
</th>
<td headers="DTaP birth"></td>
<td headers="DTaP month1"></td>
<td headers="DTaP months2">
<div class="rectangle-purple">
    
     <?php if(empty($DTaP1)&& $months==2 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>
     
     
     <?php else: ?>

<?php if(!empty($DTaP1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php endif ?>

<?php endif ?>

</div>
</td>
<td headers="DTaP months4">
<div class="rectangle-purple">

    <?php if(empty($DTaP2)&& $months==4 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>
     
     
     <?php else: ?>

<?php if(!empty($DTaP2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php endif ?>

<?php endif ?>


</div>
</td>
<td headers="DTaP months6">
<div class="rectangle-purple">

    <?php if(empty($DTaP3)&& $months==6 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>
     
     
     <?php else: ?>

<?php if(!empty($DTaP3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php endif ?>

<?php endif ?>


</div>
</td>
<td headers="DTaP months12"></td>
<td colspan="2" headers="DTaP months15 months18">
<div class="rectangle-purple percent-100">



    <?php if(empty($DTaP4)&& $months>=15 && $months<=18 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>
     
     
     <?php else: ?>

<?php if(!empty($DTaP4)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="DTaP months19"></td>
<td headers="DTaP years2"></td>
<td headers="DTaP years4">
<div class="rectangle-purple">

    <?php if(empty($DTaP5) && $months>=36 && $months<=59 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>
     
     
     <?php else: ?>

<?php if(!empty($DTaP5)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">DTaP</div>

<?php endif ?>

<?php endif ?>



</div>
</td>
</tr>
<tr>
<th id="hib" class="border-left-deep-purple">Hib<sup class="font-size-14">*</sup>
<div class="fs0875"><em>Haemophilus influenzae</em> type b</div>
</th>
<td headers="hib birth"></td>
<td headers="hib month1"></td>
<td headers="hib months2">
<div class="rectangle-deep-purple">
    <?php if(empty($Hib1)&& $months==2 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>
     
     
     <?php else: ?>

<?php if(!empty($Hib1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="hib months4">
<div class="rectangle-deep-purple">

   <?php if(empty($Hib2)&& $months==4 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>
     
     
     <?php else: ?>

<?php if(!empty($Hib2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php endif ?>

<?php endif ?>


</div>
</td>
<td headers="hib months6">
<div class="rectangle-deep-purple">
  <?php if(empty($Hib3)&& $months==6 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>
     
     
     <?php else: ?>

<?php if(!empty($Hib3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td colspan="2" headers="hib months12 months15">
<div class="rectangle-deep-purple percent-100">
  <?php if(empty($Hib4)&& $months>=12 && $months<=15 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>
     
     
     <?php else: ?>

<?php if(!empty($Hib4)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Hib</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="hib months18"></td>
<td headers="hib months19"></td>
<td headers="hib years2"></td>
<td headers="hib years4"></td>
</tr>
<tr>
<th id="pcv" class="border-left-deep-blue">PCV13, PCV15
<div class="fs0875">Pneumococcal disease</div>
</th>
<td headers="pcv birth"></td>
<td headers="pcv month1"></td>
<td headers="pcv months2">
<div class="rectangle-deep-blue">
   <?php if(empty($PCV1)&& $months==2 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>
     
     
     <?php else: ?>

<?php if(!empty($PCV1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="pcv months4">
<div class="rectangle-deep-blue">
  <?php if(empty($PCV2)&& $months==4 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>
     
     
     <?php else: ?>

<?php if(!empty($PCV2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="pcv months6">
<div class="rectangle-deep-blue">

  <?php if(empty($PCV3)&& $months==6 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>
     
     
     <?php else: ?>

<?php if(!empty($PCV3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php endif ?>

<?php endif ?>

</div>
</td>
<td colspan="2" headers="pcv months12 months15">
<div class="rectangle-deep-blue percent-100">
  <?php if(empty($PCV4)&& $months>=12 && $months<=15 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>
     
     
     <?php else: ?>

<?php if(!empty($PCV4)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">PCV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="pcv months18"></td>
<td headers="pcv months19"></td>
<td headers="pcv years2"></td>
<td headers="pcv years4"></td>
</tr>
<tr>
<th id="ipv" class="border-left-dark-blue">IPV
<div class="fs0875">Polio</div>
</th>
<td headers="ipv birth"></td>
<td headers="ipv months1"></td>
<td headers="ipv months2">
<div class="rectangle-dark-blue">
  <?php if(empty($IPV1)&& $months==2 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>
     
     
     <?php else: ?>

<?php if(!empty($IPV1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
<td headers="ipv months4">
<div class="rectangle-dark-blue">

  <?php if(empty($IPV2)&& $months==4 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>
     
     
     <?php else: ?>

<?php if(!empty($IPV2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php endif ?>

<?php endif ?>

</div>
</td>
<td colspan="4" headers="ipv months6 months12 months15 months18">
<div class="rectangle-dark-blue percent-100">

  <?php if(empty($IPV3)&& $months>=6 && $months<=18 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>
     
     
     <?php else: ?>

<?php if(!empty($IPV3)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php endif ?>

<?php endif ?>

</div>
</td>
<td headers="ipv months19"></td>
<td headers="ipv years2"></td>
<td headers="ipv years4">
<div class="rectangle-dark-blue">


  <?php if(empty($IPV4)&& $months>=36 && $months<=59 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>
     
     
     <?php else: ?>

<?php if(!empty($IPV4)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">IPV</div>

<?php endif ?>

<?php endif ?>
</div>
</td>
</tr>

<!----
<tr>
    
    
<th id="covid-19" class="border-left-blue">COVID-19<sup class="font-size-14">**</sup>
<div class="fs0875">Coronavirus disease 2019</div>
</th>
<td headers="covid-19 birth"></td>
<td headers="covid-19 month1"></td>
<td headers="covid-19 months2"></td>
<td headers="covid-19 months4"></td>
<td colspan="7" headers="covid-19 months6 months12 months15 months18 months19 years2 years4">
<div class="rectangle-blue percent-100">
<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">COVID-19<sup class="font-size-14">**</sup></div>
</div>
</td>
</tr>



---->
<tr>
<th id="flu" class="border-left-deep-green">Flu<sup class="font-size-14"></sup>
<div class="fs0875">Influenza</div>
</th>
<td headers="flu birth"></td>
<td headers="flu month1"></td>
<td headers="flu months2"></td>
<td headers="flu months4"></td>
<td colspan="7" headers="flu months6 months12 months15 months18 months19 years2 years4">
<div class="rectangle-deep-green-flu">
    
   <?php if(empty($Flu1)&& $months>=6 && $months<=59 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Flu (One or Two Doses Yearly)</div>
     
     
     <?php else: ?>

<?php if(!empty($Flu1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Flu (One or Two Doses Yearly)</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Flu (One or Two Doses Yearly)</div>

<?php endif ?>

<?php endif ?>   
    

</div>
</td>
</tr>
<tr>
<th id="mmr" class="border-left-green">MMR
<div class="fs0875">Measles, Mumps, &amp; Rubella</div>
</th>
<td headers="mmr birth"></td>
<td headers="mmr month1"></td>
<td headers="mmr months2"></td>
<td headers="mmr months4"></td>
<td headers="mmr months6"></td>
<td colspan="2" headers="mmr months12 months15">
<div class="rectangle-green percent-100">
<?php if(empty($MMR1)&& $months==12 && $months<=15 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>
     
     
     <?php else: ?>

<?php if(!empty($MMR1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>

<?php endif ?>

<?php endif ?>   
</div>
</td>
<td headers="mmr months18"></td>
<td headers="mmr months19"></td>
<td headers="mmr years2"></td>
<td headers="mmr years4">
<div class="rectangle-green">

<?php if(empty($MMR2)&& $months==36 && $months<=59 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>
     
     
     <?php else: ?>

<?php if(!empty($MMR2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">MMR</div>

<?php endif ?>

<?php endif ?>   

</div>
</td>
</tr>
<tr>
<th id="var" class="border-left-orange">Varicella
<div class="fs0875">Chickenpox</div>
</th>
<td headers="var birth"></td>
<td headers="var month1"></td>
<td headers="var months2"></td>
<td headers="var months4"></td>
<td headers="var months6"></td>
<td colspan="2" headers="var months12 months15">
<div class="rectangle-orange percent-100">

<?php if(empty($Varicella1)&& $months==12 && $months<=15 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>
     
     
     <?php else: ?>

<?php if(!empty($Varicella1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>

<?php endif ?>

<?php endif ?>   

</div>
</td>
<td headers="var months18"></td>
<td headers="var months19"></td>
<td headers="var years2"></td>
<td headers="var years4">
<div class="rectangle-orange">

<?php if(empty($Varicella2)&& $months==36 && $months<=59 ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>
     
     
     <?php else: ?>

<?php if(!empty($Varicella2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">Varicella</div>

<?php endif ?>

<?php endif ?> 


</div>
</td>
</tr>
<tr>
<th id="hepa" class="border-left-deep-orange">HepA<sup class="font-size-14"></sup>
<div class="fs0875">Hepatitis A</div>
</th>
<td headers="hepa birth"></td>
<td headers="hepa month1"></td>
<td headers="hepa months2"></td>
<td headers="hepa months4"></td>
<td headers="hepa months6"></td>
<td headers="hepa months12">
<div class="rectangle-deep-orange">

<?php if(empty($HepA1)&& $months==12  ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>
     
     
     <?php else: ?>

<?php if(!empty($HepA1)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>

<?php endif ?>

<?php endif ?> 

</div>
</td>
<td headers="hepa months15"></td>
<td colspan="2" headers="hepa months18 months19">
<div class="rectangle-deep-orange percent-100">

<?php if(empty($HepA2)&& $months>=18 && $months<=23  ): ?>
     
     <div class="bg-warning p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>
     
     
     <?php else: ?>

<?php if(!empty($HepA2)): ?>
<div class="bg-success p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>

<?php else: ?>

<div class="bg-danger p-2  text-white fw-bold" style="border-radius:20px;">HepA</div>

<?php endif ?>

<?php endif ?> 

</div>
</td>
<td headers="hepa years2"></td>
<td headers="hepa years4"></td>
</tr>
</tbody>
</table>
</div>
                            

                        
                           
                           
                           
                           
                           
                               
                                           <div class="table-responsive  mt-3">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Vaccine</th>
                                                    <th scope="col">Date Visit</th>
                                                    <th scope="col">Dose</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($family)): ?>
                                                    <?php $no=1; foreach($family as $row): ?>
                                                    <tr>
                                                        <td><?= $row['immun_type'] ?></td>
                                                        <td><?= $row['date_visit'] ?></td>
                                                    <td><?=$row['dose'] ?></td>
                                                        <td>
                                                            <!----
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class=" btn btn-link btn-primary"  style="font-size:20px; color:white;" data-original-title="View Resident Info" onclick="editImmune(this)" 
                                                                data-immno="<?= $row['immun_no'] ?>"   data-immtype="<?= $row['immun_type'] ?>"  data-datevisit="<?= $row['date_visit'] ?>" 
                                                              
                                                                    >
    


                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
--->
                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='BHW'):?>
                                                                    <!----
																<a type="button" data-toggle="tooltip" href="generate_residents.php?id=<?= $row['res_id'] ?>" class="btn btn-link btn-info" data-original-title="View Resident Info">
																	<i class="fa fa-file"></i>
																</a>---->

                                                                <a type="button" data-toggle="tooltip" href="model/remove_imm.php?id=<?= $row['res_id'] ?>&im=<?=$row['immun_no']?>" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-link btn-danger" style="font-size:13px; color:white;" data-original-title="Remove">
																  <i class="fa fa-times"></i>
																</a>
                                                                <?php endif ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                 <th scope="col">Vaccine</th>
                                                    <th scope="col">Date Visit</th>
                                                    <th scope="col">Dose</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                           
                           
                           
                           
                           
               
        
                           
                                           </div>
                                           
                                           
                                           
                                       
                        




                   

						
</form>

						</div>
						</div>


                    



                      <!-- Modal -->
                      <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Immunization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addimmunization.php" >


 
                          
                                <div class="form-group">
                                    <label>Immunization type</label>
                                    <input type="hidden" class="form-control"  name="res_id" value="<?=$resident['res_id'] ?>" required>
                                      <input type="hidden" class="form-control"  name="age" value="<?= $months ?>" required>
                                   <select class="form-control"  name="immun_type"  required>
                                                   <option disabled selected value="">Select Immmunization Type</option>
  <option value="BCG">BCG (Bacillus Calmette-Guérin)</option>
  <option value="HepB">Hepatitis B</option>
  <option value="RV">Rotavirus</option>
  <option value="DTaP">DTaP (Diphtheria, Tetanus, Pertussis)</option>
  <option value="Hib">Hib (Haemophilus influenzae type b)</option>
    <option value="PCV">PCV (Pneumococcal Conjugate Vaccine)</option>
  <option value="IPV">IPV (Inactivated Polio Vaccine)</option>
   <option value="Flu">Flu(influenza)</option>
  <option value="MMR">MMR (Measles, Mumps, Rubella)</option>
  <option value="Varicella">Varicella (Chickenpox)</option>
  <option value="HepA">Hepatitis A</option>
                                                 
                                                   
                                                       </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Visit</label>
                                    <input type="date" class="form-control"  name="date_visit" value="<?php echo date('Y-m-d');?>" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>










                   <!-- Modal -->
                   <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Immunization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_imm.php" >
                                <div class="form-group">
                                    <label>Immunization type</label>
                                    <input type="hidden" class="form-control"  name="res_id" value="<?=$resident['res_id'] ?>" required>
                                    <input type="hidden" class="form-control"  name="imm_no" id="immno" required>
                                   <select class="form-control"  name="immun_type"  required id="immtype">
                                                   <option disabled selected value="">Select Immmunization Type</option>
                                                  <option value="BCG">BCG (Bacillus Calmette-Guérin)</option>
  <option value="HepB">Hepatitis B</option>
  <option value="RV">Rotavirus</option>
  <option value="DTaP">DTaP (Diphtheria, Tetanus, Pertussis)</option>
  <option value="Hib">Hib (Haemophilus influenzae type b)</option>
    <option value="PCV">PCV (Pneumococcal Conjugate Vaccine)</option>
  <option value="IPV">IPV (Inactivated Polio Vaccine)</option>
   <option value="Flu">Flu(influenza)</option>
  <option value="MMR">MMR (Measles, Mumps, Rubella)</option>
  <option value="Varicella">Varicella (Chickenpox)</option>
  <option value="HepA">Hepatitis A</option>
                                                 
                                                   
                                                       </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Visit</label>
                                    <input type="date" class="form-control"  name="date_visit" id="datevisit"  required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
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
        $(document).ready(function() {
            
            $('.search_select_box select').selectpicker();
            
             $('#streettable').DataTable();
        });
    </script>


<script>


$(document).ready(function (e) {
  $("#formapps").on('submit',(function(e) {
   e.preventDefault();


   
   document.getElementById("acceptbtn").style.display = "none";
   document.getElementById("declinebtn").style.display = "none";
  
   document.getElementById("loading").style.display = "block";
   $.ajax({
    url: "model/accept_application.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success: function(data)
       { 
        document.getElementById("loading").style.display = "block";
       
        $('#notiferr').html(data);
     
        if($.trim(data)=="isempty"){
           
   document.getElementById("decline").style.display = "block";
   document.getElementById("accept").style.display = "block";
           
    
            document.getElementById("loading").style.display = "none";


        }else{


            if($.trim(data)=="success"){
                document.getElementById("loading").style.display = "none";
                window.location.pathname = ('/weabits/verify')
        //$('#errwarning').html(data);
        
        //$('#notiferr').html(' <b  class="border p-2 rounded border-success fw-bold pl-5 pr-5" style="color:green; letter-spacing:3px;">VERIFIED <b class="bg-danger text-white rounded  pl-1 pr-0">&#10003</b></b>');
  

     
  
      }else{
         
       // $('#notiferr').html('<b style="color:green; font-size:14px;">Verified Success!</b>');
         
      }
        }



    
         
     
       },
       
     
     
               
     });
  }));
 }); 





</script>

</body>
</html>

