<?php include '../server/server.php' ?>
<?php

 $barno=$_SESSION['barno'];

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
		    $gcashqrcode= $row['gcash_qrcode'];
	}


?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue2">
  
        <a href="dashboard.php" class="logo">
            <img src="../assets/uploads/<?= $busername?>/barangayinfo/<?=$brgylogo ?>" height="30" width="30" alt="navbar brand" class="navbar-brand rounded-circle"> <span class="text-light ml-2 fw-bold" style="font-size:16px">  Brgy. <?= $barangayname ?></span>
          
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle " href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i><b id="counts" class="bg-danger pl-1 pr-1 rounded-circle " style="color:white; background:red; "></b>
                    </a>
                    <ul style=" 
  width: 250px;
  height: 300px;
  border: 1px solid;
  overflow: auto; 

  
  
  " class="dropdown-menu messages-notif-box animated fadeIn "  aria-labelledby="messageDropdown" >
                           <div id="listnotify"  class=" scrollbar scrollbar-inner">

        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>