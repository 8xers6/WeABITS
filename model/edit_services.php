<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
    $barno=$_SESSION['bar_no'];
   


    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id  WHERE bar_no=$barno";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
	
		$barangayname 		= $row['barangayname'];
        $city 		= $row['City'];
        $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
	  
        $mission= $row['mission'];
        $vision= $row['vision'];
	}

    $id 	= $conn->real_escape_string($_POST['id']);

    $detail 	= $conn->real_escape_string($_POST['details']);
	$amount 	= $conn->real_escape_string($_POST['amount']);





        
        $query = "UPDATE `tblcertificates` SET `details`='$detail',`amount`='$amount' WHERE `bar_no`=$barno AND `cert_id`='$id'";

        if($conn->query($query) === true){

          
            $_SESSION['message'] = 'Certificate has been Updated!';
            $_SESSION['success'] = 'success';
            header("Location: ../certificate");

           
        }





   

	$conn->close();
