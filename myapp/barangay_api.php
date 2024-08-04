<?php include 'serverapi/server_api.php' ?>

<?php 

//$barno="19";
$city_id		   = $conn->real_escape_string($_POST['city_id']);
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM tblbarangay WHERE city_id='$city_id' ";
    $result = $conn->query($query);

    $barangay = array();
    while($row = $result->fetch_assoc()){
        $barangay[] = $row; 
    }

      echo json_encode($barangay);



?>