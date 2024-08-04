<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }


    $provinceid 	= $conn->real_escape_string($_POST['provinceid']);

	$provincename 	= $conn->real_escape_string($_POST['provincename']);
	

    if(!empty($provincename) && !empty($provinceid)){

        $insert  = "UPDATE `tblprovince` SET `province`='$provincename' WHERE  `province_id`='$provinceid'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Province Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Error';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../province.php");

	$conn->close();