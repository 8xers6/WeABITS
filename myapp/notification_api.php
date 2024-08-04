<?php include 'serverapi/server_api.php' ?>


<?php



$barno		   = $conn->real_escape_string($_POST['barno']);

$usertype='Resident';
$resid	   = $conn->real_escape_string($_POST['resid']);


$query = "SELECT *FROM `tblnotification` WHERE `user_type`='$usertype' AND res_id=$resid AND `bar_no`=$barno AND `notif_status`='0'  ORDER BY `date` DESC";
$result = mysqli_query($conn, $query);


  $notif = array();
    while($row = $result->fetch_assoc()){
        $notif[] = $row; 
    }
    
    
       echo json_encode($notif);
    
 
 
 
 
 









?>