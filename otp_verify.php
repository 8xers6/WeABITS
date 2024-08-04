<?php
	include('server/server.php');
	
	
	
	
	    
	    
	       $otp=$_SESSION['otp'];



    if(!empty($otp)){

     
        $mycode=$_POST['otp'];


        if($otp!=$mycode){
            $_SESSION['otpvalidation']='incorrect';
           echo"incorrect";
           
        }else{
            



          $_SESSION['otpvalidation']='correct';
          echo "correct";

            
        }

        

    }else{


       echo 'empty';
    }

	    
	    



   

?>