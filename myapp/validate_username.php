
<?php include '../server_api.php'  ?>
<?php



$username	= $conn->real_escape_string($_POST['username']);

$sql2="SELECT * from tbl_residents where username='$username'";
$result=$conn->query($sql2);

if ($result->num_rows>0) {
  

  
    echo json_encode(array("usernameFound"=>true));

}else{

    echo json_encode(array("usernameFound"=>false));
}
  
  







?>