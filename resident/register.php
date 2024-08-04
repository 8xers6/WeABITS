<?php include '../server/serverhome.php' ?>  



<!DOCTYPE html>
<html>
<head>

    <title>WEABITS</title>


    
</head>

<body>
    
  
<nav class="navbar navbar-expand-lg  navbar-light bg-primary-gradient">

  <a class="navbar-brand" href="/weabits/"  style="font-size:30px; font-weight:bolder;">
    <img src="../assets/img/weabitlogo.png" width="50" height="50" class="d-inline-block align-center"   alt="">
          WeABITS
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ">
      <li class="nav-item  p-4">


      
        <a  class="text-white "  href="../"><h2 >Home</h2> </a>
      </li>
  
      <li class="nav-item  p-4">
        <a  class="text-white"  href="register"><h2  style="font-weight:bolder;">Register</h2></a>
      </li>
      <li class="nav-item  p-4">
        
        <a  class="text-white"  href="homeresident"><h2 >Sign In</h2></a>
      </li>


     
   
      
    
    </ul>
    
  </div>
</nav>


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        
      
        <div class="col-md-12  " data-aos="zoom-out" style="position:relative; top:0px; width:100%;" data-aos-delay="200">
      
        <?php include 'regacc.php' ?>


        </div>
      

        </div>
      </div>
      </div>

	

  </section><!-- End Hero -->



    



</body>



	<!-- Main Footer -->
  <?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
  
  

<?php include 'templates/footer.php' ?>

<script>
        $(document).ready(function() {
          
            $('.search_select_box select').selectpicker();
        });
    </script>




<script>






$('#province').on('change', function() {
        var province_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'selectcity.php',
            type: "POST",
            data: {
                province_data: province_id,
            },
            success: function(data) {



                $('#city').html(data);
                
               console.log(data);
            }
        })
    });




    $('#city').on('change', function() {
        var city_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'selectbarangay.php',
            type: "POST",
            data: {
                city_data: city_id,
            },
            success: function(data) {



                $('#barangay').html(data);
               console.log(data);
            }
        })
    });



    $('#barangay').on('change', function() {
        var barangay_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'selectstreet.php',
            type: "POST",
            data: {
                barangay_data: barangay_id,
            },
            success: function(data) {



                $('#street').html(data);
               console.log(data);
            }
        })
    });




</script>


</html>