
<?php include 'serverapi/server_api.php'  ?>
<?php



$barno	= $conn->real_escape_string($_POST['barno']);




if($_POST['dashboard']=='active'){
    $query1 = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno AND `status`='Available' LIMIT 4";


$result=$conn->query($query1);

$equipment = array();
while($row = $result->fetch_assoc()){
    $equipment[] = $row; 
}

  echo json_encode($equipment);
    
}else{
    
    $query1 = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno AND `status`='Available'";


$result=$conn->query($query1);

$equipment = array();
while($row = $result->fetch_assoc()){
    $equipment[] = $row; 
}

  echo json_encode($equipment);
    
}


  
  




?>