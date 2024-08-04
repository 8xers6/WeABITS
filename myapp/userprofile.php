
<?php include '../server_api.php'  ?>
<?php

//post send data to mysql db
//get retrieve data




$resid	= $conn->real_escape_string($_POST['resid']);
//$password	= hash("sha256",$conn->real_escape_string($_POST['password']));
//$cpassword	= hash("sha256",$conn->real_escape_string($_POST['cpassword']));
//$password	= $conn->real_escape_string($_POST['password']);
//$cpassword	= $conn->real_escape_string($_POST['cpassword']);

//$hash= hash("sha256",$password);


$query 		= "SELECT * FROM tbl_residents WHERE res_id=$resid";

$result  = $conn->query($query);
  

if($result->num_rows>0) {
  

  $residentRecord=array();
  
  while($row= $result->fetch_assoc()){

         $residentRecord=$row;

       


  }

  echo json_encode(
        
    array(
        "success"=>true,
        "res_id"=>$residentRecord['res_id'],
        "username"=>$residentRecord['username'],
        "email"=>$residentRecord['email'],
        "firstname"=>$residentRecord['firstname'],
        "lastname"=>$residentRecord['lastname'],
        "res_picture"=>$residentRecord['res_picture'],

    )
);
  

}else{

    echo json_encode(array("success"=>false));
}





?>