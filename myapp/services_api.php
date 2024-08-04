<?php include 'serverapi/server_api.php' ?>

<?php 


$barno=$_POST['barno'];
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM tblcertificates WHERE bar_no=$barno Order By certificate";
    $result = $conn->query($query);

    $services = array();
    while($row = $result->fetch_assoc()){
        $services[] = $row; 
    }

      echo json_encode($services);



?>