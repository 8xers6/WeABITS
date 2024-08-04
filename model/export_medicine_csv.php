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


        $excelfile=$barangayname.'medinventory'.$city.date("Ymdhis").'.csv';

        $query 		= "UPDATE `tblbarangay` SET `med_excel_file`='$excelfile' WHERE `username`='$username'";	
        $result 	= $conn->query($query);
    
        if($result === true){
            
$query = "SELECT inventory.id,inventory.qty,inventory.expiry_date,inventory.date_updated,inventory.med_no,tblmedicine.bar_no,tblmedicine.med_name,tblmedicine.measurement,tblmedicine.description,tblmedicine.sku,med_category.category_id,med_category.category_name,type_list.type_id,type_list.type_name FROM inventory LEFT JOIN tblmedicine on tblmedicine.med_no=inventory.med_no LEFT JOIN med_category on med_category.category_id=tblmedicine.category_id LEFT JOIN type_list on type_list.type_id=tblmedicine.type_id WHERE tblmedicine.bar_no=$barno";
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
     'id',
     'qty',
     'expiry_date',
     'date_updated',
     'med_no',
     'barno',
     'med_name',
     'measurement',
 'description',
     'sku',
     'category_id',
     'category_name',
     'type_id',
     'type_name'







));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
        }
    }else{

 $clerkusername=$_SESSION['clerkusername'];
       	$query1		= "SELECT tblbarangay.username as busername ,tblbarangay.bar_no as barno,tblbarangay.barangayname as barangayname,tbl_users.username as username, tbl_users.user_type as user_type,tbl_users.avatar FROM `tbl_users` LEFT JOIN tblbarangay on tbl_users.bar_no=tblbarangay.bar_no WHERE tbl_users.username='$clerkusername' AND tbl_users.password='$hashcur'";
		$clerk_results 	= $conn->query($query1);
		if(mysqli_num_rows($clerk_results) == 1){
		           
		           
		           
		$excelfile=$barangayname.''.$city.date("Ymdhis").'.csv';
        $query 		= "UPDATE `tblbarangay` SET `med_excel_file`='$excelfile' WHERE `username`='$username'";	
        $result 	= $conn->query($query);
    
        if($result === true){
            
$query = "SELECT inventory.id,inventory.qty,inventory.expiry_date,inventory.date_updated,inventory.med_no,tblmedicine.bar_no,tblmedicine.med_name,tblmedicine.measurement,tblmedicine.description,tblmedicine.sku,med_category.category_id,med_category.category_name,type_list.type_id,type_list.type_name FROM inventory LEFT JOIN tblmedicine on tblmedicine.med_no=inventory.med_no LEFT JOIN med_category on med_category.category_id=tblmedicine.category_id LEFT JOIN type_list on type_list.type_id=tblmedicine.type_id WHERE tblmedicine.bar_no=$barno";
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
         'id',
     'qty',
     'expiry_date',
     'date_updated',
     'med_no',
     'barno',
     'med_name',
     'mesurement',
 'description',
     'sku',
     'category_id',
     'category_name',
     'type_id',
     'type_name'



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
		    header("Location: ../medicine.php");
		    
		}

       
    }
?>