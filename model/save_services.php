<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }


    $barno=$_SESSION['bar_no'];

    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblbarangay.province_id=tblprovince.province_id  WHERE bar_no=$barno";
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

   
	$title 	= $conn->real_escape_string($_POST['ttle']);
	
    $detail 	= $conn->real_escape_string($_POST['details']);
	$amount 	= $conn->real_escape_string($_POST['amount']);
    $picture   = $_FILES['img']['name'];

        // change profile2 name
     $newName = date('dmYHis').str_replace(" ", "", $picture);

        // image file directory
        $target = "../assets/uploads/".$_SESSION['username']."/services"."/".basename($newName);

    if(!empty($title) && !empty($detail)&& !empty($amount)){

        $query = "INSERT INTO tblservices (`bar_no`,`document_type`,`details`,`amount`,`image`) VALUES ($barno,'$title','$detail','$amount','$newName')";

        if($conn->query($query) === true){

          
            $_SESSION['message'] = 'Service Information has been saved!';
            $_SESSION['success'] = 'success';

            if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

               
            $_SESSION['message'] = 'Service Information has been saved!';
            $_SESSION['success'] = 'success';
            }
        }




    }
      

    header("Location: ../services.php");

	$conn->close();

    ?>