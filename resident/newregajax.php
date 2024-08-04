
<?php


include('server/serverhome.php');



   $validname   = $_FILES['validname']['name'];
      
      $billname   = $_FILES['billname']['name'];
     
      if(empty($validname)){
          
           echo 'emptyid';
          
          }else{
              
              
              
              if(empty($billname)){
          
               echo 'emptybill';
          
          }else{
              
              
              
              
              
              //terms
              if(!empty($_POST['terms'])){
    
    


if(!empty($_SESSION['otpvalidation'])&& !empty($_SESSION['s_email'] && $_SESSION['otpvalidation']=='correct')){





    
    
$email= $_SESSION['s_email']; 
$fname	= $conn->real_escape_string($_POST['fname']);
$mname	= $conn->real_escape_string($_POST['mname']);
$lname	= $conn->real_escape_string($_POST['lname']);
$suffix	= $conn->real_escape_string($_POST['suffix']);
$barno= $conn->real_escape_string($_POST['barno']);
$typeid	= $conn->real_escape_string($_POST['typeid']);


  $query = "SELECT * FROM `tblbarangay` WHERE `bar_no`=$barno";
  	$result1 = $conn->query($query);
	$barangay = $result1->fetch_assoc();
    $busername 		= $barangay['username'];
    
    
    
      
        
        
         if(!is_dir("../assets/uploads/".$busername."/validation/".$email)){
                                                                               
                  mkdir("../assets/uploads/".$busername."/validation/".$email, 07777);
                                                           
                                                           
             }


if(!empty($email) && !empty($fname) && !empty($mname) && !empty($lname)  && !empty($barno) && !empty($typeid) ){
    
       
              
              
              
              
  
        
        	$newNameValid = date('dmYHis').str_replace(" ", "", $validname);



	  // image file directory valid
		$target1 = "../assets/uploads/".$busername."/validation/".$email."/".basename($newNameValid);


	$newNameBill = date('dmYHis').str_replace(" ", "", $billname);
	
	
    //image bill
	$target2 = "../assets/uploads/".$busername."/validation/".$email."/".basename($newNameBill);
	
	
	
$insert  = "INSERT INTO `tblregistration`(`email`, `firstname`, `middlename`, `lastname`, `suffix`, `bar_no`, `id_type`, `id_image`, `billing_image`) 
                                 VALUES ('$email','$fname','$mname','$lname','$suffix',$barno,'$typeid','$newNameValid','$newNameBill')"; 

$result  = $conn->query($insert);


if($result === true){
    
      if(move_uploaded_file($_FILES['validname']['tmp_name'], $target1)){
          
          
              if(move_uploaded_file($_FILES['billname']['tmp_name'], $target2)){
          
          
          
          
             echo 'success';
          
      }
          
          
          
      }
    
    
    
    
}
              
              
              
              
              
              
              
              
          
              
          

      
      
    
    
    
  
    
    
    
}else{
    
      //echo 'emptyall'; 
    echo $suffix;
}
    
    


}else{
    
     echo 'error';
    
}
    
    
}else{
    
     echo "uncheck";
}
              
              
              
              
              
          }
          
          }


	$conn->close();


?>