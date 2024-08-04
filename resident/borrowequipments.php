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
	
	
	
	
	$query2 = "SELECT * FROM tblequipments WHERE  bar_no=$barno ";
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
	<title>Borrow Equipments -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Borrow Equipments</h2>
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
										<div class="card-title fw-bold">Borrow Equipments</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
									
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



