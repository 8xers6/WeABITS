<?php include 'serverapi/server_api.php'  ?>
<?php 




    $id=$conn->real_escape_string($_POST['resid']);


    $barno=$conn->real_escape_string($_POST['barno']);
	
    $equipno  = $conn->real_escape_string($_POST['equipno']);
    $qty  = $conn->real_escape_string($_POST['qty']);
 
	
	

    
 



        if(!empty($id)&&!empty($equipno)){

        
              

            if($qty==0){

                echo json_encode(array("qty"=>0));

        }else{


            $query1 = "SELECT * FROM `tblequipments` WHERE `bar_no`=$barno AND equip_no=$equipno";
            $result1 = $conn->query($query1);
            $row = $result1->fetch_assoc();
        
            if($row){
            
                $quantity 		= $row['quantity'];
                 $equipment 		= $row['equipment_name'];
                  
            }

             if($quantity==0){


                echo json_encode(array("quantity"=>0));


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
                
               
                echo json_encode(array("success"=>true));
    
               }
    
        }

        }else{

            echo json_encode(array("isgreater"=>true));

        }

    }

          

        }   
            
    
        }else{
    
            echo json_encode(array("success"=>false));
    
    
          
        }
    

 
           
   

   




   

	$conn->close();

    

	

   
