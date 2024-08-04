<?php include 'server/serverhome.php' ?>
<?php


   $id 	= $conn->real_escape_string($_GET['id']);
  
     
  

      $query = "SELECT * FROM tblannouncement Where id=$id";
      $result = $conn->query($query);
  
      $announcement = array();
      while($row = $result->fetch_assoc()){
          $announcement[] = $row; 
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
<a class="text-white"  href="announcementpage?search="><h2  style="font-weight:bolder;">Announcement</h2></a>
</li>
<li class="nav-item  p-4">
<a  class="text-white"  href="serviceshome"><h2>Services</h2></a>
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
                                <h2 class="text-white fw-bold ">Announcements </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">
                  

                        <?php include 'templates/loading_screen.php' ?>
                        <div class="row md-9 bg-white    justify-content-center">
                            <div class="col-md-3 pb-3 pt-3">
    
                             
                            <button type="button" class="form-control bg-primary-gradient pt-3 pb-3 text-white  fw-bold" style="font-size:20px; font-weight:bold; border-radius:10px;" onclick="goBack()">Back</button>
                       
                          

                         </div>


                       
                         </div>
                       

                    
                      
                          
                       
                        <div class="row md-12  bg-white pr-1   justify-content-center">
                      
                       
                        
                                                    <?php if(!empty($announcement)): ?>
                                                    <?php $no=1; foreach($announcement as $row): ?>
                                                    
                                                     
							                    <div class="col-md-5  m-1 pb-3  pt-3 pr-4 border rounded shadow-sm">
                                                <?php if($row['picture']!='blank.png'): ?>

<img src="<?= preg_match('/data:image/i', $row['picture']) ?  $row['picture'] : 'assets/uploads/announcement/'. $row['picture'] ?>" alt="..." class="img-fluid" width="100%">
<?php else: ?>
<img src="assets/uploads/announcement/blank.png" alt="..." class="img-fluid" width="100%" style="opacity:0.6;">
<?php endif ?>
                                              
                                                              
                                                                                
                                        
						                  	</div>

                                              <div class="col-md-5  m-1 pb-3  pt-3 pr-4 border rounded shadow-sm"   >
                                             
                                                <h1 style="font-size:40px; border-bottom:solid black 4px;" ><?= $row['activityname'] ?></h1>
                                               <b style="font-size:20px;">  Date: <?=date("M d,Y",strtotime($row['dateofactivity'])) ?></b><br>
                                             
                                             <b  style="font-size:20px;">   Place: <?=$row['placeofactivity'] ?></b><br>
                                                <b  style="font-size:20px;"> By:<?=$row['organizername'] ?></b><br>
                                                <b  style="font-size:20px;">Description:</b><br> <p  style="font-size:20px; text-align:justify; text-justify: inter-word;"><?=$row['description']?></p><br>
                                                              
                      
                                        
						                  	</div>
                             <?php $no++; endforeach ?>
                                                <?php else: ?>
                                

                                                        <h1 colspan="4" class="text-center">No Available Data</h1>
                                                
                                                <?php endif ?>
                            </div>



                           
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