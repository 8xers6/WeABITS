

<?php 


	include('server/serverhome.php');


  if(!empty($_SESSION['otp'])){

    unset($_SESSION['otp']);
  }


  if(!empty($_SESSION['s_email'])){

    unset($_SESSION['s_email']);
  }


  if(!empty($_SESSION['otpvalidation'])){

    unset($_SESSION['otpvalidation']);
  }
 
   
   



?>

<!DOCTYPE html>
<html lang="en">
<head>
  
	<title>Register -  WEABITS</title>
	<?php include 'templates/header.php' ?>


</head>
<body class="login">

 

 






<?php include 'templates/loading_screen.php' ?>




                                                            
	<div class="wrapper wrapper-login "   id="wform" >


        
		<div class="container container-login animated fadeIn border " >
			<div>
		<?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> 
				<?= $_SESSION['success']=='danger' ? ' success' : null ?>" role="alert">
                <?= $_SESSION['message']; ?>
                </div>
            <?php unset($_SESSION['message']); ?>
            <?php endif ?>

		   </div>
           


  


 


      <div  id="div3"></div>
    
      <div class="div2"  id="div2"></div>  

<div class="" id="codeform" style="display:block;">


<h3 class="text-center">Enter Code sent by Barangay</h3>
<form id="codeform" method="POST">
    
    
       <div id="codeerror">s</div>
<label for="email" class="fw-bold">Enter your Email Address</label>

					<input   type="email" name="email" class="form-control" placeholder="Enter Email" required>
					<label for="email" class="fw-bold">Code</label>
					<input   type="text" class="form-control" name="code" placeholder="Enter Code" required>
					
				
                <div class="form-action mb-3">
				<button  class="btn btn-primary fw-bold pl-5 pr-5" >Submit</button>
       
       
       
				</div>
</form>
      


                                    </div>
                                
                                   

                                    <div class="otp text-center" id="otp" >
<h3 class="text-center">OTP Email Verification</h3>



<label class="fw-bold">OTP 6-digit Code </label><br>
<div id="incorrect"></div>

<form  id="otpverifyform">
<input

      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code1"
      name="c1"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 1)"
      onKeydown="keydownHandler(event, 'code', 1)"
      onKeyup="autotab(event, 1, 'code2')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code2"
      name="c2"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 2)"
      onKeydown="keydownHandler(event, 'code', 2)"
      onKeyup="autotab(event, 2, 'code3')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code3"
      name="c3"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 3)"
      onKeydown="keydownHandler(event, 'code', 3)"
      onKeyup="autotab(event, 3, 'code4')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code4"
      name="c4"
      class=" code text-center w-8 xxs:w-12 mx-1 border-primary rounded "
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 4)"
      onKeydown="keydownHandler(event, 'code', 4)"
      onKeyup="autotab(event, 4, 'code5')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code5"
      name="c5"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 5)"
      onKeydown="keydownHandler(event, 'code', 5)"
      onKeyup="autotab(event, 5, 'code6')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code6"
      name="c6"
      class="code text-center w-8 xxs:w-12 mx-1  border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 6)"
      onKeydown="keydownHandler(event, 'code', 6)"
      onKeyup="autotab(event, 6, 'code7')"
      required
    />
                   
					
				
                <div class="form-action mb-3">
            
                <button  class="btn btn-primary fw-bold pl-5 pr-5">VERIFY</button>
                  <span role="alert" id="otploading" aria-hidden="true" style="color:black; font-size:15px; "> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
				      
				</div>


        <div class="div1" id="div1"></div>


                                    </div>

                                    

                                    <span role="alert" id="loading" aria-hidden="true" style="color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
                               







    </form>
    <div id="resendbtn" class="text-center"></div>
		</div>
    </div>


    <?php include 'head_of_family.php' ?>
    <?php include 'household.php' ?>


    <?php include 'addfamily.php' ?>


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

    <style>



.code{
  border: 2px solid #333;
  padding: 5px 5px;
  font-weight:bold;
  width: 30px;
  text-align: center;
}

/* Chrome, Safari, Edge, Opera */
.code::-webkit-outer-spin-button,
.code::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
.code[type="number"] {
  -moz-appearance: textfield;
}


</style>




<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>


<script>


$("#checkterms").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");
  $("#terms").prop("checked", true); 
});

$("#disagree").on('click',function(){
  var modal = document.getElementById("view");


          $(modal).modal("hide");

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




<script>


$(document).ready(function (e) {
 $("#forms").on('submit',(function(e) {
  e.preventDefault();

  //document.getElementById("loading").style.display = "block";

  $.ajax({
         url: "regajax.php",
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

      
 
       // $('#checkerrors').html(response);

        if($.trim(response)=='next'){
  
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
document.getElementById("login_form").style.display = "none";
document.getElementById("household_form").style.display = "block";



        }else{




        }
         
/*

     $('#checkerrors').html(response);
        //$('#checkerrors').html("<b style='color:red;'>Please check the terms of service and conditions</b>");

        
if($.trim(response)=='uncheck'){

//document.getElementById("loading").style.display = "none";
//document.getElementById("btnup").style.display = "block";
//document.getElementById("checkerrors").style.display = "block";
$('#checkerrors').html("<b style='color:red;'>Please check the terms of service and conditions</b>");

}else{   
    $('#checkerrors').html(response);
  
    //$('#forms').html("<div class='form-action mb-7 pb-4 border rounded border-success ' id='btnreg'><i class='fas fa-check-circle' style='font-size:40px; color:green;'></i><br><b style='color:green; font-size:20px;'>Registration form successfully submitted!</b></div>");
   // document.getElementById("btnup").style.display = "none";
    if($.trim(response)=='success'){
     window.location.pathname = ('weabits/resident/register')
//const removeform = document.getElementById("forms");
  // removeform.remove();
   //document.getElementById("btnup").style.display = "none";

 
     


    }else{





    }











}
*/

           
        //document.getElementById("btnup").style.display = "none";
        

      },
    
              
    });
 }));
});





$('#btnback').click(function() {

  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

  
  document.getElementById("login_form").style.display = "inline";
document.getElementById("household_form").style.display = "none"; 
     
      
  
});


$("#house_form").on('submit',(function(e) {
  e.preventDefault();




  $.ajax({
         url: "houseajax.php",
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

      
 
        $('#errhouse').html(response);

        if($.trim(response)=='next'){
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

          document.getElementById("addfamily_form").style.display = "block";
document.getElementById("household_form").style.display = "none"


        }else{




        }
         

        

      },
    
              
    });


  








}));




$('#btnbackhouse').click(function() {


  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

document.getElementById("addfamily_form").style.display = "none";
document.getElementById("household_form").style.display = "block"; 
   
    

});







$("#submitreg_form").on('submit',(function(e) {
  e.preventDefault();




  $.ajax({
         url: "submitregistration.php",
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

      
 
    

        if($.trim(response)=='uncheck'){
       
var modal = document.getElementById("view");


          $(modal).modal("show");
          $('#submiterr').html('<b style="color:red;">please check the terms of service and conditions</b>');

        

      
      }else{
       
        $('#submiterr').html(response);

        if($.trim(response)=='success'){
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
          window.location.pathname = ('/resident/registration')



        }else{




        }
      }

        

      },
    
              
    });



}));











</script>


</body>

</html>
