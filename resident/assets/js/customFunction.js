function editPos(that){
    pos = $(that).attr('data-pos');
    order = $(that).attr('data-order');
    id = $(that).attr('data-id');

    $('#position').val(pos);
    $('#order').val(order);
    $('#pos_id').val(id);
}

function editChair(that){
    title = $(that).attr('data-title');
    id = $(that).attr('data-id');

    $('#chair').val(title);
    $('#chair_id').val(id);
}

function editPurok(that){
    purok = $(that).attr('data-name');
    date= $(that).attr('data-date');
    details = $(that).attr('data-details');

    id = $(that).attr('data-id');

    $('#purok').val(purok);

    $('#details').val(details);
    $('#purok_id').val(id);

}

function editDaycare(that){


    studno = $(that).attr('data-studno');
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
    schoolyear= $(that).attr('data-sy');
    parent = $(that).attr('data-parent');

    $('#studno').val(studno);
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);

    $('#sy').val(schoolyear);
    $('#parent').val(parent);

}

function editStreet(that){
    stname = $(that).attr('data-stname');
   
    details = $(that).attr('data-details');

    stid = $(that).attr('data-stid');

    $('#streetname').val(stname);
  
    $('#details').val(details);
    $('#st_id').val(stid);

}


function viewborrow(that){
    borno = $(that).attr('data-borno');

    item = $(that).attr('data-item');
    qty = $(that).attr('data-qty');
   
    purpose = $(that).attr('data-purpose');
   dtt = $(that).attr('data-datetoreturn');
      dtb = $(that).attr('data-datetoborrow');
      
     $('#dtt').val(dtt);
     $('#dtb').val(dtb);

    $('#item').val(item);
    $('#qty').val(qty);
    $('#purpose').val(purpose);
    $('#borno').val(borno);

}


function editAnnouncement(that){
    actname = $(that).attr('data-name');
    date= $(that).attr('data-date');
    des = $(that).attr('data-des');
    file = $(that).attr('data-file');

    id = $(that).attr('data-id');

    $('#actname').val(actname);
    $('#date').val(date);
    $('#des').val(des);

    $('#purok_id').val(id);

    

    var str = file;
    var n = str.includes("data:image");
    if(!n){
        file = 'assets/uploads/announcement/'+file;
    }
    $('#photo').attr('src',file);


}





function editOfficial(that){
    id = $(that).attr('data-id');
    na = $(that).attr('data-name');
    chair = $(that).attr('data-chair');
    pos = $(that).attr('data-pos');
    start = $(that).attr('data-start');
    end = $(that).attr('data-end');
    status = $(that).attr('data-status');
    
    $('#off_id').val(id);
    $('#name').val(na);
    $('#chair').val(chair);
    $('#position').val(pos);
    $('#start').val(start);
    $('#end').val(end);
    $('#status').val(status);
}



function editResidents(that){
          
    resid          = $(that).attr('data-resid');
    fname 		= $(that).attr('data-fname');
	mname 		= $(that).attr('data-mname');
    lname 		= $(that).attr('data-lname');
    suffix 		= $(that).attr('data-suffix');
	
    
	bdate 		= $(that).attr('data-bdate');
    bplace 	    = $(that).attr('data-bplace');
    age 		= $(that).attr('data-age');
    cstatus 	= $(that).attr('data-cstatus');
    citizenship    =$(that).attr('data-citizenship');
	gen 	    = $(that).attr('data-gender');
   
    address      = $(that).attr('data-address');
    religion    = $(that).attr('data-religion');
	number 	    = $(that).attr('data-number');
    occu 	    = $(that).attr('data-occu');
    csec        =$(that).attr('data-csector');
    educ 	    = $(that).attr('data-educ');
    los 	    = $(that).attr('data-los');
    mincome 	    = $(that).attr('data-mincome');


    bloodtype 	    = $(that).attr('data-bloodtype');
    vbrand 	    = $(that).attr('data-vbrand');
    vstatus 	    = $(that).attr('data-vstatus');
    ailment 	    = $(that).attr('data-ailment');

    height 	    = $(that).attr('data-height');
    weight 	    = $(that).attr('data-weight');

    bmi 	    = $(that).attr('data-bmi');
    bmicateg	    = $(that).attr('data-bmicateg');


    pwd 	    = $(that).attr('data-pwd');

    remarks 	    = $(that).attr('data-remarks');

    dead 	    = $(that).attr('data-dead');

    respic         = $(that).attr('data-respicture');
    hof 	    = $(that).attr('data-hof');

    username         = $(that).attr('data-username');
    password         = $(that).attr('data-password');


    $('#username').val(username);
    
    $('#password').val(password);


    $('#resid').val(resid);
    
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);
    $('#suffix').val(suffix);

    $('#bplace').val(bplace);
    $('#bdate').val(bdate);
    $('#age').val(age);
    $('#cstatus').val(cstatus);
    $('#cship').val(citizenship);
    $('#gender').val(gen);

    $('#address').val(address);

    $('#religion').val(religion);
    $('#number').val(number);
    $('#occu').val(occu);
   
    $('#educ').val(educ);
  
    $('#los').val(los);
    $('#mincome').val(mincome);
    $('#bloodtype').val(bloodtype);
    $('#c_sec').val(csec);

    $('#v_brand').val(vbrand);
    $('#v_status').val(vstatus);
    $('#ailment').val(ailment);

    $('#height').val(height);
    $('#weight').val(weight);
    $('#result').val(bmi);
    $('#category').val(bmicateg);

  

    $('#remarks').val(remarks);

    if(pwd==1){
        $("#pwdyes").prop("checked", true);
    }else{
        $("#pwdno").prop("checked", true);
    }
   
    if(dead==1){
        $("#alive").prop("checked", true);
    }else{
        $("#dead").prop("checked", true);
    }


    if(hof==1){
        $("#yes").prop("checked", true);
    }else{
        $("#no").prop("checked", true);
    }

   


    var str = respic;
    var n = str.includes("data:image");
    if(!n){
        respic = 'assets/uploads/resident_profile/'+respic;
    }
    $('#image').attr('src', respic);
   

}


function editBlotter1(that){
    id          = $(that).attr('data-id');
    complainant         = $(that).attr('data-complainant');
    respondent 		= $(that).attr('data-respondent');
	victim 		= $(that).attr('data-victim');
    type 		= $(that).attr('data-type');
	l 		= $(that).attr('data-l');
    date 	    = $(that).attr('data-date');
	time 		= $(that).attr('data-time');
    details 		= $(that).attr('data-details');
    status 	= $(that).attr('data-status');

    $('#blotter_id').val(id);
    $('#complainant').val(complainant);
    $('#respondent').val(respondent);
    $('#victim').val(victim);
    $('#type').val(type);
    $('#location').val(l);
    $('#date').val(date);
    $('#time').val(time);
    $('#details').val(details);
    $('#status').val(status);
}

$('.vstatus').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.indetity').prop('disabled', 'disabled');
    }else{
        $('.indetity').prop('disabled', false);
    }
});

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});


Webcam.set({
    height: 250,
    image_format: 'jpeg',
    jpeg_quality: 90
});

$('#open_cam').click(function(){
    Webcam.attach( '#my_camera' );
});

function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}

$('#open_cam1').click(function(){
    Webcam.attach( '#my_camera1' );
});

function save_photo1() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera1').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage1').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage1" value="'+data_uri+'"/>';
    } );
}

function goBack() {
  window.history.go(-1);
}


function calculate(){
    //Need to determine the constant of some id functions.
      var bmi;
      var result = document.getElementById("result");
    //The value of the height slider
      var height = parseInt(document.getElementById("height").value);
    //The value of the weight slider
      var weight = parseInt(document.getElementById("weight").value);
    
    //The value of height and width should be displayed in the webpage using "textContent".
      //document.getElementById("weight-val").textContent = weight + " kg";
      //document.getElementById("height-val").textContent = height + " cm";
    
  //Now I have added the formula for calculating BMI in "bmi"
      bmi = (weight / Math.pow( (height/100), 2 )).toFixed(1);
    //With the help of "textContent" we have arranged to display in the result page of BMI
      result.value= bmi;
  
    
    //Now we have to make arrangements to show the text
    
    
    //When the BMI is less than 18.5, you can see the text below
      if(bmi < 18.5){
          category = "Underweight";
          result.style.color = "";
      }
    
    //If BMI is >=18.5 and <=24.9
      else if( bmi >= 18.5 && bmi <= 24.9 ){
          category = "Normal Weight";
          result.style.color = "";
      }
    
    //If BMI is >= 25 and <= 29.9 
      else if( bmi >= 25 && bmi <= 29.9 ){
          category = "Overweight";
          result.style.color = "";
      }
    
    //If BMI is <= 30
      else{
          category = "Obese";
          result.style.color = "";
      }
    //All of the above text is stored in "category".
  
  //Now you have to make arrangements to display the information in the webpage with the help of "textContent"
      document.getElementById("category").value = category;
  }

  function calculatesave(){
    //Need to determine the constant of some id functions.
      var bmi;
      var result = document.getElementById("bmi");
    //The value of the height slider
      var height = parseInt(document.getElementById("sheight").value);
    //The value of the weight slider
      var weight = parseInt(document.getElementById("sweight").value);
    
    //The value of height and width should be displayed in the webpage using "textContent".
      //document.getElementById("weight-val").textContent = weight + " kg";
      //document.getElementById("height-val").textContent = height + " cm";
    
  //Now I have added the formula for calculating BMI in "bmi"
      bmi = (weight / Math.pow( (height/100), 2 )).toFixed(1);
    //With the help of "textContent" we have arranged to display in the result page of BMI
      result.value= bmi;
  
    
    //Now we have to make arrangements to show the text
    
    
    //When the BMI is less than 18.5, you can see the text below
      if(bmi < 18.5){
          category = "Underweight";
          result.style.color = "";
      }
    
    //If BMI is >=18.5 and <=24.9
      else if( bmi >= 18.5 && bmi <= 24.9 ){
          category = "Normal Weight";
          result.style.color = "";
      }
    
    //If BMI is >= 25 and <= 29.9 
      else if( bmi >= 25 && bmi <= 29.9 ){
          category = "Overweight";
          result.style.color = "";
      }
    
    //If BMI is <= 30
      else{
          category = "Obese";
          result.style.color = "";
      }
    //All of the above text is stored in "category".
  
  //Now you have to make arrangements to display the information in the webpage with the help of "textContent"
      document.getElementById("scategory").value = category;
  }

  function female(){

              
        var gender= document.getElementById("gender");
        var value =gender.options[gender.selectedIndex].value;

        var female=document.getElementById("fonly");


       

        if(value=="Female"){
                   
            female.style.display = "block";
         
        }else{

            female.style.display = "none";

        }
             

  }




  function yesnoCheck(that) 
  {
      if (that.value == "GCash") 
      {
          document.getElementById("gcash").style.display = "block";
      }
      else
      {
          document.getElementById("gcash").style.display = "none";
          $('#errwarning').html("");
      }
  
      if (that.value == "cashonpickup")
      {
          document.getElementById("gcash").style.display = "none";
      }
      
     
  }





let inputVal = [];

const isKeyInput = (e) => {
  // exclude backspace, tab, shift, ctrl, alt, esc and arrow keys
  return (
    [8, 9, 16, 17, 18, 27, 37, 38, 39, 40, 46].indexOf(e.which) === -1
  );
};

const isNumberInput = (e) => {
  var charKey = e.key;
  return !isNaN(charKey) || charKey.toLowerCase() === "backspace";
};

const autotab = (e, currentPosition, to) => {
  const currentElement = e.currentTarget;
  // if (currentElement.type === "number" && !isNumberInput(e)) {
  //   e.preventDefault();
  //   return;
  // }
  if (
    isKeyInput(e) &&
    currentElement.getAttribute &&
    !e.ctrlKey &&
    currentElement.value.length >=
      currentElement.getAttribute("maxlength")
  ) {
    if (to) {
      const elem = document.getElementById(to);
      if (elem) {
        elem.focus();
        elem.select();
      }
    }
  }
  inputVal[currentPosition] = currentElement.value;
};

const keydownHandler = (e, prefix, currentPosition) => {
  const currentElement = e.currentTarget;
  if (e.which === 8 && currentElement.value.length === 0) {
    // go to previous input when backspace is pressed
    const elem = document.getElementById(
      `${prefix}${currentPosition - 1}`
    );
    if (elem) {
      elem.focus();
      elem.select();
      e.preventDefault();
      return;
    }
  }
  // only allows numbers (prevents e, +, - on input number type)
  if (
    // currentElement.type === "number" &&
    e.which === 69 ||
    e.which === 187 ||
    e.which === 189 ||
    e.which === 190 ||
    !isNumberInput(e)
  ) {
    e.preventDefault();
    return;
  }
};

const pasteHandler = (e, prefix, currentPosition) => {
  const clipboardData = e.clipboardData || window.clipboardData;
  const pastedData = clipboardData.getData("Text");
  let inputPos = currentPosition;
  let strIndex = 0;
  let elem;
  do {
    elem = document.getElementById(`${prefix}${inputPos}`);
    if (elem && pastedData[strIndex]) {
      elem.value = pastedData[strIndex];
      elem.dispatchEvent(new Event("input"));
      e.preventDefault();
    }
    strIndex++;
    inputPos++;
  } while (elem && strIndex < pastedData.length);
};

const loadValues = (tfaValue, prefix) => {
  if (tfaValue && tfaValue[0]) {
    inputVal = tfaValue[0].split("");
    inputVal.forEach((val, index) => {
      const inputElement = document.getElementById(`${prefix}${index}`);
      if (inputElement) {
        inputElement.value = val;
        inputElement.className =
          inputElement.className + " border border-solid border-red";
        inputElement.dispatchEvent(new Event("input"));
      }
    });
  }
};





$('#btnsend').click(function() {
    var val1 = $('#emailadd').val();

    if(val1!=""){
      var regex = /[^\s@]+@[^\s@]+\.[^\s@]+/;
      if(regex.test(val1)){
      
      

    
        document.getElementById("btnsend").style.display = "none";
        document.getElementById("loading").style.display = "block";
        document.getElementById("otploading").style.display = "none";
    $.ajax({
        type: 'POST',
        url: 'otp.php',
        data: { email: val1 },
        success: function(response) {


         // $('#div2').html(response);
            if($.trim(response)=="emailistaken"){

                $('#div2').html("<b style='color:red;'>Email is Already taken</b><a href='register'> click here to refresh the page</a>");
                document.getElementById("btnsend").style.display = "none";
                document.getElementById("loading").style.display = "none";
                document.getElementById("send").style.display = "none";
            }else{

            
           
 if($.trim(response)=="notsent"){
      $('#div2').html("<b style='color:red;'>No Internet Connection!</b>.<a href='register'> try to refresh the page</a>");
         document.getElementById("btnsend").style.display = "block";
        document.getElementById("loading").style.display = "none";
        document.getElementById("send").style.display = "none";
 

 }else{


    let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('div1').innerHTML = 'OTP expires in:'+m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  //alert('Timeout for otp');
  

  $.ajax({
    type: 'POST',
    url: 'resend_btn.php',
    
    success: function(response) {


        $('#resendbtn').html(response);
        document.getElementById("btnverify").style.display = "none";
      
    }
    
});

}

timer(120);

  document.getElementById("email_error").style.display = "none";
            document.getElementById("email_valid").style.display = "none";

   
    
    document.getElementById("send").style.display = "none";
    document.getElementById("otp").style.display = "block";
    
    document.getElementById("send").style.display = "none";
    document.getElementById("loading").style.display = "none";
   
  
 }

}
    
        }
        
    });

  }else{

    document.getElementById("email_valid").style.display = "block";
    document.getElementById("email_error").style.display = "none";
  }
  }else{

    
    document.getElementById("email_error").style.display = "block";
  }


});













function btnresend() {


  $('#incorrect').html("");
  document.getElementById("btnresend").style.display = "none";
  
  
  document.getElementById("otploading").style.display = "block";
  
  $.ajax({
    type: 'POST',
    url: 'resend_otp.php',
    
    success: function(response) {

      if(response=="notsent"){
        $('#div2').html("<b style='color:red;'>No Internet Connection!</b>.<a href='register'> try to refresh the page</a>");
        document.getElementById("btnsend").style.display = "block";
       document.getElementById("loading").style.display = "none";
       document.getElementById("send").style.display = "none";

      }else{

        
        document.getElementById("otploading").style.display = "none";
    
        document.getElementById("btnverify").style.display = "block";
      let timerOn = true;

      function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;
        
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('div1').innerHTML = 'OTP expires in:'+m + ':' + s;
        remaining -= 1;
        
        if(remaining >= 0 && timerOn) {
          setTimeout(function() {
              timer(remaining);
          }, 1000);
          return;
        }
      
        if(!timerOn) {
          // Do validate stuff here
          return;
        }
        
        // Do timeout stuff here
        //alert('Timeout for otp');
        

        $.ajax({
          type: 'POST',
          url: 'resend_btn.php',
          
          success: function(response) {
      
      
              $('#resendbtn').html(response);
              document.getElementById("otploading").style.display = "none";
              document.getElementById("btnverify").style.display = "none";
            
          }
          
      });

      
      }
      
      timer(120);
    }
    
    }
    
});
    


}




$(document).ready(function (e) {
  $("#otpverifyform").on('submit',(function(e) {
   e.preventDefault();

   $.ajax({
    url: "otp_verify.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
 
  if($.trim(response)=="incorrect"){
    $('#incorrect').html("<b style='color:red;' class='text-center'>Incorrect - OTP Code!</b>");
    document.getElementById("otp").style.display = "block";

  }else{

    document.getElementById("login_form").style.display = "block";
    document.getElementById("wform").remove();
    document.getElementById("otp").remove();
    document.getElementById("send").remove();
  }



   

 },
 


         
});
 

  
  }));
 }); 





  function previewback() {
    const preview = document.querySelector('.photo_back');
    
    
    
    const file = document.querySelector('.backphoto').files[0];
    const reader = new FileReader();
    
    reader.addEventListener("load", () => {
    // convert image file to base64 string
    preview.src = reader.result;
    }, false);
    
    if (file) {
    reader.readAsDataURL(file);
    }
    }


    const backBtn = document.querySelector('.back-btn');
const backphoto = document.querySelector('.backphoto');

function defaultBtnback(){
    
    backphoto.click();
 
    
 
 }




 function previewFront() {
    const preview = document.querySelector('.photo_front');
    
    
    
    const file = document.querySelector('.frontphoto').files[0];
    const reader = new FileReader();
    
    reader.addEventListener("load", () => {
    // convert image file to base64 string
    preview.src = reader.result;
    }, false);
    
    if (file) {
    reader.readAsDataURL(file);
    }
    }

    


    function previewFile() {
        const preview = document.querySelector('.photo_preview');
        
        
        
        const file = document.querySelector('.addphoto').files[0];
        const reader = new FileReader();
        
        reader.addEventListener("load", () => {
        // convert image file to base64 string
        preview.src = reader.result;
        }, false);
        
        if (file) {
        reader.readAsDataURL(file);
        }
        }

        



        const frontBtn = document.querySelector('.front-btn');
const frontphoto = document.querySelector('.frontphoto');

function defaultBtnfront(){
     


  document.getElementById("loading").style.display = "none";
    frontphoto.click();
 
    
 
 }






  
  
  function pickid(that) 
    {
        if (that.value == "PhilHealth") 
        {
            document.getElementById("gcash").style.display = "block";
        }
        else
        {
            document.getElementById("gcash").style.display = "none";
        }
    
        if (that.value == "cashonpickup")
        {
            document.getElementById("gcash").style.display = "none";
        }
        
       
    }
  
  function validateTicket() {
  
  
  
    let front = document.forms["myForms"]["front"].value;
    let back = document.forms["myForms"]["back"].value;
  
  
  
  
  
  
  
  
  
  
  
    if (front == "") {
      const frontError = document.getElementById("frontError");
      frontError.classList.add("visible");
      return false;
    }
  
  
    const frontError = document.getElementById("frontError");
      frontError.classList.remove("visible");
  
    if (back == "") {
      const backError = document.getElementById("backError");
      backError.classList.add("visible");
      return false;
    }
  
    const backError = document.getElementById("frontError");
      backError.classList.remove("visible");
  }



  function myBack(){
    const  backid= document.getElementById("backid");

backid.click();
   
  }


  function myFront(){
    const  frontid= document.getElementById("frontid");

frontid.click();
   
  }




$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();

  document.getElementById("loading").style.display = "block";
  document.getElementById("btnreg").style.display = "none";
  $('#crazy').html("");
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
        $('#crazy').html(response);
        document.getElementById("loading").style.display = "block";
       
         if(response=="invalid"){
          $('#crazy').html("<b style='color:red;'>INVALID!</b>");
          document.getElementById("loading").style.display = "none";
          document.getElementById("btnreg").style.display = "block";

         }else{


         
       
        if(response=="frontisempty"){
   
            $('#front_err').html("<b style='color:red;'>Please select a image</b>");
            document.getElementById("loading").style.display = "none";
            document.getElementById("btnreg").style.display = "block";
            $('#crazy').html("<b style='color:red;'>Please Attach Front ID</b>");
            
        }else if(response=="backisempty"){

          document.getElementById("loading").style.display = "none";
          document.getElementById("btnreg").style.display = "block";
          $('#crazy').html("<b style='color:red;'>Please Attach Back ID</b>");
$('#back_err').html("<b style='color:red;'>Please select a image</b>");
$('#front_err').remove();

}else{

            $('#front_err').remove();
            $('#back_err').remove();


            if(response=='uncheck'){

              document.getElementById("loading").style.display = "none";
              document.getElementById("btnreg").style.display = "block";
$('#crazy').html("<b style='color:red;'>Please check the terms of service and conditions</b>");

}else{   
  $('#crazy').html(response);
   if(response=='sent'){

    $("#form")[0].reset(); 
    document.getElementById("loading").style.display = "none";
       


    $('#login_form').html("<div class='form-action mb-7 pb-4 border rounded border-success ' id='btnreg'><i class='fas fa-check-circle' style='font-size:40px; color:green;'></i><br><b style='color:green; font-size:20px;'>Registration form successfully submitted!</b></div>");

   }else{
   // $('#crazy').html(response);
   // $('#crazy').html("<b style='color:red;'>Internet Connection error</b>");


   }



   

}
            
        }


      }

    


      





      },
    
              
    });
 }));
});



  /*
if (x == "" && y=='Gcash' ) {

	

	const nameError = document.getElementById("nameError");
    nameError.classList.add("visible");
  
    
   
   
   return false;
  }

  if (z == "" && y=='Gcash') {

	
	const nameError = document.getElementById("nameError");
    nameError.classList.add("visible");


return false;
}

*/



 

$(document).ready(function (e) {
    

    
  $("#serviceform").on('submit',(function(e) {
   e.preventDefault();
 
 
 document.getElementById("loading").style.display = "block";
 document.getElementById("reqbtn").style.display = "none";
   $.ajax({
          url: "saverequest_ajax.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success:  function(data)
       { 
       
         


       // $('#errwarning').html(data);
        
        
       
              
        if($.trim(data)=="resisempty"){
             document.getElementById("loading").style.display = "none";
 document.getElementById("reqbtn").style.display = "block";
          $('#errwarning').html("Please Select Resident Picture");
        }else{

        if($.trim(data)=="otherisempty"){
                 document.getElementById("loading").style.display = "none";
 document.getElementById("reqbtn").style.display = "block";
          $('#errwarning').html("Please specify your purpose");
        }else{
        if($.trim(data)=="cedulaisempty"){
                 document.getElementById("loading").style.display = "none";
 document.getElementById("reqbtn").style.display = "block";
          $('#errwarning').html("Cedula can't be empty");
        }else{


        
		if($.trim(data)=="isempty"){
		         document.getElementById("loading").style.display = "none";
 document.getElementById("reqbtn").style.display = "block";
			$('#errwarning').html("GCash receipt can't be empty");
			


		}else{
		    
		      if($.trim(data)=="uncheck"){
		               document.getElementById("loading").style.display = "none";
 document.getElementById("reqbtn").style.display = "block";
		          var modal = document.getElementById("view");


          $(modal).modal("show");
          $('#errwarning').html("Please Agree to terms and conditions to proceed ");
        }else{
      if($.trim(data)=="success"){
        //$('#errwarning').html(data);
       
        window.location.pathname = ('/resident/myrequest')
        
  
  
      }else{
         
        
         
      }
            
        }
     
       
		}
  }

}
       }
       
       
        
       
       
         
     
       },
       
     
     
               
     });
  }));
 }); 
 
 
 








 function gcashreceipt(){

       

const  greceipt= document.getElementById("greceipt");

 greceipt.click();


}

function previewGreceipt() {
const preview = document.querySelector('.gcashphoto');



const file = document.querySelector('.gphoto').files[0];
const reader = new FileReader();

reader.addEventListener("load", () => {
// convert image file to base64 string
preview.src = reader.result;
}, false);

if (file) {
reader.readAsDataURL(file);
}
}


function cedulabtn(){

       

  const  cedula= document.getElementById("cedula");
  
   cedula.click();
  
  
  }
  
  function previewcedula() {
  const preview = document.querySelector('.cedulaphoto');
  
  
  
  const file = document.querySelector('.cphoto').files[0];
  const reader = new FileReader();
  
  reader.addEventListener("load", () => {
  // convert image file to base64 string
  preview.src = reader.result;
  }, false);
  
  if (file) {
  reader.readAsDataURL(file);
  }
  }



function otherbclearance(that) 
{
    if (that.value == "Others") 
    {
        document.getElementById("otherbclearance").style.display = "block";
    }
    else
    {
        document.getElementById("otherbclearance").style.display = "none";
    }

  
    
   
}







function businesspicbtn(){

       

  const  cedula= document.getElementById("buspic");
  
   cedula.click();
  
  
  }
  
  function previewbusinesspic() {
  const preview = document.querySelector('.busphoto');
  
  
  
  const file = document.querySelector('.bphoto').files[0];
  const reader = new FileReader();
  
  reader.addEventListener("load", () => {
  // convert image file to base64 string
  preview.src = reader.result;
  }, false);
  
  if (file) {
  reader.readAsDataURL(file);
  }
  }



  function respicbtn(){

       

  const  cedula= document.getElementById("respic");
  
   cedula.click();
  
  
  }
  
  function previewrespic() {
  const preview = document.querySelector('.residentphoto');
  
  
  
  const file = document.querySelector('.resphoto').files[0];
  const reader = new FileReader();
  
  reader.addEventListener("load", () => {
  // convert image file to base64 string
  preview.src = reader.result;
  }, false);
  
  if (file) {
  reader.readAsDataURL(file);
  }
  }
  
  
  
  
  
 
  
  
  
  
  
  
  
  
  
  
  
  