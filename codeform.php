
<?php 	include('server/serverhome.php'); ?>
<?php



$email	= $conn->real_escape_string($_POST['email']);
$code	= $conn->real_escape_string($_POST['code']);

$sql2="SELECT * FROM `tblregistration` WHERE `email`='$email' AND `email_token`='$code' AND `status`='norecord' AND `token_expired`>now();";
$result=$conn->query($sql2);
$regis = $result->fetch_assoc();





if ($result->num_rows>0) {
    
    
    $barno=$regis['bar_no'];
    

    
    
    
  
        
           
     $sql4="SELECT * FROM `tblbarangay` LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id   WHERE  tblbarangay.`bar_no`=$barno";
$result4=$conn->query($sql4);
$brgy = $result4->fetch_assoc();
  
  
  $_SESSION['s_email']=$email;
    $_SESSION['barno']=$brgy['bar_no'];
  $_SESSION['brgyname']=$brgy['barangayname'];
  $_SESSION['brgylogo']=$brgy['brgylogo'];
  $_SESSION['buname']=$brgy['username'];
  include 'resident/head_of_family.php'; 
/*
  echo json_encode(array("codefound"=>true,
                    "barno"=>$regis['bar_no'],
                    "barangay"=>$brgy['barangayname'],
                    "city"=>$brgy['city'],
                    "province"=>$brgy['province'],
                    "username"=>$brgy['username'],
                    "brgylogo"=>$brgy['brgylogo'],
                    
  ));*/
        
    
    


    

}else{

   // echo json_encode(array("codefound"=>false));
   echo 'fail';
}
  
  







?>