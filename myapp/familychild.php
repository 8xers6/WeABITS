<?php include 'serverapi/server_api.php'  ?>
<?php

if(!empty($_POST['resid'])&& !empty($_POST['hno'])){
    

$resid	= $conn->real_escape_string($_POST['resid']);
$hno	= $conn->real_escape_string($_POST['hno']);
$barno	= $conn->real_escape_string($_POST['barno']);

$query = "SELECT `res_id`, `bar_no`, `h_no`, `firstname`, `lastname`, `middlename`, `suffix`, `civil_status`, `gender`, `relation`  FROM `tbl_residents` WHERE  `bar_no`= $barno AND `h_no`=$hno AND `res_id` Not in ('$resid') AND relation='Child'";
$result = $conn->query($query);
$family = array();
while($row = $result->fetch_assoc()){
	$family[] = $row; 
}


  echo json_encode($family);
  
}



?>