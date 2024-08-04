<?php include '../server/server.php' ?>
<?php
$barno=$_SESSION['barno'];

$resid=$_SESSION['resid'];




include 'brgy.php';

if(!empty($_POST['live_searchpending'])){

$search=$_POST['live_searchpending'];




if(strlen($search)>0){

    $query1 = "SELECT *,lpad(tblrequested_documents.req_no,6,'0') as req_no FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tbl_residents.bar_no=$barno AND tblrequested_documents.status='pending' AND (tblrequested_documents.req_no LIKE '%$search%' OR tblrequested_documents.certificate LIKE '%$search%')";
      
   
    $result1 = $conn->query($query1);

    if(mysqli_num_rows($result1)>0){
    
    
    
        
    
        while($row = $result1->fetch_assoc()){
    
             $reqno=$row['req_no'];
            $documenttype=$row['certificate'];
         
            $amount=$row['amount'];
            $purpose=$row['purpose'];

         
    
    
            echo ' <div class="row-md-5 m-1 border  rounded shadow-sm " style="width:290px;"><div class="row-md-10   "> 


            <div class="row justify-content-center  ml-0 p-2  mr-0  fw-bold  bg-primary-gradient  " style="pointer-events: none;">
         
             <i class="fas fa-file-contract text-white" style="font-size:100px;"></i>

         
           

            </div>
             <div class="row justify-content-center  fw-bold  " style="pointer-events: none;">
         
             <h3><b>'.$documenttype.'</b></h3>

            </div>


           
     <div class="row justify-content-center ">
     

     <form method="POST" action="reqviewdetails.php"  enctype="multipart/form-data" required>
     <input type="hidden" name="size" value="1000000">
     <input type="hidden" class="form-control" value="'.$reqno.'"  name="req_no" required>


     <?php if(isset($_SESSION["username"])): ?>
     <button type="submit" class="btn btn-link fw-bold">View Details</button>
     
     <?php endif ?>
</form>


                                                          
     
     
     </div></div></div>';
        }
    
    }else{
    
    
        echo '<div class="row md-12 justify-content-center" ><h1>No Related results.</h1></div>';
    }

}
  

}else{








    $query1 = "SELECT *,lpad(tblrequested_documents.req_no,6,'0') as req_no FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tbl_residents.bar_no=$barno  AND tblrequested_documents.status='pending' ORDER BY tblrequested_documents.req_no DESC;";
      
        $result1 = $conn->query($query1);
    
        if(mysqli_num_rows($result1)>0){
    
    
    
        
    
        while($row = $result1->fetch_assoc()){
    
            $reqno=$row['req_no'];
            $documenttype=$row['certificate'];
         
            $amount=$row['amount'];
            $purpose=$row['purpose'];

         
    
    
            echo ' <div class="row-md-5 m-1 border  rounded shadow-sm " style="width:290px;"><div class="row-md-10   "> 


            <div class="row justify-content-center  ml-0 p-2  mr-0  fw-bold  bg-primary-gradient  " style="pointer-events: none;">
         
             <i class="fas fa-file-contract text-white" style="font-size:100px;"></i>

         
           

            </div>
             <div class="row justify-content-center  fw-bold  " style="pointer-events: none;">
         
             <h3><b>'.$documenttype.'</b></h3>

            </div>


           
     <div class="row justify-content-center ">
     

     <form method="POST" action="reqviewdetails.php"  enctype="multipart/form-data" required>
     <input type="hidden" name="size" value="1000000">
     <input type="hidden" class="form-control" value="'.$reqno.'"  name="req_no" required>


     <?php if(isset($_SESSION["username"])): ?>
     <button type="submit" class="btn btn-link fw-bold">View Details</button>
     
     <?php endif ?>
</form>


                                                          
     
     
     </div></div></div>';
        }
    
    }else{
    
    
        echo '<div class="row md-12 justify-content-center" ><h1>No Available data</h1></div>';
    }
    



}











?>



