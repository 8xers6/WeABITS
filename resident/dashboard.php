<?php include 'server/server.php' 

?>


<?php


$resid=$_SESSION['resid'];
$barno=$_SESSION['barno'];


	$query = "SELECT * FROM tbl_residents WHERE res_id=$resid AND bar_no=$barno";
    $result = $conn->query($query);
	$resident = $result->fetch_assoc();

	

	
    



	if(isset($_SESSION['role'])){
  
		if($_SESSION['role'] =='Resident'){
          
			$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials  LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE  tblofficials.bar_no=$barno  ";
		}else{
			$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE tblofficials.bar_no=$barno ";
		}
	}else{
		$off_q = "SELECT *,tblofficials.id as id,tblchairmanship.id as chair_id FROM tblofficials  LEFT JOIN tblchairmanship ON tblchairmanship.id=tblofficials.chairmanship WHERE tblofficials.bar_no=$barno ";
	}
	
	$res_o = $conn->query($off_q);

	$official = array();
	while($row = $res_o->fetch_assoc()){
		$official[] = $row; 
	}



 
 
	$query1 = "SELECT * FROM tblcertificates WHERE  bar_no=$barno order by certificate asc";
    $res = $conn->query($query1);
 
 
 	$certificate = array();
	while($row = $res->fetch_assoc()){
		$certificate[] = $row; 
	}
	
	
		$query1d = "SELECT * FROM `tbldoctors` WHERE `bar_no`=$barno";
    $resd = $conn->query($query1d);
 
 
 	$doctor = array();
	while($row = $resd->fetch_assoc()){
		$doctor[] = $row; 
	}
	
	
	
	$query2 = "SELECT * FROM tblequipments WHERE  bar_no=$barno LIMIT 3 ";
    $res2 = $conn->query($query2);
 
 
 	$equipment = array();
	while($row = $res2->fetch_assoc()){
		$equipment[] = $row; 
	}

?>
        <?php if(!empty($resident['birthdate'])): ?>

           
          


<?php if($_SESSION['role']=='Resident'): ?>

	



	

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard -  Barangay Management System</title>
</head>
<body>
	<?php //include 'templates/loading_screen.php' ?>

	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
									<div class="card">
										   <div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold justify-content-center">Announcements & Events</div>
									
											<div class="card-tools">
											<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >

<input type="text" class="form-control m-0 border-dark  fw-bold"  id="search" autocomplete="off"  placeholder="Search Announcements" style="width:300px; ">

   
                                        </div>

                                      
											</div>
									
									</div>
								</div>
								<div class="card-body">

								<div class="row md-12  mt-3 mb-3 justify-content-center" id="search_result"></div>  

								</div>
						</div>
    
    
    <!----
						<div class="card">
								<div class="card-body">
									<div class="d-flex flex-wrap pb-2 justify-content-center">
										
									
										<div class="col text-center">
                                       
                                        <img src="../assets/uploads/<?= $busername ?>/barangayinfo/<?=$brgylogo ?>" class="img-fluid rounded-circle" >
                                        <h2 class="fw-bold ">Brgy. <?= ucwords($barangayname)  ?>, <?= ucwords($city) ?>, <?= ucwords($province) ?>   </h2>
										</div>
										
									</div>
								</div>
						</div>
--->

						<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Barangay Officials</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											
											</div>
										<?php endif?>
									</div>
								</div>
						<div class="card-body">
                                        <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($official)): ?>
                                            <?php $no=1; foreach($official as $row): ?>
                                                
        
        
                                              <div class="row-md-5 m-1  mb-3 border  rounded shadow " style="width:300px;">
        
                                             
                                                  
        
                                                  <div class="row-md-10 ">
                                                    
                                               
                                                 

                                                            <div class="row  justify-content-center p-4  ml-0  mr-0   rounded bg-primary-gradient">


                                                            
                                                            <?php if(!empty($row['picture'])): ?>

<img src="<?= preg_match('/data:image/i', $row['picture']) ?  $row['picture'] : '../assets/uploads/'. $busername.'/official/'. $row['picture'] ?>" alt="..." class="avatar-img rounded "  style="position: relative; top:40px; width:180px; height:180px; border-radius:0px;">
<?php else: ?>
<img src="assets/img/person.png" alt="..." class="avatar-img rounded " style="position: relative; top:40px; width:180px; height:180px; ">
<?php endif ?> </td>

                                                            
                                                                               

                                                                                    </div>
                                                                                    <div class="row justify-content-center mt-3">


                                                                                    <h3><b><?= $row['name'] ?></b></h3>


                                                                                    </div>

                                                                                    <div class="row  justify-content-center ">


                                                            
                                                                                    <h3><?= $row['position'] ?></h3>

                                                                                    </div>
             
                                                
                                                 
         

           
                                                    
                                            
                                                                      
                                                                  
        
                                                  </div>


                                                  <div class="row justify-content-center ">

                                               
                                                  <div class="col-5 justify-content-center mb-3 ml-3 ">


                                                                    
                                                            </div>
                                                          


                                                                <div class="col-3 mb-3">
                                                              

                              
                                                                

                                                                                    </div>


                                                                                    <div class="col-3 ">
                                                                                    <?php if($_SESSION['role']=='administrator'):?>
																	<a type="button" data-toggle="tooltip" href="model/remove_official.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this official?');" class="btn text-danger fw-bold " data-original-title="Remove">
																		<i class="fa fa-times "></i>
																	</a>
																	<?php endif ?>
                                                                                            </div>

                                                                        

                                                            </div>


                                                            
                                                 
                                                  
        
                                                 
                                                 
        
        
                                                
                                                                                    
                             
                                                
                                                
                                              
                                           </div>
                                       <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Available Data</h1>
                           
                           <?php endif ?>
                                      </div>


										   </div>

										   </div>
										   
										   
										   
										   		<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Request Certificates</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											
											</div>
										<?php endif?>
									</div>
								</div>
						<div class="card-body">
                                        <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($certificate)): ?>
                                            <?php $no=1; foreach($certificate as $row): ?>
                                                
             <form action="submitreq.php" method="POST">
                 
                 <input type="hidden" name="cert_id" value="<?= $row['cert_id'] ?>">
               
        <button  href="save_request" class=" btn-light" >
                                              <div class="row-md-5    border  rounded shadow " style="width:280px; ">
        
                                             
                                                  
        
                                                  <div class="row-md-10 ">
                                                    
                                               
                                                 

                                                            <div class="row  justify-content-center p-2  ml-0  mr-0   rounded bg-primary-gradient">


                                                            
                                               <i class='fas fa-file-contract text-white' style="font-size:100px;"></i>

                                                                               

                                                                                    </div>
                                                                                           
                                                                 
                                                                                    <div class="row justify-content-center ">

                                                                                    <h3><b><?= $row['certificate'] ?></b></h3>


                                                                                    </div>

                                                                                    <div class="row  justify-content-center ">


                                                            
                                                                                    <h3>&#8369 <?=  number_format($row['amount'],2) ?></h3>

                                                                                    </div>
             
                                                       
                                                 
         

           
                                                    
                                            
                                                                      
                                                                  
        
                                                  </div>



                                                            
                                                 
                                                  
        
                                                 
                                                 
        
        
                                                
                                                                                    
                             
                                                
                                                
                                              
                                           </div>
                                           </button>
                                           </form>
                                       <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Available Data</h1>
                           
                           <?php endif ?>
                                      </div>


										   </div>

										   </div>
										   
										   
										   		<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Doctor Schedule</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											
											</div>
										<?php endif?>
									</div>
								</div>
						<div class="card-body">
                                        <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($doctor)): ?>
                                            <?php $no=1; foreach($doctor as $row): ?>
                                                
             <form action="doctordetails.php" method="POST">
                 
                 <input type="hidden" name="id" value="<?= $row['doc_id'] ?>">
               
        <button  href="save_request" class=" btn-light" >
                                              <div class="row-md-5    border  rounded shadow " style="width:280px; ">
        
                                             
                                                  
        
                                                  <div class="row-md-10 ">
                                                    
                                               
                                                 

                                                            <div class="row  justify-content-center  ml-0  mr-0   rounded">


                                                            
                                             <?php if(!empty($row['image'])): ?>

<img src="<?= preg_match('/data:image/i', $row['image']) ?  $row['image'] : '../assets/uploads/'. $busername.'/doctor/'. $row['image'] ?>" alt="..."  height="200" width="100%" >
<?php else: ?>
<img src="assets/img/person.png" alt="..." class="avatar-img rounded ">
<?php endif ?>

                                                                               

                                                                                    </div>
                                                                                           
                                                                 
                                                                                    <div class="row justify-content-center ">

                                                                                    <h3 style="color:blue;"><b>Dr.  <?= $row['firstname'] ?> <?= $row['lastname'] ?></b></h3>


                                                                                    </div>

                                                                                    <div class="row ml-3 justify-content-center ">


                                                              <b style="color:green;"> <?= $row['specialization'] ?></b>
                                                                             
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                    
                                                                                       <div class="row ml-3 justify-content-start ">

      <p style="color:blue;"><b> <?= $row['timeavailable'] ?></b></p>
                                                            
                                                                                 
                                                                                    </div>
             
             
                                                       
                                                 
         

           
                                                    
                                            
                                                                      
                                                                  
        
                                                  </div>



                                                            
                                                 
                                                  
        
                                                 
                                                 
        
        
                                                
                                                                                    
                             
                                                
                                                
                                              
                                           </div>
                                           </button>
                                           </form>
                                       <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Available Data</h1>
                           
                           <?php endif ?>
                                      </div>


										   </div>

										   </div>
										   
										   
										   
										   
										   
										   			   		<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Borrow Equipments</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											<a type="button" href="borrowequipments.php" class="btn btn-link fw-bold"  style="font-size:20px;">Show More <i class="fas fa-arrow-right"></i></a>
											</div>
										<?php endif?>
									</div>
								</div>
						<div class="card-body">
                                        <!--start col-->

                                <div class="row md-12 justify-content-center" >
                                            
                       
                        
                                            <?php if(!empty($equipment)): ?>
                                            <?php $no=1; foreach($equipment as $row): ?>
                                            
                                            
                                                <form action="submitborrow.php" method="POST">
                                                    
                                                     <input type="hidden" name="equipno" value="<?= $row['equip_no'] ?>">
        <button  style="border-radius:20px;" class="btn btn-light" >
                                            
                                            
                                            <div class="row-md-5  " style="width:280px; "><div class="row-md-10   ">

    <div class="row justify-content-center  ml-0  mr-0    "  style="pointer-events: none;">
  
    <img src="<?= preg_match('/data:image/i', $row['image']) ?  $row['image'] : '../assets/uploads/'.$busername.'/equipment/'. $row['image'] ?>" class="" alt="Responsive image" width="100%" height="160" style="border-radius:20px;">


    <h3 class="mr-5 text-primary"><b><?= $row['equipment_name'] ?></b></h3><h3 class="ml-5 text-success">Qty: <b><?= $row['quantity'] ?></b></h3>
    
    <div class="col">
        
         <p class="" style="text-align:justify; line-height:1;"><?=  mb_strimwidth($row['description'], 0, 50, "..."); ?></p>
    </div>
   
     
  
    </div>
  

</div>
                                                
        
        


                                                            
                                                 
                                                  
        
                                                 
                                                 
        
        
                                                
                                                                                    
                             
                                                
                                                
                                              
                                           </div>
                                              </button>
                                           </form>
                                       <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Available Data</h1>
                           
                           <?php endif ?>
                                      </div>


										   </div>

										   </div>



					
		<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Local Goverment Mission & Vision Statement</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											
											</div>
										<?php endif?>
									</div>
								</div>
						<div class="card-body">
                                          
						
						<div class="row   justify-content-center   bg-white  text-center   ">
                                 <div class="col-md-5  m-1   border rounded shadow-sm ">

								 <h1 class="fw-bold" >Mission</h1>
                                     <p class="p-1" style=" font-size:16px; text-align:center; text-justify: inter-word;"><?= !empty($mission) ? $mission : 'Statement Here' ?></p>

                             

 
                                    </div>

                                    <div class="col-md-5 p-2 m-1  border rounded shadow-sm">

                                  
                 
									<h1 class="fw-bold">Vision</h1>
                                     <p  class="p-3" style="font-size:16px; text-align:center; text-justify: inter-word;"><?= !empty($vision) ? $vision : 'Statement Here' ?></p>


   </div>


                                   

                            </div>

						




										   </div>

										   </div>





			

										   
	</div>




	
	<!-- Main Footer -->
	<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
	<?php include 'templates/footer.php' ?>




	<script>



$(document).ready(function(){



	$.ajax({

url:"announcementlivesearch.php",
method:"POST",
data:{searchannouncement:$(this).val()},

success:function(result ){

    $("#search_result").html(result);


}


});


$("#search").keyup(function(){



if($(this).val()!=""){






            $.ajax({

            url:"announcementlivesearch.php",
            method:"POST",
            data:{searchannouncement:$(this).val()},

            success:function(result){

                //$("#search_result").html(result);
				$("#search_result").html(result);


            }

    
            });

        }else{

     $.ajax({

                url:"announcementlivesearch.php",
                method:"POST",
                data:{searchannouncement:$(this).val()},

                success:function(result ){

                    $("#search_result").html(result);


                }


                });




        }
   


});

});




</script>
</body>
</html>



<?php else: header('Location: ../dashboard.php'); ?>
   

<?php endif ?>



<?php endif ?>



