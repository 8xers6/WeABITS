<?php include 'server/server.php' ?>

<?php
header('Content-Type: application/json');



//$sql ="SELECT gender,COUNT(*)as number FROM `tbl_residents` WHERE alive=1 AND verification_status='verified' GROUP BY gender ";
//$result = mysqli_query($conn,$sql);
$barno=$_SESSION['bar_no'];
$sql1 ="SELECT vaccine_status,COUNT(*)as number FROM `tbl_residents` WHERE  alive=1 AND verify_status='verified' AND bar_no=$barno GROUP BY vaccine_status ";
	$result10 = mysqli_query($conn,$sql1);


$data = array();
foreach ($result10 as $row) {
	$data[] = $row;
   
}

mysqli_close($conn);

echo json_encode($data);
?>