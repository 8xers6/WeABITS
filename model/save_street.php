<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
  

    $barno=$_SESSION['bar_no'];
	$streetname 	= $conn->real_escape_string($_POST['streetname']);
	$details 	= $conn->real_escape_string($_POST['details']);

    if(!empty($streetname) && !empty($details)){

        $insert  = "INSERT INTO tblstreet (`bar_no`,`streetname`, `details`) VALUES ($barno,'$streetname', '$details')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Street added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Street is Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../street.php");

	$conn->close();