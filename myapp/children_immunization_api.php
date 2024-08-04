<?php include 'serverapi/server_api.php'  ?>
<?php

$resid	= $conn->real_escape_string($_POST['resid']);

	$query3 = "SELECT * FROM `tblimmunization` WHERE `res_id`=$resid";
    $result3 = $conn->query($query3);

    $immun = array();
	while($row = $result3->fetch_assoc()){
		$immun[] = $row;               
	}
	
	
	      echo json_encode($immun);
?>