<?php


include '../server/server.php';

if(!isset($_SESSION['username'])){
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}


$barno=$_SESSION['bar_no'];


$query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id   WHERE bar_no=$barno";
$result= $conn->query($query);
$row1 = $result->fetch_assoc();

if($row1){

    $barangayname 		= $row1['barangayname'];
    $city 		= $row1['city'];

    $phone 		= $row1['phonenumber'];
    $email= $row1['email'];
    $brgylogo= $row1['brgylogo'];
    $citylogo= $row1['citylogo'];
  
    $mission= $row1['mission'];
    $vision= $row1['vision'];
    $bar_no= $row1['bar_no'];
}

 

if(!empty($_POST['resid'])&& !empty($_POST['datevisit']) && !empty($_POST['timevisit'])){




	$resid 		   = $conn->real_escape_string($_POST['resid']);
    $datevisit 		   = $conn->real_escape_string($_POST['datevisit']);
    $timevisit 		   = $conn->real_escape_string($_POST['timevisit']);


  
    
    $visit_date = date('F j, Y', strtotime($datevisit)); 

    $visit_time = date('h:i A', strtotime($timevisit));  




$query="SELECT * FROM tbl_residents WHERE `res_id`=$resid;";

$result= $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
	
		
        $email= $row['email'];
        $lname= $row['lastname'];
       
	}





$query1="UPDATE `tbl_residents` SET `visit_date`='$datevisit',`visit_time`='$timevisit' WHERE `res_id`=$resid;";


if($conn->query($query1) === true){


   






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
					$mail->Subject="Email Verification by WeABITS";
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
										  <h1 style="margin:1 0 20px 0;font-family:Arial,sans-serif; color:white;">Visit Schedule</h1>
				
						
							  </td>
							  </tr>
							  <tr>
							  <td style="padding:36px 30px 42px 30px;">
								<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
								  <td style="padding:0 0 36px 0;color:#153643;">
								  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear '.$lname.',</h1>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder;">The Barangay Worker Will visit you at '.$visit_date.' in '.$visit_time.'</p>
								  <p style="margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder;"> Terms and Condition </p>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder; ">* Failure to meet the Barangay Worker will not verify you.</p>
								  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder;">* Failure to verify will need you to come to barangay to verify it yourself.</p>
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
									 <script type="text/javascript">document.write( new Date().getFullYear() );</script> &#169; Web Application Barangay Information and Transaction System
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
				  
							$_SESSION['message'] = 'error ';
							$_SESSION['success'] = 'danger';
                            
                            echo 'success';
							
				  
						}else{

						 
					    $_SESSION['message'] = 'Schedule has been sent';
						$_SESSION['success'] = 'success';
							
						echo 'success';
					  
						}

                    }

                        


                    }

?>