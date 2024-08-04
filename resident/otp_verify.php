<?php
	include('server/serverhome.php');

   $otp=$_SESSION['otp'];



    if(!empty($otp)){

     
        $c1=$_POST['c1'];
        $c2=$_POST['c2'];
        $c3=$_POST['c3'];
        $c4=$_POST['c4'];
        $c5=$_POST['c5'];
        $c6=$_POST['c6'];

        $mycode=''.$c1.''.$c2.''.$c3.''.$c4.''.$c5.''.$c6.'';


        if($otp!=$mycode){
            $_SESSION['otpvalidation']='incorrect';
           echo"incorrect";
           
        }else{
            



          $_SESSION['otpvalidation']='correct';
          echo "correct";

            
        }

        

    }else{


       // header("Location: register.php");
    }

   

?>