<?php include 'serverapi/server_api.php' ?>
<?php


$barno		   = $conn->real_escape_string($_POST['barno']);

$usertype='Resident';
$resid	   = $conn->real_escape_string($_POST['resid']);

$status_query = "SELECT * FROM `tblnotification` WHERE `user_type`='$usertype' AND res_id=$resid AND `bar_no`=$barno  AND notif_status=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);


$data = array(
   'success'  => true,
    'unseen_notification'  => $count
);



  echo json_encode($data);


?>