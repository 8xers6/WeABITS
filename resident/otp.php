<?php
	include('server/serverhome.php');



if(!empty($_POST['email'])){

    $email=$_POST['email'];


   

//eo8jpilg

      $sql1="SELECT * FROM `tbl_residents` WHERE `email`='$email'";
    $res1=$conn->query($sql1);

    if (mysqli_num_rows($res1) > 0) {
      



             echo "emailistaken";
      

    }else{


      $sql1="SELECT * FROM `tblhousehold` WHERE `email`='$email'";
      $res1=$conn->query($sql1);
  
      if (mysqli_num_rows($res1) > 0) {
        
  
  
  
               echo "emailistaken";
        
  
      }else{
          
          
          
              $sql3="SELECT * FROM `tblregistration` WHERE `email`='$email'";
        $result3=$conn->query($sql3);
        
        if (mysqli_num_rows($result3) > 0) {
            
             echo "emailistaken";
            
            
        }else{
            
            
    $otp_random=mt_rand(111111,999999);

                                        require "model/Mail/phpmailer/PHPMailerAutoload.php";

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
                                                          <h1 style="margin:1 0 20px 0;font-family:Arial,sans-serif; color:white;">Email Address Verification</h1>
                                
                                        
                                              </td>
                                              </tr>
                                              <tr>
                                              <td style="padding:36px 30px 42px 30px;">
                                                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                  <td style="padding:0 0 36px 0;color:#153643;">
                                                  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear User,</h1>
                                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight:bolder;">Your OTP Code Verification is :</p>
                                                  <h1 style=" font-size:40px; text-align: center; letter-spacing: 30px; border:solid black 1px; padding:40px; border-radius: 10px; box-shadow: gray 2px 2px;">'.$otp_random.'</h1>
                                                
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
                                  
                                    
                                          echo "notsent";
                                  
                                        }else{

                                         
                                          $_SESSION['otp']=$otp_random;

                                          $_SESSION['s_email']=$email;
                                       
                            
                                  
                                      
                                        }
            
            
        }


      





    



                                      }

                                      }


                                      
                                     
                                  
}else{

echo "Error";
}






?>