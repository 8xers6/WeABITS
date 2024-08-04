<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $imm_no 	= $conn->real_escape_string($_POST['imm_no']);
    $immun_type 	= $conn->real_escape_string($_POST['immun_type']);
    $datevisit 	= $conn->real_escape_string($_POST['date_visit']);

    $resid 	= $conn->real_escape_string($_POST['res_id']);
    if(!empty($imm_no) && !empty($immun_type)){

        $insert  = "UPDATE `tblimmunization` SET  `date_visit`='$datevisit',`immun_type`='$immun_type' WHERE `immun_no`=$imm_no";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Immunization Updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = ' Error!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../newborndetails.php?id=$resid");

	$conn->close();