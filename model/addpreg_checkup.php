<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $pregno	= $conn->real_escape_string($_POST['pregno']);
 
    $datevisit 	= $conn->real_escape_string($_POST['datevisit']);
    $type 	= $conn->real_escape_string($_POST['type']);


    if(!empty($pregno) && !empty($type)){

        $insert  = "INSERT INTO `tblpreg_checkup`(`preg_no`, `date_visit`, `type`) VALUES ('$pregno','$datevisit','$type')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Pregnant Check up added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = ' Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../pregdetails.php?pregno=$pregno");

	$conn->close();