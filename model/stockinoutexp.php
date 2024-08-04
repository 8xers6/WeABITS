<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
  

   // $barno=$_SESSION['bar_no'];


   if($_POST['state']=='stockin'){

    $medno 	= $conn->real_escape_string($_POST['medno']);
	$qty 	= $conn->real_escape_string($_POST['qty']);
    $date 	= $conn->real_escape_string($_POST['expirydate']);

    if(!empty($medno) && !empty($qty) && !empty($date)){

        $insert  = "INSERT INTO `inventory`(`med_no`, `qty`,`expiry_date`) VALUES ('$medno','$qty','$date')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Stock added!';
            $_SESSION['success'] = 'success';


    header("Location: ../medicine.php");

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    header("Location: ../medicine.php");
    }


   }


   if($_POST['state']=='editinventory'){

    $id 	= $conn->real_escape_string($_POST['id']);
	$qty 	= $conn->real_escape_string($_POST['qty']);
 

    if(!empty($id)){

        $insert  = "UPDATE `inventory` SET `qty`='$qty'  WHERE `id`=$id";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Medicine Inventory has been Updated!';
            $_SESSION['success'] = 'success';


    header("Location: ../medicine.php");

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    header("Location: ../medicine.php");
    }


   }


   if($_GET['state']=='delete'){

    $id 	= $conn->real_escape_string($_GET['id']);


    if(!empty($id)){

        $insert  = "DELETE FROM `inventory` WHERE `id`=$id";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Stock Removed!';
            $_SESSION['success'] = 'danger';


    header("Location: ../medicine.php");

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    header("Location: ../medicine.php");
    }


   }



   


   if($_POST['state']=='stockout'){

    $medno 	= $conn->real_escape_string($_POST['medno']);
	$resid 	= $conn->real_escape_string($_POST['resid']);

	$qty 	= $conn->real_escape_string($_POST['qty']);


    if(!empty($medno) && !empty($qty) ){


        $product = $conn->query("SELECT * FROM tblmedicine WHERE bar_no=$barno   AND med_no=$medno");
							   
								$inn = $conn->query("SELECT sum(qty) as inn FROM inventory where med_no = $medno");
								$inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
								$out = $conn->query("SELECT sum(qty) as `out` FROM tblreqmedicine where  med_no = $medno");
								$out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;

								$ex = $conn->query("SELECT sum(qty) as ex FROM expired_product where med_no = $medno");
								$ex = $ex && $ex->num_rows > 0 ? $ex->fetch_array()['ex'] : 0;

								$available = $inn - $out- $ex;

 



                                if($available==0){

                                    $_SESSION['messager'] = 'Medicine is Out of Stock';
                                    $_SESSION['success'] = 'danger';
                                }else{




                                    if($available>=$qty){

                                        $image   = $_FILES['image']['name'];
                                         

                                        if($_SESSION['role']=='administrator'){
                                            $username= $_SESSION['username'];
                                        }
                                        if($_SESSION['role']!='administrator'){
                                            $username=$_SESSION['clerkusername'];       
                                        }


                                        $newName = date('dmYHis').str_replace(" ", "", $image);
                                        if(!is_dir("../assets/uploads/".$_SESSION['username']."/prescription")){
                                            mkdir("../assets/uploads/".$_SESSION['username']."/prescription", 07777);
                                        }
                                    
                                        $target= "../assets/uploads/".$_SESSION['username']."/prescription"."/".basename($newName);

                                        $insert  = "INSERT INTO `tblreqmedicine`(`med_no`, `res_id`, `qty`, `user_name`, `prescription_image`) 
                                        VALUES ('$medno','$resid','$qty','$username','$newName')";
       $result  = $conn->query($insert);
    
       if($result === true){

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

                       
            $_SESSION['messager'] = 'Request Medicine Added!';
            $_SESSION['success'] = 'success';
            }
          
    
    
    header("Location: ../patientrecord.php?id=$resid");
    
       }
                                    }else{
    
                                        $_SESSION['messager'] = 'Insufficient
 Medicine Stock!';
                                        $_SESSION['success'] = 'danger';
                                    }
    

                                }
                               
      


          
           


    header("Location: ../patientrecord.php?id=$resid");

        

    }else{

        $_SESSION['messager'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    header("Location: ../patientrecord.php?id=$resid");
    }


   }


   if($_POST['state']=='editstockout'){

    $reqmedno 	= $conn->real_escape_string($_POST['reqmedno']);
    $medno 	= $conn->real_escape_string($_POST['medno']);

 
	$qty 	= $conn->real_escape_string($_POST['qty']);

 	$resid 	= $conn->real_escape_string($_POST['resid']);
    if(!empty($medno) && !empty($qty) ){



        if(!empty($_FILES['image']['name'])){


                      
            $image   = $_FILES['image']['name'];

            $newName = date('dmYHis').str_replace(" ", "", $image);
            if(!is_dir("../assets/uploads/".$_SESSION['username']."/prescription")){
                mkdir("../assets/uploads/".$_SESSION['username']."/prescription", 07777);
            }
        
            $target= "../assets/uploads/".$_SESSION['username']."/prescription"."/".basename($newName);




            $insert  = "UPDATE `tblreqmedicine` SET `prescription_image`='$newName' WHERE `reqmed_no`=$reqmedno";
            $result  = $conn->query($insert);
    
            if($result === true){

                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

                $_SESSION['messager'] = 'Request Medicine Updated!';
                $_SESSION['success'] = 'success';
                    }
               


             
    
    
        header("Location: ../patientrecord.php?id=$resid");
    
            }


            }



        $product = $conn->query("SELECT * FROM tblmedicine WHERE bar_no=$barno   AND med_no=$medno");
							   
        $inn = $conn->query("SELECT sum(qty) as inn FROM inventory where med_no = $medno");
        $inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
        $out = $conn->query("SELECT sum(qty) as `out` FROM tblreqmedicine where  med_no = $medno");
        $out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;

        $ex = $conn->query("SELECT sum(qty) as ex FROM expired_product where med_no = $medno");
        $ex = $ex && $ex->num_rows > 0 ? $ex->fetch_array()['ex'] : 0;

        $available = $inn - $out- $ex;





        if($available==0){

            $_SESSION['message'] = 'Medicine is Out of Stock';
            $_SESSION['success'] = 'danger';
        }else{




            if($available>=$qty){

                   
                $insert  = "UPDATE `tblreqmedicine` SET `qty`='$qty' WHERE `reqmed_no`=$reqmedno";
                $result  = $conn->query($insert);
        
                if($result === true){


                   


                    $_SESSION['messager'] = 'Request Medicine Updated!';
                    $_SESSION['success'] = 'success';
        
        
            header("Location: ../patientrecord.php?id=$resid");
        
                }




              




            }else{

                $_SESSION['messager'] = 'Insuffienct Medicine Stock!';
                $_SESSION['success'] = 'danger';
            }


        }

      


           
           


    header("Location: ../patientrecord.php?id=$resid");

        

    }else{

        $_SESSION['messager'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

    header("Location: ../patientrecord.php?id=$resid");
    }


   }


   if($_POST['state']=='expired'){
    $id 	= $conn->real_escape_string($_POST['id']);
    $medno 	= $conn->real_escape_string($_POST['medno']);
	$qty 	= $conn->real_escape_string($_POST['qty']);
    $date 	= $conn->real_escape_string($_POST['expirydate']);

    if(!empty($id) && !empty($medno) && !empty($qty) && !empty($date)){


    

        $queryupdate  = "UPDATE `inventory` SET `expired_confirm`=1 WHERE `id`='$id'";
        $result1= $conn->query($queryupdate);


        if($result1 === true){
           

            $insert  = "INSERT INTO `expired_product` (`med_no`, `qty`, `date_expired`, `date_created`) VALUES ('$medno', '$qty', '$date', current_timestamp());";
            $result2  = $conn->query($insert);


          if($result2==true){
            $_SESSION['message'] = 'Expired Confirmed!';
            $_SESSION['success'] = 'success';



    header("Location: ../medicine.php");

          }

        }

     

        

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';


    header("Location: ../medicine.php");
    }


   }
	


	$conn->close();