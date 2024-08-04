  <?php  
  	include('server/server.php');
  
  
  
  
  
  $otp=$_SESSION['otp'];



    if(!empty($otp)){

     
        $mycode=$_POST['otp'];


        if($otp!=$mycode){
            $_SESSION['otpvalidation']='incorrectsw';
           echo"incorrect";
           
        }else{
            
   
     $email 	=  $_SESSION['s_email'];
     $barno=$_POST['barno'];
            $query 		= "UPDATE `tblbarangay` SET `email`='$email' WHERE `bar_no`=$barno";	
                $result 	= $conn->query($query);

                if($result === true){
                    
                    
                    
                      $_SESSION['message'] = 'Email Change Successful';
                    $_SESSION['success'] = 'success';
                       echo "correct";
              
                }else{
                    echo'error';
                }

                   
               
          
          
          

            
        }

        

    }else{


       echo 'empty';
    }
    
    
    
    ?>