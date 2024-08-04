<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
 
	
    $cityid 	= $conn->real_escape_string($_POST['city']);
    $password 	= $conn->real_escape_string($_POST['passwords']);

    $barno=$conn->real_escape_string($_POST['barno']);
	$email 	= $conn->real_escape_string($_POST['email']);
    $uname 	= $conn->real_escape_string($_POST['uname']);
    $hash= hash("sha256",$password);
    
    
    
 
    
    
      if( !empty($barno) && !empty($cityid)){
      

       
      
       

        $insert  = "UPDATE `tblbarangay` SET  `city_id`='$cityid' WHERE `bar_no`=$barno";
        $result  = $conn->query($insert);

        if($result === true){


            if(!is_dir("../assets/uploads/".$uname."/equipment")){
           
                mkdir("../assets/uploads/".$uname."/equipment", 07777);
               
    
            }
            $_SESSION['message'] = 'Barangay Updated!';
            $_SESSION['success'] = 'success';



        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }
    
    
    
    if(!empty($barno)&&!empty($password)){
  
          if(!is_dir("../assets/uploads/".$uname."/equipment")){
           
            mkdir("../assets/uploads/".$uname."/equipment", 07777);
           
          }

        $insert  = "UPDATE `tblbarangay` SET  `email`='$email',`password`='$hash'  WHERE `bar_no`=$barno";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Barangay Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }
    }else{
        
           $_SESSION['message'] = 'Barangay Updatedk';
            $_SESSION['success'] = 'success';
    }

    header("Location: ../addbarangay.php");

	$conn->close();