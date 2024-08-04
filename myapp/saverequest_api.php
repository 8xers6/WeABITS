
<?php include 'serverapi/server_api.php'  ?>
<?php 

	
	$id =$conn->real_escape_string($_POST['resid']);
    $busername =$conn->real_escape_string($_POST['busername']);

    $certificate  = $conn->real_escape_string($_POST['certificate']);
    $amount  = $conn->real_escape_string($_POST['amount']);

    $pmethod 		   = $conn->real_escape_string($_POST['pmethod']);

    if(!empty($id)){

                                    if($pmethod=='GCash')
                                    {

                                
   
                                                                if($certificate=='Barangay Clearance'){


                                                                    $purpose 		   = $conn->real_escape_string($_POST['purpose']);

                                                               
                                                     


                                                                    if(isset($_POST["gcashreceipt"])){
                                                     
                                                   
                                                                       $greceipt=$_POST["gcashreceipt"];
                                                                   
                                                                   }else return;
                                                                   if(isset($_POST["gcashreceiptname"])){
                                                                   
                                                                      $gcashname=$_POST["gcashreceiptname"];
                                                                   }else return;


                                                                   if(isset($_POST["resimage"])){
      
    
                                                                    $respicimage=$_POST["resimage"];
                                                                
                                                                }else return;
                                                                if(isset($_POST["resname"])){
                                                                
                                                                   $resname=$_POST["resname"];
                                                                }else return;
                                                                 
                                                   
                                                                   $newName = date('dmYHis').str_replace(" ", "", $gcashname);
                                                   
                                                             
   if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                              
                                                                       mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                      
                                                           
                                                                   } 
                                                                 
                                                   
                                                                   $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);


                                                                   $newName2= date('dmYHis').str_replace(" ", "", $resname);
                                                                   
                                                                   
                                                                   
                                                                       $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                   $resident->image = $newName2;
                                                                  
                                                                   $purpose_json = json_encode($resident);
    
                                                                                              
    
                                                                

                                                                   $target2 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName2);
                                                   
                                                              
                                                                   
                                                                   
                                                                   $insert="INSERT INTO `tblrequested_documents`(`res_id`, `certificate`, `purpose`, `amount`, `greceipt_screenshot`, `paymentmethod`) VALUES ($id,'$certificate','$purpose_json',$amount,'$newName','$pmethod')";
                                                                   $result  = $conn->query($insert);
                                                           
                                                                   if($result === true){
                                                                       
                                                                     
                                                                      
                                                                       
                                                                      
                                                                       if(file_put_contents($target,base64_decode($greceipt))){

                                                                        if(file_put_contents($target2,base64_decode($respicimage))){
                                                         
                                                                            	$barno		   = $conn->real_escape_string($_POST['barno']);
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
                                                                       
                                                           
                                                                    
                                                           
                                                                   }
                                                                
                                                                }elseif($certificate=='Business Clearance'){

                                                                   
                                                                    $type  = $conn->real_escape_string($_POST['type']);
                                                                    $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
                                                                    $businessadd  = $conn->real_escape_string($_POST['businessadd']);
                                                                    $natureBO  = $conn->real_escape_string($_POST['natureBO']);
                                                                    $dtino  = $conn->real_escape_string($_POST['dtino']);
                                                                    $bnature  = $conn->real_escape_string($_POST['bnature']);
                                                                    $bphone  = $conn->real_escape_string($_POST['bphone']);
                                                                    
                                                                    
                                                                    
                                                              
                                                                         
                                                                    if(isset($_POST["gcashreceipt"])){
  

                                                                        $greceipt=$_POST["gcashreceipt"];
                                                                    
                                                                    }else return;
                                                                    if(isset($_POST["gcashreceiptname"])){
                                                                  
                                                                       $gcashname=$_POST["gcashreceiptname"];
                                                                    }else return;
    
    
    
                                                                   


                                                                    if(isset($_POST["businessimage"])){
      
    
                                                                        $businesspicimage=$_POST["businessimage"];
                                                                    
                                                                    }else return;
                                                                    if(isset($_POST["businesspicname"])){
                                                                     
                                                                       $businesspicname=$_POST["businesspicname"];
                                                                    }else return;
                                                                        
    
                                                                                        $newName = date('dmYHis').str_replace(" ", "", $gcashname);
    
                                                                                              
    
                                                                                                if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                                           
                                                                                                    mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                                                   
                                                                                        
                                                                                                } 
            
                                                                                                $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);
    
    
    
                                                                                                $newName2 = date('dmYHis').str_replace(" ", "", $businesspicname);
                                                                                                
                                                                                                
                                                                                                  $business = new \stdClass();
                                                                   $business->type = $type;
                                                                   $business->nbusiness = $namebusiness;
                                                                   $business->businessadd = $businessadd;
                                                                   $business->natureBo = $natureBO;
                                                                   $business->dtino = $dtino;
                                                                   $business->bnature = $bnature;
                                                                   $business->bphone = $bphone;
                                                                   $business->image = $newName2;
                                                                  
                                                                   $purpose_json = json_encode($business);
    
                                                                                              
    
                                                                                           
            
                                                                                                $target2 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName2);
    
                                                                                          
                                                                                            
$insert  = "INSERT INTO `tblrequested_documents`( `res_id`, `certificate`, `amount`, `greceipt_screenshot`, `paymentmethod`,`purpose`) 
VALUES ('$id','$certificate','$amount','$newName','$pmethod','$purpose_json')";
                                                                                            $result  = $conn->query($insert);
                                                                                    
                                                                                            if($result === true){
    
    
                                                              
    
                                                                                                    if(file_put_contents($target,base64_decode($greceipt))){


                                                                                                        if(file_put_contents($target2,base64_decode($businesspicimage))){
          
                                                                                                            	$barno		   = $conn->real_escape_string($_POST['barno']);
                                                                                                                    $notifname=$certificate;
                                                        $notiftype='document';
                                                        $usertype='administrator';
                                                        $message='New Pending Request';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`(`bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                        
                                                                                            echo json_encode(array("success"=>true));

                                                             }
                                                                                                         }
                                                                                                      
                                                                                                     }
                                                                                                 
    
                                                                                             
                                                                                               
                                                                                                
                                                                                    
                                                                                                
                                                                                    
                                                                                                }
                                                                         


                                                                
                                                                }
                                                                elseif($certificate=='Building Clearance'){



                                                                    $houseno 		   = $conn->real_escape_string($_POST['houseno']);

                                                                   $street 		   = $conn->real_escape_string($_POST['street']);
                                                                   
                                                                   
                                                                   $building = new \stdClass();
                                                                   $building->houseno = $houseno;
                                                                   $building->street=  $street;
                                                                   $purpose_json = json_encode($building);
    
     

               


                                                                    if(isset($_POST["gcashreceipt"])){
                                                     
                                                   
                                                                       $greceipt=$_POST["gcashreceipt"];
                                                                   
                                                                   }else return;
                                                                   if(isset($_POST["gcashreceiptname"])){
                                                                   
                                                                      $gcashname=$_POST["gcashreceiptname"];
                                                                   }else return;
                                                   
                                                                 
                                                   
                                                                   $newName = date('dmYHis').str_replace(" ", "", $gcashname);
                                                   
                                                                    if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                                                                                          
                                                                       mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                      
                                                           
                                                                   } 
                                                   
                                                                   $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);
$insert="INSERT INTO `tblrequested_documents`(`res_id`, `certificate`, `purpose`, `amount`, `greceipt_screenshot`, `paymentmethod`) VALUES ($id,'$certificate','$purpose_json','$amount','$newName','$pmethod')";
                                                                   $result  = $conn->query($insert);
                                                           
                                                                   if($result === true){
                                                                      
                                                                       
                                                                      
                                                                       if(file_put_contents($target,base64_decode($greceipt))){
                                                         
                                                                           	$barno		   = $conn->real_escape_string($_POST['barno']);
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
                                                                
                                                                
                                                                }
                                             
                                    }
                                    
                                    
                                    
                                    else{
                                               


///cashonpickup

                                        if($certificate=='Barangay Clearance'){


                                            $purpose 		   = $conn->real_escape_string($_POST['purpose']);


                                          
                                            if(isset($_POST["resimage"])){
      
    
                                                $respicimage=$_POST["resimage"];
                                            
                                            }else return;
                                            if(isset($_POST["resname"])){
                                            
                                               $resname=$_POST["resname"];
                                            }else return;


                                            $newName2= date('dmYHis').str_replace(" ", "", $resname);
    
                                            
                                            
                                            
                                              $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                    $resident->image = $newName2;
                                                                  
                                                                   $purpose_json = json_encode($resident);                                            
    
                                            if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                       
                                                mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                               
                                    
                                            } 

                                            $target2 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName2);
                            








                                           $insert="INSERT INTO `tblrequested_documents`(`res_id`, `certificate`, `purpose`, `amount`,  `paymentmethod`) VALUES ($id,'$certificate','$purpose_json',$amount,'$pmethod')";
                                            $result  = $conn->query($insert);

                                            if($result === true){

                                                if(file_put_contents($target2,base64_decode($respicimage))){
                                                         
                                                 	$barno		   = $conn->real_escape_string($_POST['barno']);
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
                                        
                                        }elseif($certificate=='Business Clearance'){

                                                                   
                                                                    $type  = $conn->real_escape_string($_POST['type']);
                                                                    $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
                                                                    $businessadd  = $conn->real_escape_string($_POST['businessadd']);
                                                                    $natureBO  = $conn->real_escape_string($_POST['natureBO']);
                                                                    $dtino  = $conn->real_escape_string($_POST['dtino']);
                                                                    $bnature  = $conn->real_escape_string($_POST['bnature']);
                                                                    $bphone  = $conn->real_escape_string($_POST['bphone']);
                                                                    
                                                                    
                                                                    
                                                             
                                                                
    
    
    
                                                                   


                                                                    if(isset($_POST["businessimage"])){
      
    
                                                                        $businesspicimage=$_POST["businessimage"];
                                                                    
                                                                    }else return;
                                                                    if(isset($_POST["businesspicname"])){
                                                                     
                                                                       $businesspicname=$_POST["businesspicname"];
                                                                    }else return;
                                                                        
    
                                                                                       
                                                                         
    
    
                                                             $newName2 = date('dmYHis').str_replace(" ", "", $businesspicname);
    
                                                                                              
                                                              $business = new \stdClass();
                                                                   $business->type = $type;
                                                                   $business->nbusiness = $namebusiness;
                                                                   $business->businessadd = $businessadd;
                                                                   $business->natureBo = $natureBO;
                                                                   $business->dtino = $dtino;
                                                                   $business->bnature = $bnature;
                                                                   $business->bphone = $bphone;
                                                                   $business->image = $newName2;
                                                                  
                                                                   $purpose_json = json_encode($business);
                                                                                           
            
                                                                 $target2 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName2);
    
                                                                                          
                                                                                            
$insert  = "INSERT INTO `tblrequested_documents`( `res_id`, `certificate`, `amount`, `paymentmethod`,`purpose`) 
VALUES ('$id','$certificate','$amount','$pmethod','$purpose_json')";
                                                                                            $result  = $conn->query($insert);
                                                                                    
                                                                                            if($result === true){
    
    
                                                              
    


                                                                                                        if(file_put_contents($target2,base64_decode($businesspicimage))){
          
                                                                                                            	$barno		   = $conn->real_escape_string($_POST['barno']);
                                                                                                                    $notifname=$certificate;
                                                        $notiftype='document';
                                                        $usertype='administrator';
                                                        $message='New Pending Request';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`(`bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                        
                                                                                            echo json_encode(array("success"=>true));

                                                             }
                                                                                                         }
                                                                                                      
                                                                                                     
                                                                                                 
    
                                                                                             
                                                                                               
                                                                                                
                                                                                    
                                                                                                
                                                                                    
                                                                                                }
                                                                         


                                                                
                                                                }elseif($certificate=='Building Clearance'){



                                                                  $houseno 		   = $conn->real_escape_string($_POST['houseno']);

                                                                   $street 		   = $conn->real_escape_string($_POST['street']);
                                                                   
                                                                   
                                                                   $building = new \stdClass();
                                                                   $building->houseno = $houseno;
                                                                   $building->street=  $street;
                                                                   $purpose_json = json_encode($building);
                                                                   
               


                                                     
                                                   
$insert="INSERT INTO `tblrequested_documents`(`res_id`, `certificate`, `purpose`, `amount`,  `paymentmethod`) VALUES ($id,'$certificate','$purpose_json','$amount','$pmethod')";
                                                                   $result  = $conn->query($insert);
                                                           
                                                                   if($result === true){
                                                                      
                                                                       
                                                                      
                                                       
                                                         
                                                                           	$barno		   = $conn->real_escape_string($_POST['barno']);
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



                                          
                                                                        
                                    

                                  

                                        }     






    

}else{


    echo 'idnotfound';

}




    ?>