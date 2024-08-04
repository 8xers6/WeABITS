<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username']) && $_SESSION['role']!='administrator'){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $user           = $_SESSION['username'];
    $resid          = $conn->real_escape_string($_POST['resid']);

    $reqno          = $conn->real_escape_string($_POST['reqno']);

    $date           = $conn->real_escape_string($_POST['date']);
    

    $reqno 	    = $conn->real_escape_string($_POST['reqno']);
    $amount 	    = $conn->real_escape_string($_POST['amount']);

    if(!empty($user) && !empty($resid)){

        $insert  = "INSERT INTO tblpayments (`res_id`,`req_no`,`amounts`, `date`, `user`) VALUES ('$resid','$reqno','$amount', '$date', '$user')";
        $result  = $conn->query($insert);

        if($result === true){

            $query="UPDATE `tblrequested_documents` SET `status`='released' WHERE `req_no`=$reqno;";

			    
				
				if($conn->query($query) === true){

                 

                   
				}
                
                $_SESSION['message'] = 'Payment has been saved!';
                $_SESSION['success'] = 'success';
                header("Location: ../requested_docs.php");
           

        }else{
            $_SESSION['message'] = 'Request No. '.$reqno.' have already a  copy of official receipt';
            $_SESSION['success'] = 'danger';
            
            header("Location: ../requested_docs");
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
        header("Location: ../requested_docs");

        
    }



	$conn->close();