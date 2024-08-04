<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }


    $cityid 	= $conn->real_escape_string($_POST['cityid']);

	$city 	= $conn->real_escape_string($_POST['cityname']);
	$province 	= $conn->real_escape_string($_POST['province']);
	$zipcode 	= $conn->real_escape_string($_POST['zipcode']);

    if(!empty($cityid)&& !empty($city) && !empty($province)){

        $insert  = "UPDATE `tblcity` SET `city`='$city',`province_id`='$province', `zipcode`='$zipcode'  WHERE  `city_id`='$cityid'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'City Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
    
    
    if(!empty($cityid)&& !empty($city) && empty($province)){

        $insert  = "UPDATE `tblcity` SET `city`='$city', `zipcode`='$zipcode'  WHERE  `city_id`='$cityid'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'City Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }

    header("Location: ../city.php");

	$conn->close();