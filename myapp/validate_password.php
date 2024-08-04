
<?php include 'serverapi/server_api.php'  ?>
<?php




$password	= $conn->real_escape_string($_POST['password']);

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialchars = preg_match('@[^\w]@', $password);


    if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
        
     

        echo json_encode(array("weakpassword"=>true));

}else{

       echo json_encode(array("weakpassword"=>false));


}





  

?>