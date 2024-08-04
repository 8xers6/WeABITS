<?php include 'serverapi/server_api.php' ?>

<?php 

//$barno="19";
//$barno		   = $conn->real_escape_string($_POST['barno']);
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM tblprovince";
    $result = $conn->query($query);

    $province = array();
    while($row = $result->fetch_assoc()){
        $province[] = $row; 
    }

      echo json_encode($province);



?>