

<?php include 'serverapi/server_api.php' ?>
<?php



$email= $conn->real_escape_string($_POST['email']);


if(isset($_POST["frontid"])){
  

    $frontid=$_POST["frontid"];

}else return;
if(isset($_POST["frontname"])){

   $frontname=$_POST["frontname"];
}else return;



if(isset($_POST["backid"])){
  

   $backid=$_POST["backid"];

}else return;

if(isset($_POST["backname"])){

  $backname=$_POST["backname"];
}else return;
/*
$newNamefront = date('dmYHis').str_replace(" ", "", $frontname);
$newNameback = date('dmYHis').str_replace(" ", "", $backname);

$pathfront="upload/$newNamefront";

$pathback="upload/$newNameback";

*/

$query1 = "SELECT * FROM tbl_registration WHERE email_address='$email'";
      
               $result1 = $conn->query($query1);
            
               if(mysqli_num_rows($result1)>0){
            
            
            
               
            
               while($row = $result1->fetch_assoc()){
            
                  $regno=$row['reg_no'];
                  $emailadd=$row['email_address'];
      
                  $firstname=$row['firstname'];
                  $middlename=$row['middle_initial'];
      
      
                  $lastname=$row['lastname'];
                  $suffix=$row['suffix'];
      
      
                  $house_no=$row['house_no'];
                  $_street=$row['street'];
      
                  $type_id=$row['ID_TYPE'];

                  


	$newNamefront = date('dmYHis').str_replace(" ", "", $frontname);

	if(!is_dir("../assets/uploads/registration/".$regno)){
		mkdir("../assets/uploads/registration/".$regno."/", 07777);
	}

	  // image file directory
	  $target1 = "../assets/uploads/registration/".$regno."/".basename($newNamefront);


	$newNameback = date('dmYHis').str_replace(" ", "", $backname);
	
	
    //image dir
	$target2 = "../assets/uploads/registration/".$regno."/".basename($newNameback);



   $query 		= "UPDATE `tbl_registration` SET `front_id`='$newNamefront',`back_id`='$newNameback' WHERE  `email_address`='$email'";	
   $result 	= $conn->query($query);

   if($result === true){



      if(file_put_contents($target1,base64_decode($frontid))){

  


         if(file_put_contents($target2,base64_decode($backid))){
      
            echo json_encode(array("success"=>true));
         }else{
      
      
      
         }
      
      }else{
      
      
      }




   }

}
}




;
;
/*

$insert  = "INSERT INTO `tbl_registration`(`firstname`, `lastname`, `middle_initial`, `suffix`, `email_address`, `house_no`, `street`, `ID_TYPE`) 
VALUES ('$fname','$lname','$mname','$suffix','$email','$houseno','$street','$typeid')";
$result  = $conn->query($insert);

if($result === true){

  

   echo json_encode(array("success"=>true));


}


*/
?>