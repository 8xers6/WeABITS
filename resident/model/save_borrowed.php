<?php include '../server/server.php' ?>
<?php 


	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	

    $id=$_SESSION['resid'];


    $barno=$_SESSION['barno'];
	
    $equipno  = $conn->real_escape_string($_POST['equipno']);
    $qty  = $conn->real_escape_string($_POST['qty']);
 
	
	

    
 



        if(!empty($id)&&!empty($equipno)){

        
              

            if($qty==0){

          
             
                
                echo 'zero';

               

        }else{


            $query1 = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno AND equip_no=$equipno";
            $result1 = $conn->query($query1);
            $row = $result1->fetch_assoc();
        
            if($row){
            
                $quantity 		= $row['quantity'];
                $equipment 		= $row['equipment_name'];
               
            }

             if($quantity==0){
           
    
     echo 'unavailable';


             }else{
            if($qty<=$quantity){

            
$datetoborrow  = $conn->real_escape_string($_POST['datetoborrow']);
           $date  = $conn->real_escape_string($_POST['datereturn']);
            $purpose 		   = $conn->real_escape_string($_POST['purpose']);

            $insert  = "INSERT INTO tblborrow (`res_id`,`equip_no`,`purpose`,`status`,`date_to_return`,`date_req`,`quantity`) VALUES ('$id','$equipno','$purpose','pending','$date','$datetoborrow','$qty')";
            $result  = $conn->query($insert);
    
            if($result === true){


               $notifname=$equipment;
               $notiftype='borrow';
               $usertype='administrator';
               $message='New Borrow Request';

                $insert1  = "INSERT INTO `tblnotification`( `bar_no`, `res_id`, `notif_name`, `message`, `notif_status`, `user_type`, `notif_type`) VALUES 
                ('$barno','$id','$notifname','$message','0','$usertype','$notiftype')";
               $result1  = $conn->query($insert1);
       
               if($result1 === true){
                 
                $_SESSION['message'] = 'Your Request has been sent';
                $_SESSION['success'] = 'success';
               
               echo 'success';
               }
               
            
    
             
    
        }

        }else{

         
            
            echo 'insufficient';

 
        }

    }

          

        }   
            
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
    
    
          
        }
    

 
           
   
        ///header("Location: ../submitborrow.php?equipno=.$equipno.");
    




   

	$conn->close();

    

	

   
