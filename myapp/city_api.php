<?php include 'serverapi/server_api.php' ?>

<?php 

//$barno="19";
$province_id= $conn->real_escape_string($_POST['province_id']);
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM tblcity WHERE province_id='$province_id'  ORDER BY city ASC";
    $result = $conn->query($query);

    $city = array();
    while($row = $result->fetch_assoc()){
        $city[] = $row; 
    }

      echo json_encode($city);



?>