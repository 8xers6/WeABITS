
<?php include '../server/serverhome.php' ?>  


<!DOCTYPE html>
<html>
<head>

    <title>WEABITS</title>


    
</head>

<body>
    
  
<nav class="navbar navbar-expand-lg  navbar-light bg-primary-gradient">

  <a class="navbar-brand" href=""  style="font-size:30px; font-weight:bolder;">
    <img src="assets/img/weabitlogo.png" width="50" height="50" class="d-inline-block align-center"   alt="">
          WeABITS
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ">
   


   
      <li class="nav-item  p-6">
        <a  class="text-white"  href="admin"><h2  style="font-weight:bolder;">WELCOME TO WEABITS ADMINISTRATOR</h2></a>
      </li>

   
      
    
    </ul>
    
  </div>
</nav>


 <!-- ======= Hero Section ======= -->
 <section id="hero" class="hero d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class="col-md-6 d-flex flex-column justify-content-center">
     <img src="assets/img/weabitlogo.png" class="img-fluid  text-center" width="400" > 
    
    
      <div data-aos="fade-up" data-aos-delay="600">
    
       
      
      
      </div>

    
      <div data-aos="fade-up" data-aos-delay="600">
        <div class="text-center text-lg-start">
            
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-6 ml-0" data-aos="zoom-out" style="position:relative; top:-10px;" data-aos-delay="200">

    <?php include 's_login.php' ?>  
    </div>
  </div>
</div>

</section><!-- End Hero -->



  
  


		<!-- Main Footer -->
      <?php include './templates/main-footer.php' ?>
			<!-- End Main Footer -->

</body>


<?php include './templates/footer.php' ?>

</html>