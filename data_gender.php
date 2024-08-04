<?php include 'server/server.php' ?>

<?php
header('Content-Type: application/json');

$barno=$_SESSION['bar_no'];

//$sql ="SELECT gender,COUNT(*)as number FROM `tbl_residents` WHERE alive=1 AND verification_status='verified' GROUP BY gender ";
//$result = mysqli_query($conn,$sql);
$sql ="SELECT gender,COUNT(*)as number FROM `tbl_residents` WHERE alive=1 AND verify_status='verified' AND bar_no=$barno GROUP BY gender DESC ";
	$result = mysqli_query($conn,$sql);


$data = array();
foreach ($result as $row) {
	$data[] = $row;
   
}

mysqli_close($conn);

echo json_encode($data);
?>