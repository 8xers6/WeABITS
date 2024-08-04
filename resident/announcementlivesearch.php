<?php include '../server/server.php' ?>
<?php








$barno=$_SESSION['barno'];
$resid=$_SESSION['resid'];





$query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id  WHERE bar_no=$barno";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
	
		$barangayname 		= $row['barangayname'];
        $city 		= $row['city'];
        $province 		= $row['province'];
        $phone 		= $row['phonenumber'];
        $email= $row['email'];
        $brgylogo= $row['brgylogo'];
        $citylogo= $row['citylogo'];
        $busername= $row['username'];
	  
        $mission= $row['mission'];
        $vision= $row['vision'];
		$bar_no= $row['bar_no'];
	}


if(!empty($_POST['searchannouncement'])){

    $search=$_POST['searchannouncement'];

    if(strlen($search)>0){





        $query1 = "SELECT * FROM `tblannouncement` WHERE bar_no=$barno AND activityname LIKE '%$search%' AND status='Active'";
      
$result1 = $conn->query($query1);

if(mysqli_num_rows($result1)>0){





while($row = $result1->fetch_assoc()){

    $id=$row['id']; 
    $activity=$row['activityname'];
    $picture=$row['picture'];
  

 


    echo ' <form action="announcementview.php"  method="POST">
    <input type="hidden" class="form-control" value="'.$id.'"  name="id" required>
        <button type="submit" class=" btn-light" style="border-radius:20px;" > <div class="row-md-5 m-1    " style="width:290px;"><div class="row-md-10   ">

    <div class="row justify-content-center  ml-0  mr-0  fw-bold   "  style="pointer-events: none;">
  
    <img src="../assets/uploads/'.$busername.'/announcement/'.$picture.'" class="" alt="Responsive image" style="border-radius:20px;"  width="100%" height="200">


    <h3><b>'.$activity.'</b></h3>
   

    </div>


</div></div> </button> </form>';
}

}else{


echo '<div class="row md-12 justify-content-center" ><h1>No Available data</h1></div>';
}




    }





}else{    


$query1 = "SELECT * FROM `tblannouncement` WHERE bar_no=$barno AND status='Active' LIMIT 6";
      
$result1 = $conn->query($query1);

if(mysqli_num_rows($result1)>0){





while($row = $result1->fetch_assoc()){
 $id=$row['id']; 
    $activity=$row['activityname'];
    $picture=$row['picture'];
  

 


    echo ' <form action="announcementview.php"  method="POST">
    <input type="hidden" class="form-control" value="'.$id.'"  name="id" required>
        <button type="submit" class=" btn-light" style="border-radius:20px;" > <div class="row-md-5 m-1    " style="width:290px;"><div class="row-md-10   ">

    <div class="row justify-content-center  ml-0  mr-0  fw-bold   "  style="pointer-events: none;">
  
    <img src="../assets/uploads/'.$busername.'/announcement/'.$picture.'" class="" alt="Responsive image" style="border-radius:20px;"  width="100%" height="200">


    <h3><b>'.$activity.'</b></h3>
   

    </div>


</div></div> </button> </form>';
}

}else{


echo '<div class="row md-12 justify-content-center" ><h1>No Available data</h1></div>';
}
}


?>