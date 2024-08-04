
<?php include 'serverapi/server_api.php'  ?>
<?php 

	
	$id =$conn->real_escape_string($_POST['resid']);
   
	
	$barno		   = $conn->real_escape_string($_POST['barno']);
    $certificate  = $conn->real_escape_string($_POST['certificate']);

   

    
  

    if(!empty($id)){

     

       


if($certificate=='Certificate of Indigency'){
    

    $target 		   = $conn->real_escape_string($_POST['target']);
    $purpose 		   = $conn->real_escape_string($_POST['purpose']);
    
    
    if(!empty($target) && !empty($purpose)){
            
            
    $indigency = new \stdClass();
     
    $toint= (int)$target;
     
    $indigency->resid = $toint;
    $indigency->purpose =  $purpose;
    $purpose_json = json_encode($indigency);
    }
    

    
     



                                                                 

                                                                      
                                        $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`) VALUES ('$id','$certificate','$purpose_json')";
                                                                                     $result  = $conn->query($insert);
                                                                             
                                                                                     if($result === true){
                                                                                         
                                                                                         
                                                                                  $notifname=$certificate;
                                                        $notiftype='document';
                                                        $usertype='administrator';
                                                        $message='New Pending Request';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                        
                                                                                            echo json_encode(array("success"=>true));

                                                             }

                                                                                     
                                                                                      
                                                                                        
                                                                                         
                                                                             
                                                                                         
                                                                             
                                                                                         }
                                                                                         
                                                                                         
}
    

    

}else{


    echo 'idnotfound';

}




    ?>