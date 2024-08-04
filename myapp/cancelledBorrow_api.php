
<?php include 'serverapi/server_api.php'  ?>
<?php



$resid	= $conn->real_escape_string($_POST['resid']);


$query1 = "SELECT tblborrow.date_req as datetoborrow,tblborrow.status,tblborrow.bor_no as bor_no,tblequipments.equipment_name as equipment_name,tblborrow.quantity as quantity, tblborrow.purpose as purpose, tblborrow.date_to_return as date,tblequipments.image as image,tblequipments.description as description    FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no WHERE tbl_residents.res_id=$resid AND tblborrow.status='cancelled' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC";


$result=$conn->query($query1);

$pending = array();
while($row = $result->fetch_assoc()){
    $pending[] = $row; 
}

  echo json_encode($pending);
  
  




?>