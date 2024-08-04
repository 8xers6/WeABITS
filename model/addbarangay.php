<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barangayname 	= $conn->real_escape_string($_POST['barangayname']);

    $cityid 	= $conn->real_escape_string($_POST['city']);
     
     
     


	$email 	=  $_SESSION['s_email'];
	

	
	
$random=mt_rand(1111,9999);
   $username=''.$barangayname.''.$random.'';
   
   
   	function password_generate($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $chars);
}
  $password=password_generate(8);

            $usertrim= str_replace(' ', '',$username);
            $userlcase=strtolower($usertrim);
    $hash= hash("sha256",$password);
    if(!empty($barangayname) && !empty($cityid)&&!empty($password)&& !empty($email)){

       

        $insert  = "INSERT INTO `tblbarangay`(`username`,`barangayname`, `email`, `password`, `city_id`) VALUES ('$userlcase','$barangayname','$email','$hash',$cityid)";
        $result  = $conn->query($insert);

        if($result === true){

            $query1 = "SELECT * FROM `tblbarangay` WHERE  `email`='$email'";
            $result2  = $conn->query($query1);
    
            $row = $result2->fetch_assoc();

	if($row){
	
	
		$bar_no= $row['bar_no'];
	} 

    $insert  = "INSERT INTO `tblfunds`(`bar_no`) VALUES ('$bar_no')";
        $result  = $conn->query($insert);
        
        
          $insert1  = "INSERT INTO `tblcertificates`(`bar_no`, `certificate`, `details`, `amount`) VALUES ('$bar_no','Barangay Clearance','',0)";
        $result1  = $conn->query($insert1);
        
        $insert2  = "INSERT INTO `tblcertificates`(`bar_no`, `certificate`, `details`, `amount`) VALUES ('$bar_no','Building Clearance','',0)";
        $result2  = $conn->query($insert2);
        
        $insert3  = "INSERT INTO `tblcertificates`(`bar_no`, `certificate`, `details`, `amount`) VALUES ('$bar_no','Business Clearance','',0)";
        $result3 = $conn->query($insert3);
        
        $insert4  = "INSERT INTO `tblcertificates`(`bar_no`, `certificate`, `details`, `amount`) VALUES ('$bar_no','Certificate of Indigency','',0)";
        $result4  = $conn->query($insert4);
        
   
        
        
        if($result === true){
            $_SESSION['message'] = 'Barangay added!';
            $_SESSION['success'] = 'success';



            if(!is_dir("../assets/uploads/".$userlcase."/")){
                mkdir("../assets/uploads/".$userlcase."/", 07777);
                mkdir("../assets/uploads/".$userlcase."/official", 07777);
                mkdir("../assets/uploads/".$userlcase."/registration", 07777);
                mkdir("../assets/uploads/".$userlcase."/requested", 07777);
                mkdir("../assets/uploads/".$userlcase."/barangayinfo", 07777);
                mkdir("../assets/uploads/".$userlcase."/services", 07777);
                mkdir("../assets/uploads/".$userlcase."/announcement", 07777);
                mkdir("../assets/uploads/".$userlcase."/avatar", 07777);
                mkdir("../assets/uploads/".$userlcase."/resident", 07777);
                mkdir("../assets/uploads/".$userlcase."/cedula", 07777);
                mkdir("../assets/uploads/".$userlcase."/blotter", 07777);
                mkdir("../assets/uploads/".$userlcase."/equipment", 07777);
                 mkdir("../assets/uploads/".$userlcase."/validation", 07777);
    
            }
            
            
            
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
					$mail->Subject="Barangay Administrator Account";
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
										  <h1 style="margin:1 0 20px 0;font-family:Arial,sans-serif; color:white;">Your Account Has been Made!</h1>
				
						
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:36px 30px 42px 30px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
								  <td style="padding:0 0 36px 0;color:#153643;">
								  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear User,</h1>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder;">Your Username and Password  is :</p>
								  <h1 style=" font-size:20px;  border:solid black 1px; padding:40px; border-radius: 10px; box-shadow: gray 2px 2px;">Username: '.$userlcase.'</h1>

								  <h1 style=" font-size:20px;   border:solid black 1px; padding:40px; border-radius: 10px; box-shadow: gray 2px 2px;">Password: '.$password.'</h1>
								
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

						 
					    $_SESSION['message'] = 'Barangay added';
						$_SESSION['success'] = 'success';
							
						echo 'success';
					  
						}

            

        }




       

        }else{
            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    //header("Location: ../addbarangay.php");

	$conn->close();



    ?>