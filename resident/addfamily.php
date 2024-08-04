<script>
    
    
    $("#submitreg_form").on('submit',(function(e) {
  e.preventDefault();


 document.getElementById("ssloading").style.display = "block";
 document.getElementById("allbtn").style.display = "none";
  $.ajax({
         url: "resident/submitregistration.php",
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
            
            
            
 document.getElementById("ssloading").style.display = "none";
 document.getElementById("allbtn").style.display = "block";
       
var modal = document.getElementById("view");


          $(modal).modal("show");
          $('#submiterr').html('<b style="color:red;">please check the terms of service and conditions</b>');

        

      
      }else{
       
        $('#submiterr').html(response);

        if($.trim(response)=='success'){
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
             $('#successna').html('<div class="col-md-12 rounded p-3 m-3 bg-success "><h3 class="text-white" >Registration Submitted</h3></div>');
               $('#household_form').remove();

        }else{




        }
      }

        

      },
    
              
    });



}));
    
    
</script>

    

 <b class="text-link ml-3">Personal Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-link"> HouseHold Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-primary">Add Family Members</b>
<form id="submitreg_form" enctype="multipart/form-data"  method="post" autocomplete="off">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">



<div class="row  p-3  rounded border">


<div class="col-md-12 ">


<b style="font-size:30px;"><img src="../assets/uploads/<?= $_SESSION['buname'] ?>/barangayinfo/<?=$_SESSION['brgylogo'] ?>" class="text-center rounded-circle" height="60" width="60" >Brgy. <?=$_SESSION['brgyname'] ?> </b>

</div>











</div>





<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>Add Family Members</b></h2>


</div>











</div>






<div class="row   pt-1 pb-3  bg-white  border shadow rounded justify-content-center">
  
<div class="col-md-12 ">



<ol class="paste-new-forms fw-bold " ></ol>
                            



                            <div class="col m-1 pb-2 rounded  text-center">
                                                     
                                                    
                                                       
                                                     <button type="button" class="add-more-form float-end btn btn-primary">  <i class="fa fa-plus"></i>Add Family Members</button>
                                                 </div>
</div>


<div class="col-md-12 ">

<div class="col m-1 pb-2 rounded  text-center">
<div id="submiterr" ></div>
<input type="checkbox" class=""  name="terms" id="terms" value="accepted"/>
                <label for="terms">I have read and agree to the </label>
                <a  href="#view" data-toggle="modal" class="fw-bold"
                                                                   >terms of service and conditions
                                                                </a>
                                             </div>
      

                        
</div>



                

                               

<div  class="col-md-4 m-1 pb-2  rounded shadow-sm">



      <span role="alert" id="ssloading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>  

<button type="submit" class="col btn btn-primary fw-bold mt-1"  value="Submit"  id="allbtn">Submit</button>
                                               

 
                                                                

                  
                                                           


</div>



</div>











                   

						
</form>
