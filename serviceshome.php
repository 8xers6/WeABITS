<?php include 'server/serverhome.php' ?>
<?php
    $query = "SELECT * FROM tblservices";
    $result = $conn->query($query);

    $services = array();
    while($row = $result->fetch_assoc()){
        $services[] = $row; 
    }
?>



<!DOCTYPE html>
<html>
<head>
<?php include 'templates/header.php' ?>
    <title>WEABITS</title>


    
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
      <li class="nav-item p-4 ">


      
        <a  class="text-white" href="index"><h2>Home</h2> </a>
      </li>
      <li class="nav-item  p-4">
        <a class="text-white" href="about"><h2>About</h2></a>
      </li>
      <li class="nav-item p-4">
        <a class="text-white"  href="announcementpage?search="><h2>Announcement</h2></a>
      </li>
      <li class="nav-item p-4">
        <a  class="text-white"  href="#"><h2  style="font-weight:bolder;">Services</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="map"><h2>Map</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="resident/register"><h2>Register</h2></a>
      </li>
      <li class="nav-item  p-4">
        <a  class="text-white"  href="resident/homeresident"><h2>RESIDENT</h2></a>
      </li>


      <li class="nav-item  p-4">
        <a  class="text-white"  href="admin"><h2>ADMIN</h2></a>
      </li>

   
      
    
    </ul>
    
  </div>
</nav>




    <div class="wrapper">
    

        <div class="main">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row  justify-content-center">
                            <div>
                                <h2 class="text-white fw-bold ">Barangay Services </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">


                  
                              <!--start col-->

                              <div class="row  justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($services)): ?>
                                            <?php $no=1; foreach($services as $row): ?>
                                                
        
        
                                              <div class="col-md-5 m-2   border pl-4 pr-4  shadow " >
        
                                           
                                                  <img src="assets/uploads/services/<?php echo $row['image']; ?>" class="img-fluid  mt-3 rounded border border-dark" alt="Responsive image" width="100%" >
                                                  <div class="d-flex flex-column mt-1">
                                                  <!-- <button class="btn btn-primary "><b>Request</b> </button>-->
                                                  
                                                   
        
                                                  </div>
        
                                                  <div class="row justify-content-center">
        
                                                  <h2 style="font-weight:bolder;"><?= $row['document_type'] ?></h2> 
                                                  </div>
                                                   
                                                 
         
        
                                                  <div class="row">
                                                  <div class="d-flex flex-column mt-1 ml-4 mr-4">
                                                  <b>Details:</b>
                                                  <p style="text-align:justify; text-justify: inter-word;"> <?= $row['details'] ?></p>
        
                                                  </div>
                                                
                                                
        
                                                
        
                                                  </div>
        
                                                  <div class="row ">
                                                  <div class="d-flex flex-column mb-4 mt-1 ml-4 mr-4">
                                                   <b>Amount:</b>
        
                                                  </div>
                                                  <div class="col-5">
                                                 <p style="text-align:justify; text-justify: inter-word;">&#8369 <?= $row['amount'] ?></p>
        
                                                  </div>
        
                                                  </div>
        
        
        
                                              
                                              
                                                
        
        
        
                                                                                    
                                                 
                                               
        
                                                
                                                     
                                              
                                           </div>
                                       <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Available Data</h1>
                           
                           <?php endif ?>
                                      </div>
        
        
                                           <!---end table-->
					



                           
                       </div>
                     </div>
						
				</div>
             
                
         
            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->
            
        </div>
        
    </div>

    <?php include 'templates/footer.php' ?>

</body>


</html>