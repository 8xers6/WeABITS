<?php include '../server/server.php' ?>


<?php


if(isset($_POST['view'])){

// $con = mysqli_connect("localhost", "root", "", "notif");
$barno=$_SESSION['bar_no'];
$usertype=$_SESSION['role'];

if($_POST["view"] != '')
{
    $update_query = "UPDATE `tblnotification` SET `notif_status`=1 WHERE `notif_status`=0 AND `bar_no`=$barno AND `user_type`='$usertype'";
    mysqli_query($conn, $update_query);
}


$query = "SELECT * FROM `tblnotification` WHERE user_type='$usertype' AND  `bar_no`=$barno  ORDER BY `date` DESC";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {


    if($row['notif_type']=='document'){
      $output .= '
      <div class="row border m-1" >
   
      <div class="col ">
     
      <b>'.$row["notif_name"].'</b><br><span style="position:relative; top:-10px;font-size:9px;"><i class="	fas fa-clock"></i>'.$row['date'].'</span><br>
    <p style="position:relative; top:-10px; font-size:12px; line-height: 1.3;   text-align: justify;  width:200px;">'.$row["message"].' </p>
      
    <a href="requested_docs" class="fw-bold" style="position:relative;  top:-20px; "> View</a>
    
     
     </div>
   
    
   
      </div>
      ';


    }else{


      $output .= '
      <div class="row border m-1" >
   
      <div class="col-md-10">
     
      <b>'.$row["notif_name"].'</b><br><span style="position:relative; top:-10px;font-size:9px;"><i class="	fas fa-clock"></i>'.$row['date'].'</span><br>
    <p style="position:relative; top:-10px; font-size:12px; line-height: 1.3; text-align: justify; width:200px;">'.$row["message"].'. </p>
      
    <a href="borrowed_item" class="fw-bold" style="position:relative;  top:-20px; "> View</a>
    
     
     </div>
   
    
   
      </div>
      ';



    }
 

 }
}
else{
     $output .= '
     <div class="m-5 text-center justify-content-center">No Notification yet</div>';
}








$status_query = "SELECT * FROM `tblnotification` WHERE `user_type`='$usertype' AND `bar_no`=$barno  AND notif_status=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);






  echo json_encode($data);



}

?>