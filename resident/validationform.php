

<div id="login_form" style="display:none;" class="mt-4 mb-4">

<form id="forms" enctype="multipart/form-data"  method="post" >
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">


<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>New Registration Form </b></h2>
</div>









</div>

<div class="row  pl-3 pr-3 pt-1 pb-3  bg-white  border shadow rounded justify-content-center">








                        





                    


                           
                          
                           



                          




                                         
                         
<div class="col-md-3   ">
                           
                           
                           <label >Firstname</label>
                                              <input type="text" id="fname" class="form-control" placeholder="Firstname"  name="fname"  required>
                           </div>

                           <div class="col-md-3">
                           
                           
                           <label>Middlename</label>
                                              <input type="text" class="form-control " placeholder="Middle"  name="mname"  required>
                           </div>
                           <div class="col-md-3">
                           
                           
                           <label>Lastname</label>
                                              <input type="text" class="form-control" placeholder="Lastname"  name="lname"  required>
                           </div>


                           <div class="col-md-3 ">
                                    <label class="fw-bold">Suffix</label> 
                                                    <select class="form-control" name="suffix"    required>
                                                    <option disabled selected value="">--Select Suffix--</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                    
                                    </div>

                                 


                        

                           
                           
    

                           <div class="col-md-4 ">
                                    <label>Province</label>
                                    <div class="search_select_box" >   
                                                            
                                                            <select name="province" class="form-control border" id="province" data-live-search="true"  required >
                                                            <option  selected value="">-- Select Province -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblprovince");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['province_id'].'">'.$row['province'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>

                                                            </div>
                       
  <div class="col-md-4  ">
                                    <label>Municipality/City</label>
                                   
                                                            
                                                            <select name="city" class="form-control border" id="city"  required >
                                                            <option disabled selected value="">-- Select City -- </option>
                                                        
                                                            </select>
                                                        </div>
                        
                        <div class="col-md-4">
                                    <label>Barangay</label>
                                    
                                                            
                                                            <select name="barno" class="form-control border" id="barangay"  data-live-search="true" required >
                                                            <option  disabled selected value="">-- Select Barangay -- </option>
                                                        
                                                            </select>
                                                      


                                                   
                                                            </div>
                         

                       

                               
                               
                               

                                   


                                   


                                   
                                   
                                       <div class="col-md-4 ">
                               <label>Type ID</label>
                                                     
                                                       <select class="form-control"  name="typeid"  required   >
                                                       <option disabled selected value="">--Select Type ID</option>
                                                       <option value="Passport">Passport</option>
                                                       <option value="Philhealth">Philhealth ID</option>
                                                       <option value="National ID">National ID</option>
                                                       <option value="Senior Citizen ID">Senior Citzen ID</option>
                                                       <option value="Student ID">Student ID</option>
                                                   
                                                    
                                                       

                                               </select>
                                               
                                               </div>

                        
                               
                               
                                     <div class="col-md-4 ">
                               <label>Valid ID</label>
                                                     <input type="file" id="validid" class="validphoto" name="validname" onchange="previewID()" accept="image/*" hidden>
                                                   <img src="../assets/img/uploadimage.png" class="idphoto  rounded mb-1"  width="100%" height="200"  alt="Image preview">
  <button type="button" class="front-btn  btn btn-primary rounded fw-bold text-white form-control" onclick="AttachValid()">Attach Valid ID</button>
                               </div>



      <div class="col-md-4 ">
                               <label>Billing Address</label>
                                                       <input type="file" id="billingadd" class="billingphoto" name="billname" onchange="previewBill()" accept="image/*" hidden >
                                                     <img src="../assets/img/uploadimage.png" class="billphoto  rounded mb-1"  width="100%" height="200"  alt="Image preview">
  <button type="button" class="front-btn  btn btn-primary rounded fw-bold text-white form-control" onclick="AttachBill()">Attach Billing Address</button>
                               </div>



                            

                           


                         


                          

                           


                          


                             

                            
<div class="col-md-12 m-1 pb-2 rounded  text-center mt-5">
<div id="checkerrors" > </div>
 <span role="alert" id="ssloading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span> 
<input type="checkbox" class=""  name="terms" id="terms" value="accepted"/>
                <label for="terms">I have read and agree to the </label>
                <a  href="#view" data-toggle="modal" class="fw-bold"
                                                                   >terms of service and conditions
                                                                </a>
                                          
      

                        
</div>

<div  class="col-md-5 ">







     
                                                            
                                                                    
      <button type="submit" class="col btn btn-primary fw-bold mt-1"  value="Submit"  id="btnsub">Submit</button>



  
                                                                

                  
                                                           


</div>





</div>







</div>









                   

						
</form>


                                                                </div>
                                                              
                                                                
                                                                
                                                                
                                                                
                                                               
                                                              
                                        
                                        