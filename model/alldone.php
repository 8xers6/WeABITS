<?php include '../server/server.php' ?>


<?php



        $barno=$_SESSION['bar_no'];
	 	$query1 = "UPDATE tblbarangay SET  `medin`='1'  WHERE bar_no=$barno;";

		if($conn->query($query1) === true){

		
				header("Location: ../dashboard");
			
		}




?>