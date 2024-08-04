<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $pregno 	= $conn->real_escape_string($_POST['pregno']);
    $checkno 	= $conn->real_escape_string($_POST['checkno']);
    $datevisit 	= $conn->real_escape_string($_POST['datevisit']);
    $type 	= $conn->real_escape_string($_POST['type']);


    if(!empty($checkno)){

        $insert  = "UPDATE `tblpreg_checkup` SET `date_visit`='$datevisit',`type`='$type' WHERE `checkup_no`=$checkno";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Record has been Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = ' Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../pregdetails.php?pregno=$pregno");

	$conn->close();