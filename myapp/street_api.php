<?php include 'serverapi/server_api.php' ?>

<?php 

//$barno="19";
$barno		   = $conn->real_escape_string($_POST['barno']);
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM tblstreet WHERE bar_no='$barno'";
    $result = $conn->query($query);

    $street = array();
    while($row = $result->fetch_assoc()){
        $street[] = $row; 
    }

      echo json_encode($street);



?>