
<?php include 'serverapi/server_api.php'  ?>
<?php



if(!empty($_POST['resid'])){
    
    
    
    $resid	= $conn->real_escape_string($_POST['resid']);



$query 		= "SELECT *,tblcity.city as city,tblbarangay.vision as vision,tblbarangay.mission as mission, tblbarangay.brgylogo as brgylogo,tblbarangay.barangayname as brgyname,tblbarangay.bar_no as bar_no,tbl_residents.res_id as res_id,tbl_residents.email as email,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname ,tbl_residents.username as username, tblbarangay.username as busername, tbl_residents.password as rpassword,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM `tbl_residents` LEFT JOIN tblbarangay ON tbl_residents.bar_no=tblbarangay.bar_no LEFT JOIN tblcity on tblcity.city_id=tblbarangay.city_id  LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id  LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no WHERE  tbl_residents.res_id=$resid";

$result  = $conn->query($query);
  

if($result->num_rows>0) {
  

  $residentRecord=array();
  
  while($row= $result->fetch_assoc()){

         $residentRecord=$row;

       


  }

  echo json_encode(
        
    array(
        "success"=>true,
        
        "res_id"=>$residentRecord['res_id'],
        "username"=>$residentRecord['username'],
        "hno"=>$residentRecord['h_no'],
        "email"=>$residentRecord['email'],
         "age"=>$residentRecord['age'],
    
        "firstname"=>$residentRecord['firstname'],
        "middlename"=>$residentRecord['middlename'],
        "lastname"=>$residentRecord['lastname'],
        "suffix"=>$residentRecord['suffix'],
        "birthdate"=>$residentRecord['birthdate'],
        "birthplace"=>$residentRecord['birthplace'],
        "occu"=>$residentRecord['occupation'],
        "citi"=>$residentRecord['citizenship'],
        "cstatus"=>$residentRecord['civil_status'],
        "religion"=>$residentRecord['religion'],
        "gender"=>$residentRecord['gender'],
        "relation"=>$residentRecord['relation'],
        "csector"=>$residentRecord['classified_sector'],
        "educ"=>$residentRecord['educational_attainment'],
        "mincome"=>$residentRecord['monthly_income'],
        "los"=>$residentRecord['length_of_stay'],
        "bt"=>$residentRecord['blood_type'],
        "pwd"=>$residentRecord['pwd'],
        "vb"=>$residentRecord['vaccine_brand'],
        "vs"=>$residentRecord['vaccine_status'],
        "ailment"=>$residentRecord['ailment'],
        "height"=>$residentRecord['height'],
        "weight"=>$residentRecord['weight'],
        "pregnant"=>$residentRecord['pregnant'],
        "solo_parent"=>$residentRecord['solo_parent'],
        "contact_no"=>$residentRecord['contact_no'],
        "ename"=>$residentRecord['emergencyname'],
        "eno"=>$residentRecord['emergencycontact'],
        "blocklisted"=>$residentRecord['blocklisted'],
     
        
     
        "barno"=>$residentRecord['bar_no'],
        "busername"=>$residentRecord['busername'],
          "gcashqrcode"=>$residentRecord['gcash_qrcode'],
        "bname"=>$residentRecord['brgyname'],
        "blogo"=>$residentRecord['brgylogo'],
        "city"=>$residentRecord['city'],
        "province"=>$residentRecord['province'],
        "mission"=>$residentRecord['mission'],
        "vision"=>$residentRecord['vision']
      
        

    )
);
  

}else{

    echo json_encode(array("success"=>false));
}
    
    
    
}else{
    
     echo json_encode(array("success"=>false));
    
}








?>