<?php include 'serverapi/server_api.php'  ?>
<?php

$resid	= $conn->real_escape_string($_POST['resid']);

	$query3 = "SELECT * FROM `tblpregnant`  WHERE `res_id`=$resid ";
    $result3 = $conn->query($query3);

    $pregnant = array();
	while($row = $result3->fetch_assoc()){
		$pregnant[] = $row;               
	}
	
	
	      echo json_encode($pregnant);
?>