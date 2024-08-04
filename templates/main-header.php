

<?php include('./model/fetch_brgy_info.php') ?>

<?php



if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'){

    $barno=$_SESSION['bar_no'];
    $query = "SELECT *,lpad(bar_no,5,'0')as bar_no FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id   WHERE bar_no=$barno";
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
      
        $mission= $row['mission'];
        $vision= $row['vision'];
                
         $bct= $row['basic_community_tax'];

        $addtax= $row['additional_tax'];
        $nomonth= $row['no_of_month'];
               $gcashqrcode= $row['gcash_qrcode'];
               
               $getstarted= $row['getstarted'];
               
               $street= $row['street'];
               $chairman= $row['chairman'];
               $person= $row['personel'];
                
                
                $cert=$row['cert'];
                $equips=$row['equip'];
                $medin=$row['medin'];
        
    }
    
    if($getstarted==0){
        
           header("Location: getstarted");
    }else{
        
          if($street==0){
        
           header("Location: getstreet");
    }else{
        
        
       
        
        
          if($chairman==0){
        
           header("Location: getchairman");
    }else{
        
          if($person==0){
        
           header("Location: getpersonel");
    }else{
        
        
        if($cert==0){
        
           header("Location: getcert");
    }else{
        
        
        if($equips==0){
        
           header("Location: getequip");
    }else{
        
        
        if($medin==0){
        
           header("Location: getmed");
    }
        
        
    }
        
    }
        
        
    }
    }
    }
        
    }
    
    
}




?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue2">
       

    <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>

        <a href="dashboard.php" class="logo">
            <img src="./assets/uploads/<?=$_SESSION['username']?>/barangayinfo/<?=$brgylogo ?>" height="30" width="30" alt="navbar brand" class="navbar-brand rounded-circle"> <span class="text-light ml-2 fw-bold" style="font-size:16px">  Brgy. <?= $barangayname ?></span>
          
        </a>
        <?php else: ?>

            <a href="#" class="logo">
            <img src="assets/img/weabitlogo.png" height="30" width="30" alt="navbar brand" class="navbar-brand"> <span class="text-light ml-2 fw-bold" style="font-size:20px">WeABITS</span>
        </a>

        <?php endif ?>
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
            <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk' ): ?>
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle " href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i><b id="count" class="bg-danger pl-1 pr-1 rounded-circle " style="color:white; background:red; "></b>
                    </a>
                    <ul style=" 
  width: 250px;
  height: 300px;
  border: 1px solid;
  overflow: auto; 

  
  
  " class="dropdown-menu messages-notif-box animated fadeIn "  aria-labelledby="messageDropdown" >
                           <div id="listnotif"  class=" scrollbar scrollbar-inner">

        </div>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>




















