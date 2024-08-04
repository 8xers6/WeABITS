<?php 
	include '../server/serverhome.php';

	$email 	= $conn->real_escape_string($_POST['email']);



	if($email != ''){
		$query 		= "SELECT * FROM tblbarangay WHERE email = '$email';";
		
		$result 	= $conn->query($query);
		
		if($result->num_rows){


		


		


				$token=md5(rand(1,1000));

				$update_query="UPDATE tblbarangay set email_token='$token' WHERE email='$email' LIMIT 1";
				$update_query_run=mysqli_query($conn,$update_query);
	
				if($update_query_run){
	
					
	
	
					$verify_query="SELECT * FROM tblbarangay WHERE email='$email' LIMIT 1";
					$verify_query_run=mysqli_query($conn,$verify_query);
					
		
					if(mysqli_num_rows($verify_query_run)>0){
		
						$rows=mysqli_fetch_array($verify_query_run);
		
		
							$r_email=$rows['email'];
				            $barangayname=$rows['barangayname'];
							$email_token=$rows['email_token'];
		
							sendmail_verify("$r_email","$email_token","$barangayname");
		
					$_SESSION['message'] = '<b >We e-mailed you  a password reset link.</b>';
					$_SESSION['success'] = 'success';
                
		
		    header('location: ../forgotpassword');
		
		
		
					}
	
					
		
				  }else{


                    $_SESSION['message'] = 'Something Went wrong.';
                    $_SESSION['success'] = 'danger';
               
                  }
			
	
				


			



		
			

		}else{
			$_SESSION['message'] = '<b style="color:red;">No Account found.</b>';
			$_SESSION['success'] = 'danger';
            header('location: ../forgotpassword');
		}

	}else{
		$_SESSION['message'] = 'Email cannot be empty!';
		$_SESSION['success'] = 'danger';
		    header('location: ../forgotpassword');

	}



	function sendmail_verify($r_email,$email_token,$barangayname){



		require "Mail/phpmailer/PHPMailerAutoload.php";
		$mail = new PHPMailer;
  
		$mail->isSMTP();
		$mail->Host='smtp.hostinger.com';
		$mail->Port=587;
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='tls';
  
		$mail->Username='weabits@weabits.com';
		$mail->Password='Nopainnogain2899$';
  
		$mail->setFrom('weabits@weabits.com', 'Barangay Password Change');
		$mail->addAddress($r_email);
  
		$mail->isHTML(true);
		$mail->Subject="WeABITS";
		$mail->Body="<p>To: $barangayname ,</p>
		<p>You requested a new password for your account $r_email</p>
	   <br>
       <p>Continue resetting your password by clicking reset button below:</p><br>
		<a style='background:green; text-decoration:none; position:relative; left:300px; width:300px; padding:10px; text-align:center;  color:white; font-weight:bolder; border-radius:10px; font-family:arial; font-size:18px;' href='https://weabits.com/password_change?token=$email_token&email=$r_email'>Reset Password</a>
  <br><br>
  <p>if you did not request for a new password, please reply to this email immediately.</p><br>

		<p>With regards,</p>
		<b>Team WeABITS</b><br>
		 www.weabits.com";
  
  
		$mail->send();
  
  
	
  
  
  
  
  }

    

	 


