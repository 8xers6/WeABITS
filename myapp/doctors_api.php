<?php include 'serverapi/server_api.php' ?>

<?php


$barno=$_POST['barno'];

// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM `tbldoctors` WHERE bar_no=$barno  ";
    $result = $conn->query($query);

    $doctors = array();
    while($row = $result->fetch_assoc()){
        $doctors[] = $row; 
    }

      echo json_encode($doctors);
      
      
      ?>