<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$city 	= $conn->real_escape_string($_POST['cityname']);
	$province	= $conn->real_escape_string($_POST['province']);
	$zipcode 	= $conn->real_escape_string($_POST['zipcode']);

    if(!empty($city) && !empty($province)){

        $insert  = "INSERT INTO tblcity (`city`, `province_id`,`zipcode`) VALUES ('$city',$province,'$zipcode')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Municipality added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Municipality is Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../city");

	$conn->close();