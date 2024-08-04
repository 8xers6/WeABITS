<?php include '../server_api.php'  ?>
<?php 


	
	$id =$conn->real_escape_string($_POST['resid']);
	$serno		   = $conn->real_escape_string($_POST['serno']);
    $doctype  = $conn->real_escape_string($_POST['doctype']);
    $amount  = $conn->real_escape_string($_POST['amount']);
	
	
    if(!empty($id)){


            if($doctype=="Barangay Clearance"){
                $purpose 		   = $conn->real_escape_string($_POST['purpose']);

                $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`) VALUES ('$id',$serno,'$doctype','$purpose',$amount)";
                $result  = $conn->query($insert);
        
                if($result === true){
                   
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: ../reqdocs");
        
                 
        
                }
               



               
            }elseif($doctype=="Certificate of Indigency"){

                $purpose 		   = $conn->real_escape_string($_POST['purpose']);
                $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`) VALUES ('$id',$serno,'$doctype','$purpose',$amount)";
                $result  = $conn->query($insert);
        
                if($result === true){
                   
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: ../reqdocs");
        
                 
        
                }
    

        }elseif($doctype=="Business Permit"){

           

            $namebusiness  = $conn->real_escape_string($_POST['nbusiness']);
            $businessadd  = $conn->real_escape_string($_POST['businessadd']);
            $bnature  = $conn->real_escape_string($_POST['bnature']);

            $purpose  = 'Business Name:'.$namebusiness.', Business address:'.$businessadd.', Business Nature: '.$bnature;
            

            $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`) VALUES ('$id',$serno,'$doctype','$purpose',$amount)";
            $result  = $conn->query($insert);
        
                if($result === true){
                   
                    $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                    $_SESSION['success'] = 'success';
                   
                    header("Location: ../reqdocs");
        
                 
        
                }
    

        }elseif($doctype=="Building Permit"){

            $location 		   = $conn->real_escape_string($_POST['location']);

            $purpose  = 'Building Location: '.$location;


            $insert  = "INSERT INTO tblrequested_documents (`res_id`,`ser_no`,`document_type`,`purpose`,`amount`) VALUES ('$id',$serno,'$doctype','$purpose',$amount)";
            $result  = $conn->query($insert);
    
            if($result === true){
               
                $_SESSION['message'] = 'Your Request '.$doctype.' has been sent';
                $_SESSION['success'] = 'success';
               
                header("Location: ../reqdocs");
    
             
    
            }
          

        }
    
        }else{
    
            $_SESSION['messages'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
    
          
    
    
          
        }
    

 
           
   

   




   

	$conn->close();

    

	

   
