<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
    $medno 	= $conn->real_escape_string($_POST['medno']);
 
    $quantity	= $conn->real_escape_string($_POST['qty']);
    $stocks 	= $conn->real_escape_string($_POST['stocks']);

    $medexp 	= $conn->real_escape_string($_POST['medexp']);


    $query1 		= "SELECT * FROM `tblmedicine` WHERE bar_no=$barno AND med_no=$medno";
		
		$result1 	= $conn->query($query1);
		
		if($result1->num_rows){
			while ($row = $result1->fetch_assoc()) {
				$medname=$row['med_name'];
			}

        }



    if(!empty($barno) && !empty($medname)){

        $insert  = "INSERT INTO `tblexpiredmedicine`(`med_no`, `med_name`, `med_qty`, `med_stock`, `med_expired`) 
                     VALUES ('$medno','$medname','$quantity','$stocks','$medexp')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Expired Medicine added!';
            $_SESSION['success'] = 'success';
            
            
            							$barno=$_SESSION['bar_no'];
                 if(!empty($barno) && $_SESSION['role']=='administrator'){
  $username=$_SESSION['username'];
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Expired Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }
    
    
      if(!empty($barno) && $_SESSION['role']!='administrator'){
          $username=$_SESSION['clerkusername']; 
        $insert  = "INSERT INTO `tblaudit_trail`(`bar_no`, `log_id`, `audit_username`, `audit_action`) VALUES ('$barno','0','$username','Add Expired Medicine')";
        $result  = $conn->query($insert);

        if($result === true){
             

        }

    }

        }else{
            $_SESSION['message'] = ' Already added!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../medicine.php");

	$conn->close();