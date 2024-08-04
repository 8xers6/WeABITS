<?php

include('../server/serverhome.php');

$num1	= $conn->real_escape_string($_POST['num1']);
$num2	= $conn->real_escape_string($_POST['num2']);
$num3	= $conn->real_escape_string($_POST['num3']);
$num4	= $conn->real_escape_string($_POST['num4']);
$num5	= $conn->real_escape_string($_POST['num5']);
$num6	= $conn->real_escape_string($_POST['num6']);



$otprandom=rand(1000, 999999);



$fname=$_SESSION['s_fname'];
$mname=$_SESSION['s_mname'];
$lname=$_SESSION['s_lname'];
$email=$_SESSION['s_email'];
$username=$_SESSION['s_user'];
$password=$_SESSION['s_password'];



$email_otp=''.$num1.''.$num2.''.$num3.''.$num4.''.$num5.''.$num6.'';
$system_otp=$_SESSION['otp'];

if($email_otp!=$system_otp){

    $_SESSION['message'] = '<spam style="color:black;">OTP InCORRECT</spam>';
    $_SESSION['success'] = 'danger';
    
    header("Location: ../otp_verification.php");

}else{

     $hash= hash("sha256",$password);


    $insert  = "INSERT INTO tbl_residents (`firstname`, `middlename`,`lastname`,`email`,`username`,`password`) VALUES ('$fname','$mname','$lname','$email','$username','$hash')";
    $result  = $conn->query($insert);

    if($result === true){


    
        $_SESSION['message'] = '<b style="color:black;">Registered Successfully.</b>';
        $_SESSION['success'] = 'success';
        unset($_SESSION['s_fname']);
        unset($_SESSION['s_mname']);
        unset($_SESSION['s_lname']);

        unset($_SESSION['s_email']);
        unset($_SESSION['s_user']);
        unset($_SESSION['s_password']);

        header("Location: ../notif_email.php");
      
      

    

    }else{


        $_SESSION['message'] = '<b style="color:red;">Email is already use</b>';
        $_SESSION['success'] = 'danger';
      
        header("Location: ../register.php");

    }

   

}



/*
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = '<spam style="color:red;">invalid email'.$system_otp.'</spam>';
    $_SESSION['success'] = 'danger';
    
    header("Location: ../otp_verification.php");
}else{

   

}

*/











?>