<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	


    if($_POST['state']=='addprescription'){




    


        //$checkno 	= $conn->real_escape_string($_GET['id']);
        $reason 	= $conn->real_escape_string($_POST['reason']);
        $diagnosis 	= $conn->real_escape_string($_POST['diagnosis']);
    
        $instruction 	= $conn->real_escape_string($_POST['instruction']);
    
    
    
    
        $id 	= $conn->real_escape_string($_POST['id']);
    
        if($id != ''){

            if($_SESSION['role']=='administrator'){
                $username= $_SESSION['username'];
            }
            if($_SESSION['role']!='administrator'){
                $username=$_SESSION['clerkusername'];       
            }
            $query 		= "INSERT INTO `tblpatient`(`res_id`, `consultation_reason`, `diagnosis`, `instruction`, `username`) 
                                            VALUES ('$id','$reason','$diagnosis','$instruction','$username')";
            
            $result 	= $conn->query($query);
            
            if($result === true){
                $_SESSION['message'] = 'Prescription Added!';
                $_SESSION['success'] = 'success';
    
    
        header("Location: ../patientrecord.php?id=$id");
                
            }else{
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
    
        header("Location: ../patientrecord.php?id=$id");
            }
        }else{
    
            $_SESSION['message'] = 'Missing  ID!';
            $_SESSION['success'] = 'danger';
    
            header("Location: ../patientrecord.php?id=$id");
        }
        }



        if($_POST['state']=='editprescription'){





            $pno 	= $conn->real_escape_string($_POST['pno']);
            $reason 	= $conn->real_escape_string($_POST['reason']);
            $diagnosis 	= $conn->real_escape_string($_POST['diagnosis']);
        
            $instruction 	= $conn->real_escape_string($_POST['instruction']);
        
        
        
        
            $id 	= $conn->real_escape_string($_POST['id']);
        
            if($id != ''){
    
                if($_SESSION['role']=='administrator'){
                    $username= $_SESSION['username'];
                }
                if($_SESSION['role']!='administrator'){
                    $username=$_SESSION['clerkusername'];       
                }
                $query 		= "UPDATE `tblpatient` SET `consultation_reason`='$reason',`diagnosis`='$diagnosis',`instruction`='$instruction',`username`='$username'   WHERE  `patient_no`=$pno AND `res_id`=$id";
                
                $result 	= $conn->query($query);
                
                if($result === true){
                    $_SESSION['message'] = 'Prescription Updated!';
                    $_SESSION['success'] = 'success';
        
        
            header("Location: ../patientrecord.php?id=$id");
                    
                }else{
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
        
            header("Location: ../patientrecord.php?id=$id");
                }
            }else{
        
                $_SESSION['message'] = 'Missing  ID!';
                $_SESSION['success'] = 'danger';
        
                header("Location: ../patientrecord.php?id=$id");
            }
            }



    if($_GET['state']=='remove'){




    


	//$checkno 	= $conn->real_escape_string($_GET['id']);
    $pno 	= $conn->real_escape_string($_GET['pno']);

    $id 	= $conn->real_escape_string($_GET['id']);

	if($pno != ''){
		$query 		= "DELETE FROM `tblpatient` WHERE `patient_no`='$pno'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'Prescription has been removed!';
            $_SESSION['success'] = 'danger';


	header("Location: ../patientrecord.php?id=$id");
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';

	header("Location: ../patientrecord.php?id=$id");
        }
	}else{

		$_SESSION['message'] = 'Missing  ID!';
		$_SESSION['success'] = 'danger';

        header("Location: ../patientrecord.php?id=$id");
	}
    }
	$conn->close();

