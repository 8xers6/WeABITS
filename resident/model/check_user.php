
<?php include '../server/serverhome.php'?>
<?php
 


 
 ini_set('display_errors',1);
 error_reporting(E_ALL);
 mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);
 // error_reporting(0);
 
 $conn = new mysqli($host,$username,$password,$database);
 
 if($conn->connect_error){
     die("Connection Failed: ". $conn->connect_error());
 }
 


    $result = mysqli_query($conn,"select username from tbl_residents where username = '".$_POST['username']."' ");

    $cnt = mysqli_num_rows($result);
    print($cnt);




?>