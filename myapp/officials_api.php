<?php include 'serverapi/server_api.php' ?>

<?php 


$barno=$_POST['barno'];
// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT *FROM tblofficials  WHERE `status`='Active' AND tblofficials.bar_no=$barno ";
    $result = $conn->query($query);

    $officials = array();
    while($row = $result->fetch_assoc()){
        $officials[] = $row; 
    }

      echo json_encode($officials);



?>