<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    



    $resid 	= $conn->real_escape_string($_POST['res_id']);
    
    
    
    $immun_type 	= $conn->real_escape_string($_POST['immun_type']);
    $datevisit 	= $conn->real_escape_string($_POST['date_visit']);
    
    
        $age 	= $conn->real_escape_string($_POST['age']);
        
        
        
        
        //BCG
        
        
        if($immun_type=='BCG'){
            
            
             if($age==0){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose' AND immun_type='BCG' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of BCG 1st Dose is already done';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            					$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }else{
            
            
        $_SESSION['message'] = 'BCG only at birth';
        $_SESSION['success'] = 'danger';
            
            
        }
            
            
            
            
        }
    
        
        //HEPB
          if($immun_type=='HepB'){
              
              
              
              if($age==0 || $age>=1 && $age<=2 || $age>=6 && $age<=18 ){
                  
                  
             
              
            
            
              if($age==0){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose' AND immun_type='HepB' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
             $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
          if($age>=1 && $age<=2){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose'  AND immun_type='HepB' AND res_id=$resid  ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
             $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added!';
            $_SESSION['success'] = 'success';
            
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
            
        }
        
        
        
          if($age>=6 && $age<=18){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'  AND immun_type='HepB' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added!';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
            
        }
        
        
              }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
        
        
       
            
            
        }
        
          //RV
          if($immun_type=='RV'){
              
              
              
               if($age==2 || $age==4 || $age==6  ){
                   
               
              
                if($age==2){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose' AND immun_type='RV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
        if($age==4){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose' AND immun_type='RV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        if($age==6){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'   AND immun_type='RV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
              
              
               }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
            
            
            
            
        }
        
        
          if($immun_type=='DTaP'){
              
              
               if($age==2 || $age==4 || $age==6 || $age>=15 && $age<=18 || $age>=36 && $age<=59  ){
          
              
               if($age==2){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose' AND immun_type='DTaP' AND res_id=$resid ";
            $res = $conn->query($check);
              

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
        if($age==4){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose' AND immun_type='DTaP' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        if($age==6){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'   AND immun_type='DTaP' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
          $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
        
          if($age>=15 && $age<=18){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='4th Dose'   AND immun_type='DTaP' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 4th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
         if($age>=36 && $age<=59){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='5th Dose'   AND immun_type='DTaP' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of '.$immun_type.' 5th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','5th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
        
        
        
        
               }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
        
        
            
            
            
            
        }
        
        
         
        
          if($immun_type=='Hib'){
              
                   if($age==2 || $age==4 || $age==6 || $age>=12 && $age<=15  ){
              
              
               if($age==2){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='Hib' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
              $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
        if($age==4){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose' AND immun_type='Hib' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        if($age==6){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'   AND immun_type='Hib' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                 $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
        
          if($age>=15 && $age<=18){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='4th Dose'   AND immun_type='Hib' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
               $_SESSION['message'] = 'Immunization of '.$immun_type.' 4th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
         if($age>=12 && $age<=15){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='5th Dose'   AND immun_type='Hib' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of '.$immun_type.' 5th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
        
        
        
                   }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
        
            
            
            
            
        }
        
        
          if($immun_type=='PCV'){
            if($age==2 || $age==4 || $age==6 || $age>=12 && $age<=15  ){
              
                if($age==2){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='PCV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
        if($age==4){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose' AND immun_type='PCV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                 $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';
            
            
            			$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Immunization')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        if($age==6){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'   AND immun_type='PCV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                 $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
        
          if($age>=15 && $age<=18){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='4th Dose'   AND immun_type='PCV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 4th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
         if($age>=12 && $age<=15){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='5th Dose'   AND immun_type='PCV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                   $_SESSION['message'] = 'Immunization of '.$immun_type.' 5th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
              
            }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
              
            
            
        }
        
        
          if($immun_type=='IPV'){
              
                  if($age==2 || $age==4 || $age==6 || $age>=6 && $age<=18  ){
              
                if($age==2){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='IPV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                 $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        
        if($age==4){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose' AND immun_type='IPV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
       $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }  
        
        if($age>=6 && $age<=18){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='3rd Dose'   AND immun_type='IPV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
               $_SESSION['message'] = 'Immunization of '.$immun_type.' 3rd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','3rd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
        
          if($age>=35 && $age<=59){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='4th Dose'   AND immun_type='IPV' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
            $_SESSION['message'] = 'Immunization of '.$immun_type.' 4th Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','4th Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
         
                  }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
              
              
              
              
              
            
            
            
            
        }
        
        
        
          if($immun_type=='Flu'){
              
              
              
              
               if($age>=6 && $age<=59){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='Flu' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                    $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
               }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
              
              
            
            
            
            
        }
        
        
          if($immun_type=='MMR'){
              
              
              
                if($age>=12 && $age<=15 || $age>=36 && $age<=59){
              
               if($age>=12 && $age<=15){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='MMR' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                    $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
        
        
        
           if($age>=36 && $age<=59){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose'   AND immun_type='MMR' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                  $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
            
                }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
              
            
            
            
        }
        
        
          if($immun_type=='Varicella'){
              
                  if($age>=12 && $age<=15 || $age>=36 && $age<=59){
               if($age>=12 && $age<=15){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'   AND immun_type='Varicella' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                 $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
        
        
        
           if($age>=36 && $age<=59){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose'   AND immun_type='Varicella' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                    $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
              
              
                  }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
            
            
            
        }
        
        
         if($immun_type=='HepA'){
            
              if($age==12 || $age>=18 && $age<=23 ){
            
            
               if($age==12 ){
            
            
               $check = "SELECT * FROM tblimmunization WHERE dose='1st Dose'  AND immun_type='HepA' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
               $_SESSION['message'] = 'Immunization of '.$immun_type.' 1st Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','1st Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
             
             
            
        }
        
        
        
           if($age>=18 && $age<=23){
            
            
              $check = "SELECT * FROM tblimmunization WHERE dose='2nd Dose'   AND immun_type='HepA' AND res_id=$resid ";
            $res = $conn->query($check);

            if($res->num_rows){
                
                
                $_SESSION['message'] = 'Immunization of '.$immun_type.' 2nd Dose is already done see table for next vaccination';
            $_SESSION['success'] = 'danger';
                
            }else{
                
                
                  if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`,`dose`) VALUES ('$resid','$datevisit','$immun_type','2nd Dose')";
        $result  = $conn->query($insert);

        if($result === true){
                $_SESSION['message'] = 'Immunization added! ';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
                
                
           
                
                
            }
            
            
            
            
               
        }
        
        
              }else{
                  
        $_SESSION['message'] = 'No Schedule for Vaccination.see table for next vaccination';
        $_SESSION['success'] = 'danger';
              }
            
            
            
        }
        
        
        
      
        
    
    /*
     if($age==1){
            
            
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in 1 month';
            $_SESSION['success'] = 'success';
            
            
            
        }
        
        
          if($age==2){
            
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in 2 months';
            $_SESSION['success'] = 'success';
            
            
            
            
        }
        
        
          if($age==4){
            
             
            $_SESSION['message'] = 'Immunization added! in 4 months';
            $_SESSION['success'] = 'success';
            
            
            
            
            
            
            
        }
        
        
        
          if($age==6){
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in 6months';
            $_SESSION['success'] = 'success';
            
            
            
            
            
        }
        
        
        
          if($age==12){
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in 12 months';
            $_SESSION['success'] = 'success';
            
            
            
            
            
        }
        
        
        
          if($age==15){
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in Birth';
            $_SESSION['success'] = 'success';
            
            
            
            
            
          }
          
          
            if($age==18){
            
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in Birth';
            $_SESSION['success'] = 'success';
            
            
            
            
        }
        
          if($age>=19 && $age<=23){
            
            
             
            $_SESSION['message'] = 'Immunization added! in Birth';
            $_SESSION['success'] = 'success';
            
            
            
            
            
            
        }
        
        
            if($age>=24 && $age<=35){
            
            
             
            $_SESSION['message'] = 'Immunization added! in Birth';
            $_SESSION['success'] = 'success';
            
            
            
            
            
            
        }
        
            if($age>=36 && $age<=59){
            
            
            
             
            $_SESSION['message'] = 'Immunization added! in Birth';
            $_SESSION['success'] = 'success';
            
        }
    
    
    
    
    */
    
    
    
    
    
    
    
    
    
/*

    if(!empty($resid) && !empty($immun_type)){

        $insert  = "INSERT INTO `tblimmunization`(`res_id`, `date_visit`, `immun_type`) VALUES ('$resid','$datevisit','$immun_type')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Immunization added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = ' Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
*/
    header("Location: ../newborndetails.php?id=$resid");

	$conn->close();