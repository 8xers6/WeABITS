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

function editHousehold(that){
    id= $(that).attr('data-id');
   
    hhno = $(that).attr('data-householdno');

    street = $(that).attr('data-street');

    $('#id').val(id);
  
    $('#hhno').val(hhno);
    $('#street').val(street);

}


function editAnnouncement(that){
    actname = $(that).attr('data-name');
    date= $(that).attr('data-date');
    des = $(that).attr('data-des');
    place = $(that).attr('data-place');

    org = $(that).attr('data-org');
    stat = $(that).attr('data-stat');
    pic = $(that).attr('data-pic');

    id = $(that).attr('data-id');
    brgy = $(that).attr('data-brgy');

    $('#actname').val(actname);
    $('#date').val(date);
    $('#des').val(des);
    $('#place').val(place);
    $('#org').val(org);
    $('#stat').val(stat);

    $('#ann_id').val(id);

    

    var str = pic;
    var n = str.includes("data:image");
    if(!n){
        pics = 'assets/uploads/'+brgy+'/announcement/'+pic;
    }
    $('#photo').attr('src',pics);


}

function editServices(that){


    id = $(that).attr('data-id');
    title = $(that).attr('data-ttle');
    require = $(that).attr('data-require');
    details= $(that).attr('data-details');
    amount = $(that).attr('data-amount');

    file = $(that).attr('data-file');


    brgy = $(that).attr('data-brgy');


    $('#serid').val(id);
    $('#ttle').val(title);
    $('#require').val(require);
    $('#details').val(details);
    $('#amount').val(amount);

    

    var str = file;
    var n = str.includes("data:image");
    if(!n){
        file = 'assets/uploads/'+brgy+'/services/'+file;
    }
    $('#photo').attr('src',file);


}



function savepayment(that){
   
    resid = $(that).attr('data-resid');
    amount = $(that).attr('data-amount');
    docreq = $(that).attr('data-docreq');
    reqno = $(that).attr('data-reqno');
    $('#resid').val(resid);
    $('#reqno').val(reqno);

    $('#amount').val(amount);
   
    $('#docreq').val(docreq);
}












function editOfficial(that){
    id = $(that).attr('data-id');
    na = $(that).attr('data-name');
    chair = $(that).attr('data-chair');
    pos = $(that).attr('data-pos');
    start = $(that).attr('data-start');
    end = $(that).attr('data-end');
    status = $(that).attr('data-status');

    official = $(that).attr('data-official');
    brgyname = $(that).attr('data-brgyname');
    

    $('#brgy').val(brgyname);
    $('#off_id').val(id);
    $('#name').val(na);
    $('#chair').val(chair);
    $('#position').val(pos);
    $('#start').val(start);
    $('#end').val(end);
    $('#status').val(status);

    var str = official;
    var n = str.includes("data:image");
    if(!n){
        official = 'assets/uploads/'+brgyname+'/'+official;
    }
    $('#image').attr('src', official);
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
    houseno	    = $(that).attr('data-houseno');
    street      = $(that).attr('data-street');
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

    ename 	    = $(that).attr('data-ename');
    eno 	    = $(that).attr('data-eno');

    bmi 	    = $(that).attr('data-bmi');
    bmicateg	    = $(that).attr('data-bmicateg');




    remarks 	    = $(that).attr('data-remarks');

        verify    = $(that).attr('data-verify');
        blocklisted    = $(that).attr('data-blocklisted');


    dead 	    = $(that).attr('data-dead');
    pwd 	    = $(that).attr('data-pwd');

    hof 	    = $(that).attr('data-hof');

    respic         = $(that).attr('data-respicture');

    username         = $(that).attr('data-username');
    


    $('#username').val(username);



    email         = $(that).attr('data-email');
    

    pregnant 	    = $(that).attr('data-pregnant');
    soloparent 	    = $(that).attr('data-soloparent');

    $('#pregnant').val(pregnant);
    $('#soloparent').val(soloparent);



    relation 	    = $(that).attr('data-relation');

    $('#relation').val(relation);



    hno 	    = $(that).attr('data-hno');
    $('#hno').val(hno);

    $('#email').val(email);

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



       
    currentadd= houseno+'  '+'  '+street;
     
    $('#curradd').val(currentadd);
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

    $('#ename').val(ename);
    $('#eno').val(eno);
    $('#result').val(bmi);
    $('#category').val(bmicateg);

    $('#verify').val(verify);
    $('#blocklisted').val(blocklisted);

    $('#disability').val(pwd);

    $('#remarks').val(remarks);
   
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


    if(pwd==1){
        $("#pwdyes").prop("checked", true);
    }else{
        $("#pwdno").prop("checked", true);
    }


    var str = respic;
    var n = str.includes("data:image");
    
    if(str!=''){


        

        if(!n){
          
          
            respic = "assets/uploads/resident_profile/"+resid+'/'+respic;
    
    
    
            $('#image').attr('src', respic);
            
        }


    }else{
     
        respic = "assets/img/person.png";
        $('#image').attr('src', respic);
        
    }


    $('#image').attr('src', respic);
   
   
   
   

}

function editVacc(that){

    id          = $(that).attr('data-resid');
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
    vbrand 	    = $(that).attr('data-vbrand');
    vstatus = $(that).attr('data-vstatus');



    $('#resid').val(id);
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);
    $('#v_brand').val(vbrand);
    $('#v_status').val(vstatus);





}


function editBlotter1(that){
    id          = $(that).attr('data-id');
    complainant = $(that).attr('data-complainant');
    comage = $(that).attr('data-com_age');
    comadd= $(that).attr('data-comadd');
    comcontact= $(that).attr('data-comtact');


    respondent 		= $(that).attr('data-respondent');
	resage 		= $(that).attr('data-resage');

    resadd 		= $(that).attr('data-resadd');


    type 		= $(that).attr('data-type');
	l 		= $(that).attr('data-l');
    dateincident 	    = $(that).attr('data-dateincident');
	timeincident 		= $(that).attr('data-timeincident');

    datenotice 	    = $(that).attr('data-datenotice');
	timenotice 		= $(that).attr('data-timenotice');

    details 		= $(that).attr('data-details');
    status 	= $(that).attr('data-status');
    
    
     amount 	= $(that).attr('data-amount');
     
     orno 	= $(that).attr('data-orno');
    
    
    
      uname 		= $(that).attr('data-username');
    bimage = $(that).attr('data-bimage');
    limage = $(that).attr('data-limage');

    bsrc='assets/uploads/'+uname+'/blotter/'+bimage;
     lsrc='assets/uploads/'+uname+'/blotter/'+limage;
     
        $('#blotterimg').attr('src', bsrc);
          $('#logbook').attr('src', lsrc);
    

    $('#blotter_id').val(id);
    $('#complainant').val(complainant);
    $('#comage').val(comage);
    $('#comadd').val(comadd);
    $('#comtact').val(comcontact);
  
 
    $('#respondent').val(respondent);
    $('#resage').val(resage);
    $('#resadd').val(resadd);
    $('#type').val(type);
    $('#location').val(l);
    $('#dateincident').val(dateincident);
    $('#timeincident').val(timeincident);

    $('#datenotice').val(datenotice);
    $('#timenotice').val(timenotice);
    $('#details').val(details);
    $('#status').val(status);
    
    
     $('#amount').val(amount);
     $('#orno').val(orno);
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

  /*

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

  */

  function editCerts(that){
    controlno          = $(that).attr('data-controlno');
    orno          = $(that).attr('data-orno');
    ctcno          = $(that).attr('data-ctcno');
      amount          = $(that).attr('data-amount');

    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');

    date = $(that).attr('data-date');
    resid = $(that).attr('data-resid');

    fullname=fname+" "+mname+"  "+lname;


    purpose          = $(that).attr('data-purpose');

    $('#controlno').val(controlno);
    $('#orno').val(orno);
    $('#amount').val(amount);
    $('#resid').val(resid);

    $('#ctcno').val(ctcno);
    $('#fullname').val(fullname);

    $('#purpose').val(purpose);
    $('#date').val(date);
  }


  function editBusinessPermit(that){
     busno          = $(that).attr('data-busno');
    orno          = $(that).attr('data-orno');
    ctcno          = $(that).attr('data-ctcno');

   amount         = $(that).attr('data-amount');
    bo         = $(that).attr('data-BO');
    dtino          = $(that).attr('data-dtino');

    bname          = $(that).attr('data-bname');
    bnature          = $(that).attr('data-bnature');
    bstreet          = $(that).attr('data-bstreet');
    bcontact          = $(that).attr('data-bcontact');

    applied          = $(that).attr('data-applied');
    expired         = $(that).attr('data-expired');
    


    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');

    fullname=fname+" "+mname+"  "+lname;



    $('#busno').val(busno);
    $('#orno').val(orno);


    $('#bname').val(bname);
    $('#bnature').val(bnature);


    $('#natureBO').val(bo);
    $('#dtino').val(dtino);

    $('#bstreet').val(bstreet);
    $('#bcontact').val(bcontact);


    $('#applied').val(applied);
    $('#expired').val(expired);

    $('#ctcno').val(ctcno);
    $('#amount').val(amount);
    
    $('#fullname').val(fullname);

  
  }



  function editBuildingPermit(that){
    bpno          = $(that).attr('data-bpno');
   orno          = $(that).attr('data-orno');
   ctcno          = $(that).attr('data-ctcno');

   houseno  = $(that).attr('data-house');
   street  = $(that).attr('data-bstreet');

   applied          = $(that).attr('data-applied');

   
  amount  = $(that).attr('data-amount');

   fname = $(that).attr('data-fname');
   mname = $(that).attr('data-mname');
   lname = $(that).attr('data-lname');

   fullname=fname+" "+mname+"  "+lname;



   $('#bpno').val(bpno);
   $('#orno').val(orno);


  $('#amount').val(amount);
   $('#bhouseno').val(houseno);
   $('#bstreet').val(street);



   $('#applied').val(applied);


   $('#ctcno').val(ctcno);
   $('#fullname').val(fullname);

 
 }



  




 function editBarangay(that){
   
    barno = $(that).attr('data-barno');

    uname = $(that).attr('data-uname');
    barangayname = $(that).attr('data-brgyname');
    email = $(that).attr('data-email');
    
    $('#barno').val(barno);
     $('#bar_no').val(barno);
    $('#uname').val(uname);
    $('#brgyname').val(barangayname);
     $('#brgy_name').val(barangayname);
    $('#email').val(email);

 }


  function editCedula(that){
    resid          = $(that).attr('data-resid');
    fname 		= $(that).attr('data-fname');
	mname 		= $(that).attr('data-mname');
    lname 		= $(that).attr('data-lname');
 

    
    ctc_id = $(that).attr('data-ctc_id');
    ctcno = $(that).attr('data-ctcno');
    amount = $(that).attr('data-amount');
    date = $(that).attr('data-date');
     

    fullname= 'RES ID: '+resid+' | '+fname+' '+mname+' '+lname; 
    uname 		= $(that).attr('data-username');
    cedula = $(that).attr('data-cedulaimage');

    cedulasrc='assets/uploads/'+uname+'/cedula/'+cedula;

    


    $('#fullname').val(fullname);
    $('#ctcid').val(ctc_id);
    $('#ctcno').val(ctcno);
    $('#amount').val(amount);
    $('#date').val(date);

    $('#cedulapic').attr('src', cedulasrc);

 }





 function editEquipment(that){
   
    id = $(that).attr('data-id');
    equipname = $(that).attr('data-eqname');
    description = $(that).attr('data-description');
    status = $(that).attr('data-status');
    qty = $(that).attr('data-qty');
    $('#id').val(id);
    $('#equipname').val(equipname);
    $('#description').val(description);

    $('#qty').val(qty);
   
    $('#status').val(status);
}


function senddocs(that){
   
   
  
    reqno = $(that).attr('data-reqno');
    dtype = $(that).attr('data-dtype');
    resid = $(that).attr('data-resid');

    $('#req').val(reqno);
    $('#dtype').val(dtype);
    $('#residentid').val(resid);


}
  



  function editImmune(that){
   
   
  
    immno = $(that).attr('data-immno');
    immtype = $(that).attr('data-immtype');
    datevisit = $(that).attr('data-datevisit');

    $('#immno').val(immno);
    $('#immtype').val(immtype);
    $('#datevisit').val(datevisit);

}



 function editCheckUp(that){
   
   
  
    checkno = $(that).attr('data-checkupno');
    type = $(that).attr('data-type');
    datevisit = $(that).attr('data-datevisit');

    $('#checkno').val(checkno);
    $('#type').val(type);
    $('#datevisit').val(datevisit);

}



function editProject(that){
   
   
  
    projno = $(that).attr('data-projno');
    projectname = $(that).attr('data-projectname');
    fundby = $(that).attr('data-fundby');
    budget = $(that).attr('data-budget');
    approveddate = $(that).attr('data-approveddate');
    enddate = $(that).attr('data-enddate');
    projstatus = $(that).attr('data-projstatus');
    projectdes = $(that).attr('data-projectdes');
    sponsorname = $(that).attr('data-sponsorname');
    $('#projno').val(projno);
    $('#projectname').val(projectname);
    $('#fundby').val(fundby);
    $('#budget').val(budget);
    $('#approveddate').val(approveddate);
    $('#enddate').val(enddate);
    $('#projstatus').val(projstatus);
    $('#projectdes').val(projectdes);

    $('#spname').val(sponsorname);

}



function editCity(that){
   
   
  
    cityid = $(that).attr('data-cityid');
    cityname = $(that).attr('data-cityname');
    province = $(that).attr('data-province');
    zipcode = $(that).attr('data-zipcode');
  
    $('#cityid').val(cityid);
    $('#cityname').val(cityname);
    $('#province').val(province);
    $('#zipcode').val(zipcode);
  

}


function editProvince(that){
   
   
  
    provinceid = $(that).attr('data-provinceid');

    province = $(that).attr('data-province');
  
    $('#provinceid').val(provinceid);
    $('#provincename').val(province);
  

}



function editHouseRecord(that){
   
   
  
  hno = $(that).attr('data-hno');
  householdno = $(that).attr('data-householdno');
  street = $(that).attr('data-street');

  htype = $(that).attr('data-htype');
  land = $(that).attr('data-land');
  electric = $(that).attr('data-electricitysource');

  waste = $(that).attr('data-wastedisposal');
  water = $(that).attr('data-watersource');
  toilet= $(that).attr('data-toilet');
  
  appliances = $(that).attr('data-appliances');
  vehicle = $(that).attr('data-vehicle');
  energy = $(that).attr('data-energysource');


    $('#hno').val(hno);
    $('#houseno').val(householdno);
    $('#street').val(street);


    $('#htype').val(htype);
    $('#land').val(land);
    $('#electric').val(electric);

    $('#waste').val(waste);
    $('#water').val(water);
    $('#toilet').val(toilet);

    $('#appliance').val(appliances);
    $('#vehicle').val(vehicle);
    $('#energy').val(energy);



}


function editPregnant(that){
   
   
  
    pregno = $(that).attr('data-pregno');
    mpregnant = $(that).attr('data-mpregnant');
    noc = $(that).attr('data-nochild');
  
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
    suffix = $(that).attr('data-suffix');
  
  
      $('#pregno').val(pregno);
      $('#mop').val(mpregnant);
      $('#noc').val(noc);
      
      fullname=lname+' ,'+fname+'  '+mname+'  '+suffix;

      $('#fullname').val(fullname);

  
  
  
  
  }
  
  
  
  
  
function editPatient(that){
   
   
  
    patientno = $(that).attr('data-pno');
    findings = $(that).attr('data-findings');
    treatment = $(that).attr('data-treatment');
     date = $(that).attr('data-date');
  
    fname = $(that).attr('data-fname');
    mname = $(that).attr('data-mname');
    lname = $(that).attr('data-lname');
    suffix = $(that).attr('data-suffix');
  
  
      $('#pno').val(patientno);
      $('#findings').val(findings);
      $('#treatment').val(treatment);
      
        $('#date').val(date);
      
      fullname=lname+' ,'+fname+'  '+mname+'  '+suffix;

      $('#fullname').val(fullname);

  
  
  
  
  }




function editMedicine(that){
   
   
  
    medno= $(that).attr('data-medno');
    medname = $(that).attr('data-medname');
    medqty = $(that).attr('data-medqty');
  
    medstocks = $(that).attr('data-medstocks');
 
  
  
      $('#medno').val(medno);
      $('#medname').val(medname);
      $('#qty').val(medqty);
      
      $('#stocks').val(medstocks);

  
  
  
  
  }


  function editExpMedicine(that){
   
   
    expno= $(that).attr('data-expno');
    medno= $(that).attr('data-medno');
    medname = $(that).attr('data-medname');
    medqty = $(that).attr('data-medqty');
  
    medstocks = $(that).attr('data-medstocks');
    medexp = $(that).attr('data-medexp');
 
  
    $('#expno').val(expno);
      $('#medno').val(medno);
      $('#emed_name').val(medname);
      $('#eqty').val(medqty);

      
      $('#expstocks').val(medstocks);

      $('#medexp').val(medexp);
  
  
  
  
  }


    function editReqMed(that){
   
   
   reqmedno= $(that).attr('data-reqmedno');
    bhw = $(that).attr('data-bhw');
    medname = $(that).attr('data-medname');
    medqty = $(that).attr('data-medqty');

    datereq = $(that).attr('data-datereq');
  
 
 
  
    $('#reqmedno').val(reqmedno);

      $('#reqmedname').val(medname);
      $('#reqqty').val(medqty);

      $('#bhwname').val(bhw);


      $('#datereq').val(datereq);


           fname = $(that).attr('data-fname');
           mname = $(that).attr('data-mname');
           lname = $(that).attr('data-lname');
           suffix = $(that).attr('data-suffix');
         
         
        
             
             fullname=lname+' , '+fname+'  '+mname+'  '+suffix;
        
             $('#fullname').val(fullname);

    
  
  
  
  
  }



function sendVisit(that){
   
   
  
    resid= $(that).attr('data-resid');

  
  
      $('#resid').val(resid);

  
  
  
  
  }
  
  
  
function editUsers(that){
   
   
  
    clerkid= $(that).attr('data-clerkid');

  
  
      $('#clerkid').val(clerkid);
      
      
         uname= $(that).attr('data-username');

  
  
      $('#userclerk').val(uname);
      

  
  
  
  
  }


  




