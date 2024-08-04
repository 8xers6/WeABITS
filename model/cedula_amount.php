<?php include '../server/server.php' ?>



  <?php
  
       $barno=$_SESSION['bar_no'];
    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id   WHERE bar_no=$barno";
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
      
        $mission= $row['mission'];
        $vision= $row['vision'];
                
         $bct= $row['basic_community_tax'];

        $addtax= $row['additional_tax'];
        $nomonth= $row['no_of_month'];
               $gcashqrcode= $row['gcash_qrcode'];

        
    }
    
    
    
                          $resid	= $conn->real_escape_string($_POST['resid']);
									  $basiccommunitytax= $bct;
									  $amount=$addtax;
									  $monthly=$nomonth;
									  
										  $squery1 = mysqli_query($conn,"SELECT Format((`monthly_income`*$monthly/$amount+$basiccommunitytax),2) as monthly_income,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,res_id,lastname,firstname,middlename from tbl_residents WHERE bar_no=$barno AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=18 AND tbl_residents.verify_status='verified' AND tbl_residents.res_id=$resid; ");
									while ($row1 = mysqli_fetch_array($squery1)){
											  echo 
												  $row1['monthly_income'];
											  ;
										  }
										      
										 
									  ?>
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  