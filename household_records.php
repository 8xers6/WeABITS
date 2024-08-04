<?php include 'server/server.php' ?>
<?php
  $barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM `tblhousehold`LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tblhousehold.bar_no=$barno  ORDER BY tblhousehold.h_no ASC";
    $result = $conn->query($query);

    $household = array();
	while($row = $result->fetch_assoc()){
		$household[] = $row; 
	}


    $total = $result->num_rows;



   /* $query = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' Group by tblhousehold.h_no";*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>HouseHold Records -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Population</h2>
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
										<div class="card-title">Barangay HouseHold </div>
										<div class="card-tools">
										   	<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Household
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                  
                                                    <th scope="col">HouseHold No. </th>
                                                    <th scope="col">Street</th>
                                             
                                                    <th scope="col">Total Family Members</th>
                                                  
                                                 
                                                    <th scope="col">Head of the Family</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($household)): ?>
                                                    <?php  foreach($household as $row): ?>
                                                    <tr>
                                                        
                                                        <td> <div  style="width:100px;"><?= $row['household_no'] ?></div></td>
                                                        <td> <div  style="width:100px;"><?= $row['streetname'] ?></div></td>
                                                         
                                                 
                                                        <td class='text-center fw-bold'> <div  ><?php
                                                        
                                                        
                                                        
                                                          $hno=$row['h_no'];
                                                        $query1 = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tblhousehold.h_no=$hno Group by tblhousehold.h_no";
                                                        
                                                        
                                                        
                                                          $result1 = $conn->query($query1);
                                                        	$house = $result1->fetch_assoc();
                                                        
                                                        
                                                        
                                                        if(!empty($house['members'])){
                                                            
                                                              echo $house['members']; 
                                                            
                                                        }else{
                                                        
                                                          echo '0';
                                                        }
                                                     
                                                        ?>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        </div></td>
                                                    
                                                         
                                                         
                                                          <td class=''> <?php
                                                        
                                                        
                                                        
                                                          $hno=$row['h_no'];
                                                        $query1 = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tblhousehold.h_no=$hno AND tbl_residents.relation='Head' ";
                                                        
                                                        
                                                        
                                                          $result1 = $conn->query($query1);
                                                        	$head = $result1->fetch_assoc();
                                                        
                                                        
                                                        
                                                        if(!empty($head['members'])){
                                                            
                                                              echo $head['firstname'].'  '.$head['middlename'].'  '.$head['lastname']; 
                                                            
                                                        }else{
                                                        
                                                          echo '';
                                                        }
                                                     
                                                        ?>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                </td>
                                                             <td> <?= $row['email'] ?></td>
                                                        
                                                        <td>
                                                            
                                                            
                                                            <div class="form-button-action">
                                                                <?php if($head['verify_status']=='verified'):  ?>
                                                            <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Household" onclick="editHouseRecord(this)" 
                                                           
                                                            data-hno="<?= $row['h_no'] ?>" 
                                                           
                                                            data-householdno="<?= $row['household_no'] ?>" 
                                                            data-street="<?= $row['st_id'] ?>"
                                                            data-htype="<?= $row['house_type'] ?>" 
                                                            data-land="<?= $row['land_ownership'] ?>"  
                                                            data-electricitysource="<?= $row['electricity_source'] ?>"  
                                                            data-wastedisposal="<?= $row['waste_disposal'] ?>"
                                                            data-watersource="<?= $row['water_source'] ?>"
                                                            data-toilet="<?= $row['toilet_type'] ?>"
                                                            data-appliances="<?= $row['appliances'] ?>"
                                                            data-vehicle="<?= $row['vehicle'] ?>"   
                                                            data-energysource="<?= $row['energy_source'] ?>"               >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                         
                                                            <a type="button" data-toggle="tooltip" href="view_householdmembers.php?id=<?= $row['h_no']?>" class="btn btn-link btn-info" data-original-title="View Household Members">
                                                            <i class="fas fa-eye"></i>
																</a>
																
																	   <a type="button" data-toggle="tooltip" href="model/remove_household.php?id=<?= $row['h_no'] ?>" onclick="return confirm('Are you sure you want to delete this Household all members will also be deleted?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                            </a>
														
                                                            
                                                            
                                                      
                                                           
                                                           
                                                           
                                                             <?php else: ?>
                                                               <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Household" onclick="editHouseRecord(this)" 
                                                           
                                                            data-hno="<?= $row['h_no'] ?>" 
                                                           
                                                            data-householdno="<?= $row['household_no'] ?>" 
                                                            data-street="<?= $row['st_id'] ?>"
                                                            data-htype="<?= $row['house_type'] ?>" 
                                                            data-land="<?= $row['land_ownership'] ?>"  
                                                            data-electricitysource="<?= $row['electricity_source'] ?>"  
                                                            data-wastedisposal="<?= $row['waste_disposal'] ?>"
                                                            data-watersource="<?= $row['water_source'] ?>"
                                                            data-toilet="<?= $row['toilet_type'] ?>"
                                                            data-appliances="<?= $row['appliances'] ?>"
                                                            data-vehicle="<?= $row['vehicle'] ?>"   
                                                            data-energysource="<?= $row['energy_source'] ?>"               >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                             <a type="button" data-toggle="tooltip" href="view_householdmembers.php?id=<?= $row['h_no']?>" class="btn btn-link btn-info" data-original-title="View Household Members">
                                                            <i class="fas fa-eye"></i>
																</a>
																
																 <a type="button" data-toggle="tooltip" href="model/remove_household.php?id=<?= $row['h_no'] ?>" onclick="return confirm('Are you sure you want to delete this Household all members will also be deleted?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                            </a>
                                                            <?php endif ?>
                                                            
                                                 
                                                              
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php  endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                              
                                                      <th scope="col">HouseHold No. </th>
                                                    <th scope="col">Street</th>
                                             
                                                    <th scope="col">Total Family Members</th>
                                                  
                                                 
                                                    <th scope="col">Head of the Family</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Household Information   </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="model/edithouseholdinfo.php" enctype="multipart/form-data"  method="post" autocomplete="off">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">


<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>HouseHold Information</b></h2>
</div>



</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white   rounded justify-content-center">






<div class="col-md-5 m-1 p-2  rounded">

<div class="form-group m-0 border rounded shadow-sm">

<input  name="hno" id="hno" type="text" hidden class="form-control fw-bold" style="color:black;" placeholder="Household No" readonly required>
<label for="housno" class="placeholder">House No.</label>
					<input  name="householdno" type="text" class="form-control " id="houseno" placeholder="Household No"  required>
				
				</div>
            



              

                <div class="form-group  m-0 border rounded shadow-sm mt-1">
      
                                    <label>Street</label>
                                  
                                  
                                  <select name="street" class="form-control input-sm"   id="street" required>
                                  <option selected="" disabled="">-- Select Street -- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE bar_no=$barno");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                          
                                </div>

<div class="form-group mt-1 border rounded shadow-sm">
<label for="" class="placeholder">House Type.</label>

                                               <select class="form-control" id="htype"   name="housetype" required>
                                                   <option disabled selected value="">Select House Type</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Land Ownership.</label>

                                               <select class="form-control" id="land"    name="landownership" required>
                                                   <option disabled selected value="">Select Land Ownership</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Electricty</label>

                                               <select class="form-control" id="electric"    name="electricity" required>
                                                   <option disabled selected value="">Select Source of Electricty</option>
                                                   <option value="Power Distributor">Power Distributor</option>
                                                   <option value="Gas">Gas</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Energy for Cooking</label>

                                               <select class="form-control" id="energy"   name="cooking" required>
                                                   <option disabled selected value="">Source of Energy for Cooking</option>
                                                   <option value="Electricity">Electricity</option>
                                                   <option value="Gas">Gas</option>
                                                   <option value="Gas">Wood</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Water</label>

                                               <select class="form-control" id="water"    name="source_water" required>
                                                   <option disabled selected value="">Select Source of Water</option>
                                                   <option value="Deep Well">Deep Well</option>
                                                   <option value="Deep Well">Water Pump</option>
                                                   <option value="Faucet">Faucet</option>
                                               </select>
                     
                           </div>
                           <div class="form-group border mt-1 rounded shadow-sm">
<label for="" class="placeholder">Waste Disposal</label>

                                               <select class="form-control" id="waste"    name="waste_disposal" required>
                                                   <option disabled selected value="">Select Waste Disposal</option>
                                                   <option value="Hukay na may Takip">Hukay na may Takip</option>
                                                   <option value="Collected">Collected</option>
                                                   <option value="Sinusunog">Sinusunog</option>
                                                   
                                               </select>
                     
                           </div>    

                          
                           
				

             


                                                          
                                                    
                       

                          

                          
                        
                         

















</div>




<div class="col-md-6 m-1 p-2  rounded  ">


              
                           
                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Toilet Type</label>

                                               <select class="form-control" id="toilet"    name="toilet" required>
                                                   <option disabled selected value="">Select Toilet Type</option>
                                                   <option value="Flush">Flush</option>
                                                   <option value="De Buhos">De Buhos</option>
                                                 
                                               </select>
                     
                           </div> 


                           <div class="form-group m-0 mt-2 border bg-primary-gradient  rounded shadow-sm">
<b style="color:white">Current Vehicles</b>

                                           
                     
                           </div> 
<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


 <textarea id="vehicle" class="form-control fw-bold" style="color:black;" readonly></textarea>
                           </div> 
                           

</div>


<div class="form-group m-0 mt-2 border bg-primary-gradient  rounded shadow-sm">
<input type="checkbox" id="checkvehi" name="checkvehi"  value="checkvehi">

<label for="checkvehi"> <b style="color:white">Change vehicles to:</b></label>

                                           
                     
                           </div> 
<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


<input type="checkbox" id="car" name="vehicles[]"  value="Car">
  <label for="car"> Car</label><br>

  <input type="checkbox" id="jeep" name="vehicles[]" value="Jeep">
  <label for="jeep"> Jeep</label><br>

  <input type="checkbox" id="motor" name="vehicles[]" value="MotorCycle">
  <label for="motor">Motorcycle</label><br>


  <input type="checkbox" id="bike" name="vehicles[]" value="Bike">
  <label for="bike">Bike</label><br>

                           </div> 

                           <div class="col m-1 p-2 border rounded shadow-sm">
    

<input type="checkbox" id="truck"  name="vehicles[]" value="Truck">
  <label for="truck"> Truck</label><br>

  <input type="checkbox" id="tricycle" name="vehicles[]" value="Tricycle">
  <label for="tricycle"> Tricycle</label><br>

  <input type="checkbox" id="van" name="vehicles[]" value="Van/AUV">
  <label for="van">Van/AUV</label><br>


                           </div> 

                           <div class="border m-1 rounded p-1">
                           <label  class="placeholder">others specify</label>   
					<input  name="vehicles[]" type="text" class="form-control" value="" placeholder="Vehicles" >
                           
                                    </div>
</div>

<div class="form-group m-0 mt-2 border bg-primary-gradient  rounded shadow-sm">
<b style="color:white">Current Appliances</b>

                                           
                     
                           </div> 
<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


 <textarea id="appliance" class="form-control fw-bold" style="color:black;" readonly></textarea>
                           </div> 
                           

</div>

<div class="form-group mt-2 border bg-primary-gradient  rounded shadow-sm">
<input type="checkbox" id="checkapp" name="checkapp"  value="checkapp">

<label for="checkapp"> <b style="color:white">Change Appliances to:</b></label>

                                           
                     
                           </div> 

<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


<input type="checkbox" id="refrigerator" name="appliances[]" value="Refrigerator">
  <label for="refrigerator">Refrigerator</label><br>
  
  <input type="checkbox" id="freezer" name="appliances[]" value="Freezer">
  <label for="freezer">Freezer</label><br>
  
  <input type="checkbox" id="oven" name="appliances[]" value="Oven">
  <label for="oven">Oven</label><br>
  
  <input type="checkbox" id="stove" name="appliances[]" value="Stove">
  <label for="stove">Stove</label><br>

                           </div> 

                           <div class="col m-1 p-2 border rounded shadow-sm">
    

                           <input type="checkbox" id="microwave" name="appliances[]" value="Microwave">
  <label for="microwave">Microwave</label><br>
  
  <input type="checkbox" id="dishwasher" name="appliances[]" value="DishWasher">
  <label for="dishwasher">Dishwasher</label><br>
  
  <input type="checkbox" id="washing-machine" name="appliances[]" value="Washing-Machine">
  <label for="washing-machine">Washing Machine</label><br>
  
  <input type="checkbox" id="dryer" name="appliances[]" value="Dryer">
  <label for="dryer">Dryer</label><br>

                           </div> 

                           <div class="border m-1 rounded p-1">
                           <label  class="placeholder">others specify</label>   
                           <input  name="appliances[]" type="text" class="form-control " placeholder="Appliances" >
                                    </div>

</div>
                        

                           
                        


</div>


          

                      





                           

                          






                          




                               

<div  class="col-md-4 m-1 pb-2  rounded shadow-sm">







      <span role="alert" id="ssloading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                                

                  
                                                           


</div>





</div>


</div>





</div>

<div class="modal-footer">
                            <input type="text" id="st_id" name="stid" hidden >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>              

						
</form>

                    </div>
                </div>
            </div>
            
            
            
              <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Household Information   </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="model/save_household.php" enctype="multipart/form-data"  method="post" autocomplete="off">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">


<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>HouseHold Information</b></h2>
</div>



</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white   rounded justify-content-center">






<div class="col-md-5 m-1 p-2  rounded">

<div class="form-group m-0 border rounded shadow-sm">

<input  name="hno" id="hno" type="text" hidden class="form-control fw-bold" style="color:black;" placeholder="Household No" readonly required>
<label for="housno" class="placeholder">House No.</label>
					<input  name="householdno" type="text" class="form-control " placeholder="Household No"  required>
				
				</div>
            



              

                <div class="form-group  m-0 border rounded shadow-sm mt-1">
      
                                    <label>Street</label>
                                  
                                  
                                  <select name="street" class="form-control input-sm"   required>
                                  <option selected="" disabled="">-- Select Street -- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT st_id,streetname from tblstreet WHERE bar_no=$barno");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                          
                                </div>

<div class="form-group mt-1 border rounded shadow-sm">
<label for="" class="placeholder">House Type.</label>

                                               <select class="form-control" name="housetype" required>
                                                   <option disabled selected value="">--Select House Type--</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Land Ownership.</label>

                                               <select class="form-control"    name="landownership" required>
                                                   <option disabled selected value="">--Select Land Ownership--</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Electricty</label>

                                               <select class="form-control"    name="electricity" required>
                                                   <option disabled selected value="">--Select Source of Electricty--</option>
                                                   <option value="Electricity">Electricty</option>
                                                   <option value="Gas">Gas</option>
                                               </select>
                     
                           </div> 

                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Energy for Cooking</label>

                                               <select class="form-control"   name="cooking" required>
                                                   <option disabled selected value="">--Source of Energy for Cooking--</option>
                                                   <option value="Electricity">Electricity</option>
                                                   <option value="Gas">Gas</option>
                                                   <option value="Gas">Wood</option>
                                               </select>
                     
                           </div> 

                        

                          
                           
				

             


                                                          
                                                    
                       

                          

                          
                        
                         

















</div>




<div class="col-md-6 m-1 p-2  rounded  ">


                  <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Source of Water</label>

                                               <select class="form-control"    name="source_water" required>
                                                   <option disabled selected value="">--Select Source of Water--</option>
                                                   <option value="Deep Well">Deep Well</option>
                                                   <option value="Deep Well">Water Pump</option>
                                                   <option value="Faucet">Faucet</option>
                                               </select>
                     
                           </div>
                           <div class="form-group border mt-1 rounded shadow-sm">
<label for="" class="placeholder">Waste Disposal</label>

                                               <select class="form-control"     name="waste_disposal" required>
                                                   <option disabled selected value="">--Select Waste Disposal--</option>
                                                   <option value="Hukay na may Takip">Hukay na may Takip</option>
                                                   <option value="Collected">Collected</option>
                                                   <option value="Sinusunog">Sinusunog</option>
                                                   
                                               </select>
                     
                           </div>   
                           
                           <div class="form-group mt-2 border rounded shadow-sm">
<label for="" class="placeholder">Toilet Type</label>

                                               <select class="form-control"    name="toilet" required>
                                                   <option disabled selected value="">--Select Toilet Type--</option>
                                                   <option value="Flush">Flush</option>
                                                   <option value="De Buhos">De Buhos</option>
                                                 
                                               </select>
                     
                           </div> 




<div class="form-group m-0 mt-2 border bg-primary-gradient  rounded shadow-sm">


<label for="checkvehi"> <b style="color:white">Select Vehicles:</b></label>

                                           
                     
                           </div> 
<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


<input type="checkbox" id="car" name="vehicles[]"  value="Car">
  <label for="car"> Car</label><br>

  <input type="checkbox" id="jeep" name="vehicles[]" value="Jeep">
  <label for="jeep"> Jeep</label><br>

  <input type="checkbox" id="motor" name="vehicles[]" value="MotorCycle">
  <label for="motor">Motorcycle</label><br>


  <input type="checkbox" id="bike" name="vehicles[]" value="Bike">
  <label for="bike">Bike</label><br>

                           </div> 

                           <div class="col m-1 p-2 border rounded shadow-sm">
    

<input type="checkbox" id="truck"  name="vehicles[]" value="Truck">
  <label for="truck"> Truck</label><br>

  <input type="checkbox" id="tricycle" name="vehicles[]" value="Tricycle">
  <label for="tricycle"> Tricycle</label><br>

  <input type="checkbox" id="van" name="vehicles[]" value="Van/AUV">
  <label for="van">Van/AUV</label><br>


                           </div> 

                           <div class="border m-1 rounded p-1">
                           <label  class="placeholder">others specify</label>   
					<input  name="vehicles[]" type="text" class="form-control" value="" placeholder="Vehicles" >
                           
                                    </div>
</div>


<div class="form-group mt-2 border bg-primary-gradient  rounded shadow-sm">


<label for="checkapp"> <b style="color:white">Select Appliances:</b></label>

                                           
                     
                           </div> 

<div class="row m-0 p-0 border rounded shadow-sm">
                 


<div class="col m-1 p-2 border rounded shadow-sm">


<input type="checkbox" id="refrigerator" name="appliances[]" value="Refrigerator">
  <label for="refrigerator">Refrigerator</label><br>
  
  <input type="checkbox" id="freezer" name="appliances[]" value="Freezer">
  <label for="freezer">Freezer</label><br>
  
  <input type="checkbox" id="oven" name="appliances[]" value="Oven">
  <label for="oven">Oven</label><br>
  
  <input type="checkbox" id="stove" name="appliances[]" value="Stove">
  <label for="stove">Stove</label><br>

                           </div> 

                           <div class="col m-1 p-2 border rounded shadow-sm">
    

                           <input type="checkbox" id="microwave" name="appliances[]" value="Microwave">
  <label for="microwave">Microwave</label><br>
  
  <input type="checkbox" id="dishwasher" name="appliances[]" value="DishWasher">
  <label for="dishwasher">Dishwasher</label><br>
  
  <input type="checkbox" id="washing-machine" name="appliances[]" value="Washing-Machine">
  <label for="washing-machine">Washing Machine</label><br>
  
  <input type="checkbox" id="dryer" name="appliances[]" value="Dryer">
  <label for="dryer">Dryer</label><br>

                           </div> 

                           <div class="border m-1 rounded p-1">
                           <label  class="placeholder">others specify</label>   
                           <input  name="appliances[]" type="text" class="form-control " placeholder="Appliances" >
                                    </div>

</div>
                        

                           
                        


</div>


          

                      





                           

                          






                          




                               

<div  class="col-md-4 m-1 pb-2  rounded shadow-sm">







      <span role="alert" id="ssloading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                                

                  
                                                           


</div>





</div>


</div>





</div>

<div class="modal-footer justify-content-center">
            <button type="submit" class="btn btn-primary fw-bold">Add Household</button>
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

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
	<script src="assets/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#streettable').DataTable({
                	"order": [[ 3, "asc" ]]
            });
            $('.search_select_box select').selectpicker();
        });
    </script>
</body>
</html>