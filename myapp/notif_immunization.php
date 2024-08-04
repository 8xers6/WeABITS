<?php include 'serverapi/server_api.php' ?>

<?php

     $barno		   = $conn->real_escape_string($_POST['barno']);
	 $resid 	= $conn->real_escape_string($_POST['resid']);
	
	//BCG
	$check = "SELECT * FROM tblimmunization WHERE immun_type='BCG' AND dose='1st Dose' AND res_id= $resid";
    $res = $conn->query($check);
    $BCG1 = $res->fetch_assoc();
	
	//hepb
	$check1 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='1st Dose' AND res_id= $resid";
    $res1 = $conn->query($check1);
   $HepB1 = $res1->fetch_assoc();
   
   
   
   	$check2 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='2nd Dose' AND res_id=$resid ";
    $res2 = $conn->query($check2);
   $HepB2 = $res2->fetch_assoc();
   
   
   	$check3 = "SELECT * FROM tblimmunization WHERE immun_type='HepB' AND dose='3rd Dose' AND res_id=$resid";
    $res3 = $conn->query($check3);
    $HepB3 = $res3->fetch_assoc();
    
    
    
    //rota
    
    $check4 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='1st Dose' AND res_id= $resid";
    $res4 = $conn->query($check4);
   $RV1 = $res4->fetch_assoc();
   
   
   
   	$check5 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='2nd Dose' AND res_id=$resid ";
    $res5 = $conn->query($check5);
   $RV2 = $res5->fetch_assoc();
   
   
   	$check6 = "SELECT * FROM tblimmunization WHERE immun_type='RV' AND dose='3rd Dose' AND res_id=$resid";
    $res6 = $conn->query($check6);
    $RV3 = $res6->fetch_assoc();
    
    
    
    
    //DTaP
    
       $check7 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='1st Dose' AND res_id= $resid";
    $res7= $conn->query($check7);
   $DTaP1 = $res7->fetch_assoc();
   
   
   
   	$check8 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='2nd Dose' AND res_id=$resid ";
    $res8 = $conn->query($check8);
   $DTaP2= $res8->fetch_assoc();
   
   
   	$check9 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='3rd Dose' AND res_id=$resid";
    $res9 = $conn->query($check9);
    $DTaP3 = $res9->fetch_assoc();
    
    
    
     	$check10 = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='4th Dose' AND res_id=$resid";
    $res10 = $conn->query($check10);
  $DTaP4= $res10->fetch_assoc();
  
  	$check10a = "SELECT * FROM tblimmunization WHERE immun_type='DTaP' AND dose='5th Dose' AND res_id=$resid";
    $res10a = $conn->query($check10a);
  $DTaP5= $res10a->fetch_assoc();
  
  
  
  //Hib
  
    	$check11 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='1st Dose' AND res_id=$resid ";
    $res11 = $conn->query($check11);
   $Hib1= $res11->fetch_assoc();
   
   
   	$check12 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='2nd Dose' AND res_id=$resid";
    $res12 = $conn->query($check12);
    $Hib2 = $res12->fetch_assoc();
    
    
    
    $check13 = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='3rd Dose' AND res_id=$resid";
    $res13 = $conn->query($check13);
    $Hib3= $res13->fetch_assoc();
    
     $check13a = "SELECT * FROM tblimmunization WHERE immun_type='Hib' AND dose='4th Dose' AND res_id=$resid";
    $res13a = $conn->query($check13a);
    $Hib4= $res13a->fetch_assoc();
  
  
    //PCV
    
    
           $check14 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='1st Dose' AND res_id= $resid";
    $res14= $conn->query($check14);
   $PCV1 = $res14->fetch_assoc();
   
   
   
   	$check15 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='2nd Dose' AND res_id=$resid ";
    $res15 = $conn->query($check15);
   $PCV2= $res15->fetch_assoc();
   
   
   	$check16 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='3rd Dose' AND res_id=$resid";
    $res16 = $conn->query($check16);
    $PCV3 = $res16->fetch_assoc();
    
    
    
     	$check17 = "SELECT * FROM tblimmunization WHERE immun_type='PCV' AND dose='4th Dose' AND res_id=$resid";
    $res17 = $conn->query($check17);
  $PCV4= $res17->fetch_assoc();
  

    
    //IPV
    
    
     $check18 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='1st Dose' AND res_id= $resid";
    $res18= $conn->query($check18);
   $IPV1 = $res18->fetch_assoc();
   
   
   
   	$check19 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='2nd Dose' AND res_id=$resid ";
    $res19 = $conn->query($check19);
   $IPV2= $res19->fetch_assoc();
   
   
   	$check20 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='3rd Dose' AND res_id=$resid";
    $res20 = $conn->query($check20);
    $IPV3 = $res20->fetch_assoc();
    
    
    
     	$check21 = "SELECT * FROM tblimmunization WHERE immun_type='IPV' AND dose='4th Dose' AND res_id=$resid";
    $res21 = $conn->query($check21);
  $IPV4= $res21->fetch_assoc();
    
    
    
    
    //Flu
    
    
    	$check22 = "SELECT * FROM tblimmunization WHERE immun_type='Flu' AND dose='1st Dose' AND res_id=$resid";
    $res22 = $conn->query($check22);
  $Flu1= $res22->fetch_assoc();
    
    
    
    
    //MMR
    
    $check23 = "SELECT * FROM tblimmunization WHERE immun_type='MMR' AND dose='1st Dose' AND res_id= $resid";
    $res23= $conn->query($check23);
   $MMR1 = $res23->fetch_assoc();
   
   
   
   	$check24 = "SELECT * FROM tblimmunization WHERE immun_type='MMR' AND dose='2nd Dose' AND res_id=$resid ";
    $res24 = $conn->query($check24);
   $MMR2= $res24->fetch_assoc();
    
    
    
    
    
    
    
    //Varicella
    
      $check25 = "SELECT * FROM tblimmunization WHERE immun_type='Varicella' AND dose='1st Dose' AND res_id= $resid";
    $res25= $conn->query($check25);
   $Varicella1 = $res25->fetch_assoc();
   
   
   
   	$check26 = "SELECT * FROM tblimmunization WHERE immun_type='Varicella' AND dose='2nd Dose' AND res_id=$resid ";
    $res26 = $conn->query($check26);
   $Varicella2= $res26->fetch_assoc();
    
    
    
    
    //HepA
  
      $check27 = "SELECT * FROM tblimmunization WHERE immun_type='HepA' AND dose='1st Dose' AND res_id= $resid";
    $res27= $conn->query($check27);
   $HepA1 = $res27->fetch_assoc();
   
   
   
   	$check28 = "SELECT * FROM tblimmunization WHERE immun_type='HepA' AND dose='2nd Dose' AND res_id=$resid ";
    $res28 = $conn->query($check28);
   $HepA2= $res28->fetch_assoc();
   
   
 
   
   
   
   $query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.res_id='$resid' AND tbl_residents.relation='Child' ";
    $result = $conn->query($query);
	$resident = $result->fetch_assoc();
     

    $hno 		= $resident['h_no'];
     $birthdate		= $resident['birthdate'];
     
     $fname		= $resident['firstname'];
     
     
     
      $query1 = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Head'";
    $result1 = $conn->query($query1);
	$father = $result1->fetch_assoc();
    
    
    
    $fresid=$father['res_id'];
   
     
      $date1 = new DateTime($birthdate);
$date2 = new DateTime(date('Y-m-d'));
$interval = $date1->diff($date2);
$months = ($interval->y * 12) + $interval->m;


$age=$months.' Months';
     
     
     
  
            
   
   
   
   //hepB
   
    if(empty($HepB1) && $months==0){
        
                              $notifname='Hepatitis B ';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Hepatitis B 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
     if(empty($HepB2) && $months>=1 && $months<=2){
        
                              $notifname='Hepatitis B ';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Hepatitis B 2nd Dose ready for your baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
      if(empty($HepB3)&& $months>=6 && $months<=18){
        
                              $notifname='Hepatitis B ';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Hepatitis B 3rd Dose ready for your baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    //BCG
    if(empty($BCG1) && $months==0){
        
                              $notifname='BCG';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='BCG 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                           //echo json_encode(array("success"=>true));                 
                                                          
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    //RV
    
     if(empty($RV1) && $months==2){
        
                              $notifname='Rota Virus';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='RotaVirus 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($RV2)&& $months==4){
        
                              $notifname='Rota Virus';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='RotaVirus 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
     if(empty($RV3)&& $months==6 ){
        
                              $notifname='Rota Virus';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='RotaVirus 3rd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    //DTAP
    
        if(empty($DTaP1) && $months==2){
        
                              $notifname='DTaP';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Diphtheria, Pertussis, & Tetanus 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($DTaP2)&& $months==4){
        
                              $notifname='DTaP';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Diphtheria, Pertussis, & Tetanus 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
     if(empty($DTaP3)&& $months==6 ){
        
                              $notifname='DTaP';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Diphtheria, Pertussis, & Tetanus 3rd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
     if(empty($DTaP4)&& $months>=15 && $months<=18  ){
        
                              $notifname='DTaP';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Diphtheria, Pertussis, & Tetanus 4th Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
      if(empty($DTaP5) && $months>=36 && $months<=59){
        
                              $notifname='DTaP';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Diphtheria, Pertussis, & Tetanus 5th Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    //hib
    
      if(empty($Hib1) && $months==2){
        
                              $notifname='Hib';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Haemophilus influenzae type b 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($Hib2)&& $months==4){
        
                              $notifname='Hib';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Haemophilus influenzae type b 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
        if(empty($Hib3)&& $months==6){
        
                              $notifname='Hib';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Haemophilus influenzae type b 3rd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($Hib4)&& $months>=12 && $months<=15 ){
        
                              $notifname='Hib';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Haemophilus influenzae type b 4th Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    //PCV
    
    
      if(empty($PCV1) && $months==2){
        
                              $notifname='PCV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Pneumococcal disease 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($PCV2)&& $months==4){
        
                              $notifname='PCV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Pneumococcal disease 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
        if(empty($PCV3)&& $months==6){
        
                              $notifname='PCV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Pneumococcal disease 3rd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($PCV4)&& $months>=12 && $months<=15 ){
        
                              $notifname='PCV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Pneumococcal disease  4th Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    
    
    //IPV
    
     
      if(empty($IPV1) && $months==2){
        
                              $notifname='IPV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Polio 1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($IPV2)&& $months==4){
        
                              $notifname='IPV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Polio 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
        if(empty($IPV3)&& $months>=6 && $months<=18){
        
                              $notifname='IPV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Polio 3rd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
     if(empty($IPV4)&& $months>=36 && $months<=59 ){
        
                              $notifname='IPV';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Polio  4th Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    
    //FLU
       if(empty($Flu1)&& $months>=6 && $months<=59 ){
        
                              $notifname='Flu';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Influenza  1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    //MMR
    
      if(empty($MMR1)&& $months>=12 && $months<=15 ){
        
                              $notifname='Flu';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Measles, Mumps, & Rubella  1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
      if(empty($MMR2)&& $months>=36 && $months<=59 ){
        
                              $notifname='Flu';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Measles, Mumps, & Rubella  2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    //Varicella
      if(empty($Varicella1)&& $months>=12 && $months<=15 ){
        
                              $notifname='Varicella';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Varicella  1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
      if(empty($Varicella2)&& $months>=36 && $months<=59 ){
        
                              $notifname='Varicella';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Varicella 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
    
    
    //hepA
    
      if(empty($HepA1)&& $months>=12 && $months<=15 ){
        
                              $notifname='HepA';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Hepatitis A  1st Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
      if(empty($HepA2)&& $months>=36 && $months<=59 ){
        
                              $notifname='HepA';
                                                        $notiftype='vaccine';
                                                        $usertype='Resident';
                                                        $message='Hepatitis A 2nd Dose ready for your Baby '.$fname.' .Visit the nearest Health Center in your barangay.';
                                         
                                                         $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                                                         ('$barno','$fresid','$notifname','$message','0','$usertype','$notiftype')";
                                                        $result1  = $conn->query($insert1);
                                                             if($result1 === true){
                                                                                            
                                                          //echo json_encode(array("success"=>true));
                                                                                         

                                                             }
        
    }else{
        
            
        
                                                                                                 
        
        
    }
    
   
  
 echo json_encode(array("success"=>true));


?>








