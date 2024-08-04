<?php 
	include('../server/server.php');

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    
	
	



	
	

		if(!empty($_GET['h_no'])){

			
			$h_no		= $conn->real_escape_string($_GET['h_no']);
				$email		= $conn->real_escape_string($_GET['email']);

				$query="DELETE tbl_residents,tblhousehold FROM `tblhousehold` LEFT JOIN tbl_residents ON tbl_residents.h_no=tblhousehold.h_no WHERE tblhousehold.h_no=$h_no;";

			    
				
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
								   
								   Your registration has been cancelled due to incorrect information you provided with us.
								  
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
				  
		
				  
						}else{

						$_SESSION['message'] = 'Decline Success';
					$_SESSION['success'] = 'danger';
					
					
					 header("Location: ../verify.php");
					  
						}
        
				    
				    

				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					   $sql3="DELETE FROM `tblregistration` WHERE `email`='$email'";
    $result1=$conn->query($sql3);
    
    if ($result1==true) {
        
        
        	
        



}
					
					
										$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Denied Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Denied Resident')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

                   
				}

			}else{

			$_SESSION['message'] = 'House No is empty';
			$_SESSION['success'] = 'danger';
            header("Location: ../verify.php");
		}
	
  

	$conn->close();
?>
