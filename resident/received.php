<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }



    $reqno 	    = $_GET['reqno'];


    if(!empty($reqno)){



        $query="UPDATE `tblrequested_documents` SET `status`='received' WHERE `req_no`=$reqno;";

			    
				
        if($conn->query($query) === true){

            $_SESSION['message'] = 'Document has been received';
            $_SESSION['success'] = 'success';
            header("Location:  myrequest.php");
           
        }
    }else{

        $_SESSION['message'] = 'error req no not found!';
        $_SESSION['success'] = 'danger';
        header("Location:  myrequest.php");


    }


  


	$conn->close();