<?php 




	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
  
    

	
	

      
          if(!empty($_POST['status']) && !empty($_POST['regid']) &&  !empty($_POST['email'])){
		
			$barno=$_SESSION['bar_no'];
		
			$email 	= $conn->real_escape_string($_POST['email']);
			$regid 	= $conn->real_escape_string($_POST['regid']);
			$status 		   = $conn->real_escape_string($_POST['status']);
		



  	function password_generate($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $chars);
}
  $token=password_generate(8);
        
			

		
            if(!empty($regid)){

              if($status=='norecord'){
                    
                    
            $datenow=date("Y-m-d h:i:s");
       $expired = date('Y-m-d h:i:s', strtotime($datenow.' + 1 days'));
                  
                  $query="UPDATE `tblregistration` SET `status`='$status',`email_token`='$token',`token_expired`='$expired'  WHERE `reg_id`=$regid;";
			    
				
				if($conn->query($query) === true){

                    
                               
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
					$mail->addAddress($email);
			  
					$mail->isHTML(true);
					$mail->Subject="No Existing Record";
						$mail->Body='<!DOCTYPE html>
						<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
						<head>
						  <meta charset="UTF-8">
						  <meta name="viewport" content="width=device-width,initial-scale=1">
						  <meta name="x-apple-disable-message-reformatting">
						  <title></title>
						  <!--[if mso]>
						  <noscript>
						  <xml>
							<o:OfficeDocumentSettings>
							<o:PixelsPerInch>96</o:PixelsPerInch>
							</o:OfficeDocumentSettings>
						  </xml>
						  </noscript>
						  <![endif]-->
						  <style>
						  table, td, div, h1, p {font-family: Arial, sans-serif;}
						  </style>
						</head>
						<body style="margin:1;padding:0; ">
						  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff; ">
						  <tr>
							<td align="center" style="padding:0;">
							<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
							  <tr>
							  <td align="center" style="padding:10px 0 30px 0;background:#0275d8;">
										  <h1 style="margin:1 0 20px 0;font-family:Arial,sans-serif; color:white;">No Existing Record in Barangay!</h1>
				
						
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:36px 30px 42px 30px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
								  <td style="padding:0 0 36px 0;color:#153643;">
								  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear User,</h1>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder; text-align:justify;">You may use this code to gain access to our 2nd registration method</p>
								   
									  <h1 style=" font-size:20px;   border:solid black 1px; padding:40px; border-radius: 10px; box-shadow: gray 2px 2px;">Code: '.$token.'</h1>
									  
									   <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder; text-align:justify;">This code can only be used once and is valid for 24 hours.</p>
									   
									   <a href="https://weabits.com/registration">https://weabits.com/registration</a>
									  
								  </td>
								</tr>
				
								<tr>
								  <td style="padding:0;color:#153643;">
				
				
									  <p style="font-size:16px;line-height:1px;font-family:Arial,sans-serif; ">With Regards,</p>
								  
								  <p style="font-size:16px;font-family:Arial,sans-serif; ">Team WeABITS</p>
								
								  </td>
								</tr>
								
								</table>
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:30px;background:#0275d8;; border:solid white 1px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
								<tr>
								  <td style="padding:0;width:100%; " align="left">
								  <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:white; font-weight: bolder; ">
									 2022 &#169; Web Application Barangay Information and Transaction System
								  </p>
								  </td>
								  <td style="padding:0;width:50%;" align="right">
								  <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
									<tr>
									<td style="padding:0 0 0 10px;width:38px;">
									
									</td>
									<td style="padding:0 0 0 10px;width:38px;">
									
									</td>
									</tr>
								  </table>
								  </td>
								</tr>
								</table>
							  </td>
							  </tr>
							</table>
							</td>
						  </tr>
						  </table>
						</body>
						</html>';
					   
				  
						if(!$mail->send()){
				  
							$_SESSION['message'] = 'error';
							$_SESSION['success'] = 'danger';

							
				  
						}else{

						 
					    $_SESSION['message'] = 'Registration status updated to No Record !';
						$_SESSION['success'] = 'success';
						
						
						echo 'success';
					  
						}





}
                  
                  
              }
              
              
              if($status=='cancel'){
                  
                  
                      $query="DELETE FROM `tblregistration` WHERE `reg_id`=$regid;";
			    
				
				if($conn->query($query) === true){

                    
                               
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
					$mail->addAddress($email);
			  
					$mail->isHTML(true);
					$mail->Subject="Registration has been cancelled";
						$mail->Body='<!DOCTYPE html>
						<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
						<head>
						  <meta charset="UTF-8">
						  <meta name="viewport" content="width=device-width,initial-scale=1">
						  <meta name="x-apple-disable-message-reformatting">
						  <title></title>
						  <!--[if mso]>
						  <noscript>
						  <xml>
							<o:OfficeDocumentSettings>
							<o:PixelsPerInch>96</o:PixelsPerInch>
							</o:OfficeDocumentSettings>
						  </xml>
						  </noscript>
						  <![endif]-->
						  <style>
						  table, td, div, h1, p {font-family: Arial, sans-serif;}
						  </style>
						</head>
						<body style="margin:1;padding:0; ">
						  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff; ">
						  <tr>
							<td align="center" style="padding:0;">
							<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
							  <tr>
							  <td align="center" style="padding:10px 0 30px 0;background:#0275d8;">
										  <h1 style="margin:1 0 20px 0;font-family:Arial,sans-serif; color:white;">Registration has been cancelled</h1>
				
						
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:36px 30px 42px 30px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
								  <td style="padding:0 0 36px 0;color:#153643;">
								  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear User,</h1>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder; text-align:justify;">
								   
								   Your registration has been cancelled due to invalid supporting documents.
								  
								  </p>
								   
									
									  
								  </td>
								</tr>
				
								<tr>
								  <td style="padding:0;color:#153643;">
				
				
									  <p style="font-size:16px;line-height:1px;font-family:Arial,sans-serif; ">With Regards,</p>
								  
								  <p style="font-size:16px;font-family:Arial,sans-serif; ">Team WeABITS</p>
								
								  </td>
								</tr>
								
								</table>
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:30px;background:#0275d8;; border:solid white 1px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
								<tr>
								  <td style="padding:0;width:100%; " align="left">
								  <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:white; font-weight: bolder; ">
									 2022 &#169; Web Application Barangay Information and Transaction System
								  </p>
								  </td>
								  <td style="padding:0;width:50%;" align="right">
								  <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
									<tr>
									<td style="padding:0 0 0 10px;width:38px;">
									
									</td>
									<td style="padding:0 0 0 10px;width:38px;">
									
									</td>
									</tr>
								  </table>
								  </td>
								</tr>
								</table>
							  </td>
							  </tr>
							</table>
							</td>
						  </tr>
						  </table>
						</body>
						</html>';
					   
				  
						if(!$mail->send()){
				  
							$_SESSION['message'] = 'error';
							$_SESSION['success'] = 'danger';

							
				  
						}else{

						 
					    $_SESSION['message'] = 'Registration has been cancelled !';
						$_SESSION['success'] = 'danger';
						
						
						echo 'success';
					  
						}





}
                  
              }





                    
                    

			
		

			}else{

			$_SESSION['message'] = 'id not found';
			$_SESSION['success'] = 'danger';
		}


		

		
		

	}else{

		echo 'isempty';
	}
	

	$conn->close();


?>
