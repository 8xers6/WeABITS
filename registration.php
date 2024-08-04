<?php include 'server/serverhome.php' ?>


<?php
  if(!empty($_SESSION['s_email'])){

    unset($_SESSION['s_email']);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Registration-  Barangay Management System</title>
</head>
<body>
	<?php //include 'templates/loading_screen.php' ?>

	<div class="wrapper">
	

		
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="justify-content-center">
							<div>
							<a type="button" class="btn btn-primary text-white rounded shadow-sm fw-bold border" href="resident/homeresident">Go back to Loginpage.</a>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2  ">
			

<div  id="successna"></div>


                        <div class="row mt-5 justify-content-center rounded ">
                            
                            	
            
            <div class="col-md-4" >

                    

             <div class="card border" id="codingform">
                 <div class="card-header bg-primary-gradient rounded">
                     <div class="card-head-row">
                         <div class="card-title fw-bold text-white">Enter code sent by Barangay</div>
                         <div class="card-tools">
                             
                         </div>
                     </div>
                 </div>
                 <div class="card-body" >
				 <?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? ' text-light' : null ?> " role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>




                 <form method="POST"  id="code_form" >

 
                 <div class="form-group">
                   <div id="warning"></div>
                    <label>Email </label>
					<input name="email" type="text" class="form-control " placeholder="Email"   required>
					
					
					 <label  >Code</label>
					<input name="code" type="text" class="form-control "  placeholder="Code" required>
				
			
					
				
				</div>
                     
                   <div class="form-group">
                  
                
					   
					    
					     <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span> 
				
				</div>
                  
                     <div class="row justify-content-center m-4">
                        
                     
                         <button type="submit" class="btn btn-primary fw-bold" id="acceptbtn">Submit</button>
                     </div>
                     </form>

             </div>

         </div>
         
         
         
         

 </div>
		 	         
	
	

	  <?php //include 'resident/head_of_family.php' ?>
      
     <?php //include 'resident/household.php' ?>
     
     
     <div id="headoffamily" style="display:;" class="">
         
         </div>
     
     <div id="household_form" style="display:block;" class=" mt-3 mb-4  justify-content-center">
         
         
         </div>   
<div id="addfamily_form" style="display:block;" class="mt-3 mb-4">
    
    </div>
  


					
				</div>

             
			</div>
			
			
			
			   
			     
			</div>    
		
			    
			    
			   

    
    
    
    
    
    
    
    
    
    
      <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Terms of Service and Conditions</h5>
                          
                        </div>
                        <div class="modal-body">
                       
                                 <p>

                                 Republic Act No. 10173, also known as the Data Privacy Act of 2012 (DPA), aims to protect personal data in information and communications systems both in the government and the private sector. The DPA created the National Privacy Commission (NPC) which is tasked to monitor its implementation.









                                 </p>
                            
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="disagree">
                                 Disagree
                            </button>
                            <button type="button" class="btn btn-primary" id="checkterms" data-dismiss="modal">Agree</button>
                        
                        </div>
               
                    </div>
                </div>
            </div>
			
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		
		
	</div>
	<?php include 'templates/footerreg.php' ?>
</body>


<script>


$("#checkterms").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");
  $("#terms").prop("checked", true); 
});

$("#disagree").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");
           $("#terms").prop("checked", false); 

});

    
    $(document).ready(function (e) {
  $("#code_form").on('submit',(function(e) {
   e.preventDefault();


     document.getElementById("acceptbtn").style.display = "none";
   document.getElementById("loading").style.display = "block";
   $.ajax({
    url: "codeform.php",
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
        document.getElementById("loading").style.display = "none";
     
         
          
          
         
        if($.trim(data)=='fail'){
              document.getElementById("loading").style.display = "none";
              document.getElementById("acceptbtn").style.display = "block";
               $('#warning').html('<b style="color:red;">Invalid Email or Code</b>');

        
            
        }else{
             $('#codingform').remove();
             $('#headoffamily').html(data);
        }

    
         
     
       },
       
     
     
               
     });
  }));
 }); 
    
    
    
    
    


















$('#btnbackhouse').click(function() {


  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

document.getElementById("addfamily_form").style.display = "none";
document.getElementById("household_form").style.display = "block"; 
   
    

});












$('#province').on('change', function() {
        var province_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'resident/selectcity.php',
            type: "POST",
            data: {
                province_data: province_id,
            },
            success: function(data) {



                $('#city').html(data);
                
               console.log(data);
            }
        })
    });




    $('#city').on('change', function() {
        var city_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'resident/selectbarangay.php',
            type: "POST",
            data: {
                city_data: city_id,
            },
            success: function(data) {



                $('#barangay').html(data);
               console.log(data);
            }
        })
    });



    $('#barangay').on('change', function() {
        var barangay_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'resident/selectstreet.php',
            type: "POST",
            data: {
                barangay_data: barangay_id,
            },
            success: function(data) {



                $('#street').html(data);
               console.log(data);
            }
        })
    });
    
    
    
    
    
      $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form border border-primary rounded m-1 justify-content-start  " >\
                <li>\
                                <div class="row mb-3 p-1 justify-content-start ">\
                                    <div class="col-md-3 mt-1">\
                                        <div class="p-2 rounded  border ">\
                                            <label  class="fw-bold">FirstName</label>\
                                            <input type="text" name="firstname[]" class="form-control" required placeholder="Enter Firstname">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3 mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Middlename</label>\
                                            <input type="text" name="middlename[]" class="form-control" required placeholder="Enter Middlename">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Lastname</label>\
                                            <input type="text" name="lastname[]" class="form-control" required placeholder="Enter lastname">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Suffix</label>\
                                            <select class="form-control" name="suffixes[]"    required>\
                                                    <option disabled selected value="">Select Suffix</option>\
                                                    <option value="">None</option>\
                                                    <option value="Jr.">Jr.</option>\
                                                    <option value="Sr.">Sr.</option>\
                                                    <option value="I.">I</option>\
                                                    <option value="II.">II</option>\
                                                    <option value="II.">III</option>\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3 mt-1 ">\
                                <div class="p-2 rounded border bg-primary">\
                                        <b style="color:white;">Relationship to family</b>\
                                            <select class="form-control"  name="relations[]" required>\
                                                   <option disabled selected value="">Select Relationship</option>\
                                                   <option value="Spouse">Spouse</option>\
                                                   <option value="Child">Child</option>\
                                                   <option value="Sibling">Sibling</option>\
                                                   <option value="Grand Child">Grand Child</option>\
                                                   <option value="Brother-in-law or Sister-in-law">Brother-in-law or Sister-in-law</option>\
                                                   <option value="Cousin">Cousin</option>\
                                                   <option value="Friend">Friend</option>\
                                                   <option value="Mother">Mother</option>\
                                                   <option value="Father">Father</option>\
                                        </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Gender</label>\
                                            <select class="form-control"    name="genders[]"  required>\
                                                   <option disabled selected value="">Select Gender</option>\
                                                   <option value="Male">Male</option>\
                                                   <option value="Female">Female</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Birthday</label>\
                                            <input type="date" name="bdays[]" class="form-control" required placeholder="Enter BirthDay">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">BirthPlace</label>\
                                            <input type="text" name="bplaces[]" class="form-control" required placeholder="Enter Birth Place">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Contact No</label>\
                                            <input type="number" name="contacts[]" class="form-control" required placeholder="Enter Contact No">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Civil Status</label>\
                                            <select class="form-control"  name="civilstatus[]"  >\
                                                   <option disabled selected value="">Select Civil Status</option>\
                                                   <option value="Single">Single</option>\
                                                   <option value="Married">Married</option>\
                                                   <option value="Widow">Widowed</option>\
                                                   <option value="Separated">Separated</option>\
                                                   <option value="Divorced">Divorced</option>\
                                                   <option value="Divorced">Live-In</option>\
                                                       </select>\           </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Citizenship</label>\
                                            <input type="text" name="citizenship[]" class="form-control" required placeholder="Enter Citizenship">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Religion</label>\
                                            <input type="text" name="religions[]" class="form-control" required placeholder="Enter Religion">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Length of Stay</label>\
                                            <input type="text" name="lengthofstay[]"  class="form-control" required placeholder="Enter Lenght of Stay">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Occupation</label>\
                                            <input type="text" name="occupation[]" class="form-control" required placeholder="Enter Occupation">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Classified Sector</label>\
                                            <select class="form-control"   name="class_sector[]" id="c_sec" required>\
                                                   <option disabled selected value="">Select Classified Sector</option>\
                                                   <option value="Labor Force/Employed">Labor Force/Employed</option>\
                                                   <option value="Self-Employed">Self-Employed</option>\
                                                   <option value="Unemployed">Unemployed</option>\
                                                   <option value="Student">Student</option>\
                                                   <option value="Out-of-School Youth(OSY">Out-of-School Youth(OSY)</option>\
                                                   <option value="Out-of-School Children(OSC)">Out-of-School Children(OSC)</option>\
                                                   <option value="Not Applicable">Not Applicable</option>\
                                                       </select>\                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Highest Educational Attainement</label>\
                                            <select class="form-control"  name="educs[]" id="educ" required>\
                                                   <option disabled selected value="">Highest Educational Attainment</option>\
                                                   <option value="Primary">Primary</option>\
                                                   <option value="Secondary">Secondary</option>\
                                                   <option value="Tertiary">Tertiary</option>\
                                                   <option value="Post Graduate">Post Graduate</option>\
                                                   <option value="Not Applicable">Not Applicable</option>\
                                                       </select>                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Monthly Income</label>\
                                            <input type="number" name="m_incomes[]" class="form-control" min="0"  required placeholder="Enter Monthly Income">\
                                                                                 </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Person With Disability</label>\
                                            <select id="disability" class="form-control" name="pwds[]" required>\
<option disabled selected value="">Select Disability</option>\
<option value="Not Applicable">Not Applicable</option>\
  <option value="blindness">Blindness or Visual Impairment</option>\
  <option value="deafness">Deafness or Hearing Impairment</option>\
  <option value="mobility">Mobility Impairment</option>\
  <option value="cognitive">Cognitive Impairment</option>\
  <option value="neurological">Neurological Impairment</option>\
  <option value="psychiatric">Psychiatric Impairment</option>\
  <option value="speech">Speech Impairment</option>\
  <option value="learning">Learning Disabilities</option>\
  <option value="developmental">Developmental Disabilities</option>\
  <option value="chronic">Chronic Illnesses</option>\
  <option value="autoimmune">Autoimmune Disorders</option>\
  <option value="intellectual">Intellectual Disabilities</option>\
  <option value="mental-health">Mental Health Disabilities</option>\
  <option value="physical">Physical Disabilities</option>\
  <option value="sensory">Sensory Disabilities</option>\
</select>\                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Covid-19 Vaccine Brand</label>\
                                            <select class="form-control"  name="vbrands[]" required>\
                                                       <option disabled selected value="">Select Latest Vaccine Brand</option>\
                                                       <option value="Pfizer">Pfizer</option>\
                                                       <option value="Janssen">Janssen</option>\
                                                       <option value="Sinovac">Sinovac</option>\
                                                       <option value="Moderna">Moderna</option>\
                                                       <option value="Not Vaccinated">Not Vaccinated</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Latest Vaccination Status</label>\
                                            <select class="form-control"  name="vaccstatus[]" required>\
                                                       <option disabled selected value="">Select Latest Vaccine Status</option>\
                                                       <option value="1st Dose">1st Dose</option>\
                                                       <option value="2nd Dose">2nd Dose</option>\
                                                       <option value="1st Booster">1st Booster</option>\
                                                       <option value="2nd Booster">2nd Booster</option>\
                                                       <option value="Not Vaccinated">Not Vaccinated</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                     <label for="">Ailments</label>\
                        <select class="form-control"  name="ailments[]" required>\
                           <option disabled selected value="">Select Ailments</option>\
                           <option value="Not Applicable">Not Applicable</option>\
                           <option value="TB Respiratory">TB Respiratory</option>\
                           <option value="High Cholesterol">High Cholesterol</option>\
                           <option value="Kidney Disease">Kidney Disease</option>\
                           <option value="Hypertension">Hypertension</option>\
                           <option value="Diabetes Mellitus">Diabetes Mellitus</option>\
                           <option value="Heart Disease">Heart Disease</option>\
                           <option value="Broncial Asthma">Broncial Asthma</option>\
                           <option value="Cancer">Cancer</option>\
                           </select>\
                           </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Blood Type</label>\
                                            <select class="form-control"  name="bloodtypes[]" required>\
                                                       <option disabled selected value="">Select Blood Type</option>\
                                                       <option value="O+">O+</option>\
                                                       <option value="O-">O-</option>\
                                                       <option value="A+">A+</option>\
                                                       <option value="A-">A-</option>\
                                                       <option value="B+">B+</option>\
                                                       <option value="B-">B-</option>\
                                                       <option value="AB+">AB+</option>\
                                                       <option value="AB-">AB-</option>\
                                                       <option value="Unknown">Unknown</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                   <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Pregnant (for female)</label>\
                                            <select class="form-control"    name="pregnant[]"  required>\
                                                   <option disabled selected value="">Pregnant?</option>\
                                                   <option value="Yes">Yes</option>\
                                                   <option value="No">No</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Solo Parent?</label>\
                                            <select class="form-control"    name="soloparent[]"  required>\
                                                   <option disabled selected value="">Solo parent?</option>\
                                                   <option value="Yes">Yes</option>\
                                                   <option value="No">No</option>\
                                               </select>\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Height</label>\
                                            <input type="number" min="0" name="heights[]" class="form-control" required placeholder="Enter Height">\
                                        </div>\
                                  </div>\
                                  <div class="col-md-3  mt-1">\
                                        <div class="p-2 rounded  border">\
                                            <label for="">Weight</label>\
                                            <input type="number" min="0" name="weights[]" class="form-control" required placeholder="Enter Weight">\
                                        </div>\
                                  </div>\
                                    <div class="col-md-6 text-center mt-2 ">\
                                        <div class=" p-3 rounded border">\
                                         <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                        </div>\
                                    </div>\
                                    </li>\
                                </div>\
                            </div>');
            });

        });
    
    
    
    
    
    
    
    
</script>




</html>


