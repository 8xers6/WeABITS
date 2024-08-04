<?php include 'server/server.php' ?>
<?php 




    

if(!empty($_POST['equipno'])){
    
    
    $equipno=$_POST['equipno'];
	$query = "SELECT * FROM tblequipments WHERE equip_no=$equipno";
	$result = $conn->query($query);
	$equipment = $result->fetch_assoc();


}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Borrow Equipment -  Barangay Management System</title>

	
</head>
<body >
	<?php include 'templates/loading_screen.php' ?>

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
                      	<h2 class="text-white fw-bold"><button type="button" class="btn btn-primary shadow-sm fw-bold border "  onclick="goBack()">Go back</button></h2>
                      	
                      	<h2 class="text-white fw-bold ml-3"></h2>
						</div>
					</div>
				</div>
                <div id="success">
              
				<div class="page-inner mt--2">
                <div class="row mt--2">
						<div class="col-md-6">
						
 
                   

                           
						</div>


                        <div class="col-md-6">

							<div class="card border">
								<div class="card-header bg-primary-gradient">
									<div class="card-head-row">
										<div class="card-title fw-bold text-white">Borrow Equipment</div>
										<div class="card-tools">
											
										</div>
									</div>
								</div>
								<div class="card-body" >
                             
  <form id="borrowformid"   method="POST"  enctype="multipart/form-data" >
                              
<img src="<?= preg_match('/data:image/i', $equipment['image']) ?  $equipment['image'] : '../assets/uploads/'.$busername.'/equipment/'. $equipment['image'] ?>" class="" alt="Responsive image" width="100%" height="360" style="border-radius:20px;">
                                <div class="form-group">
                                    <label>Equipment Name.</label>
                                    <h1><?=$equipment['equipment_name'] ?></h1>
                                    <input type="hidden" class="form-control"  name="equipno" value="<?=$equipment['equip_no']; ?>" required>


						


                                </div>
                                  <div class="form-group">
                                    <label>Description.</label>
                                    <p style="text-align:justify; color:gray;"><?=$equipment['description'] ?></p>
                               

						


                                </div>
                                   <div class="form-group">
                                    <label>Available Quantity:  <?=$equipment['quantity']; ?> </label>
                                   
                                </div>

                             

                                <div class="form-group">

                                <label>Purpose</label>
                                <textarea type="text" class="form-control"  name="purpose" placeholder="Enter your purpose" autocomplete="off" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control"  name="qty" autocomplete="off" placeholder="Enter your quantity"  required min="1" >
                                </div>

    <div class="form-group">
                                    <label>Date to Borrow</label>
                                    <input type="date" class="form-control" min="<?=date("Y-m-d")?>" max=""  name="datetoborrow" autocomplete="off" required min="1" >
                                </div>

                                <div class="form-group">
                                    <label>Date to Return</label>
                                    <input type="date" class="form-control" min="<?=date("Y-m-d")?>" max=""  name="datereturn" autocomplete="off" required min="1" >
                                </div>

                                
                            
                        </div>
<div  id="errwarning" class="text-center bg-danger "></div>
                        <div class="modal-footer">
                            
          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to borrow this equipment?');">Request</button>
                  
                                                   
                        </div>
                        </form>

							</div>
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


<script>
$(document).ready(function (e) {
    

    
  $("#borrowformid").on('submit',(function(e) {
   e.preventDefault();
 

   $.ajax({
          url: "model/save_borrowed.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success:  function(data)
       { 
       
         


        //$('#errwarning').html(data);

        if($.trim(data)=="zero"){
          $('#errwarning').html("<b class='text-white'>Quantity cant be zero</b> ");
        }else{

        if($.trim(data)=="unavailable"){
          $('#errwarning').html("<b class='text-white'>Equipment Unavailable</b> ");
        }else{
        if($.trim(data)=="insufficient"){
          $('#errwarning').html("<b class='text-white'>Insufficient Equipment</b> ");
        }else{


        

      if($.trim(data)=="success"){
        //$('#errwarning').html(data);
       
        window.location.pathname = ('/resident/borrowed_items')
        
  
  
      }else{
         
        
         
      }
     
       
		
  }

}
       }
         
     
       },
       
     
     
               
     });
  }));
 }); 





</script>

</html>


