
<?php include 'serverapi/server_api.php'  ?>
<?php






$hno	= $conn->real_escape_string($_POST['hno']);
$barno	= $conn->real_escape_string($_POST['barno']);
$resid	= $conn->real_escape_string($_POST['resid']);







$query = "SELECT `res_id`, `bar_no`, `h_no`, `firstname`, `lastname`, `middlename`, `suffix`, `civil_status`, `gender`, `relation`,`email`  FROM `tbl_residents` WHERE  `bar_no`= $barno AND `h_no`=$hno AND  `res_id` Not in ('$resid') ";
    $result = $conn->query($query);

    $family = array();
    while($row = $result->fetch_assoc()){
        $family[] = $row; 
    }

      echo json_encode($family);

?>