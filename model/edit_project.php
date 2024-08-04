<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
  

    $barno=$_SESSION['bar_no'];
    

if(!empty($_POST['fundby'])){
  


    
	$fundby 	= $conn->real_escape_string($_POST['fundby']);
    $projno 	= $conn->real_escape_string($_POST['projno']);
   

    $projname 	= $conn->real_escape_string($_POST['projname']);
    $budget 	= $conn->real_escape_string($_POST['budget']);
    $approveddate 	= $conn->real_escape_string($_POST['approveddate']);
    $enddate 	= $conn->real_escape_string($_POST['enddate']);
    $projstat 	= $conn->real_escape_string($_POST['projstatus']);

    $projdes 	= $conn->real_escape_string($_POST['projdescription']);    


    if($fundby=='Sponsored'){
               

        if(!empty($_POST['sponsorname'])){

            $sponsorname	= $conn->real_escape_string($_POST['sponsorname']);

            $update  = "UPDATE `tblproject` SET `fund_by`='$fundby',`project_name`='$projname',`sponsor_name`='$sponsorname',`approved_date`='$approveddate',`end_date`='$enddate',`project_status`='$projstat',`budget`='$budget',`proj_description`='$projdes' WHERE proj_no='$projno'";
            $result  = $conn->query($update);
    
            if($result === true){
                $_SESSION['message'] = 'Project Updated successfully!';
                $_SESSION['success'] = 'success';
                
                
                	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
               

 
    
            }else{
                $_SESSION['message'] = 'Error';
                $_SESSION['success'] = 'danger';
             
            }






        }else{

            echo 'empty';

        }

       

    }


    if($fundby=='Barangay'){



        $remaining	= $conn->real_escape_string($_POST['remainingfund']);
          if($budget>$remaining){

            $_SESSION['message'] = 'Budget should be less than or equal to remaining funds';
            $_SESSION['success'] = 'danger';
          }else{


          
            $update  = "UPDATE `tblproject` SET `fund_by`='$fundby',`project_name`='$projname',`sponsor_name`='Funded by Barangay',`approved_date`='$approveddate',`end_date`='$enddate',`project_status`='$projstat',`budget`='$budget',`proj_description`='$projdes' WHERE proj_no='$projno'";
$result  = $conn->query($update);

if($result === true){
$_SESSION['message'] = 'Project Updated successfully!';
$_SESSION['success'] = 'success';


	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }




}else{
$_SESSION['message'] = 'Error';
$_SESSION['success'] = 'danger';

}

     
    }


}
}else{


    $fundby 	= $conn->real_escape_string($_POST['fundby']);
    $projno 	= $conn->real_escape_string($_POST['projno']);
   

    $projname 	= $conn->real_escape_string($_POST['projname']);
    $budget 	= $conn->real_escape_string($_POST['budget']);
    $approveddate 	= $conn->real_escape_string($_POST['approveddate']);
    $enddate 	= $conn->real_escape_string($_POST['enddate']);
    $projstat 	= $conn->real_escape_string($_POST['projstatus']);

    $projdes 	= $conn->real_escape_string($_POST['projdescription']); 


    $currfundby 	= $conn->real_escape_string($_POST['currentfundby']);

    if($currfundby=='Sponsored'){
               

   

            $sponsorname	= $conn->real_escape_string($_POST['sponsorname']);

            $update  = "UPDATE `tblproject` SET `project_name`='$projname',`approved_date`='$approveddate',`end_date`='$enddate',`project_status`='$projstat',`budget`='$budget',`proj_description`='$projdes' WHERE proj_no='$projno'";
            $result  = $conn->query($update);
    
            if($result === true){
                $_SESSION['message'] = 'Project Updated successfully!';
                $_SESSION['success'] = 'success';
                
                
                
                	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
               

 
    
            }else{
                $_SESSION['message'] = 'Error';
                $_SESSION['success'] = 'danger';
             
            }






     

       

    }


    if($currfundby=='Barangay'){



        $remaining	= $conn->real_escape_string($_POST['remainingfund']);
          if($budget>$remaining){

            $_SESSION['message'] = 'Budget should be less than or equal to remaining funds';
            $_SESSION['success'] = 'danger';
          }else{


          
            $update  = "UPDATE `tblproject` SET `project_name`='$projname',`sponsor_name`='Funded by Barangay',`approved_date`='$approveddate',`end_date`='$enddate',`project_status`='$projstat',`budget`='$budget',`proj_description`='$projdes' WHERE proj_no='$projno'";
$result  = $conn->query($update);

if($result === true){
$_SESSION['message'] = 'Project Updated successfully!';
$_SESSION['success'] = 'success';



	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Updated Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }




}else{
$_SESSION['message'] = 'Error';
$_SESSION['success'] = 'danger';

}

     
    }


}
    

 




}

     
	

    //header("Location: ../barangayfunds.php");

	$conn->close();

    