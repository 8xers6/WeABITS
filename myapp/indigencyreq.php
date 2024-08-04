<?php include 'serverapi/server_api.php'  ?>
<?php

if(!empty($_POST['barno'])&& !empty($_POST['hno'])){
    


$hno	= $conn->real_escape_string($_POST['hno']);
$barno	= $conn->real_escape_string($_POST['barno']);

$query = "SELECT `res_id`, `bar_no`, `h_no`, `firstname`, `lastname`, `middlename`, `suffix`, `civil_status`, `gender`, `relation`  FROM `tbl_residents` WHERE  `bar_no`= $barno AND `h_no`=$hno ";
$result = $conn->query($query);
$family = array();
while($row = $result->fetch_assoc()){
	$family[] = $row; 
}


  echo json_encode($family);
  
}



?>