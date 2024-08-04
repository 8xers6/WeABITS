<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
 $barno=$_SESSION['bar_no'];
	//$user 	= $conn->real_escape_string($_POST['username']);
    $pass	= 	$password	= $conn->real_escape_string($_POST['pass']);
	//$pass 	= sha1($conn->real_escape_string($_POST['pass']));
	
	    $name	= $conn->real_escape_string($_POST['name']);
    $usertype 	= $conn->real_escape_string($_POST['user_type']);
    
    
$randoms=mt_rand(1111,9999);

$user=$usertype.''.$barno.''.$randoms;

    
  
$usertrim=preg_replace("/\s+/", "", $user);


    if(!empty($user) && !empty($pass) && !empty($usertype)){
      
        
                    // Validate password strength
$uppercase = preg_match('@[A-Z]@',$pass);
$lowercase = preg_match('@[a-z]@',$pass);
$number    = preg_match('@[0-9]@',$pass);
$specialchars = preg_match('@[^\w]@',$pass);


if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($pass) < 8) {
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
        

        $query = "SELECT * FROM tbl_users WHERE username='$user'";
        $res = $conn->query($query);

        if($res->num_rows){
            $_SESSION['message'] = 'User is Already added!';
            $_SESSION['success'] = 'danger';
        }else{

         $hash= hash("sha256",$pass);
            $insert  = "INSERT INTO tbl_users (`bar_no`,`name`,`username`, `password`, user_type) VALUES ($barno,'$name','$usertrim', '$hash', '$usertype')";
            $result  = $conn->query($insert);
            
            if($result === true){
                $_SESSION['message'] = 'User added!';
                $_SESSION['success'] = 'success';

            }else{
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        }
        
        
  }
        
    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../users.php");

	$conn->close();
