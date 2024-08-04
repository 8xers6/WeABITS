
<?php include 'server/server.php' ?> 

<?php


$barno=$_SESSION['bar_no'];
// get Users





$state = $_GET['state'];
    
if($state=='payments'){


     if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
          
     $mindate= $_GET['mindate'];
     $maxdate=$_GET['maxdate'];
     
       if(!empty($_GET['type'])){
          
               $type=$_GET['type'];
               
               
               
                    if($type=="BarangayID"){
         
         	$query = "SELECT * FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id WHERE tbl_residents.bar_no=$barno AND tblbarangayid.date_issued  BETWEEN '$mindate' 
AND '$maxdate'  ";
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	    $query1 = "SELECT *,SUM(amounts) as total FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id WHERE tbl_residents.bar_no=$barno AND tblbarangayid.date_issued  BETWEEN '$mindate' 
AND '$maxdate'  ";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
         
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
               
               
                if($type=="Blotter"){
         
         	$query = "SELECT * FROM `tblblotter`  WHERE  bar_no=$barno AND created_at  BETWEEN '$mindate' 
AND '$maxdate'  ";
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	    $query1 = "SELECT *,SUM(amounts) as total FROM `tblblotter`  WHERE  bar_no=$barno AND created_at  BETWEEN '$mindate' 
AND '$maxdate' ";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
         
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
               
               
               
               
               
               
               
               
     
        if($type=='BusinessClearance'){
         
          
               
       
  $query = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tblbusinesspermit.applied 
  
  BETWEEN '$mindate' 
AND '$maxdate'
  ORDER BY tblbusinesspermit.busp_no;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    
   	  $query1 = "SELECT *,SUM(amounts) as total FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tblbusinesspermit.applied 
  
  BETWEEN '$mindate' 
AND '$maxdate' ORDER BY tblbusinesspermit.busp_no;";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
   

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
}


     if($type=='Cedula'){
         
          
          $query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblcedula` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblcedula.res_id WHERE tbl_residents.bar_no=$barno   AND tblcedula.date_issued  BETWEEN '$mindate' 
AND '$maxdate'";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
    
       $query1 = "SELECT *,SUM(amount) as total FROM `tblcedula` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblcedula.res_id WHERE tbl_residents.bar_no=$barno  AND tblcedula.date_issued  BETWEEN '$mindate' 
AND '$maxdate'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();


   
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
 
 $total = $result->num_rows;

     }
     
     
     
      if($type=="BarangayClearance"){
         
         	$query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id WHERE tbl_residents.bar_no=$barno AND tbl_barangayclearance.date_issued  BETWEEN '$mindate' 
AND '$maxdate'";
         	
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	
         	   $query1 = "SELECT *,SUM(amounts) as total FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id WHERE tbl_residents.bar_no=$barno  AND tbl_barangayclearance.date_issued  BETWEEN '$mindate' 
AND '$maxdate'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
     
         	
         	
         	
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
     
       if($type=="BuildingClearance"){
         
         	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tblbuilding_permit.applied  BETWEEN '$mindate' 
AND '$maxdate' ORDER BY tblbuilding_permit.bp_no;";
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	    $query1 = "SELECT *,SUM(amounts) as total  FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tblbuilding_permit.applied  BETWEEN '$mindate' 
AND '$maxdate'  ORDER BY tblbuilding_permit.bp_no;";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
         
     
     
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }





     }
       
     
     
     
    
      
     }else{
         
          if(!empty($_GET['type'])){
          
               $type=$_GET['type'];
               
               
                     if($type=='BusinessClearance'){
         
          
               
       
  $query = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,SUM(amounts) as total FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
     
  

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}


     }
     
     
     
           if($type=='Cedula'){
         
          
          $query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblcedula` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblcedula.res_id WHERE tbl_residents.bar_no=$barno";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
    
       $query1 = "SELECT *,SUM(amount) as total FROM `tblcedula` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblcedula.res_id WHERE tbl_residents.bar_no=$barno";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
    
    

    

    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
 


     }
     
     
     
             if($type=='BarangayID'){
         
          
          $query = "SELECT * FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id WHERE tbl_residents.bar_no=$barno";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
    
       $query1 = "SELECT *,SUM(amounts) as total FROM `tblbarangayid` LEFT JOIN tbl_residents ON tbl_residents.res_id=tblbarangayid.res_id WHERE tbl_residents.bar_no=$barno";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
    
    

    

    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
 


     }
     
     if($type=="BarangayClearance"){
         
         	$query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id WHERE tbl_residents.bar_no=$barno";
         	
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
    
    
     $query1 = "SELECT *,SUM(amounts) as total FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id WHERE tbl_residents.bar_no=$barno";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
     
         	
         	 
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
     
     
     
     
     
         if($type=="BuildingClearance"){
         
         	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	    $query1 = "SELECT *,SUM(amounts) as total  FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
         
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
     
     
         if($type=="Blotter"){
         
         	$query = "SELECT * FROM `tblblotter`  WHERE  bar_no=$barno ";
         	
         	  if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
         	
         	
         	    $query1 = "SELECT *,SUM(amounts) as total FROM `tblblotter`  WHERE  bar_no=$barno ";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalpayment = $result1->fetch_assoc();
         
    $resident = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}
         
     }
     
     
     
      }
   
         
     
         
         

     
    

}
  
}









?>




<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Print Payment Report -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Generate Report</h2>
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
										<div class="card-title">

                                     
	<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
											
												Choose Type
											</a>
                                 
                                     
                                        </div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Report
											</button>
										</div>
									</div>
									
								<div class="card-body " id="printThis">
                                <div class="d-flex flex-wrap justify-content-around" style="border-bottom:3px solid black">
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username']?>/barangayinfo/<?= $citylogo ?>" class="rounded-circle" width="160">
										</div>
										<div class="text-center">
                                            <h1 class="mb-0 fw-bold">Republic of the Philippines</h1>
                                            <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
											<h3 class="mb-0">City of 	<?= ucwords($city) ?></h3>
											<h3 class="mb-0"> Barangay <?= ucwords($barangayname) ?></i></h3>
                                            <p><i>Mobile No. <?= $phone ?></i></p>
                                           
										</div>
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="rounded-circle" width="160">
										</div>
									</div>
									<div class=" justify-content-center" style="position:absolute; display:none; left: 110px; top: 300px;opacity: 0.2;">
                                          
										  <img src="assets/uploads/<?= $_SESSION['username']?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='800'> 
										</div>
                                    <div class="text-center">
                                   <?php if($state=='payments'){
                                       
                                       
                                       
                                                   if(!empty($type)){
                                                       
                                                       
                                           
                                                   
                                                    
                                                    if($type=='BusinessClearance'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Business Clearance </h1>';
                                                    
                                                    }
                                                    
                                                     if($type=='BarangayClearance'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Barangay Clearance </h1>';
                                                    
                                                    }
                                                    
                                                    
                                                     if($type=='BuildingClearance'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Building Clearance </h1>';
                                                    
                                                    }
                                                    
                                                    
                                                     if($type=='Cedula'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Cedula </h1>';
                                                    
                                                    }
                                                    
                                                    
                                                       if($type=='Blotter'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Blotter </h1>';
                                                    
                                                    }
                                                    if($type=='BarangayID'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments - Barangay ID </h1>';
                                                    
                                                    }
                                                   }else{
                                                       
                                                       echo'<h1 class="mt-4 fw-bold" style="color:black;"> Choose Type </h1>';
                                                       
                                                   }
                                                    
                                                    
                                                }
                                                ?>
                                  
										</div>
                                        <?php               if($state=='payments' && !empty($type)): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="3" style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?php 
 if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
 
    $mindate= $_GET['mindate'];
    $maxdate=$_GET['maxdate'];


    echo  'Dates: '.$mindate.' to '.$maxdate;

 }else{

echo'All Payments';

 }



?>

</th>
   
   


       
    
        <th colspan="4" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Amount:  <?php if(!empty($totalpayment['total'])): ?>
												<b>&#8369</b> 
 													<?=number_format($totalpayment['total'],2)?> 
													<?php  else:?>
													<b>&#8369</b> 0
														<?php  endif ?>



</th>



      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Date</th>

<?php if($type!='Cedula'  ):  ?>



<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Control No</th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">O.R. No</th>


<?php endif ?>






<?php if($type!='Blotter'):  ?>

<?php if($type!='BarangayID'):  ?>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">CTC No.</th></th>
<?php endif ?>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">     Resident ID  </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Recepient</th>


<?php endif ?>
<?php if($type=='Blotter'):  ?>


<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Complainant</th>



<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Respondent</th>


<?php endif ?>
<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Amount</th>









</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

  
<?php


      if($type=='BusinessClearance'){
                                        echo $row['applied'];                
                                                   
                                                    
                                                    }
                                                    
                                                     if($type=='BarangayClearance'){
                                                      
                                                     echo $row['date_issued'];  
                                                    }
                                                    
                                                    
                                                     if($type=='BuildingClearance'){
                                                        
                                                     echo $row['applied'];  
                                                    
                                                    }
                                                    
                                                    
                                                     if($type=='Cedula'){
                                                        
                                                         echo $row['date_issued'];  
                                                    
                                                    }
                                                    
                                                       if($type=='BarangayID'){
                                                        
                                                         echo $row['date_issued'];  
                                                    
                                                    }
                                                      if($type=='Blotter'){
                                                        
                                                         echo $row['created_at'];  
                                                    
                                                    }


?>


</td>

<?php if($type!='Cedula'):  ?>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?php



    if($type=='BusinessClearance'){
                                                        
                                                   echo $row['busp_no'];
                                                    
                                                    }
                                                    
                                                     if($type=='BarangayClearance'){
                                                        
                                                       echo $row['bclearance_no'];
                                                    
                                                    }
                                                    
                                                    
                                                     if($type=='BuildingClearance'){
                                                        
                                                          echo $row['bp_no'];
                                                    
                                                    }
                                                    
                                                    
                                                         if($type=='Blotter'){
                                                        
                                                          echo $row['id'];
                                                    
                                                    }

   if($type=='BarangayID'){
                                                        
                                                          echo $row['id_no'];
                                                    
                                                    }


 ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['or_no']).' ' ?> 


</td>
<?php endif ?>


<?php if($type!='Blotter'):  ?>
<?php if($type!='BarangayID'):  ?>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['ctc_no']).' ' ?> 


</td>
<?php endif ?>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

</td>



<?php endif ?>
<?php if($type=='Blotter'):  ?>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?php if($row['complainant_type']=='Resident'): ?>
														    
														     	  <?php
									       
									          $resid=$row['complainant'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												      $clname=$rows['lastname'];
												    $cfname=$rows['firstname'];
												    $cmname=$rows['middlename'];
												    $csuffix=$rows['suffix'];
												     $cage=$rows['age'];
												      $ccontact=$rows['contact_no'];
												       $caddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														     
														     
														     
														      <sup style="color:green;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['complainant_type']=='Non-resident'): ?>
														     
														      <?php  $jsonobj =  $row['complainant'];

                                                                    $complainant = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $complainant->lastname.', '.$complainant->firstname.' '.$complainant->middlename.' '.$complainant->suffix;
                                                                      $cnlname=$complainant->lastname;
												    $cnfname=$complainant->firstname;
												    $cnmname=$complainant->middlename;
												    $cnsuffix=$complainant->suffix;
                                                                     
														    ?>
														    
														     <sup style="color:red;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>

</td>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

 <?php if($row['respondent_type']=='Resident'): ?>
														  	     	  <?php
									       
									          $resid=$row['respondent'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												    
												    
												    $rlname=$rows['lastname'];
												    $rfname=$rows['firstname'];
												    $rmname=$rows['middlename'];
												    $rsuffix=$rows['suffix'];
												    
												    $rage=$rows['age'];
												    $rcontact=$rows['contact_no'];
												     $raddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														  
														  
														  
														    <sup style="color:green;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['respondent_type']=='Non-resident'): ?>
														     <?php  $jsonobj =  $row['respondent'];

                                                                    $respondent = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $respondent->lastname.', '.$respondent->firstname.' '.$respondent->middlename.' '.$respondent->suffix;
                                                                     
                                                                     
                                                                            $rnlname=$respondent->lastname;
												    $rnfname=$respondent->firstname;
												    $rnmname=$respondent->middlename;
												    $rnsuffix=$respondent->suffix;
														    ?>
														    <sup style="color:red;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    

</td>
<?php endif ?>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">
<b>&#8369</b>
  
<?php
   
   
                                                     if($type=='Cedula'){
                                                        echo number_format($row['amount'],2);
                                                    
                                                    }else{
                                                        
                                                       echo number_format($row['amounts'],2);
                                                        
                                                    }
                                                    
                                                    
                                                    




?>

</td>




             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>
    <tfoot>
    <tr>
      
         <td colspan="2" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="2" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="2" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>
</table>


<?php            endif ?>
                                   

		


















              




































             




                                      
                                       
                                    
                                </div>
                                     
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			  <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Print Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  >
                                <input type="hidden"  name="state" value="payments" >
                              	<div class="form-group">
											<label>Payment to be printed</label>
											<select class="form-control" name="type" >
												<option disabled selected>Select Type</option>
												<option value="BusinessClearance">Business Clearance</option>
												<option value="BarangayClearance">Barangay Clearance</option>
												<option value="BuildingClearance">Building Clearance</option>
													<option value="BarangayID">Barangay ID</option>
										<option value="Blotter">Blotter</option>
													<option value="Cedula">Cedula</option>
													
											</select>
										</div>
										
										
										<div class="form-group">
Minimum Dates
                                        <input type="date" class="form-control"  name="mindate"  >
           

                            </div>
                            <div class="form-group">
Maximum Dates
                                        <input type="date" class="form-control"  name="maxdate" >
           

                            </div>
                              
                            
                        </div>
                        <div class="modal-footer">
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
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