<?php include 'serverapi/server_api.php'  ?>
<?php

$resid	= $conn->real_escape_string($_POST['resid']);

	$query3 = "SELECT * FROM `tblpatient` WHERE `res_id`=$resid ";
    $result3 = $conn->query($query3);

    $patient = array();
	while($row = $result3->fetch_assoc()){
		$patient[] = $row;               
	}
	
	
	      echo json_encode($patient);
?>