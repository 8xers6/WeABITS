<?php 
	include '../server/serverhome.php';

	$email 	= $conn->real_escape_string($_POST['email']);
    $emailtoken = $conn->real_escape_string($_POST['emailtoken']);

    $new_pass	= $conn->real_escape_string($_POST['new_pass']);
    $con_pass	= $conn->real_escape_string($_POST['con_pass']);


	if(!empty($email)&& !empty($emailtoken)){
	
		
	
        $verify_query="SELECT email_token,email FROM tblbarangay WHERE  email_token='$emailtoken' AND email='$email' LIMIT 1";
        $verify_query_run=mysqli_query($conn,$verify_query);
      
      
        if(mysqli_num_rows($verify_query_run)>0){

                           // Validate password strength
                            $uppercase = preg_match('@[A-Z]@', $new_pass);
                            $lowercase = preg_match('@[a-z]@', $new_pass);
                            $number    = preg_match('@[0-9]@', $new_pass);
                            $specialchars = preg_match('@[^\w]@', $new_pass);


                            if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($new_pass) < 8) {
                                $_SESSION['message'] = '
                            
                                <b style="color:red; font-size:15px;">
                            
                                <ul>
                                Failed to change the password.</b>
                                <b style="color:black; font-size:11px;">

                            <li>password must be atleast 8 characters in length.</li>
                            <li>password must include atleast one upper case.</li>
                            <li>password must include atleast one number.</li>
                            <li>password must include atleast one special character.</li>
                            
                            </ul></b>';
                                $_SESSION['success'] = 'danger';

                            
                                header("Location: ../password_change.php?token=$emailtoken&email=$email");
                                exit(0);


                            

                            }else{


                                if($new_pass==$con_pass){



            
                                    $hash= hash("sha256",$new_pass);
                                   
                                    $token=md5(rand(1,1000));
                                      
                                        $query 		= "UPDATE tblbarangay SET `password`='$hash',email_token='$token' WHERE email='$email'";	
                                        $result 	= $conn->query($query);
                        
                                        if($result === true){
                                            
                                            $_SESSION['message'] = '<b>Your password has been changed successfully.</b>';
                                                $_SESSION['success'] = 'success';
                                            
                                                header("Location: ../notif_email");
                                                exit(0);
                        
                                        }else{
                                            $_SESSION['message'] = '<b>something went wrong.</b>';
                                            $_SESSION['success'] = 'danger';
                                        
                                            header("Location: ../notif_email");
                                            exit(0);
                                        }
                                    
                        
                                }else{
                                    $_SESSION['message'] = '<b style="color:red;">Password not match.</b>';
                                            $_SESSION['success'] = 'danger';
                                        
                                            header("Location: ../password_change.php?token=$emailtoken&email=$email");
                                            exit(0);

                                }



                            }

        }else{


                $_SESSION['message'] = '<b style="color:red;">Invalid Token</b>';
                $_SESSION['success'] = 'danger';
            
                header("Location: ../notif_email");
                exit(0);
        }
			


	}else{
		$_SESSION['message'] = 'Something went wrong!';
		$_SESSION['success'] = 'danger';
        header('location: ../notif_email');
	}



    

	$conn->close();

