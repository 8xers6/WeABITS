<script>
    
        $(document).ready(function (e) {
 $("#forms").on('submit',(function(e) {
  e.preventDefault();

  //document.getElementById("loading").style.display = "block";

  $.ajax({
         url: "resident/regajax.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
   // $("#err").fadeOut();
   },
   success: function(response)
      {

      
       
       $('#household_form').html(response);
       document.getElementById("headoffamily").style.display = "none";
        document.documentElement.scrollTop = 0; 
         /*
        if($.trim(response)=='next'){
  
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
document.getElementById("login_form").style.display = "none";
document.getElementById("household_form").style.display = "block";



        }else{




        }
*/
        

      },
    
              
    });
 }));
});
    
</script>

<b class="text-primary ml-3"> Personal Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-link"> HouseHold Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-link">Add Family Members</b>
<form id="forms" enctype="multipart/form-data"  method="post" >
<input type="hidden" name="size" value="1000000">

<div class="row  ml-3 mr-3 p-3   shadow rounded border justify-content-center">



<div class="col-md-10 ">

<b style="font-size:30px;"><img src="assets/uploads/<?= $_SESSION['buname'] ?>/barangayinfo/<?=$_SESSION['brgylogo'] ?>" class="text-center rounded-circle" height="60" width="60" >Brgy. <?=$_SESSION['brgyname'] ?> </b>
</div>










</div>

<div class="row ml-3 mr-3  p-1 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>Head of Family </b></h2>
</div>






</div>

<div class="row ml-3 mr-3   bg-white  border  rounded justify-content-center ">


                          

                      

                        
<div class="col-md-3 border pb-2 m-1 rounded shadow-sm">
                           
                           
                           <label>Firstname</label>
                                              <input type="text" id="fname" class="form-control" placeholder="Firstname"  name="fname"  required>
                           </div>

                           <div class="col-md-3 border pb-2 m-1 rounded shadow-sm">
                           
                           
                           <label>Middlename</label>
                                              <input type="text" class="form-control" placeholder="Middle"  name="mname"  required>
                           </div>
                           <div class="col-md-3 border pb-2 m-1 rounded shadow-sm">
                           
                           
                           <label>Lastname</label>
                                              <input type="text" class="form-control" placeholder="Lastname"  name="lname"  required>
                           </div>



        <div class="col-md-2 border pb-2 m-1 rounded shadow-sm">
                                    <label class="fw-bold">Select Suffix</label>
                                                    <select class="form-control" name="suffix" required    >
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                    
                                    </div>
                    

<div class="col-md-2 border pb-2 m-1 rounded shadow-sm">
                           
                           <label>Gender</label>
                                               <select class="form-control"    name="gender" id="gender" required>
                                                   <option disabled selected value="">Select Gender</option>
                                                   <option value="Male">Male</option>
                                                   <option value="Female">Female</option>
                                               </select>
                     
                           </div>  
                           
                           
                           
                               <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">

							
<i class="fas fa-birthday-cake"></i>
<label> Birthdate</label>
<input type="date" class="form-control " max="<?php
// PHP program to add days to $Date

// Declare a date
$Date = date('Y-m-d');

// Add days to date and display it
echo date('Y-m-d', strtotime($Date. ' - 6570 days'));

?>" min="" placeholder="Enter Birthdate" name="bdate" id="bdate" required >

</div>



<div class="col-md-3 m-1 border pb-2 rounded shadow-sm">
                           
                           
                            <label>Place of Birth</label>
                                               <input type="text" class="form-control"placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                      
                            </div>


<div class="col-md-2 m-1 border pb-2 rounded shadow-sm">
                           
                           
                           <label>Your Contact Number</label>
                                              <input type="number" min="0" class="form-control" placeholder="Contact Number"  name="contact_no" required >
                           </div>
                           
                           
                           
                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                            <label>Civil Status</label>
                                                      <select class="form-control"  name="cstatus"  required>
                                                   <option disabled selected value="">Select Civil Status</option>
                                                       <option value="Single">Single</option>
                                                       <option value="Married">Married</option>
                                                       <option value="Widow">Widowed</option>
                                                       <option value="Separated">Separated</option>
                                                       <option value="Divorced">Divorced</option>
                                                       <option value="Live-In">Live-In</option>
                                                   
                                                       </select>
                           
                     
                           </div>

                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Citizenship</label>
                                                  <input type="text" class="form-control" name="citizenship" id="cship" placeholder="Enter citizenship" required>
                     
                           </div>


                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Religion</label>
                                                  <input class="form-control" name="religion" placeholder="Enter Religion" id="religion" required>
                     
                           </div>
                         
                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label>Length of Stay</label>
                                                  <input type="text" class="form-control"  name="los" placeholder="Enter Length of stay" id="los" required>
                           </div>
                           

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Occupation</label>
                                              <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occu"required >
                     
                           </div>

                          
                             <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Monthly Income</label>
                           <input type="number" class="form-control" placeholder="Monthly income" min='0'  name="m_income" required >
                                                  
                                                   
                                                   
                                                       </select>
                     
                           </div>
                         



                          




                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Classified Sector</label>
                                                      <select class="form-control"   name="class_sec" id="c_sec" required >
                                                   <option disabled selected value="">Select Classified Sector</option>
                                                   <option value="Labor Force/Employed">Labor Force/Employed</option>
                                                   <option value="Self-Employed">Self-Employed</option>
                                                   <option value="Unemployed">Unemployed</option>
                                                   <option value="Student">Student</option>
                                                   <option value="Out-of-School Youth(OSY">Out-of-School Youth(OSY)</option>
                                                   <option value="Out-of-School Children(OSC)">Out-of-School Children(OSC)</option>
                                                   <option value="Not Applicable">Not Applicable</option>
                                            
                                               
                                                   
                                                       </select>
                     
                           </div>


                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           <label>Highest Educational Attainment</label>
                                                      <select class="form-control"  name="educ" id="educ" required>
                                                   <option disabled selected value="">Highest Educational Attainment</option>
                                                   <option value="Primary">Primary</option>
                                                   <option value="Secondary">Secondary</option>
                                                   <option value="Tertiary">Tertiary</option>
                                                   <option value="Post Graduate">Post Graduate</option>
                                                   <option value="Not Applicable">Not Applicable</option>
                                            
                                               
                                                   
                                                       </select>
                     
                           </div>


                         



                        

                           

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact Person</label>
                                              <input type="text" class="form-control" placeholder="Enter Emergency Name"  name="ename"  required>
                           </div> 

                           <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                           
                           
                           <label class="text-danger fw-bold">Emergency Contact No.</label>
                                              <input type="number" min="0" class="form-control" placeholder="Enter Emergency Contact Number"  name="eno" required >
                           </div>

                       

                        
                       
                         

                       

                               
                               
                               

                                   


                           <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                               <label>Person With Disability</label>
                                                     
                              
<select id="disability" class="form-control" name="pwd" required>
<option disabled selected value="">Select Disability</option>
<option value="Not Applicable">Not Applicable</option>
  <option value="Blindness or Visual Impairment">Blindness or Visual Impairment</option>
  <option value="Deafness or Hearing Impairment">Deafness or Hearing Impairment</option>
  <option value="Mobility Impairment">Mobility Impairment</option>
  <option value="Cognitive Impairment">Cognitive Impairment</option>
  <option value="Neurological Impairment">Neurological Impairment</option>
  <option value="psychiatric">Psychiatric Impairment</option>
  <option value="Psychiatric Impairment">Speech Impairment</option>
  <option value="Learning Disabilities">Learning Disabilities</option>
  <option value="Developmental Disabilities">Developmental Disabilities</option>
  <option value="Chronic Illnesses">Chronic Illnesses</option>
  <option value="Autoimmune Disorders">Autoimmune Disorders</option>
  <option value="Intellectual Disabilities">Intellectual Disabilities</option>
  <option value="Mental Health Disabilities">Mental Health Disabilities</option>
  <option value="Physical Disabilities">Physical Disabilities</option>
  <option value="Sensory Disabilities">Sensory Disabilities</option>
</select>

                               </div>
                                   


                               <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                               <label>COVID-19 Vaccine Brand </label>
                                                     
                                                       <select class="form-control"  name="vbrand"  required   >
                                                       <option disabled selected value="">Select Latest Vaccine Brand</option>
                                                       <option value="Pfizer">Pfizer</option>
                                                       <option value="Janssen">Janssen</option>
                                                       <option value="Sinovac">Sinovac</option>
                                                       <option value="Moderna">Moderna</option>
                                                       <option value="None">None</option>
                                                   
                                                       <option value="Not Vaccinated">Not Vaccinated</option>
                                                       

                                               </select>

                               </div>


                               <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                               <label>Latest COVID-19 Vaccination Status</label>
                                                       <select class="form-control"  name="vstatus"  required >
                                                       <option disabled selected value="">Select Latest Vaccination Status</option>
                                                       <option value="1st Dose">1st Dose</option>
                                                       <option value="2nd Dose">2nd Dose</option>
                                                       <option value="1st Booster">1st Booster</option>
                                                       <option value="2nd Booster">2nd Booster</option>
                                                   
                                                       <option value="Not Vaccinated">Not Vaccinated</option>
                                                       

                                               </select>

                               </div>

                           


                               <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                               <label>Ailments</label>
                           <select class="form-control"  name="ailment" id="ailment" required >
                           <option disabled selected value="">Select Ailments</option>
                           <option value="Not Applicable">Not Applicable</option>
                           <option value="TB Respiratory">TB Respiratory</option>
                           <option value="High Cholesterol">High Cholesterol</option>
                           <option value="Kidney Disease">Kidney Disease</option>
                           <option value="Hypertension">Hypertension</option>
                           <option value="Diabetes Mellitus">Diabetes Mellitus</option>
                           <option value="Heart Disease">Heart Disease</option>
                           <option value="Broncial Asthma">Broncial Asthma</option>
                           
                           <option value="Cancer">Cancer</option>




                           </select>

                               </div>


                               <div class="col-md-3 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Blood Type</label>
                                               <select class="form-control"  name="bloodtype" id="bloodtype"  required>
                                                       <option disabled selected value="">Select Blood Type</option>
                                                       <option value="O+">O+</option>
                                                       <option value="O-">O-</option>
                                                       <option value="A+">A+</option>
                                                       <option value="A-">A-</option>
                                                       <option value="B+">B+</option>
                                                       <option value="B-">B-</option>
                                                       <option value="AB+">AB+</option>
                                                       <option value="AB-">AB-</option>
                                                       <option value="Unknown">Unknown</option>




                                               </select>

                               </div>

                               <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Pregnant (for Female)</label>
                                               <select class="form-control"  name="preg"  required>
                                                       <option disabled selected value="">--Pregnant?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>

                               </div>
                               <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Solo Parent?</label>
                                               <select class="form-control"  name="singleparent"  required>
                                                       <option disabled selected value="">--Solo Parent?--</option>
                                                       <option value="Yes">Yes</option>
                                                       <option value="No">No</option>
                                                     




                                               </select>

                               </div>

                               <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                               <label >Height(in cm)</label>
                                                       <input type="number"   class="form-control"step=".01" placeholder="example: 180" name="height" id="height"  required>
                               

                               </div>


                               <div class="col-md-2 m-1 pb-2 border rounded shadow-sm">
                               
                               <label>Weight(in Kilograms)</label>
                                                       <input type="number"   class="form-control" step=".01" placeholder="example: 60" name="weight" id="weight"  required>

                               </div>


                             

                            


                            <!---
                               <div class="col-md-12 m-1 p-2 rounded fw-bold  text-center bg-primary-gradient ">
                               <h5  style="color:white; ">ADD FAMILY MEMBERS</h5>
                                 
                                   
                                   
                               </div>

                             
                               


                              --->
                               

<div  class="col-md-4 m-3 pb-2  rounded shadow-sm">


<div id="checkerrors" ></div>



                                                            
                                                                    
      <button type="submit" class="col btn btn-primary fw-bold mt-1" id="btnup" value="Submit"  onclick="return confirm('Are you sure you want to proceed ?');" >Next</button>



      <span role="alert" id="ssloading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                                

                  
                                                           


</div>



</div>



</div>









                   

						
</form>


                                                    
                                                          
                                                               
                                                              
                                        
                                        