<?php include 'server/server.php' ?>
<?php 

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id =$_SESSION['resid'];
	$serno		   = $conn->real_escape_string($_POST['serno']);
    $doctype  = $conn->real_escape_string($_POST['doctype']);
    $amount  = $conn->real_escape_string($_POST['amount']);
	


	

    if(!is_dir("../assets/uploads/".$barangayname."/")){
      
        mkdir("../assets/uploads/".$barangayname."/resident", 07777);
       

    }
 



        if(!empty($id)){


            if($doctype=="Barangay Clearance"){
                $pmethod 		   = $conn->real_escape_string($_POST['pmethod']);

                $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                if($reqtype=='digital'){
                 


                   $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                  


                    $gpayment   = $_FILES['gpayment']['name'];

                    $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                       if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                           mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                       }

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`greceipt_screenshot`,`reqtype`,`paymentmethod`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,'$newName','$reqtype','$pmethod')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                       if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                           $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                           $_SESSION['success'] = 'success';
                          
                           header("Location: reqdocs");
                           
                       }
                      
                    
           
                    
           
                   }

                       


                }else{
                      

                if($pmethod==='Gcash'){

                  
                   

                     $date		   = $conn->real_escape_string($_POST['pickdate']);
                     $time		   = $conn->real_escape_string($_POST['picktime']);


                    $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                     $refno 		   = $conn->real_escape_string($_POST['refno']);


                     $gpayment   = $_FILES['gpayment']['name'];

                     $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                        if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                            mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                        }

                        $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                    $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod','$date','$time')";
                    $result  = $conn->query($insert);
            
                    if($result === true){

                        if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                            $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                            $_SESSION['success'] = 'success';
                           
                            header("Location: reqdocs");
                            
                        }
                       
                     
            
                     
            
                    }

                }else{


                    $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                    $date		   = $conn->real_escape_string($_POST['pickdate']);
                    $time		   = $conn->real_escape_string($_POST['picktime']);


                   $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                  


                   

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,'$reqtype','$pmethod','$date','$time')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                     
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: reqdocs");
                    
           
                    
           
                   }




                 
 
                }
            }



               
            }elseif($doctype=="Certificate of Indigency"){


                $pmethod 		   = $conn->real_escape_string($_POST['pmethod']);

                $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                if($reqtype=='digital'){
                 


                   $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                    $refno 		   = $conn->real_escape_string($_POST['refno']);


                    $gpayment   = $_FILES['gpayment']['name'];

                    $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                       if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                           mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                       }

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                       if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                           $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                           $_SESSION['success'] = 'success';
                          
                           header("Location: reqdocs");
                           
                       }
                      
                    
           
                    
           
                   }

                       


                }else{
                      

                if($pmethod==='Gcash'){

                  
                   

                     $date		   = $conn->real_escape_string($_POST['pickdate']);
                     $time		   = $conn->real_escape_string($_POST['picktime']);


                    $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                     $refno 		   = $conn->real_escape_string($_POST['refno']);


                     $gpayment   = $_FILES['gpayment']['name'];

                     $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                        if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                            mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                        }

                        $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                    $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod','$date','$time')";
                    $result  = $conn->query($insert);
            
                    if($result === true){

                        if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                            $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                            $_SESSION['success'] = 'success';
                           
                            header("Location: reqdocs");
                            
                        }
                       
                     
            
                     
            
                    }

                }else{


                    $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                    $date		   = $conn->real_escape_string($_POST['pickdate']);
                    $time		   = $conn->real_escape_string($_POST['picktime']);


                   $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                  


                   

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,'$reqtype','$pmethod','$date','$time')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                     
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: reqdocs");
                    
           
                    
           
                   }




                 
 
                }
            }
              
    

        }elseif($doctype=="Business Permit"){

           
            $type  = $conn->real_escape_string($_POST['type']);
            $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
            $businessadd  = $conn->real_escape_string($_POST['businessadd']);
            $bnature  = $conn->real_escape_string($_POST['bnature']);
            $bphone  = $conn->real_escape_string($_POST['bphone']);



            
        

            $pmethod 		   = $conn->real_escape_string($_POST['pmethod']);

                $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                if($reqtype=='digital'){
                 

                    $purpose  = 'Type:'.$type.',Business Name:'.$namebusiness.', Business address:'.$businessadd.', Business Nature: '.$bnature.', Phone No: '.$bphone;

                 
                    $refno 		   = $conn->real_escape_string($_POST['refno']);


                    $gpayment   = $_FILES['gpayment']['name'];

                    $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                       if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                           mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                       }

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                       if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                           $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                           $_SESSION['success'] = 'success';
                          
                           header("Location: reqdocs");
                           
                       }
                      
                    
           
                    
           
                   }

                       


                }else{
                      

                if($pmethod==='Gcash'){

                  
                   

                     $date		   = $conn->real_escape_string($_POST['pickdate']);
                     $time		   = $conn->real_escape_string($_POST['picktime']);


                     $purpose  = 'Type:'.$type.',Business Name:'.$namebusiness.', Business address:'.$businessadd.', Business Nature: '.$bnature.', Phone No: '.$bphone;

                     $refno 		   = $conn->real_escape_string($_POST['refno']);


                     $gpayment   = $_FILES['gpayment']['name'];

                     $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                        if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                            mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                        }

                        $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                    $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod','$date','$time')";
                    $result  = $conn->query($insert);
            
                    if($result === true){

                        if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                            $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                            $_SESSION['success'] = 'success';
                           
                            header("Location: reqdocs");
                            
                        }
                       
                     
            
                     
            
                    }

                }else{


                    $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                    $date		   = $conn->real_escape_string($_POST['pickdate']);
                    $time		   = $conn->real_escape_string($_POST['picktime']);


                    $purpose  = 'Type: '.$type.',Business Name: '.$namebusiness.', Business Address: '.$businessadd.', Business Nature: '.$bnature.', Phone No: '.$bphone;
                  


                   

                       $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                   $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,'$reqtype','$pmethod','$date','$time')";
                   $result  = $conn->query($insert);
           
                   if($result === true){

                     
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: reqdocs");
                    
           
                    
           
                   }




                 
 
                }
            }
            
    

        }elseif($doctype=="Building Permit"){

            $location 		   = $conn->real_escape_string($_POST['location']);

           


            $pmethod 		   = $conn->real_escape_string($_POST['pmethod']);

            $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

            if($reqtype=='digital'){
             


                $purpose  = 'Building Location: '.$location;
                $refno 		   = $conn->real_escape_string($_POST['refno']);


                $gpayment   = $_FILES['gpayment']['name'];

                $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                   if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                       mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                   }

                   $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

               $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod')";
               $result  = $conn->query($insert);
       
               if($result === true){

                   if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                       $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                       $_SESSION['success'] = 'success';
                      
                       header("Location: reqdocs");
                       
                   }
                  
                
       
                
       
               }

                   


            }else{
                  

            if($pmethod==='Gcash'){

              
               

                 $date		   = $conn->real_escape_string($_POST['pickdate']);
                 $time		   = $conn->real_escape_string($_POST['picktime']);


                 $purpose  = 'Building Location: '.$location;
                 $refno 		   = $conn->real_escape_string($_POST['refno']);


                 $gpayment   = $_FILES['gpayment']['name'];

                 $newName = date('dmYHis').str_replace(" ", "", $gpayment);

                    if(!is_dir("../assets/uploads/resident_profile/".$id."/receipt")){
                        mkdir("../assets/uploads/resident_profile/".$id."/receipt", 07777);
                    }

                    $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

                $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reference_no`,`greceipt_screenshot`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,$refno,'$newName','$reqtype','$pmethod','$date','$time')";
                $result  = $conn->query($insert);
        
                if($result === true){

                    if(move_uploaded_file($_FILES['gpayment']['tmp_name'], $target)){

                        $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                        $_SESSION['success'] = 'success';
                       
                        header("Location: reqdocs");
                        
                    }
                   
                 
        
                 
        
                }

            }else{


                $reqtype 		   = $conn->real_escape_string($_POST['reqtype']);

                $date		   = $conn->real_escape_string($_POST['pickdate']);
                $time		   = $conn->real_escape_string($_POST['picktime']);


                $purpose  = 'Building Location: '.$location;
              


               

                   $target = "../assets/uploads/resident_profile/".$id."/receipt"."/".basename($newName);

               $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`,`reqtype`,`paymentmethod`,`datepickup`,`timepickup`) VALUES ('$id',$serno,'$doctype','$purpose',$amount,'$reqtype','$pmethod','$date','$time')";
               $result  = $conn->query($insert);
       
               if($result === true){

                 
                $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                $_SESSION['success'] = 'success';
               
                header("Location: reqdocs");
                
       
                
       
               }




             

            }
        }
          

        }
    
        }else{
    
            $_SESSION['messages'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
    
          
    
    
          
        }
    

 
           
   

   




   

	$conn->close();

    ?>

	

   
