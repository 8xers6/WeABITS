<?php include 'serverapi/server_api.php'  ?>
<?php

$resid	= $conn->real_escape_string($_POST['resid']);

	$query3 = "SELECT * FROM `tblreqmedicine` LEFT JOIN tblmedicine on tblmedicine.med_no=tblreqmedicine.med_no  WHERE `res_id`=$resid ";
    $result3 = $conn->query($query3);

    $med = array();
	while($row = $result3->fetch_assoc()){
		$med[] = $row;               
	}
	
	
	      echo json_encode($med);
?>