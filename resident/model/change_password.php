<?php 
	include '../server/server.php';

    $username 	= $_SESSION['username'];


    $cur_pass	= hash("sha256",$conn->real_escape_string($_POST['cur_pass']));
    //$new_pass	= hash("sha256",$conn->real_escape_string($_POST['new_pass']));
   // $con_pass	= hash("sha256",$conn->real_escape_string($_POST['con_pass']));


    $new_pass	= $conn->real_escape_string($_POST['new_pass']);
    $con_pass	= $conn->real_escape_string($_POST['con_pass']);


	if(!empty($username)){

              
        $check = "SELECT * FROM tbl_residents WHERE username='$username' AND `password`='$cur_pass'";
        $res = $conn->query($check);

      
        if($res->num_rows){




            // Validate password strength
$uppercase = preg_match('@[A-Z]@', $new_pass);
$lowercase = preg_match('@[a-z]@', $new_pass);
$number    = preg_match('@[0-9]@', $new_pass);
$specialchars = preg_match('@[^\w]@', $new_pass);


if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($new_pass) < 8) {
    $_SESSION['message'] = '
   
    
   
    <ul>
    Failed to change the password.
  <li>The password must be at least 8 characters in length.</li>
  <li>The password must include at least one upper case.</li>
  <li>The password must include at least one number.</li>
  <li> The password must include at least one special character.</li>
 
</ul>';
    $_SESSION['success'] = 'danger';
  

  }else{




  

        if($new_pass==$con_pass){



            
            $hash= hash("sha256",$new_pass);
           

              
                $query 		= "UPDATE tbl_residents SET `password`='$hash' WHERE username='$username'";	
                $result 	= $conn->query($query);

                if($result === true){
                    
                    $_SESSION['message'] = 'Password has been updated!';
                    $_SESSION['success'] = 'success';

                }else{

                    $_SESSION['message'] = 'Somethin went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            

        }else{
            $_SESSION['message'] = 'Password did not match!';
		    $_SESSION['success'] = 'danger';
        }


  }



        }else{
            $_SESSION['message'] = 'Current Password is incorrect!';
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