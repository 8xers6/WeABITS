<?php include '../server/server.php' ?>
<?php
$barno=$_SESSION['bar_no'];





$query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id  WHERE bar_no=$barno";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if($row){

    $barangayname 		= $row['barangayname'];
    $city 		= $row['City'];
    $province 		= $row['province'];
    $phone 		= $row['phonenumber'];
    $email= $row['email'];
    $brgylogo= $row['brgylogo'];
    $citylogo= $row['citylogo'];
    $busername= $row['username'];
    $mission= $row['mission'];
    $vision= $row['vision'];
}

if(!empty($_POST['live_search'])){

$search=$_POST['live_search'];




if(strlen($search)>0){
    $barno=$_SESSION['bar_no'];

    $query1 = "SELECT * FROM tblequipments WHERE bar_no=$barno AND equipment_name LIKE '%$search%'";
      
   
    $result1 = $conn->query($query1);

    if(mysqli_num_rows($result1)>0){
    
    
    
        
    
        while($row = $result1->fetch_assoc()){
    
       
            $equipname=$row['equipment_name'];
            $qty=$row['quantity'];

            $status=$row['status'];

            $id=$row['equip_no'];
     


        echo '<div class="col-md-5 m-2  border  shadow ">

        <div class="row bg-primary d-flex flex-row-reverse  " >
    
       <div class="form-button-action"> 
       <a type="button" href="#edit" data-toggle="modal" class="btn btn-link bg-primary " title="Edit Equipment"  onclick="editEquipment(this)"
       data-id="'.$id.'"    data-eqname="'.$equipname.'"   data-qty="'.$qty.'"   data-status="'.$status.'"
        >
        
                                             <b class="text-white">  <i class="fa fa-edit"></i></b>
                                          </a>
          
       <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

       <li class="nav-item dropdown hidden-caret">
           <a class="btn btn-primary fw-bold  dropdown-toggle" style="color:white;" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 X
           </a>
           <ul class="dropdown-menu  animated fadeIn p-2" aria-labelledby="messageDropdown">
           <p class="fw-bold text-center" style="font-size:12px;">Remove this Equipment?</p>
           <a type="button" data-toggle="tooltip" href="model/remove_equipment.php?id='.$id.'"  class="btn  btn-light bg-success text-white " data-original-title="Remove">
           <b>YES</b>
                  </a>
                  <a type="button"  class="btn  btn-light bg-danger text-white " >
                  <b>NO</b>
                         </a>
           </ul>
       </li>
   </ul>
                          </div>
        </div>

        

        <div class="d-flex flex-column mt-1">
      
       
     
        
                            
                        

        </div>

        <div class="row justify-content-center">


      

        <h2 style="font-weight:bolder;"> '.$equipname.' </h2> 
        </div>
       


      

        <div class="row ">
        <div class="col-3">
         <b>Quantity:</b>

        </div>
        <div class="col-2">
       <p style="text-align:justify; text-justify: inter-word;" class="fw-bold">'.$qty.'</p>
       

        </div>


        <div class="col-3">
        <b>Status:</b>

       </div>
       <div class="col-4">
      <p style="text-align:justify; text-justify: inter-word;" class="fw-bold">'.$status.'</p>
      

       </div>


       

          
      

  </div>
                                          
     
    
 </div>';
        }
    
    }else{
    
    
        echo '<div class="row md-12 justify-content-center" ><h1>No Related results.</h1></div>';
    }

}
  

}else{






  

    $query1 = "SELECT * FROM tblequipments WHERE bar_no=$barno";
      
        $result1 = $conn->query($query1);
    
        if(mysqli_num_rows($result1)>0){
    
    
    
        
    
        while($row = $result1->fetch_assoc()){
    
            
                $equipname=$row['equipment_name'];
                $qty=$row['quantity'];

                $status=$row['status'];

                $id=$row['equip_no'];


                $image=$row['image'];
         


            echo '<div class="col-md-5 m-2  border  shadow ">

            <div class="row bg-primary d-flex flex-row-reverse  " >
        
           <div class="form-button-action">
           <a type="button" href="#edit" data-toggle="modal" class="btn btn-link bg-primary " title="Edit Equipment" onclick="editEquipment(this)" 
           data-id="'.$id.'"    data-eqname="'.$equipname.'"   data-qty="'.$qty.'"   data-status="'.$status.'"
            >
            
                                                 <b class="text-white">  <i class="fa fa-edit"></i></b>
                                              </a>
              
           <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

           <li class="nav-item dropdown hidden-caret">
               <a class="btn btn-primary fw-bold  dropdown-toggle" style="color:white;" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     X
               </a>
               <ul class="dropdown-menu  animated fadeIn p-2" aria-labelledby="messageDropdown">
               <p class="fw-bold text-center" style="font-size:12px;">Remove this Equipment?</p>
               <a type="button" data-toggle="tooltip" href="model/remove_equipment.php?id='.$id.'"  class="btn  btn-light bg-success text-white " data-original-title="Remove">
               <b>YES</b>
                      </a>
                      <a type="button"  class="btn  btn-light bg-danger text-white " >
                      <b>NO</b>
                             </a>
               </ul>
           </li>
       </ul>
                              </div>
            </div>
    
            

            <div class="d-flex flex-column mt-1">
          
           
         
            
                                
                            

            </div>

            <div class="row justify-content-center">
            <img src="../assets/uploads/'.$_SESSION['username'].'/equipment/'.$image.'" class=" "  width="100%" height="200" alt="Responsive image">
            <h2 style="font-weight:bolder;"> '.$equipname.' </h2> 
            </div>
           


          

            <div class="row ">
            <div class="col-3">
             <b>Quantity:</b>

            </div>
            <div class="col-2">
           <p style="text-align:justify; text-justify: inter-word;" class="fw-bold">'.$qty.'</p>
           

            </div>


            <div class="col-3">
            <b>Status:</b>

           </div>
           <div class="col-4">
          <p style="text-align:justify; text-justify: inter-word;" class="fw-bold">'.$status.'</p>
          

           </div>


           

              
          

      </div>
                                              
         
        
     </div>';
    
    
        
        }
    
    }else{
    
    
        echo '<div class="row md-12 justify-content-center" ><h1>No Available data</h1></div>';
    }
    




}











?>



