<?php include 'serverapi/server_api.php'  ?>
<?php

$pregno	= $conn->real_escape_string($_POST['pregno']);

	$query3 = "SELECT * FROM `tblpreg_checkup` WHERE `preg_no`=$pregno ";
    $result3 = $conn->query($query3);

    $pregnantcheckup = array();
	while($row = $result3->fetch_assoc()){
		$pregnantcheckup[] = $row;               
	}
	
	
	      echo json_encode($pregnantcheckup);
?>