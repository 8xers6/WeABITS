<?php include '../server/server.php' ?>
<?php


$resid=$_SESSION['resid'];



include 'brgy.php';

if(!empty($_POST['live_search_borrow'])){

$search=$_POST['live_search_borrow'];




if(strlen($search)>0){

   
    $query1="SELECT tblequipments.description,tblborrow.date_to_return as date_to_return,tblborrow.bor_no as bor_no,tblequipments.equipment_name as equipment_name,tblborrow.quantity as quantity, tblborrow.purpose as purpose,tblequipments.image as image    FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.res_id=$resid AND tblborrow.status='borrowed' AND tblequipments.equipment_name IS NOT NULL AND (tblborrow.bor_no LIKE '%$search%' OR tblequipments.equipment_name LIKE '%$search%') ORder by tblborrow.bor_no DESC;";
    $result1 = $conn->query($query1);

    if(mysqli_num_rows($result1)>0){

        while($row = $result1->fetch_assoc()){
    
               $borno=$row['bor_no'];
            $itemname=$row['equipment_name'];
                $description=  mb_strimwidth($row['description'], 0, 80, "...");
            $purpose=$row['purpose'];
            $qty=$row['quantity'];
              $str = $row['date_to_return']; 
           $image=$row['image'];
         $date = date('F j, Y', strtotime($str));
         
         $datetoborrow= $row['datetoborrow']; 
         $dtoborrow = date('F j, Y', strtotime($datetoborrow));
            echo ' <div class="row-md-10 m-1  rounded shadow-sm " style="width:290px; border-radius:20px;">
            
            
            <div class="row-md-10   ">
            
            
            <!---<div  class="row   justify-content-center p-2  ml-0  mr-0  text-white fw-bold rounded bg-danger-gradient">Borrow No.'.$borno.'<span class="badge  badge-danger  fw-bold">Pending</span></div> ----> <div class="row justify-content-center ">
                           <img src="../assets/uploads/'.$busername.'/equipment/'.$image.'" height="200" width="290" alt="Responsive image" style="width:290px; border-radius:20px;">
                           
                           
                           
                                <h4 class="mr-5 text-primary"><b>'.$itemname.' </b>    </h4>    
                      
                       
                                
                       
                         <h4 class="ml-5 text-success">Qty:'.$qty.'</h4> 
           </div> 
           
        
       
          

    </div>
    

    
    
    <div class="row ml-3 mr-3">
    
    
    
    </div> <div class="row justify-content-center  mb-1"><div class="container-fluid">


    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
 
    <li class="nav-item dropdown hidden-caret pl-2 pr-2">
    <!---
 
        <a class=" fw-bold  dropdown-toggle" style="color:red;" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cancel 
        </a>---->
         <p style="color:gray; text-align:justify; line-height: 1.25;">  '.$description.'   <a type="button" href="#viewborrow" data-toggle="modal" class="mr-2" title="View details" onclick="viewborrow(this)" 
    data-borno="'.$borno.'" data-purpose="'.$purpose.'" data-item="'.$itemname.'" data-qty="'.$qty.'" data-datetoreturn="'.$date.'" data-datetoborrow="'.$dtoborrow.'"
 
 >  
   View Details

</a></p>
       
        <ul class="dropdown-menu  animated fadeIn p-2" aria-labelledby="messageDropdown">
        <p class="fw-bold text-center" style="font-size:12px;">Cancel this Request?</p>
        <a type="button" data-toggle="tooltip" href="model/borrow_status.php?borno='.$borno.'"  class="btn  btn-light bg-success text-white " data-original-title="Remove">
        <b>YES</b>
               </a>
               <a type="button"  class="btn  btn-light bg-danger text-white " >
               <b>NO</b>
                      </a>
        </ul>
    </li>
</ul>

   
</div>





</div></div></div>';
    }

}else{


    echo '<div class="row justify-content-center" ><h3>No Related Result.</h3></div>';
}

}
  

}else{


    $query1=" SELECT  tblborrow.date_req as datetoborrow,tblequipments.description,tblborrow.date_to_return as date_to_return,tblborrow.bor_no as bor_no,tblequipments.equipment_name as equipment_name,tblborrow.quantity as quantity, tblborrow.purpose as purpose,tblequipments.image as image    FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.res_id=$resid AND tblborrow.status='borrowed' AND tblequipments.equipment_name IS NOT NULL  ORder by tblborrow.bor_no DESC;";
    $result1 = $conn->query($query1);
    
        if(mysqli_num_rows($result1)>0){
    
    
    
        
    
                
    
            while($row = $result1->fetch_assoc()){
    
                     $borno=$row['bor_no'];
            $itemname=$row['equipment_name'];
                $description=  mb_strimwidth($row['description'], 0, 80, "...");
            $purpose=$row['purpose'];
            $qty=$row['quantity'];
              $str = $row['date_to_return']; 
           $image=$row['image'];
         $date = date('F j, Y', strtotime($str));
         
         $datetoborrow= $row['datetoborrow']; 
         $dtoborrow = date('F j, Y', strtotime($datetoborrow));
            echo ' <div class="row-md-10 m-1  rounded shadow-sm " style="width:290px; border-radius:20px;">
            
            
            <div class="row-md-10   ">
            
            
            <!---<div  class="row   justify-content-center p-2  ml-0  mr-0  text-white fw-bold rounded bg-danger-gradient">Borrow No.'.$borno.'<span class="badge  badge-danger  fw-bold">Pending</span></div> ----> <div class="row justify-content-center ">
                           <img src="../assets/uploads/'.$busername.'/equipment/'.$image.'" height="200" width="290" alt="Responsive image" style="width:290px; border-radius:20px;">
                           
                           
                           
                                <h4 class="mr-5 text-primary"><b>'.$itemname.' </b>    </h4>    
                      
                       
                                
                       
                         <h4 class="ml-5 text-success">Qty:'.$qty.'</h4> 
           </div> 
           
        
       
          

    </div>
    

    
    
    <div class="row ml-3 mr-3">
    
    
    
    </div> <div class="row justify-content-center  mb-1"><div class="container-fluid">


    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
 
    <li class="nav-item dropdown hidden-caret pl-2 pr-2">
    <!---
 
        <a class=" fw-bold  dropdown-toggle" style="color:red;" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cancel 
        </a>---->
         <p style="color:gray; text-align:justify; line-height: 1.25;">  '.$description.'   <a type="button" href="#viewborrow" data-toggle="modal" class="mr-2" title="View details" onclick="viewborrow(this)" 
    data-borno="'.$borno.'" data-purpose="'.$purpose.'" data-item="'.$itemname.'" data-qty="'.$qty.'" data-datetoreturn="'.$date.'" data-datetoborrow="'.$dtoborrow.'"
 
 >  
   View Details

</a></p>
       
        <ul class="dropdown-menu  animated fadeIn p-2" aria-labelledby="messageDropdown">
        <p class="fw-bold text-center" style="font-size:12px;">Cancel this Request?</p>
        <a type="button" data-toggle="tooltip" href="model/borrow_status.php?borno='.$borno.'"  class="btn  btn-light bg-success text-white " data-original-title="Remove">
        <b>YES</b>
               </a>
               <a type="button"  class="btn  btn-light bg-danger text-white " >
               <b>NO</b>
                      </a>
        </ul>
    </li>
</ul>

   
</div>





</div></div></div>';
        }
    
    }else{
    
    
        echo '<div class="row md-12 justify-content-center" ><h1>No Available data</h1></div>';
    }
    



}











?>



