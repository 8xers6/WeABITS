
<script>
    
    $("#house_form").on('submit',(function(e) {
  e.preventDefault();




  $.ajax({
         url: "resident/houseajax.php",
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
 
        //$('#addfamily_form').html(response);


/*
 
        if($.trim(response)=='next'){
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

          document.getElementById("addfamily_form").style.display = "block";
      document.getElementById("household_form").style.display = "none"


        }else{




        }
         
*/
        

      },
    
              
    });


  








}));




$('#btnback').click(function() {

  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

  
  document.getElementById("headoffamily").style.display = "inline";
document.getElementById("household_form").style.display = "none"; 
     
      
  
});
    
    
</script>

 <b class="text-link ml-3">Personal Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-primary"> HouseHold Info </b><i class='fas fa-angle-right' style='font-size:15px'></i><b class="text-link">Add Family Members</b>
<form id="house_form" enctype="multipart/form-data"  method="post" autocomplete="off">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">


<div class="row  p-3 shadow rounded border">


<div class="col-md-12 ">

<b style="font-size:30px;"><img src="assets/uploads/<?= $_SESSION['buname'] ?>/barangayinfo/<?=$_SESSION['brgylogo'] ?>" class="text-center rounded-circle" height="60" width="60" >Brgy. <?=$_SESSION['brgyname'] ?> </b>
</div>



</div>

<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>HouseHold Information</b></h2>
</div>



</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white  border shadow rounded justify-content-center">




<div class="col-md-3 m-1 p-2 border rounded ">


<label for="housno" class="placeholder">House No.</label>
					<input  name="houseno" type="text" class="form-control " placeholder="Household No"  required>
				
  



              

                                  
                                                         
</div>

<div class="col-md-4 m-1 p-2 border rounded ">


  <label> Street</label>
                                    <div class="search_select_box" >   
                                                            
                                                            <select name="street" class="form-control border" id="province" data-live-search="true"  required >
                                                            <option  selected value="">-- Select Street -- </option>
                                                            <?php
                                                                $barno=$_SESSION['barno'];
                                                                $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>

              

                                  
                                                         
</div>


<div class="col-md-3 m-1 p-2 border rounded ">


<label for="" class="placeholder">House Type.</label>

                                               <select class="form-control"    name="housetype" required>
                                                   <option disabled selected value="">Select House Type</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>

              

                                  
                                                         
</div>



<div class="col-md-3 m-1 p-2 border rounded ">

<label for="" class="placeholder">Land Ownership.</label>

                                               <select class="form-control"    name="landownership" required>
                                                   <option disabled selected value="">Select Land Ownership</option>
                                                   <option value="Owner">Owner</option>
                                                   <option value="Rent">Rent</option>
                                               </select>



              

                                  
                                                         
</div>



<div class="col-md-4 m-1 p-2 border rounded ">

<label for="" class="placeholder">Source of Electricty</label>

                                               <select class="form-control"    name="s_electricity" required>
                                                   <option disabled selected value="">Select Source of Electricity</option>
                                                   <option value="Power Distributor">Power Distributor</option>
                                                   <option value="Gas">Gas</option>
                                               </select>
  



              

                                  
                                                         
</div>





<div class="col-md-3 m-1 p-2 border rounded ">

<label for="" class="placeholder">Source of Energy for Cooking</label>

                                               <select class="form-control"    name="s_cooking" required>
                                                   <option disabled selected value="">Source of Energy for Cooking</option>
                                                   <option value="Electricity">Electricity</option>
                                                   <option value="Gas">Gas</option>
                                                   <option value="Gas">Wood</option>
                                               </select>



              

                                  
                                                         
</div>



<div class="col-md-3 m-1 p-2 border rounded">






                         
<label for="" class="placeholder">Source of Water</label>

                                               <select class="form-control"    name="source_water" required>
                                                   <option disabled selected value="">Select Source of Water</option>
                                                   <option value="Deep Well">Deep Well</option>
                                                   <option value="Deep Well">Water Pump</option>
                                                   <option value="Faucet">Faucet</option>
                                               </select>
                     
                



</div>







              

                                  




<div class="col-md-4 m-1 p-2 border rounded ">

<label for="" class="placeholder">Waste Disposal</label>

                                               <select class="form-control"    name="waste_disposal" required>
                                                   <option disabled selected value="">Select Waste Disposal</option>
                                                   <option value="Hukay na may Takip">Hukay na may Takip</option>
                                                   <option value="Collected">Collected</option>
                                                   <option value="Sinusunog">Sinusunog</option>
                                                   
                                               </select>



              

                                  
                                                         
</div>


<div class="col-md-3 m-1 p-2 border rounded ">

<label for="" class="placeholder">Toilet Type</label>

                                               <select class="form-control"    name="toilet" required>
                                                   <option disabled selected value="">Select Toilet Type</option>
                                                   <option value="Flush">Flush</option>
                                                   <option value="De Buhos">Manual</option>
                                                   
                                               </select>


              

                                  
                                                         
</div>


<div class="col-md-5  m-1 border rounded ">









<b class="text-primary" >Vehicles:</b>

                                           
                 
<div class="row ">
                 


<div class="col  p-2 border rounded shadow-sm">


<input type="checkbox" id="car" name="vehicles[]" value="Car">
  <label for="car"> Car</label><br>

  <input type="checkbox" id="jeep" name="vehicles[]" value="Jeep">
  <label for="jeep"> Jeep</label><br>

  <input type="checkbox" id="motor" name="vehicles[]" value="MotorCycle">
  <label for="motor">Motorcycle</label><br>


  <input type="checkbox" id="bike" name="vehicles[]" value="Bike">
  <label for="bike">Bike</label><br>

                           </div> 

                           <div class="col  p-2 border rounded shadow-sm">
    

<input type="checkbox" id="truck"  name="vehicles[]" value="Truck">
  <label for="truck"> Truck</label><br>

  <input type="checkbox" id="tricycle" name="vehicles[]" value="Tricycle">
  <label for="tricycle"> Tricycle</label><br>

  <input type="checkbox" id="van" name="vehicles[]" value="Van/AUV">
  <label for="van">Van/AUV</label><br>

  <label  class="placeholder">others specify</label>   
					<input  name="vehicles[]" type="text" class="form-control " placeholder="Vehicles" >
                           </div> 
                           

</div>



                        

                           
                        


</div>


          

<div class="col-md-5 m-1 border rounded  ">












<b class="text-primary">Home Appliances:</b>

                                           
                     
<div class="row ">
                 


<div class="col p-2 border rounded shadow-sm">


<input type="checkbox" id="refrigerator" name="appliances[]" value="Refrigerator">
  <label for="refrigerator">Refrigerator</label><br>
  
  <input type="checkbox" id="freezer" name="appliances[]" value="Freezer">
  <label for="freezer">Freezer</label><br>
  
  <input type="checkbox" id="oven" name="appliances[]" value="Oven">
  <label for="oven">Oven</label><br>
  
  <input type="checkbox" id="stove" name="appliances[]" value="Stove">
  <label for="stove">Stove</label><br>
  <input type="checkbox" id="dryer" name="appliances[]" value="Dryer">
  <label for="dryer">Dryer</label><br>
                           </div> 

                           <div class="col  p-2 border rounded shadow-sm">
    

                           <input type="checkbox" id="microwave" name="appliances[]" value="Microwave">
  <label for="microwave">Microwave</label><br>
  
  <input type="checkbox" id="dishwasher" name="appliances[]" value="DishWasher">
  <label for="dishwasher">Dishwasher</label><br>
  
  <input type="checkbox" id="washing-machine" name="appliances[]" value="Washing-Machine">
  <label for="washing-machine">Washing Machine</label><br>
  

  <label  class="placeholder">others specify:</label>   
					<input  name="appliances[]" type="text" class="form-control " placeholder="Appliances" >
                           </div> 

</div>
                        

                           
                        


</div>


          

                      





                           
                      





                           

                          






                          




                               



                               

<div  class="col-md-4 m-1 pb-2  rounded shadow-sm">




<button type="submit" class="col btn btn-primary fw-bold mt-1" id="btnnext"  onclick="return confirm('Are you sure you want to proceed ?');" value="Submit" >Next</button>
                                               


                  
                                                           


</div>
<div id="errhouse" ></div>




</div>


</div>






                   

						
</form>
    





