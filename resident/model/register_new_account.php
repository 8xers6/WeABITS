<?php 
	include('../server/serverhome.php');


	  $fname	= $conn->real_escape_string($_POST['fname']);
    $mname	= $conn->real_escape_string($_POST['mname']);
    $lname	= $conn->real_escape_string($_POST['lname']);

    $email	= $conn->real_escape_string($_POST['email']);

    $username	= $conn->real_escape_string($_POST['username']);
    //$password	= hash("sha256",$conn->real_escape_string($_POST['password']));
    //$cpassword	= hash("sha256",$conn->real_escape_string($_POST['cpassword']));
    $password	= $conn->real_escape_string($_POST['password']);
    $cpassword	= $conn->real_escape_string($_POST['cpassword']);


    $sql1="SELECT * from tbl_residents where email='$email';";
    $res1=$conn->query($sql1);

    if (mysqli_num_rows($res1) > 0) {
      



    
      
      if($email==isset($row['email']))
      {
                $_SESSION['message'] = '<spam style="color:red;">Email is already taken!</spam>';
                $_SESSION['success'] = 'danger';
               
                header("Location: ../register.php");
      }
    
    
      }else{



        if(strlen($username) < 5) {


          $_SESSION['message'] = '<spam style="color:red;">Username must be at 5 characters in length!</spam>';
          $_SESSION['success'] = 'danger';
        
          header("Location: ../register.php");
          
        }else{

                $sql="SELECT * from tbl_residents where username='$username';";
                $res=$conn->query($sql);

                if (mysqli_num_rows($res) > 0) {
                  
                  $row = mysqli_fetch_assoc($res);


    
      
                  if($username==isset($row['username']))
                  {
                    $_SESSION['message'] = '<spam style="color:red;">Username is already taken!</spam>';
                            $_SESSION['success'] = 'danger';
                          
                            header("Location: ../register.php");
                  }

                
                
                
                  }else{
  
                            //do your insert code here or do something (run your code)
                                  
                            // Validate password strength
                            $uppercase = preg_match('@[A-Z]@', $password);
                            $lowercase = preg_match('@[a-z]@', $password);
                            $number    = preg_match('@[0-9]@', $password);
                            $specialchars = preg_match('@[^\w]@', $password);


                            if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
                                $_SESSION['message'] = '
                              
                                
                              
                                <ul style="font-size:13px; color:red;">
                                Register Failed!
                              <li>The password must be at least 8 characters in length.</li>
                              <li>The password must include at least one upper case.</li>
                              <li>The password must include at least one number.</li>
                              <li> The password must include at least one special character.</li>
                            
                            </ul>';
                                $_SESSION['success'] = 'danger';
                                header("Location: ../register.php");

                       }else{



                                  if($password==$cpassword){
                                      

                                        
                                      if(!empty($fname) &&!empty($mname)&&!empty($lname)&&!empty($email)&&!empty($username)&& !empty($password)){
                                       
                                        $email_token=md5(rand(1,1000));

                                        $otp_random=rand(1000, 999999);

                                        require "Mail/phpmailer/PHPMailerAutoload.php";

                                        $mail = new PHPMailer;
                                          try{


                                          
                                        $mail->isSMTP();
                                        $mail->Host='smtp.hostinger.com';
                                        $mail->Port=587;
                                        $mail->SMTPAuth=true;
                                        $mail->SMTPSecure='tls';
                                  
                                        $mail->Username='weabits@weabits.com';
                                        $mail->Password='Nopainnogain2899$';
                                  
                                        $mail->setFrom('weabits@weabits.com', 'Account Verification');
                                        $mail->addAddress($email);
                                  
                                        $mail->isHTML(true);
                                        $mail->Subject="Email Verification by WeABITS";
                                        $mail->Body="<p>Dear $lname,</p>
                                        <p>Your OTP Code is: <b>$otp_random</b></p>
                                       <br>
                                    
                                  <br>
                                        <p>With regards,</p>
                                        <b>Team WeABITS</b><br>
                                         www.weabits.com";
                                       
                                  
                                        if(!$mail->send()){
                                  
                                          $_SESSION['message'] = '<spam style="color:red;">Invalid Email!</spam>';
                                          $_SESSION['success'] = 'danger';
                                  
                                  
                                          header("Location: ../register");
                                  
                                  
                                        }else{

                                         
                                          $_SESSION['otp']=$otp_random;

                                          $_SESSION['s_fname']=$fname;
                                          $_SESSION['s_mname']=$mname;
                                          $_SESSION['s_lname']=$lname;

                                          $_SESSION['s_email']=$email;
                                          $_SESSION['s_user']=$username;
                                          $_SESSION['s_password']=$password;


                                          $_SESSION['message'] = 'check your email inbox to verify email address.</b></a>';
                                          $_SESSION['success'] = 'success';
                                        
                                          header("Location: ../otp_verification.php");
                                       
                                  
                                  
                                      
                                        }
                                      }catch (Exception $e) {
                                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

                                        $_SESSION['message'] = '<b style="color:red;">Emai invalid</b>'.$mail->ErrorInfo.'';
                                        $_SESSION['success'] = 'danger';
                                      
                                        header("Location: ../register.php");
                                    }
                                  
                                  
                                      }else{
                                  
                                          $_SESSION['messages'] = 'Please fill up the form completely!';
                                          $_SESSION['success'] = 'danger';
                                  
                                        
                                  
                                  
                                        
                                      }


                                  

                                  }else{

                                      $_SESSION['message'] = '<spam style="color:red;">Password not Match!</spam>';
                                      $_SESSION['success'] = 'danger';


                                      header("Location: ../register");

                                  }


                                

                      }


      
      

                 }     

        

        }
   
    }



   




   

	$conn->close();


  ?>

    

	

   