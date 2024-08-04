<?php 


$barno=$_SESSION['barno'];






$query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblcity.province_id=tblprovince.province_id  WHERE bar_no=$barno";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if($row){

    $barangayname 		= $row['barangayname'];
    $city 		= $row['city'];
    $province 		= $row['province'];
    $phone 		= $row['phonenumber'];
    $email= $row['email'];
    $brgylogo= $row['brgylogo'];
    $citylogo= $row['citylogo'];
    $busername= $row['username'];
    $mission= $row['mission'];
    $vision= $row['vision'];
}

?>