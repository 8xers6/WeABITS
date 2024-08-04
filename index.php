
<?php 
	session_start(); 
	if(isset($_SESSION['username'])&& $_SESSION['role']=='Resident'){
		header('Location: ./resident/dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='administrator'){

		header('Location: dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='staff'){

		header('Location: dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='superadmin'){

		header('Location: s_dashboard.php');
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


      
        <a  class="text-white"><h2 style="font-weight:bolder; ">Home</h2> </a>
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
        <div class="col-md-6 d-flex flex-column pt-3 pb-4 justify-content-center">
        <img src="assets/img/weabitlogo.png" class="img-fluid" width="300" > 
     
        <h1 data-aos="fade-up" class="pl-4 fw-bold">Welcome to WEABITS </h1>
          <h2 data-aos="fade-up" data-aos-delay="400">How to Register in Barangay?  <a href="" class="text-primary"></a></h2>
          <div data-aos="fade-up" data-aos-delay="600">
        
           
              <a href="resident/register.php" class=" pl-4 pr-4 pt-1 pb-1 bg-primary text-white" style="font-size:30px; border-radius:20px; font-weight:bolder; text-decoration:none;">
                Register <i class="fas fa-arrow-right"></i> 
           
              </a>
          
          </div>
  
        
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
             
            
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-3   text-center ">
             
             
                  
                <h1 class="fw-bold" >Available on Android</h1> 
                
                
        
             <img src="assets/img/android.png" class="img-fluid" height="400" width="400"><br> 
               <div class="form-group ml-5 mr-5" style="background:none;">
                    <a href="https://weabits.com/assets/img/android/WeABITS_0.2.0.apk"  onclick="return confirm('Are you sure you want to Download?');" class="form-control bg-primary text-white  border"><b>Download Now</b> <i class="fa fa-download"></i></a> 
                   
               </div>
               
   
       
       
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