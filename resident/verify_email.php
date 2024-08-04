<?php include '../server/serverhome.php' ?>
<?php

session_start();


if(isset($_GET['token'])){
    
    

  $email_token=$_GET['token'];

  $verify_query="SELECT email_token,email_status FROM tbl_residents WHERE  email_token='$email_token' LIMIT 1";
  $verify_query_run=mysqli_query($conn,$verify_query);


  if(mysqli_num_rows($verify_query_run)>0){



    $row=mysqli_fetch_array($verify_query_run);


    if($row['email_status']==0){

   
          $click_email_token=$row['email_token'];

          $update_query="UPDATE tbl_residents set email_status='1' WHERE email_token='$click_email_token' LIMIT 1";
          $update_query_run=mysqli_query($conn,$update_query);


          if($update_query_run){

            $_SESSION['message'] = '<b>Your email has been verified successfully</b>';
            $_SESSION['success'] = 'success';
          
            header("Location: notif_email");
            exit(0);

          }else{

            $_SESSION['message'] = '<b style="color:red;">Verification Failed</b>';
            $_SESSION['success'] = 'success';
          
            header("Location: notif_email");
            exit(0);


          }



    }else{


        $_SESSION['message'] = '<b style="color:red;">Your Email is Already Verified.</b>';
        $_SESSION['success'] = 'danger';
      
        header("Location: notif_email");
        exit(0);
    }
  }else{

    $_SESSION['message'] = '<b style="color:red;">Invalid Token</b>';
    $_SESSION['success'] = 'danger';
  
    header("Location: notif_email");
    exit(0);



  }
 

}else{


    $_SESSION['message'] = '<b style="color:red;">Error</b>';
    $_SESSION['success'] = 'danger';

    header("Location: notif_email");
    exit(0);

}












?>