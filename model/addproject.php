<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
  

    $barno=$_SESSION['bar_no'];
    


    
	$fundby 	= $conn->real_escape_string($_POST['fundby']);
   

    $projname 	= $conn->real_escape_string($_POST['projname']);
    $budget 	= $conn->real_escape_string($_POST['budget']);
    $approveddate 	= $conn->real_escape_string($_POST['approveddate']);
    $enddate 	= $conn->real_escape_string($_POST['enddate']);
    $projstat 	= $conn->real_escape_string($_POST['projstatus']);

    $projdes 	= $conn->real_escape_string($_POST['projdescription']);    


    if($fundby=='Sponsored'){
               

        if(!empty($_POST['sponsorname'])){

            $sponsorname	= $conn->real_escape_string($_POST['sponsorname']);

            $insert  = "INSERT INTO `tblproject`(`bar_no`, `fund_by`, `project_name`, `sponsor_name`, `approved_date`, `end_date`, `project_status`, `budget`, `proj_description`) VALUES 
                                                ('$barno','$fundby','$projname','$sponsorname','$approveddate','$enddate','$projstat','$budget','$projdes')";
            $result  = $conn->query($insert);
    
            if($result === true){
                $_SESSION['message'] = 'Project added!';
                $_SESSION['success'] = 'success';
               
  
  
  	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Project')";
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


          
            $insert  = "INSERT INTO `tblproject`(`bar_no`, `fund_by`, `project_name`, `sponsor_name`, `approved_date`, `end_date`, `project_status`, `budget`, `proj_description`) VALUES 
            ('$barno','$fundby','$projname','Funded by Barangay','$approveddate','$enddate','$projstat','$budget','$projdes')";
$result  = $conn->query($insert);

if($result === true){
$_SESSION['message'] = 'Project added!';
$_SESSION['success'] = 'success';


	$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Project')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Project')";
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


     
	

    //header("Location: ../barangayfunds.php");

	$conn->close();

    