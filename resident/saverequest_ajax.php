
<?php include 'server/server.php' ?>
<?php 

	$barno=$_SESSION['barno'];

 if(!empty($_POST['terms'])){

	$id =$_SESSION['resid'];

    $doctype  = $conn->real_escape_string($_POST['certificate']);
    $amount  = $conn->real_escape_string($_POST['amount']);
 

    
  





    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblcity.province_id=tblprovince.province_id  WHERE bar_no=$barno";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
	
		$barangayname 		= $row['barangayname'];
        $city 		= $row['city'];
        $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
        $busername= $row['username'];
        $mission= $row['mission'];
        $vision= $row['vision'];
	}

    if(!empty($id)){
    





        if($doctype=="Certificate of Indigency"){
     $target 		   = $conn->real_escape_string($_POST['target']);
    $purposes 		   = $conn->real_escape_string($_POST['purpose']);
            if($purposes =="Others"){


                if(empty($_POST['opurpose'])){
                    echo "otherisempty";
                  
   
                }else{
   
                     
                    $purpose		  =$conn->real_escape_string($_POST['opurpose']);
                    
                     $indigency = new \stdClass();
     
    $toint= (int)$target;
     
    $indigency->resid = $toint;
    $indigency->purpose =  $purpose;
    $purpose_json = json_encode($indigency);


     
                 
                    $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`) VALUES ('$id','$doctype','$purpose_json',$amount)";
                    $result  = $conn->query($insert);
            
                    if($result === true){

                        $notifname=$doctype;
                        $notiftype='document';
                        $usertype='administrator';
                        $message='New Pending Request';
         
                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                         ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                        $result1  = $conn->query($insert1);

                          
                        $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                        $_SESSION['success'] = 'success';
                      
                        echo 'success';
                           
                        
            
                        }
                }
              
   
           }else{
   
               $purpose		  = $purposes;

           $indigency = new \stdClass();
     
    $toint= (int)$target;
     
    $indigency->resid = $toint;
    $indigency->purpose =  $purpose;
    $purpose_json = json_encode($indigency);
               

               

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`) VALUES ('$id','$doctype','$purpose_json',$amount)";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                    $notifname=$doctype;
                    $notiftype='document';
                    $usertype='administrator';
                    $message='New Pending Request';
     
                     $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                     ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                    $result1  = $conn->query($insert1);

                         
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                  
                    echo 'success';
                       
           
                       
           
                       }
   
           }
            
        
        }else{

        
//pickup
$pmethod 		   = $conn->real_escape_string($_POST['pmethod']);
        $gpayment   = $_FILES['gpayment']['name'];

      

           
     

                                    if($pmethod=='GCash')
                                    {

                                        if(!empty($gpayment))
                                        {
                                

                                                                if($doctype=='Barangay Clearance'){


                                                                    $respic   = $_FILES['respic']['name'];

                                                                    if(empty($respic)){


                                                                        echo 'resisempty';

                                                                    }else{


                                                                    $purposes 		   = $conn->real_escape_string($_POST['purpose']);
                                                                    if($purposes =="Others"){
       

                                                                        if(empty($_POST['opurpose'])){

                                                                            echo "otherisempty";
                                                                          
                                                           
                                                                        }else{
                                                           
                                                                             
                                                                            $purpose= $conn->real_escape_string($_POST['opurpose']);




             
                                                                          
              

               
                                                                            $newName = date('dmYHis').str_replace(" ", "", $gpayment);
                                                           
                                                                            if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                               
                                                                                mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                           
                                                           
                                                                            }

                                                                            $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);


                                                                            $newName5 = date('dmYHis').str_replace(" ", "", $respic);
                                                           
                                                                            if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                               
                                                                                mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                           
                                                           
                                                                            }
                                                                            
                                                                            
                                                                               $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                   $resident->image = $newName5;
                                                                  
                                                                   $purpose_json = json_encode($resident);
                                                           
                                                                            $target5 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName5);
                                                           
                                                                           $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`greceipt_screenshot`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$newName','$pmethod')";
                                                                           $result  = $conn->query($insert);
                                                                   
                                                                           if($result === true){
                                                           
                                                                               if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){
                                                           
                                                                                if(move_uploaded_file($_FILES['respic']['tmp_name'], $target5)){

                                                                                    $notifname=$doctype;
                                                                                    $notiftype='document';
                                                                                    $usertype='administrator';
                                                                                    $message='New Pending Request';
                                                                     
                                                                                     $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                                                     ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                                                    $result1  = $conn->query($insert1);


                                                                                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                    $_SESSION['success'] = 'success';
                                                                                    
                                                                                    echo 'success';
                                                                                    
                                                                                }
                                                                                   
                                                                               }
                                                                              
                                                                            
                                                                   
                                                                            
                                                                   
                                                                           }
                                                                        }
                                                                      
                                                           
                                                                   }else{
                                                           
                                                                       $purpose		  = $purposes;


                                                                
               

             

                                                                     

               
                                                                       $newName = date('dmYHis').str_replace(" ", "", $gpayment);
                                                      
                                                                       if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                          
                                                                           mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                      
                                                      
                                                                       }


                                                      
                                                                       $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);


                                                                       $newName5 = date('dmYHis').str_replace(" ", "", $respic);
                                                           
                                                                       if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                          
                                                                           mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                      
                                                      
                                                                       }
                                                                       
                                                                       
                                                                          $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                   $resident->image = $newName5;
                                                                  
                                                                   $purpose_json = json_encode($resident);
                                                      
                                                                       $target5 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName5);
                                                      
                                                                      $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`greceipt_screenshot`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$newName','$pmethod')";
                                                                      $result  = $conn->query($insert);
                                                              
                                                                      if($result === true){
                                                      
                                                                          if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){
                                                      
                                                                            if(move_uploaded_file($_FILES['respic']['tmp_name'], $target5)){


                                                                                $notifname=$doctype;
                                                                                $notiftype='document';
                                                                                $usertype='administrator';
                                                                                $message='New Pending Request';
                                                                 
                                                                                 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                                                 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                                                $result1  = $conn->query($insert1);

                                                      
                                                                             
                                                                                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                    $_SESSION['success'] = 'success';
                                                                                                                                                      
                                                                                                                                                        echo 'success';
                                                                                
                                                                            }
                                                                              
                                                                          }
                                                                         
                                                                       
                                                              
                                                                       
                                                              
                                                                      }
                                                           
                                                                   }

                                                                }

                                                                
                                                                }elseif($doctype=="Business Clearance"){
                                                                        
                                                                    $bpicture   = $_FILES['bpicture']['name'];
                                                                    
                                                                 
                                                                    $type  = $conn->real_escape_string($_POST['type']);
                                                                    $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
                                                                    $businessadd  = $conn->real_escape_string($_POST['businessadd']);
                                                                    $natureBO  = $conn->real_escape_string($_POST['natureBO']);
                                                                    $dtino  = $conn->real_escape_string($_POST['dtino']);
                                                                    $bnature  = $conn->real_escape_string($_POST['bnature']);
                                                                    $bphone  = $conn->real_escape_string($_POST['bphone']);
                                                                    

                                                                   /* $purpose  = 'Type:'.$type.',Business Name:'.$namebusiness.', Business address:'.$businessadd.',Nature of Business Ownsership: '.$natureBO.' , Business Nature: '.$bnature.',SEC/ DTI Registration Number: '.$dtino.' ,Phone No: '.$bphone;*/
                                                                        

                                                                    $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                                                                    if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                       
                                                                        mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                       
                                                            
                                                                    } 

                                                                            $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);


                                                                            $newName2 = date('dmYHis').str_replace(" ", "", $bpicture);

                                                                            if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                               
                                                                                mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                               
                                                                    
                                                                            } 
                                                                            
                                                                            
                                                                            
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
VALUES ('$id','$doctype','$amount','$newName','$pmethod','$purpose_json')";
                                                                        $result  = $conn->query($insert);
                                                                
                                                                        if($result === true){

                                                                            if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                                                                                if(move_uploaded_file($_FILES['bpicture']['tmp_name'], $target2)){


                                                                                    $notifname=$doctype;
                                                                                    $notiftype='document';
                                                                                    $usertype='administrator';
                                                                                    $message='New Pending Request';
                                                                     
                                                                                     $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                                                     ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                                                    $result1  = $conn->query($insert1);


                                                                                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                    $_SESSION['success'] = 'success';
                                                                                    
                                                                                    echo 'success';
                                                                                    
                                                                                }

                                                                                
                                                                            }
                                                                            
                                                                            
                                                                
                                                                            
                                                                
                                                                            }
                                                                
                                                                }elseif($doctype=="Building Clearance"){

                                                                      $houseno 		   = $conn->real_escape_string($_POST['houseno']);

                                                                   $street 		   = $conn->real_escape_string($_POST['street']);
                                                                   
                                                                   
                                                                   $building = new \stdClass();
                                                                   $building->houseno = $houseno;
                                                                   $building->street=  $street;
                                                                   $purpose_json = json_encode($building);
                                                                    
                                                                    $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                                                                    if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                                       
                                                                        mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                                                       
                                                            
                                                                    } 



                                                                            $target = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName);


                                                                        

                                                                        $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`greceipt_screenshot`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$newName','$pmethod')";
                                                                        $result  = $conn->query($insert);
                                                                
                                                                        if($result === true){

                                                                            if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){


                                                                                $notifname=$doctype;
                                                                                $notiftype='document';
                                                                                $usertype='administrator';
                                                                                $message='New Pending Request';
                                                                 
                                                                                 $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                                                 ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                                                $result1  = $conn->query($insert1);


                                                                                $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                $_SESSION['success'] = 'success';
                                                                                echo 'success';
                                                                           
                                                                                
                                                                            }
                                                                            
                                                                            
                                                                
                                                                            
                                                                
                                                                            }
                                                                
                                                                }



               

                                                                    
                      
                                                                                            
                                

                                                            }else
                                                            {
                                                    
                                                            echo 'isempty';
                                                    
                                                            }
                                                                                            
                                    }else
                                    {
                                               




                                        if($doctype=='Barangay Clearance'){


                                            $respic   = $_FILES['respic']['name'];

                                            if(empty($respic)){


                                                echo 'resisempty';

                                            }else{
                                                    
                                            $purposes 		   = $conn->real_escape_string($_POST['purpose']);
                                            if($purposes =="Others"){


                                                if(empty($_POST['opurpose'])){
                                                    echo "otherisempty";
                                                  
                                   
                                                }else{
                                   
                                                     
                                                    $purpose= $conn->real_escape_string($_POST['opurpose']);



                                                    


                                                    $newName5 = date('dmYHis').str_replace(" ", "", $respic);
                                                           
                                                    if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                       
                                                        mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                   
                                   
                                                    }
                                   
                                                    $target5 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName5);

     $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                   $resident->image = $newName5;
                                                                  
                                                                   $purpose_json = json_encode($resident);


                                                  
                                   
                                                    $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$pmethod')";
                                                    $result  = $conn->query($insert);
        
                                                    if($result === true){
        
                                                      
        
                                                        if(move_uploaded_file($_FILES['respic']['tmp_name'], $target5)){
                                                      
                                                            $notifname=$doctype;
                                                            $notiftype='document';
                                                            $usertype='administrator';
                                                            $message='New Pending Request';
                                             
                                                             $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                             ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                            $result1  = $conn->query($insert1);

                                                            $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                                                                    $_SESSION['success'] = 'success';
                                                                                                                                  
                                                                                                                                    echo 'success';
                                                            
                                                        }
        
        
        
        
                                                    }
                                                }
                                              
                                   
                                           }else{
                                   
                                               $purpose		  = $purposes;




                                               $newName5 = date('dmYHis').str_replace(" ", "", $respic);
                                                           
                                               if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                                  
                                                   mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                              
                              
                                               }
                              
                                               $target5 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName5);
                              
     $resident = new \stdClass();
                                                                    $resident->purpose = $purpose;
                                                                   $resident->image = $newName5;
                                                                  
                                                                   $purpose_json = json_encode($resident);



                                               
                              
                              
                                            
                                               $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$pmethod')";
                                               $result  = $conn->query($insert);
   
                                               if($result === true){
   
                                                if(move_uploaded_file($_FILES['respic']['tmp_name'], $target5)){
                                                      
                                                    $notifname=$doctype;
                                                    $notiftype='document';
                                                    $usertype='administrator';
                                                    $message='New Pending Request';
                                     
                                                     $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                     ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                    $result1  = $conn->query($insert1);

                                                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                                                                                            $_SESSION['success'] = 'success';
                                                                                                                          
                                                                                                                            echo 'success';
                                                    
                                                }
   
   
   
   
   
                                               }
                                   
                                           }

                                        }
                                        
                                        }elseif($doctype=="Business Clearance"){

                                         
                                            $type  = $conn->real_escape_string($_POST['type']);
                                            $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
                                            $businessadd  = $conn->real_escape_string($_POST['businessadd']);
                                            $natureBO  = $conn->real_escape_string($_POST['natureBO']);
                                            $dtino  = $conn->real_escape_string($_POST['dtino']);
                                            $bnature  = $conn->real_escape_string($_POST['bnature']);
                                            $bphone  = $conn->real_escape_string($_POST['bphone']);
                                            

                                            $purpose  = 'Type:'.$type.',Business Name:'.$namebusiness.', Business address:'.$businessadd.',Nature of Business Ownsership: '.$natureBO.' , Business Nature: '.$bnature.',SEC/ DTI Registration Number: '.$dtino.' ,Phone No: '.$bphone;
                                                
                                            $bpicture   = $_FILES['bpicture']['name'];
                                          

                                            $newName2 = date('dmYHis').str_replace(" ", "", $bpicture);

                                            if(!is_dir("../assets/uploads/".$busername."/resident/".$id)){
                                               
                                                mkdir("../assets/uploads/".$busername."/resident/".$id, 07777);
                                               
                                    
                                            } 
                                            $target2 = "../assets/uploads/".$busername."/resident/".$id.'/'.basename($newName2);

                                                
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

                                                $insert  = "INSERT INTO `tblrequested_documents`( `res_id`, `certificate`, `amount`, `paymentmethod`,`purpose`) 
VALUES ('$id','$doctype','$amount','$pmethod','$purpose_json')";
                                                $result  = $conn->query($insert);
                                        
                                                if($result === true){


                                                    if(move_uploaded_file($_FILES['bpicture']['tmp_name'], $target2)){


                                                        $notifname=$doctype;
                                                        $notiftype='document';
                                                        $usertype='administrator';
                                                        $message='New Pending Request';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);


                                                        $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                        $_SESSION['success'] = 'success';
                                                        
                                                        echo 'success';
                                                        
                                                    }


                                           


                                                    
                                                    
                                        
                                                    
                                        
                                                    }

                                                
                                        
                                        }elseif($doctype=="Building Clearance"){

                                             $houseno 		   = $conn->real_escape_string($_POST['houseno']);

                                                                   $street 		   = $conn->real_escape_string($_POST['street']);
                                                                   
                                                                   
                                                                   $building = new \stdClass();
                                                                   $building->houseno = $houseno;
                                                                   $building->street=  $street;
                                                                   $purpose_json = json_encode($building);
                        

                                      
                                                

                                                $insert  = "INSERT INTO tblrequested_documents (`res_id`,`certificate`,`purpose`,`amount`,`paymentmethod`) VALUES ('$id','$doctype','$purpose_json',$amount,'$pmethod')";
                                                $result  = $conn->query($insert);
                                        
                                                if($result === true){



                                                    $notifname=$doctype;
                                                    $notiftype='document';
                                                    $usertype='administrator';
                                                    $message='New Pending Request';
                                     
                                                     $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                     ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
                                                    $result1  = $conn->query($insert1);



                                                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                                                    $_SESSION['success'] = 'success';
                                                    echo 'success';

                                                   
                                                    
                                        
                                                    
                                        
                                                    }
                                        
                                        }



                                           
        




                                                                        
                                    

                                  

                                        }     






    }



}else{


    echo 'idnotfound';

}

}else{
    
    
    echo "uncheck";
}




    ?>