<?php include 'server/server.php' ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Pregnant Checkup- Weabits</title>
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

		<?php 

 $barno=$_SESSION['barno'];
 $hno=$resident['h_no'];
 
 $resid=$_GET['resid'];



$query1 = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd,tbl_residents.username as user FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.res_id='$resid'";
$result1 = $conn->query($query1);
$residenthealth = $result1->fetch_assoc();

 




    $query2 = "SELECT * FROM `tblimmunization` LEFT JOIN tbl_residents on tblimmunization.res_id=tbl_residents.res_id WHERE tblimmunization.res_id=$resid;";
                        $result2 = $conn->query($query2);

    $immune = array();
	while($row = $result2->fetch_assoc()){
		$immune[] = $row; 
	}





	$query3 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM `tblpatient` LEFT JOIN tbl_residents on tblpatient.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE   tbl_residents.res_id=$resid AND  tbl_residents.bar_no=$barno; ";
    $result3 = $conn->query($query3);

    $patient = array();
	while($row = $result3->fetch_assoc()){
		$patient[] = $row; 
	}
	
	
	
	$query4= "SELECT *FROM tblreqmedicine LEFT join tbl_residents on tblreqmedicine.res_id=tbl_residents.res_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.res_id=$resid";
$result4= $conn->query($query4);

$reqmed= array();
while($row = $result4->fetch_assoc()){
$reqmed[] = $row; 
}



$pregno=$_GET['pregno'];

$query5 = "SELECT * FROM `tblpreg_checkup` WHERE `preg_no`=$pregno";
                        $result5 = $conn->query($query5);

    $pregnant = array();
	while($row = $result5->fetch_assoc()){
		$pregnant[] = $row; 
	}
	
	
	
	
	
	
	  
$query6 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM `tblpregnant` LEFT JOIN tbl_residents on tblpregnant.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbl_residents.pregnant='Yes'  AND tbl_residents.bar_no=$barno AND  tbl_residents.res_id=$resid ";
$result6 = $conn->query($query6);
	$pregresident = $result6->fetch_assoc();


	
?>

		<div class="main-panel">
			<div class="content">
      <div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
										<h2 class="text-white fw-bold"><button type="button" class="btn btn-primary shadow-sm fw-bold border "  onclick="goBack()">Go back</button></h2>
							</div>
						</div>
					</div>
				</div>
				
				<div class="mt-1 ">


                <div class="accordion" id="accordionExample">

  


   
    
    
    <?php  if($residenthealth['gender']=='Female' && $residenthealth['pregnant']=='Yes' ): ?>
  <div class="card">

   
        <button class="btn bg-primary-gradient collapsed text-white fw-bold ml-1 mr-1 mt-1" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           Pregnant Check Up Details
        </button>
 

    <div id="collapseTwo" class="collapse border ml-1 mr-1 " aria-labelledby="heading" data-parent="#accordionExample">
   

  
 <div class="card  bg-white ">
                          
                               <div class="card-body p-3 bg-white">
                            
                            

                                 
                               <?php if(!empty($pregnant)): ?>
                                            <?php $no=1; foreach($pregnant as $row): ?>
                               <div class="main-form  m-2">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 p-3 ">
                                
                                          
                                        
                             
                     


                                                                 
													
                                        </div>
                                    </div>
                                    <div class="col-md-6 bg-white">
                                        <div class="form-group">
                                            <label for="">Check Up Type</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['type'])  ?>" >
                                        </div>
                                    </div>
                                  
                                    
                                    
                                          <div class="col-md-5">
                                        <div class="form-group mb-2">
                                            <label for="">Date Visit</label><br>
                                  <input type="text" class="form-control fw-bold" readonly style="font-size:18px; color:black;" value="<?php $str = $row['date_visit']; $date = date('F j, Y', strtotime($str)); echo $date; ?>">
                                            
                                        </div>
                                    </div>
                                    
                                    
                               


                                   
                                 
                                 
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Record Check Up</h1>
                           
                           <?php endif ?>
                                    
                        




       

 
			

  </div>
  </div>
 </div>


<?php endif ?>















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
        $(document).ready(function() {
            
            $('.search_select_box select').selectpicker();
        });
    </script>




</body>
</html>

