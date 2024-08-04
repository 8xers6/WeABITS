<?php 
	include '../server/server.php';

    $id 	= $conn->real_escape_string($_POST['id']);
	$cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);
	$new_pass 	= $conn->real_escape_string($_POST['new_pass']);
    $con_pass 	= $conn->real_escape_string($_POST['con_pass']);


    $hashcur= hash("sha256",$cur_pass);


    $hashnew= hash("sha256",$new_pass);
    $hashcon= hash("sha256",$con_pass);
     
     
     $username=$_SESSION['username'];


	if(!empty($id)){

        if($new_pass==$con_pass){
            
            
            
            
                        
                                // Validate password strength
$uppercase = preg_match('@[A-Z]@',$new_pass);
$lowercase = preg_match('@[a-z]@',$new_pass);
$number    = preg_match('@[0-9]@',$new_pass);
$specialchars = preg_match('@[^\w]@',$new_pass);


if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($new_pass) < 8) {
    $_SESSION['message'] = '
   
    
   
    <ul>
    Invalid password.
  <li>The password must be at least 8 characters in length.</li>
  <li>The password must include at least one upper case.</li>
  <li>The password must include at least one number.</li>
  <li> The password must include at least one special character.</li>
 
</ul>';
    $_SESSION['success'] = 'danger';
  

  }else{

            $check = "SELECT * FROM tblbarangay WHERE username='$username' AND `password`='$hashcur'";
            $res = $conn->query($check);

            if($res->num_rows){

                $query 		= "UPDATE `tbl_users` SET  `password`='$hashnew' WHERE `id`=$id";	
                $result 	= $conn->query($query);

                if($result === true){
                    
                    $_SESSION['message'] = 'Password has been updated!';
                    $_SESSION['success'] = 'success';

                }else{

                    $_SESSION['message'] = 'Somethin went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }else{
                $_SESSION['message'] = 'Admin Password is incorrect!';
                $_SESSION['success'] = 'danger';
            }
            
  }

        }else{
            $_SESSION['message'] = 'Password not match';
		    $_SESSION['success'] = 'danger';
        }
        

	}else{
		$_SESSION['message'] = 'No Username found!';
		$_SESSION['success'] = 'danger';
	}

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();