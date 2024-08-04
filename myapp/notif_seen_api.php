<?php include 'serverapi/server_api.php' ?>


<?php




$barno = $conn->real_escape_string($_POST['barno']);
$id = $conn->real_escape_string($_POST['id']);

$usertype='Resident';
$resid	   = $conn->real_escape_string($_POST['resid']);


    $update_query = "UPDATE `tblnotification` SET `notif_status`=1 WHERE  `bar_no`=$barno AND res_id=$resid AND `notif_id`=$id ";
    
    
	if($conn->query($update_query) === true){

                    echo json_encode(array("success"=>true));

              
				}
    
      






?>