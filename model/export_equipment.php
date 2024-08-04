<?php

require("../server/server.php");




// get Users
$barno=$_SESSION['bar_no'];

$query1 = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id WHERE bar_no=$barno";
    $result1 = $conn->query($query1);
	$row = $result1->fetch_assoc();

	if($row){
	
		$barangayname 		= $row['barangayname'];
        $city 		= $row['city'];
       // $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
	  
        $mission= $row['mission'];
        $vision= $row['vision'];
		$bar_no= $row['bar_no'];
	}

    $cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);

    $hashcur= hash("sha256",$cur_pass);
    $username=$_SESSION['username'];
   
    
  
    
    $check = "SELECT * FROM tblbarangay WHERE username='$username' AND `password`='$hashcur'";
    $res = $conn->query($check);
    
    if(mysqli_num_rows($res) === 1){


        $excelfile=$barangayname.'equipments'.$city.date("Ymdhis").'.csv';

        $query 		= "UPDATE `tblbarangay` SET `equip_excel_file`='$excelfile' WHERE `username`='$username'";	
        $result 	= $conn->query($query);
    
        if($result === true){
            
$query = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$excelfile.'');
$output = fopen('php://output', 'w');
fputcsv($output, array(
     'equip_no',
     'barno',
     'equipment_name',
     'description',
     'quantity',
     'status',
     'image',


));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
        }
    }else{

		    
		    		$_SESSION['message'] = 'Incorrect password';
		$_SESSION['success'] = 'danger';
		    header("Location: ../equipment.php");
		    
		

       
    }
?>