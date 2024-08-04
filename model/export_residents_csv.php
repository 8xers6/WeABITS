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


        $excelfile=$barangayname.''.$city.date("Ymdhis").'.csv';

        $query 		= "UPDATE `tblbarangay` SET `excel_file`='$excelfile' WHERE `username`='$username'";	
        $result 	= $conn->query($query);
    
        if($result === true){
            
$query = "SELECT 
tbl_residents.res_id,
tbl_residents.h_no as hid,
tbl_residents.email,
tbl_residents.firstname,
tbl_residents.middlename,
tbl_residents.`lastname`,
tbl_residents.suffix, 
tbl_residents.`birthdate`,
tbl_residents.`birthplace`,
tbl_residents.`occupation`,
tbl_residents.`citizenship`,
tbl_residents.`civil_status`,
tbl_residents.`religion`,
tbl_residents.`gender`,
tbl_residents.`alive`,
tbl_residents.`relation`,
tbl_residents.`classified_sector`,
tbl_residents.`educational_attainment`,
tbl_residents.`monthly_income`,
tbl_residents.`length_of_stay`,
tbl_residents.`blood_type`,
tbl_residents.`pwd`,
tbl_residents.`vaccine_brand`,
tbl_residents.`vaccine_status`,
tbl_residents.`ailment`,
tbl_residents.`height`,
tbl_residents.`weight`,
tbl_residents.`pregnant`,
tbl_residents.`solo_parent`,
tbl_residents.`contact_no`,
tbl_residents.`emergencyname`,
tbl_residents.`emergencycontact`,
tbl_residents.`username`,
tbl_residents.`verify_status`,
tbl_residents.`remarks`,
tbl_residents.`blocklisted`,
tbl_residents.`created_at`,

tblhousehold.h_no,
tblhousehold.bar_no,
tblhousehold.st_id,
tblhousehold.household_no,
tblhousehold.email as hemail,
tblhousehold.land_ownership,
tblhousehold.house_type,
tblhousehold.electricity_source,
tblhousehold.energy_source,
tblhousehold.waste_disposal,
tblhousehold.water_source,
tblhousehold.toilet_type,
tblhousehold.appliances,
tblhousehold.vehicle,
tbl_residents.password

FROM tbl_residents LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified';";
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
    
    'res_id',
    'h_id',
    'email',
    'firstname',
    'middlename',
    'lastname',
    'suffix', 
    'birthdate',
    'birthplace',
    'occupation',
    'citizenship',
    'civil_status',
    'religion',
    'gender',
    'alive',
    'relation',
    'classified_sector',
    'educational_attainment',
    'monthly_income',
    'length_of_stay',
    'blood_type',
    'pwd',
    'vaccine_brand',
    'vaccine_status',
    'ailment',
    'height',
    'weight',
    'pregnant',
    'solo_parent',
    'contact_no',
    'emergencyname',
    'emergencycontact',
    'username',
    'verify_status',
    'remarks',
    'blocklisted',
    'created_at',


    'h_no',
    'bar_no',
    'st_id',
    'household_no',
    'hemail',
    'land_ownership',
    'house_type',
   'electricity_source',
    'energy_source',
    'waste_disposal',
    'water_source',
    'toilet_type',
    'appliances',
    'vehicle',
    'password',







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
        $query 		= "UPDATE `tblbarangay` SET `excel_file`='$excelfile' WHERE `username`='$username'";	
        $result 	= $conn->query($query);
    
        if($result === true){
            
$query = "SELECT 
tbl_residents.res_id,
tbl_residents.h_no as hid,
tbl_residents.email,
tbl_residents.firstname,
tbl_residents.middlename,
tbl_residents.`lastname`,
tbl_residents.suffix, 
tbl_residents.`birthdate`,
tbl_residents.`birthplace`,
tbl_residents.`occupation`,
tbl_residents.`citizenship`,
tbl_residents.`civil_status`,
tbl_residents.`religion`,
tbl_residents.`gender`,
tbl_residents.`alive`,
tbl_residents.`relation`,
tbl_residents.`classified_sector`,
tbl_residents.`educational_attainment`,
tbl_residents.`monthly_income`,
tbl_residents.`length_of_stay`,
tbl_residents.`blood_type`,
tbl_residents.`pwd`,
tbl_residents.`vaccine_brand`,
tbl_residents.`vaccine_status`,
tbl_residents.`ailment`,
tbl_residents.`height`,
tbl_residents.`weight`,
tbl_residents.`pregnant`,
tbl_residents.`solo_parent`,
tbl_residents.`contact_no`,
tbl_residents.`emergencyname`,
tbl_residents.`emergencycontact`,
tbl_residents.`username`,
tbl_residents.`verify_status`,
tbl_residents.`remarks`,
tbl_residents.`blocklisted`,
tbl_residents.`created_at`,

tblhousehold.h_no,
tblhousehold.bar_no,
tblhousehold.st_id,
tblhousehold.household_no,
tblhousehold.email as hemail,
tblhousehold.land_ownership,
tblhousehold.house_type,
tblhousehold.electricity_source,
tblhousehold.energy_source,
tblhousehold.waste_disposal,
tblhousehold.water_source,
tblhousehold.toilet_type,
tblhousehold.appliances,
tblhousehold.vehicle,
tbl_residents.password

FROM tbl_residents LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified';";
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
    
    'res_id',
    'h_id',
    'email',
    'firstname',
    'middlename',
    'lastname',
    'suffix', 
    'birthdate',
    'birthplace',
    'occupation',
    'citizenship',
    'civil_status',
    'religion',
    'gender',
    'alive',
    'relation',
    'classified_sector',
    'educational_attainment',
    'monthly_income',
    'length_of_stay',
    'blood_type',
    'pwd',
    'vaccine_brand',
    'vaccine_status',
    'ailment',
    'height',
    'weight',
    'pregnant',
    'solo_parent',
    'contact_no',
    'emergencyname',
    'emergencycontact',
    'username',
    'verify_status',
    'remarks',
    'blocklisted',
    'created_at',


    'h_no',
    'bar_no',
    'st_id',
    'household_no',
    'hemail',
    'land_ownership',
    'house_type',
   'electricity_source',
    'energy_source',
    'waste_disposal',
    'water_source',
    'toilet_type',
    'appliances',
    'vehicle',
    'password',







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
		    header("Location: ../residents.php");
		    
		}

       
    }
?>