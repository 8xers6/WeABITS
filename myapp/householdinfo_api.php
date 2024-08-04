
<?php include 'serverapi/server_api.php'  ?>
<?php



if(!empty($_POST['hno'])){
    
    
    
    $hno	= $conn->real_escape_string($_POST['hno']);



$query 		= "SELECT * FROM `tblhousehold` LEFT JOIN tblstreet ON tblhousehold.st_id =tblstreet.st_id WHERE tblhousehold.`h_no`=$hno";

$result  = $conn->query($query);
  

if($result->num_rows>0) {
  

  $houseRecord=array();
  
  while($row= $result->fetch_assoc()){

         $houseRecord=$row;

       


  }

  echo json_encode(
        
    array(
        "success"=>true,
        
        "householdno"=>$houseRecord['household_no'],
        "streetname"=>$houseRecord['streetname'],
        "email"=>$houseRecord['email'],
        "land"=>$houseRecord['land_ownership'],
        "housetype"=>$houseRecord['house_type'],
    
        "esource"=>$houseRecord['electricity_source'],
        "waste"=>$houseRecord['waste_disposal'],
        "water"=>$houseRecord['water_source'],
        "toilet"=>$houseRecord['toilet_type'],
        "appliances"=>$houseRecord['appliances'],
        "vehicle"=>$houseRecord['vehicle'],
        "cooking"=>$houseRecord['energy_source'],

        

    )
);
  

}else{

    echo json_encode(array("success"=>false));
}
    
    
    
}else{
    
     echo json_encode(array("success"=>false));
    
}








?>