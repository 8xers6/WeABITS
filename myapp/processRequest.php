<?php include 'serverapi/server_api.php'  ?>
<?php



$resid	= $conn->real_escape_string($_POST['resid']);


$query1 = "SELECT *,lpad(tblrequested_documents.req_no,6,'0') as req_no FROM `tblrequested_documents` LEFT JOIN tbl_residents ON tblrequested_documents.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblrequested_documents.status='processing' ORDER BY tblrequested_documents.req_no DESC";


$result=$conn->query($query1);

$process = array();
while($row = $result->fetch_assoc()){
    $process[] = $row; 
}

  echo json_encode($process);
  
  




?>