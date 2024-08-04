<?php include 'server/serverhome.php' ?>  
<?php 
    $query = "SELECT * FROM tblbrgy_info";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
		$province = $row['province'];
		$town	= $row['town'];
		$brgy 		= $row['brgy_name'];
		$number =  $row['number'];
		$city_logo 	= $row['city_logo'];
		$brgy_logo		= $row['brgy_logo'];
		$db_txt		= $row['text'];
		$db_img		= $row['image'];
        $email		= $row['emailaddress'];
    $map		= $row['map_url'];
	}

	$pos_q = "SELECT * FROM tblposition ORDER BY `order` ASC";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}

	$chair_q = "SELECT * FROM tblchairmanship";
	$res_q = $conn->query($chair_q);

	$chair = array();
	while($row = $res_q->fetch_assoc()){
		$chair[] = $row; 
	}
    
?>

<!DOCTYPE html>
<html>
<head>

    <title>WEABITS</title>
<?php include 'templates/header.php' ?>

    
</head>

<body>
    
  
<nav class="navbar navbar-expand-lg  navbar-light bg-primary-gradient">

  <a class="navbar-brand" href="#"  style="font-size:30px; font-weight:bolder;">
    <img src="assets/img/weabitlogo.png" width="50" height="50" class="d-inline-block align-center"   alt="">
          WeABITS
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ">
      <li class="nav-item  p-4">


      
        <a  class="text-white" href="index"><h2  style="font-weight:bolder; ">Home</h2> </a>
      </li>
      <li class="nav-item  p-4">
      <a class="text-white" href="about"><h2>About</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a class="text-white" href="announcementpage?search="><h2>Announcement</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="serviceshome"><h2>Services</h2></a>
      </li>

      <li class="nav-item  p-4">
        <a  class="text-white"  href=""><h2  style="font-weight:bolder;">Map</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="resident/register"><h2>Register</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="resident/homeresident"><h2>Sign In</h2></a>
      </li>



   
      
    
    </ul>
    
  </div>
</nav>


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-md-6  justify-content-center">
        <img src="assets/uploads/barangay/<?= $brgy_logo ?>" class="img-fluid " width="500" > 

        <h1 data-aos="fade-up" class="text-uppercase fw-bold ">Welcome to Barangay <?= ucwords($brgy) ?></h1> 
         
          <div data-aos="fade-up" data-aos-delay="600">
        
           
            
          
          </div>
  
        
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
             
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 ml-0 mt-4" data-aos="zoom-out" style="position:relative; top:10px;" data-aos-delay="200">
        <h1>Barangay   <?= ucwords($brgy) ?> Map</h1>
        <?=ucwords($map)?>
       
        </div>
      </div>
    </div>

  </section><!-- End Hero -->




  
  


		<!-- Main Footer -->
      <?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

</body>


<?php include 'templates/footer.php' ?>

</html>