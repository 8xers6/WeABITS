<?php include 'serverapi/server_api.php'  ?>


<?php

$email= $conn->real_escape_string($_POST['email']);
$fname	= $conn->real_escape_string($_POST['fname']);
$mname	= $conn->real_escape_string($_POST['mname']);
$lname	= $conn->real_escape_string($_POST['lname']);
$suffix	= $conn->real_escape_string($_POST['suffix']);


$barno= $conn->real_escape_string($_POST['barno']);



$typeid	= $conn->real_escape_string($_POST['typeid']);





 
        
    

if(!empty($email) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($suffix) && !empty($barno) && !empty($typeid) ){
    
    
    
    
      $query = "SELECT * FROM `tblbarangay` WHERE `bar_no`=$barno";
  	$result1 = $conn->query($query);
	$barangay = $result1->fetch_assoc();
    $username 		= $barangay['username'];
    
    
    if(!is_dir("../assets/uploads/".$username."/validation/".$email."")){
           
            mkdir("../assets/uploads/".$username."/validation/".$email, 07777);


        }
    
    
    if(isset($_POST["valid"])){
  

    $validid=$_POST["valid"];

}else return;
if(isset($_POST["validname"])){

   $validname=$_POST["validname"];
}else return;



if(isset($_POST["bill"])){
  

   $bill=$_POST["bill"];

}else return;

if(isset($_POST["billname"])){

  $billname=$_POST["billname"];
}else return;

    
    
    	$newNameValid = date('dmYHis').str_replace(" ", "", $validname);



	  // image file directory valid
		$target1 = "../assets/uploads/".$username."/validation/".$email."/".basename($newNameValid);


	$newNameBill = date('dmYHis').str_replace(" ", "", $billname);
	
	
    //image bill
	$target2 = "../assets/uploads/".$username."/validation/".$email."/".basename($newNameBill);
	
	
	
$insert  = "INSERT INTO `tblregistration`(`email`, `firstname`, `middlename`, `lastname`, `suffix`, `bar_no`, `id_type`, `id_image`, `billing_image`) 
                                 VALUES ('$email','$fname','$mname','$lname','$suffix',$barno,'$typeid','$newNameValid','$newNameBill')"; 

$result  = $conn->query($insert);


if($result === true){
    
    
    
     if(file_put_contents($target1,base64_decode($validid))){

  


         if(file_put_contents($target2,base64_decode($bill))){
      
            echo json_encode(array("success"=>true));
         }
      
      }

   

}else{

    echo json_encode(array("success"=>false));
}
	
	
  
  
    
    
}







    

    
    

/*

    if(!is_dir("../assets/uploads/".$username."/validation")){
           
            mkdir("../assets/uploads/".$username."/validation", 07777);


        }







*/

$conn->close();

?>