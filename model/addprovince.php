<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$provincename 	= $conn->real_escape_string($_POST['provincename']);
	

    if(!empty($provincename)){

        $insert  = "INSERT INTO tblprovince (`province`) VALUES ('$provincename')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Province added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Province is Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../province.php");

	$conn->close();