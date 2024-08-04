<?php include 'serverapi/server_api.php'  ?>
<?php 






	if(!empty($_POST['email'])){
	    	$email 	= $conn->real_escape_string($_POST['email']);
		$query 		= "SELECT * FROM tbl_residents WHERE email = '$email' and verify_status='verified'";
		
		$result 	= $conn->query($query);
		
		if($result->num_rows){


		


		


				$token=md5(rand(1,1000));

				$update_query="UPDATE tbl_residents set email_token='$token' WHERE email='$email' LIMIT 1";
				$update_query_run=mysqli_query($conn,$update_query);
	
				if($update_query_run){
	
					
	
	
					$verify_query="SELECT lastname,email,email_token FROM tbl_residents WHERE email='$email' LIMIT 1";
					$verify_query_run=mysqli_query($conn,$verify_query);
					
		
					
		
					if(mysqli_num_rows($verify_query_run)>0){
		
						$rows=mysqli_fetch_array($verify_query_run);
		
		
							$r_email=$rows['email'];
							$lname=$rows['lastname'];
							$email_token=$rows['email_token'];
		
						
							
							
							
							
							
							
							
							require "Mail/phpmailer/PHPMailerAutoload.php";
		$mail = new PHPMailer;
  
		$mail->isSMTP();
		$mail->Host='smtp.hostinger.com';
		$mail->Port=587;
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='tls';
  
		$mail->Username='weabits@weabits.com';
		$mail->Password='Nopainnogain2899$';
  
		$mail->setFrom('weabits@weabits.com', 'WeABITS');
		$mail->addAddress($r_email);
  
		$mail->isHTML(true);
		$mail->Subject="Password Reset link";
		$mail->Body="<p>Dear $lname,</p>
		<p>You requested a new password for your account '.$r_email.'</p>
	   <br>
       <p>Continue resetting your password by clicking reset button below:</p><br>
		<a style='background:green; text-decoration:none; position:relative; left:300px; width:300px; padding:10px; text-align:center;  color:white; font-weight:bolder; border-radius:10px; font-family:arial; font-size:18px;' href='https://weabits.com/resident/password_change?token=$email_token&email=$r_email'>Reset Password</a>
  <br><br>
  <p>if you did not request for a new password, please reply to this email immediately.</p><br>

		<p>With regards,</p>
		<b>Team WeABITS</b><br>
		 www.weabits.com";
  
  
	
		
			if(!$mail->send()){
				  
						echo json_encode(array("success"=>false));

							
				  
						}else{
						    
						     echo json_encode(array("success"=>true));
						    
						}
		
				
                
		
		
		
		
		
		
					}
	
					
		
				  }
			
	
				


			



		
			

		}else{
		  echo json_encode(array("emailFound"=>false));
		}

	}else{
	    
	      echo json_encode(array("emailFound"=>false));
	    
	}




    

	$conn->close();

