<?php include 'serverapi/server_api.php' ?>

<?php 


$barno=$_POST['barno'];



if($_POST['dashboard']=='active'){
    
    
    
    // $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM `tblannouncement` WHERE bar_no=$barno AND status='Active' LIMIT 5";
    $result = $conn->query($query);

    $announcement = array();
    while($row = $result->fetch_assoc()){
        $announcement[] = $row; 
    }

      echo json_encode($announcement);
}else{

// $query = "SELECT id,`activityname`,`description` FROM tblannouncement WHERE status='active' ORDER BY dateofactivity DESC";
$query = "SELECT * FROM `tblannouncement` WHERE bar_no=$barno AND status='Active' ";
    $result = $conn->query($query);

    $announcement = array();
    while($row = $result->fetch_assoc()){
        $announcement[] = $row; 
    }

      echo json_encode($announcement);
       

}


?>