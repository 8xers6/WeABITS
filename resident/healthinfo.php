<?php include 'server/server.php' ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Health Information - Weabits</title>
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



$query5 = "SELECT * FROM `tblpregnant` WHERE  res_id=$resid";
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
  <div class="card ">

  
        <button class="btn bg-primary-gradient text-white ml-1 mr-1 fw-bold" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Resident Health Information
        </button>
    
   

    <div id="collapseOne" class="ml-1 mr-1 collapse show border bg-white "  aria-labelledby="headingOne" data-parent="#accordionExample">
  

<div class="row ml-3 mr-3 pl-2 pr-2 pt-1 pb-3   justify-content-center">









                          
                           



                          

<div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label >First Name</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['firstname']) ?>" >
                     
                           </div>


                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Middle Name</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['middlename']) ?>" >
                     
                           </div>


                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Last Name</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['lastname']) ?>" >
                         
                           </div>

                           <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                           
                           
                           <label>Suffix</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['suffix']) ?>" >
                           </div>


<div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Gender</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['gender']) ?>" >
                     
                           </div>  
              
              <div class="col-md-4 m-1 p-1 border rounded shadow-sm">
                           
                      <i class="fas fa-birthday-cake"></i>
<label> Birthdate</label>
 <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?php $str = $residenthealth['birthdate']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >

                           </div>  
              
              
              <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label>Age</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['age']) ?>" >
                     
                           </div>  
                           
                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Relationship to Family</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['relation']) ?>" >
                     
                           </div>
                           
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Vaccine Brand</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['vaccine_brand']) ?>" >
                     
                           </div>
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Latest Vaccination Status</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['vaccine_status']) ?>" >
                     
                           </div>
                           
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Ailment</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['ailment']) ?>" >
                     
                           </div>
                           
                           
                           
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Bloodtype</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['blood_type']) ?>" >
                     
                           </div>
                           
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Height</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['height']) ?>" >
                     
                           </div>
                           
                           
                             <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Weight</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($residenthealth['weight']) ?>" >
                     
                           </div>
              



					</div>










                   

						


  </div>
  
  
    <div class="card mt-1">

  
        <button class="btn bg-primary-gradient text-white ml-1 mr-1 fw-bold" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapsepatient" aria-expanded="false" aria-controls="collapsepatient">
           Health Record
        </button>
    
   

    <div id="collapsepatient" class="ml-1 mr-1 collapse show border bg-white "  aria-labelledby="heading" data-parent="#accordion">
  





 <div class="card  bg-white ">
                          
                               <div class="card-body p-3 bg-white">
                            
                            

                                 
                               <?php if(!empty($patient)): ?>
                                            <?php $no=1; foreach($patient as $row): ?>
                               <div class="main-form  m-2">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 ">
                                            <b for=""  style="font-size:20px; color:white;">No.<?= $no  ?></b>
                                        
                             
    


                                                                 
													
                                        </div>
                                    </div>
                                    <div class="col-md-4 bg-white">
                                        <div class="form-group">
                                            <label for="">Findings</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['findings'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Treatment</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= $row['treatment']; ?>" >
                                        </div>
                                    </div>
                                    
                                    
                                          <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Date Visit</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?php $str = $row['date']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                                        </div>
                                    </div>



                                   
                                 
                                 
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Record </h1>
                           
                           <?php endif ?>
                                    
                        




       


  


              
			

  </div>
  </div>
  
  
  </div>
  
  
  
  <div class="card ">

  
        <button class="btn bg-primary-gradient text-white ml-1 mr-1 mt-1 fw-bold" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapsemedicine" aria-expanded="false" aria-controls="collapsemedicine">
          Medicine Requested
        </button>
    
   

    <div id="collapsemedicine" class="ml-1 mr-1 collapse show border bg-white "  aria-labelledby="heading" data-parent="#accordionExample">
  



 <div class="card  bg-white ">
                          
                               <div class="card-body p-3 bg-white">
                            
                            

                                 
                               <?php if(!empty($reqmed)): ?>
                                            <?php $no=1; foreach($reqmed as $row): ?>
                               <div class="main-form  m-2">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 ">
                                            <b for=""  style="font-size:20px; color:white;">No.<?= $no  ?></b>
                                        
                             
    


                                                                 
													
                                        </div>
                                    </div>
                                    <div class="col-md-4 bg-white">
                                        <div class="form-group">
                                            <label for="">Medicine</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['medicine_name'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Quantity</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= $row['quantity']; ?>" >
                                        </div>
                                    </div>
                                    
                                    
                                          <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Date Received</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?php $str = $row['date_received']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                                        </div>
                                    </div>



                                   
                                 
                                 
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Record </h1>
                           
                           <?php endif ?>
                                    
                        




       


  


              
			

  </div>
  </div>
  







                   

						



  </div>
    
   
    
    
    <?php  if($residenthealth['gender']=='Female' && $residenthealth['pregnant']=='Yes' ): ?>
  <div class="card">

   
        <button class="btn bg-primary-gradient collapsed text-white fw-bold ml-1 mr-1 mt-1" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           Pregnant Details
        </button>
 

    <div id="collapseTwo" class="collapse border ml-1 mr-1 " aria-labelledby="heading" data-parent="#accordionExample">
   

  
 <div class="card  bg-white ">
                          
                               <div class="card-body p-3 bg-white">
                            
                            

                                 
                               <?php if(!empty($pregnant)): ?>
                                            <?php $no=1; foreach($pregnant as $row): ?>
                               <div class="main-form  m-2">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 ">
                                
                                            <b for=""  style="font-size:20px; color:white;">Date Recorded: <?php $str = $row['date']; $date = date('F j, Y', strtotime($str)); echo $date; ?></b>
                                        
                             
    


                                                                 
													
                                        </div>
                                    </div>
                                    <div class="col-md-4 bg-white">
                                        <div class="form-group">
                                            <label for="">Months of Pregnancy</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['months_pregnant'])  ?>" >
                                        </div>
                                    </div>
                                  
                                    
                                    
                                          <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">No of Children</label>
                                             <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['no_of_children'])  ?>" >
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                        <div class="form-group mb-2 ">
                                           <br>
                                            <a type="button" class="btn btn-primary m-2" href="checkup?pregno=<?=$row['preg_no'] ?>&resid=<?=$row['res_id']?>" >View Check Up</a>
                                            
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
 </div>


<?php endif ?>






   <?php  if($residenthealth['age']== 0): ?>

  <div class="card">
   
     
        <button class="btn bg-primary-gradient text-white fw-bold collapsed mt-1 ml-1 mr-1" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         Children Immunization Record
        </button>
     
 
    <div id="collapseThree" class="collapse border ml-1 mr-1 bg-white" aria-labelledby="headingThree" data-parent="">
      
      
          
                         <div class="card border bg-white ">
                             
                       
                               <div class="card-body p-3">
                            
                            

                                 
                               <?php if(!empty($immune)): ?>
                                            <?php $no=1; foreach($immune as $row): ?>
                               <div class="main-form  m-2">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 ">
                                            <b for=""  style="font-size:20px; color:white;">No.<?= $no  ?></b>
                                        
                             
    


                                                                 
													
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Immunization Type</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['immun_type'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Date Visit</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?php $str = $row['date_visit']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                                        </div>
                                    </div>


                                   
                                 
                                 
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Immunization Record</h1>
                           
                           <?php endif ?>
                                           </div>
                        




                   


						</div>
						</div>


</div>
</div>


</div>



</div>

<?php endif ?>











   
 
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

