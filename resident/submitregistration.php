<?php

include('server/serverhome.php');



if(!empty($_POST['terms'])){
	

if(!empty($_SESSION['s_email'])){

 $email= $_SESSION['s_email']; 

		
if(!empty($email)){
	
 



        

		if(!empty($_SESSION['fname'])){






           


		 $fname=$_SESSION['fname'];		
		 $mname=$_SESSION['mname'];	 		 
		 $lname=$_SESSION['lname'];
		 $suffix=$_SESSION['suffix'];		 
		
		 $bdate=$_SESSION['bdate']; 	
		 $bplace=$_SESSION['bplace'];		
	
		
		 $cstatus=$_SESSION['cstatus'];		
		 $citi=$_SESSION['citizenship'];	     
		 $gender=$_SESSION['gender'];	
		
		
		 $religion=$_SESSION['religion'];		
		
		 $contact=$_SESSION['contact'];		
		 $occu=$_SESSION['occupation'];		
		
		 $class_sec=$_SESSION['class_sec'];
		
		 $educ=$_SESSION['educ'];    
			
		 $los=$_SESSION['los'];		   
		
		 $mincome=$_SESSION['m_income'];		
			
		
	
		 $pwd=$_SESSION['pwd'];
		
		
		 $ename=$_SESSION['ename'];	
		 $eno=$_SESSION['eno'];  
		
		 
		
		
		 $vbrand=$_SESSION['vbrand'];		
		 $vstatus=$_SESSION['vstatus'];			 
		 $ailment=$_SESSION['ailment'];			   
		 $bloodtype=$_SESSION['bloodtype'];	
		
		 $preg=$_SESSION['preg'];  
		 $singleparent=$_SESSION['singleparent']; 
		 $height =$_SESSION['height'];
		 $weight=$_SESSION['weight'];


        $houseno=$_SESSION['houseno'];
        $barno=$_SESSION['barno'];	 
        $streetid=$_SESSION['street'];		  
        $housetype=$_SESSION['housetype'];	
        $landownership=$_SESSION['landownership'];		
        $s_electricity=$_SESSION['s_electricity'];		  
        $s_cooking=$_SESSION['s_cooking'];
        $source_water=$_SESSION['source_water'];		 
        $waste_disposal=$_SESSION['waste_disposal'];		   
        $toilet=$_SESSION['toilet'];
        $vehicles=$_SESSION['vehicles'];
        $appliances=$_SESSION['appliances'];




        

      

        $insert="INSERT INTO `tblhousehold`(`bar_no`, `st_id`, `household_no`, `email`, `land_ownership`, `house_type`, `electricity_source`, `waste_disposal`, `water_source`, `toilet_type`, `appliances`, `vehicle`, `energy_source`) 
                                    VALUES ($barno,$streetid,'$houseno','$email','$landownership','$housetype','$s_electricity','$waste_disposal','$source_water','$toilet','$appliances','$vehicles','$s_cooking')";

		if($conn->query($insert) === true){

			
       
         



        $query = "SELECT * From tblhousehold Where email='$email'";
        $result = $conn->query($query);  
        $row = $result->fetch_assoc();
           
           if($row){
   
            $h_no 		= $row['h_no'];


			if($gender=='Female'){

				$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`pregnant`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`email`,`verify_status`) 
				VALUES ($h_no,$barno,'$fname','$lname','$mname','$suffix','$bdate','$bplace','$occu','$citi','$cstatus','$religion','$gender','$class_sec','$educ','$mincome','$los','$bloodtype','$pwd','$vbrand','$vstatus','$ailment','$height','$weight','$preg','$singleparent','$contact','Head','$ename','$eno','$email','pending')";

			}else{



				$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`solo_parent`,`contact_no`,`relation`,`emergencyname`,`emergencycontact`,`email`,`verify_status`) 
				VALUES ($h_no,$barno,'$fname','$lname','$mname','$suffix','$bdate','$bplace','$occu','$citi','$cstatus','$religion','$gender','$class_sec','$educ','$mincome','$los','$bloodtype','$pwd','$vbrand','$vstatus','$ailment','$height','$weight','$singleparent','$contact','Head','$ename','$eno','$email','pending')";
			}

   
           
             if($conn->query($query) === true){
                 
                 
                 
                        function password_generate($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $chars);
}
  $token=password_generate(8);
     
       $sql3="UPDATE `tblregistration` SET `status`='verification',`email_token`='$token' WHERE `email`='$email'";
    $result1=$conn->query($sql3);
    
    if ($result1==true) {



}
    
    
				if(!empty($_POST['firstname'])){
      

		
					$firstname= $_POST['firstname'];
					$middlename=$_POST['middlename'];
					$lastname=$_POST['lastname'];
					$suffixes=$_POST['suffixes'];
					$relations=$_POST['relations'];
					$genders=$_POST['genders'];
					$bdays=$_POST['bdays'];
					$bplaces=$_POST['bplaces'];
					$contacts=$_POST['contacts'];
					$civilstatus=$_POST['civilstatus'];
					$citizenship=$_POST['citizenship'];
					$religions=$_POST['religions'];
					$lengthofstay=$_POST['lengthofstay'];
					$occupation=$_POST['occupation'];
					$class_sector=$_POST['class_sector'];
					$educs=$_POST['educs'];
					$m_incomes=$_POST['m_incomes'];
					$pwds= $_POST['pwds'];
					$vbrands=$_POST['vbrands'];
					$vaccstatus=$_POST['vaccstatus'];
					$ailments=$_POST['ailments'];
					$bloodtypes=$_POST['bloodtypes'];


					
					$pregnants=$_POST['pregnant'];
					$soloparent=$_POST['soloparent'];
					$heights=$_POST['heights'];
					$weights=$_POST['weights'];
				 
					 foreach($firstname as $index => $fnames)
						 {
			 
							 
						  $s_first = $fnames;
						  $s_middle = $middlename[$index];
						  $s_last = $lastname[$index];
						  $s_suffix = $suffixes[$index];
						  $s_relation = $relations[$index];
						  $s_gender = $genders[$index];
						  $s_bday = $bdays[$index];
						  $s_bplace=$bplaces[$index];
						  $s_contact=$contacts[$index];
						  $s_civilstatus = $civilstatus[$index];
						  $s_citizenship = $citizenship[$index];
						  $s_bday = $bdays[$index];
						  $s_religion = $religions[$index];
						  $s_los = $lengthofstay[$index];
						  $s_occupation = $occupation[$index];
						  $s_class_sector = $class_sector[$index];
						  $s_educs = $educs[$index];
						  $s_mincomes = $m_incomes[$index];
						  $s_pwd  = $pwds[$index];
						  $s_vbrand = $vbrands[$index];
						  $s_vaccstatus = $vaccstatus[$index];
						  $s_ailments = $ailments[$index];
						  $s_bloodtypes = $bloodtypes[$index];
						  $s_height = $heights[$index];
						  $s_weight = $weights[$index];
						  $s_pregnant = $pregnants[$index];
						  $s_soloparent = $soloparent[$index];
						  
					           
					
						  $emergencyname= $fname.' '.$mname.' '.$lname;
							   
							   if( $s_gender=='Female'){

               


								$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`pregnant`,`contact_no`,`relation`,`verify_status`,`solo_parent`,`emergencyname`,`emergencycontact`) 
								VALUES ($h_no,$barno,'$s_first','$s_last','$s_middle','$s_suffix','$s_bday','$s_bplace','$s_occupation','$s_citizenship','$s_civilstatus','$s_religion','$s_gender','$s_class_sector','$s_educs','$s_mincomes','$s_los','$s_bloodtypes','$s_pwd','$s_vbrand','$s_vaccstatus','$s_ailments','$s_height','$s_weight','$s_pregnant','$s_contact','$s_relation','pending','$s_soloparent','$emergencyname','$contact')";
		if($conn->query($query) === true){


	  

		
		if ($index === array_key_last($firstname)){


		  $_SESSION['message'] = 'Registration successfully submitted';
		  $_SESSION['success'] = 'success';
		   echo "success";

		}
   



		}



							   }else{


								$query="INSERT INTO `tbl_residents`(`h_no`,`bar_no`,`firstname`, `lastname`, `middlename`,`suffix`, `birthdate`,`birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`,`classified_sector`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`,`pwd`, `vaccine_brand`, `vaccine_status`, `ailment`, `height`, `weight`,`contact_no`,`relation`,`verify_status`,`solo_parent`,`emergencyname`,`emergencycontact`) 
								VALUES ($h_no,$barno,'$s_first','$s_last','$s_middle','$s_suffix','$s_bday','$s_bplace','$s_occupation','$s_citizenship','$s_civilstatus','$s_religion','$s_gender','$s_class_sector','$s_educs','$s_mincomes','$s_los','$s_bloodtypes','$s_pwd','$s_vbrand','$s_vaccstatus','$s_ailments','$s_height','$s_weight','$s_contact','$s_relation','pending','$s_soloparent','$emergencyname','$contact')";
		if($conn->query($query) === true){


	  

		
		if ($index === array_key_last($firstname)){


		  $_SESSION['message'] = 'Registration successfully submitted';
		  $_SESSION['success'] = 'success';
		   echo "success";

		}
   



		}



							   }
			 
			 
					
			 
			 
						 }
			 
			 
					 }else{
			 
			 
		
						 echo "success";
					 }
					 
					 
					 
					 
			 
    
    
    
             }
             

           }

		}



	}
	


		
    

    

    
	
	


	

        
        
		
	
		


}else{


	 echo 'email is empty';
}



}else{

		echo "error";
	}

}else{


  echo "uncheck";
}

  //  onclick="return confirm('Are you sure you want to proceed?');"
?>