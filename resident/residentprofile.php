<?php include 'server/server.php' ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Verify Resident Details - Weabits</title>
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
 $resid=$resident['res_id'];
 
$query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.res_id Not in ('$resid')";
$result = $conn->query($query);
$family = array();
while($row = $result->fetch_assoc()){
	$family[] = $row; 
}




$query1 = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.res_id ";
$result1 = $conn->query($query1);
$health = array();
while($row = $result1->fetch_assoc()){
	$health[] = $row; 
}
	
?>

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
				
				<div class="mt-1 ">


                <div class="accordion" id="accordionExample">
  <div class="card ">

  
        <button class="btn bg-primary-gradient text-white ml-1 mr-1 fw-bold" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Personal Information
        </button>
    
   

    <div id="collapseOne" class="ml-1 mr-1 collapse show border bg-white "  aria-labelledby="headingOne" data-parent="#accordionExample">
  

<div class="row ml-3 mr-3 pl-2 pr-2 pt-1 pb-3   justify-content-center">

<div class="col-md-4 m-1 p-2  rounded ">


<div class="form-group p-1 rounded border shadow-sm">
<label>Email:</label>  
<input  name="hno" type="text" readonly  value="<?= ucwords($resident['h_no']) ?>"  required hidden>
<input  name="resid" type="text" readonly  value="<?= ucwords($resident['res_id']) ?>"  required hidden>
<input  name="lname" type="text" readonly  value="<?= ucwords($resident['lastname']) ?>"  required hidden>
<input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly  required name="email" value="<?= $resident['email'] ?>" >
</div>

<div class="form-group mt-1  p-1 border rounded shadow-sm">


                           <label>Firstname:</label>
                                    
                                              <input type="text" class="form-control fw-bold" style="font-size:18px; color:black;" placeholder="Firstname" value="<?= ucwords($resident['firstname']) ?>" required name="fname" readonly >
                           </div>

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           
                           <label>Middlename</label>
                                              <input type="text" class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="Middle" value="<?= ucwords($resident['middlename']) ?>" required name="mname"  >
                           </div>
                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           
                           <label>Lastname</label>
                                              <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['lastname']) ?>" >
                           </div>


                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           <label>Suffix</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly required name="" value="<?= ucwords($resident['suffix']) ?>" >
                                    
                                    </div>



</div>




<div class="col-md-4 m-1 p-2  rounded">


<div class="form-group  border p-1 rounded shadow-sm">
                           
                           <label>Gender</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['gender']) ?>" >
                     
                           </div>  

<div class="form-group mb-2 p-1 mt-1 border rounded shadow-sm">

							
<i class="fas fa-birthday-cake"></i>
<label> Birthdate</label>
<input type="date"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['birthdate']) ?>" placeholder="Enter Birthdate" name="bdate" id="bdate" required >

</div>
<div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           
                           <label>Age</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['age']) ?>" >
                     
                           </div>
    

<div class="form-group mb-2 mt-1 border p-1 rounded shadow-sm">
                           
                           
                            <label>Place of Birth</label>
                                               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['birthplace']) ?>" placeholder="Enter Birthplace" name="bplace" id="bplace"required >
                      
                            </div>

                           
                           
                         


               

              

                                



                                                            <div class="form-group mt-1  p-1 border rounded shadow-sm">

<label >Person With Disability(PWD)?</label>
<b> <input  name="houseno" type="text"   class="form-control fw-bold " style="font-size:18px; color:black;" readonly  value="<?= ucwords($resident['pwd']) ?>"   required> </b>

                                </div>
                                                    
                       

                          

                          
                        
                         

















</div>




<div class="col-md-3 m-1 p-2  rounded  ">

<div class="form-group  border p-1 rounded shadow-sm">
                            <label>Civil Status</label>
                            <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['civil_status']) ?>" >
                           
                     
                           </div>

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           <label>Citizenship</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['citizenship']) ?>" >
                     
                           </div>                     
                                                
                           
                        
                           <div class="form-group mt-2  p-1 border rounded shadow-sm">
                           
                           <label>Religion</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="." value="<?= ucwords($resident['religion']) ?>" >
                     
                           </div>


                           

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           <label>Occupation</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['occupation']) ?>" >
                     
                           </div>

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
                           
                           
                           <label>Your Contact Number</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['contact_no']) ?>" >
                           </div>


</div>


                          

                        






                          
                           



                          

<div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Relationship to Family</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['relation']) ?>" >
                     
                           </div>


                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Classified Sector</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['classified_sector']) ?>" >
                     
                           </div>


                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Highest Educational Attainment</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['educational_attainment']) ?>" >
                         
                           </div>

                           <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                           
                           
                           <label>Length of Stay(in Months)</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['length_of_stay']) ?>" >
                           </div>


                           <div class="col-md-4 m-1 p-1 border rounded shadow-sm">
                           
                           <label>Monthly Income</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['monthly_income']) ?>" >
                     
                           </div>
                         



                        



                           <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact Name</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['emergencyname']) ?>" >
                           </div> 

                           <div class="col-md-4 m-1 p-1 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact No.</label>
                           <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['emergencycontact']) ?>" >
                           </div>

                    

                               
                                   

                               <div class="col-md-3 m-1 p-1 border rounded shadow-sm">

          <label for="">Solo Parent</label>
          <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($resident['solo_parent'])  ?>" >
    
</div>
<?php if($resident['gender']=='Female' && $resident['pregnant']=='Yes'):
?>

<div class="col-md- m-1 p-1 border rounded shadow-sm">
    
          <label for="">Pregnant</label>
          <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($resident['pregnant'])  ?>" >

</div>

<?php endif ?>
                              

                               <div class="col-md-4   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Blocklisted</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:red;" readonly placeholder="" required name="" value="<?= ucwords($resident['blocklisted']) ?>" >

                               </div>




     <div class="col-md-3">
           <div class="form-group  p-3">
            <br>
            <!---
            <a href="healthinfo?resid=<?= ucwords($resident['res_id']) ?>" type="button" class=" btn btn-primary text-white  fw-bold">View Health Info</a>-->
           </div>
     </div>
                            
                          
                        

              



					</div>










                   

						


  </div>

    
  <div class="card">

   
        <button class="btn bg-primary-gradient collapsed text-white fw-bold ml-1 mr-1 mt-1" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Family Members
        </button>
 

    <div id="collapseTwo" class="collapse border ml-1 mr-1 " aria-labelledby="headingTwo" data-parent="#accordionExample">
    <div class="col-md-12 ">
  
                                 
  <?php if(!empty($family)): ?>
               <?php $no=1; foreach($family as $row): ?>
  <div class="main-form mt-1 mb-1">
   <div class="row border ml-0 mr-0 rounded ">
   <div class="col-md-12 bg-primary-gradient  ">
           <div class="form-group m-0 ">
               <b for=""  style="font-size:20px; color:white;">Relationship to Family: <?= ucwords($row['relation'])  ?></b>

              
           </div>
       </div>
       <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">FirstName</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['firstname'])  ?>" >
           </div>
       </div>
       <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Middlename</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['middlename'])  ?>" >
           </div>
       </div>
       <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Lastname</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['lastname'])  ?>" >
           </div>
       </div>
       <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Suffix</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= $row['suffix']  ?>" >
           </div>
       </div>
      
       <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Gender</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['gender'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Birthday</label>
               <input type="date"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['birthdate'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Age</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['age'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Birth Place</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['birthplace'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Contact no</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['contact_no'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Civil Status</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['civil_status'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Citizenship</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['citizenship'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Religion</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['religion'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Length of Stay</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['length_of_stay'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Occupation</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['occupation'])  ?>" >
           </div>
     </div>
   
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Classified Sector</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['classified_sector'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Highest Educational Attainment</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['educational_attainment'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Monthly Income</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['monthly_income'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">PWD</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['pwd'])  ?>" >
           </div>
     </div>
 

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Covid-19 Vaccine Brand</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['vaccine_brand'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Latest Vaccine Status</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['vaccine_status'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Ailments</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['ailment'])  ?>" >
           </div>
     </div>
     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Blood Type</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['blood_type'])  ?>" >
           </div>
     </div>
     <?php  

if($row['gender']=='Female'):
?>

<div class="col-md-3">
<div class="form-group mb-2">
<label for="">Pregnant</label>
<input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?=$row['pregnant'] ?>" >
</div>
</div>

<?php endif ?>
<div class="col-md-3">
<div class="form-group mb-2">
<label for="">Solo Parent</label>
<input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['solo_parent'])  ?>" >
</div>
</div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Height (cm)</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['height'])  ?>" >
           </div>
     </div>

     <div class="col-md-3">
           <div class="form-group mb-2">
               <label for="">Weight (kgs.)</label>
               <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['weight'])  ?>" >
           </div>
     </div>


     <div class="col-md-3">
           <div class="form-group  p-3">
            <br><!----
             <a href="healthinfo?resid=<?= ucwords($row['res_id']) ?>" type="button" class=" btn btn-primary text-white  fw-bold">View Health Info</a>--->
           </div>
     </div>
    
   </div>
</div>

<?php $no++; endforeach ?>
              <?php else: ?>


      <h1 colspan="4" class="text-center">No Family Members</h1>

<?php endif ?>
</div>
  
  </div>



  <div class="card">
   
     
        <button class="btn bg-primary-gradient text-white fw-bold collapsed mt-1 ml-1 mr-1" style="font-size:20px;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         Household Information
        </button>
     
 
    <div id="collapseThree" class="collapse border ml-1 mr-1" aria-labelledby="headingThree" data-parent="#accordionExample">
      

    <div class="row  pl-2 pr-2  pb-3   rounded justify-content-center">

<div class="col-md-3 m-1 p-2  rounded ">

<div class="form-group m-0 p-1 border rounded shadow-sm">
<label for="housno" class="placeholder">House No.</label>
					<input  name="houseno" type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['household_no']) ?>" readonly required>
				
				</div>

                                                            <div class="form-group mt-2 p-1 border rounded shadow-sm">
                                    <label>Street Name</label>
                                
                                    <input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['streetname']) ?>" readonly required>

                                                      

                                                            </div>

                                                            <div class="form-group mt-2 p-1 border rounded shadow-sm">
                                    <label>House Type</label>
                                
                                    <input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['house_type']) ?>" readonly required>

                                                      

                                                            </div>
                                                            <div class="form-group mt-2 p-1 border rounded shadow-sm">
                                    <label>Land Ownership</label>
                                
                                    <input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['land_ownership']) ?>" readonly required>

                                                      

                                                            </div>
                                               


</div>


<div class="col-md-3 m-1 p-2  rounded">


<div class="form-group  border p-1 rounded shadow-sm">
                                    <label>Source of Electricity</label>
                                
                                    <input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['electricity_source']) ?>" readonly required>

                                                      

                                                            </div>


               

                        

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
<label for="" class="placeholder">Source of Energy for Cooking</label>

<input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['energy_source']) ?>" readonly required>

                     
                           </div> 

                           <div class="form-group mt-2 p-1 border rounded shadow-sm">
<label for="" class="placeholder">Source of Water</label>

<input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['water_source']) ?>" readonly required>

                     
                           </div> 
                           
				

             


                                     
<div class="form-group border p-1 rounded shadow-sm">
<label for="" class="placeholder">Waste Disposal</label>

<input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['waste_disposal']) ?>" readonly required>

                     
                           </div>                      
                                                    
                       



</div>




<div class="col-md-5 m-1 p-2  rounded  ">

<div class="form-group p-1 border rounded shadow-sm">
<label for="" class="placeholder">Toilet Type</label>

<input   type="text" class="form-control fw-bold " style="font-size:18px; color:black;"  placeholder="Household No" value="<?= ucwords($resident['toilet_type']) ?>" readonly required>

                     
                           </div> 




<div class="form-group m-0 mt-2 border bg-primary-gradient  rounded shadow-sm">
    
<b style="color:white">Vehicles</b>

                                           
                     
                           </div> 
<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">



<textarea class="form-control fw-bold " style="color:black;" readonly><?=$resident['vehicle']?></textarea>



                           </div> 

</div>



<div class="form-group mt-2 border bg-primary-gradient  rounded shadow-sm">
<b style="color:white">Home Appliances</b>

                                           
                     
                           </div> 

<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">
<textarea class="form-control fw-bold " style="color:black;" readonly><?=$resident['appliances']?></textarea>

                           </div> 

</div>
                        

                           
                        


</div>


          

                      





                           

                          






                          
</div></div>


</div></div>


   
 
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

