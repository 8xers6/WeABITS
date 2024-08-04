
<?php include 'serverapi/server_api.php'  ?>
<?php



$email	= $conn->real_escape_string($_POST['email']);





   

    $sql1="SELECT * from tbl_residents where email='$email'";
    $result=$conn->query($sql1);
    
    if ($result->num_rows>0) {

        
      
           
       
       
        echo json_encode(array("emailFound"=>true));

      
       
    
    }else{

        $sql2="SELECT * from tblhousehold where email='$email'";
        $result2=$conn->query($sql2);
        
        if ($result2->num_rows>0) {
            
            
            

           
            echo json_encode(array("emailFound"=>true));

        }else{
            
            
             $sql2="SELECT * FROM `tblregistration` WHERE `email`='$email'";
        $result2=$conn->query($sql2);
        
        if ($result2->num_rows>0) {

           
            echo json_encode(array("emailFound"=>true));

        }else{

            echo json_encode(array("emailFound"=>false));

        }

          

        }
    
    
    }





  
  







?>