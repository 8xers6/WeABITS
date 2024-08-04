
<?php include 'server/server.php' ?> 

<?php


$barno=$_SESSION['bar_no'];
// get Users





$state = $_GET['state'];
    
if($state=='children'){


     if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
          
     $mindate= $_GET['mindate'];
     $maxdate=$_GET['maxdate'];
     
       if(!empty($_GET['type'])){
          
               $type=$_GET['type'];
               
                 $street=$_GET['street'];
               
                     if($type=='All'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate' ";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
  

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}


     }
               
               
                             if($type=='Male'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate' AND tbl_residents.gender='Male' ";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate' AND tbl_residents.gender='Male'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
  

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}


     }
               
               
               if($type=='Female'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate' AND tbl_residents.gender='Female' ";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street' AND tbl_residents.birthdate BETWEEN '$mindate' AND '$maxdate' AND tbl_residents.gender='Female'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
  

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
               $street=$_GET['street'];
               
                     if($type=='All'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street'";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tblstreet.st_id='$street'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
  

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}


     }
     
     
            if($type=='Male'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tbl_residents.gender='Male' AND tblstreet.st_id='$street'";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tbl_residents.gender='Male' AND tblstreet.st_id='$street'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
  

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
        
    }
}


     }
     
     
        if($type=='Female'){
         
          
               
       
  $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tbl_residents.gender='Female' AND tblstreet.st_id='$street'";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

     $query1 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=17 AND tbl_residents.gender='Female' AND tblstreet.st_id='$street'";
       if (!$result1 = $conn->query($query1)) {
        exit($conn->error);
    }
     
     $totalchildren = $result1->num_rows;
     
$squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
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
	<title>Print Children Report -  Barangay Management System</title>
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

                                     
	<a href="#add" data-toggle="modal" class="btn btn-primary text-white">
											
												Sort by
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
                                   <?php if($state=='children'){
                                       
                                       
                                       
                                                   if(!empty($type)){
                                                       
                                                       
                                           
                                                   
                                                    
                                                    if($type=='Male'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Male Children </h1>';
                                                    
                                                    }
                                                    
                                                     if($type=='Female'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> Female Children </h1>';
                                                    
                                                    }
                                                    
                                                      if($type=='All'){
                                                        
                                                         echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Children </h1>';
                                                    
                                                    }
                                               
                                                   }else{
                                                       
                                                       echo'<h1 class="mt-4 fw-bold" style="color:black;"> Children Report </h1>';
                                                       
                                                   }
                                                    
                                                    
                                                }
                                                ?>
                                  
										</div>
                                        <?php               if($state=='children' && !empty($type)): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">
Birthdate:
<?php 
 if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
 
    $mindate= $_GET['mindate'];
    $maxdate=$_GET['maxdate'];


    echo  ''.$mindate.' to '.$maxdate;

 }else{

echo'No filter';

 }



?>

</th>
   
      <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Street Name: <?=$streetname?>



</th>


       
    
        <th colspan="4" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Children: <?=$totalchildren?>



</th>



      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">RES ID</th>





<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Full Name</th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">House No. & Street</th>








<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Birthdate</th></th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">     Age  </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Gender</th>









</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


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
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>



<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['birthdate']).' ' ?> 


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['age']).' ' ?> 
</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
<?= ucwords($row['gender']).' ' ?> 

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
                            <h5 class="modal-title" id="exampleModalLabel"> Print Childrens Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  >
                                <input type="hidden"  name="state" value="children" >
                              	<div class="form-group">
											<label>Gender</label>
											<select class="form-control" name="type" >
												<option disabled selected>Select Gender</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
												<option value="All">All Gender</option>
											
													
											</select>
										</div>
										<div class="form-group">
										    
										    <label class=" fw-bold">Street/Purok/Sitio</label>
<select name="street" class="form-control border"    required >
                                                            <option  selected value="">-- Select Street -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
										</div>
										
										<div class="form-group">
Minimum Date
                                        <input type="date" class="form-control" min="<?php

//Get last year's date in a YYYY-MM-DD format.
$lastYear = date("Y-m-d", strtotime("-17 years"));

//On 2019-08-22, this resulted in 2018-08-22.
echo $lastYear;


?>"  max="<?php

//Get last year's date in a YYYY-MM-DD format.
$lastYear = date("Y-m-d");

//On 2019-08-22, this resulted in 2018-08-22.
echo $lastYear;


?>"  name="mindate"  >
           

                            </div>
                            <div class="form-group">
Maximum Date
                                        <input type="date" min="<?php

//Get last year's date in a YYYY-MM-DD format.
$lastYear = date("Y-m-d", strtotime("-17 years"));

//On 2019-08-22, this resulted in 2018-08-22.
echo $lastYear;


?>"  max="<?php

//Get last year's date in a YYYY-MM-DD format.
$lastYear = date("Y-m-d");

//On 2019-08-22, this resulted in 2018-08-22.
echo $lastYear;


?>"     class="form-control"  name="maxdate" >
           

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