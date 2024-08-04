<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];



$pregno=$_GET['pregno'];

  
$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM `tblpregnant` LEFT JOIN tbl_residents on tblpregnant.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbl_residents.pregnant='Yes' AND tblpregnant.preg_no=$pregno AND tbl_residents.bar_no=$barno; ";
$result = $conn->query($query);
	$resident = $result->fetch_assoc();
     

    $hno 		= $resident['h_no'];
    $resid 		= $resident['res_id'];



    $query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Head' ";
    $result = $conn->query($query);
	$father = $result->fetch_assoc();


    $query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.h_no=$hno AND tbl_residents.relation='Spouse' ";
    $result = $conn->query($query);
	$mother = $result->fetch_assoc();





    $query = "SELECT tblpreg_checkup.checkup_no as checkupno,tblpreg_checkup.date_visit,tblpreg_checkup.type FROM `tblpreg_checkup` LEFT JOIN tblpregnant on tblpregnant.preg_no=tblpreg_checkup.preg_no LEFT JOIN tbl_residents on tblpregnant.res_id=tbl_residents.res_id WHERE tblpregnant.preg_no=$pregno";
                        $result = $conn->query($query);

    $family = array();
	while($row = $result->fetch_assoc()){
		$family[] = $row; 
	}

	
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Verify Resident Details - Weabits</title>
</head>
<body>
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
							<div>

							</div>
						</div>
					</div>
				</div>
				
				<div class="page-inner mt--2">

                

           <!-- Modal -->
		
                   
         
<form id="formapps" enctype="multipart/form-data"  method="post">
<input type="hidden" name="size" value="1000000">
<div class="col-md-12">

<div class="row  p-3 bg-primary-gradient shadow rounded border">


<div class="col-md-12 ">


<h2 class="text-white" style="text-align:center;"><b>Pregnant Resident Information</b></h2>
</div>









</div>

<div class="row  pl-2 pr-2 pt-1 pb-3  bg-white  border shadow rounded justify-content-start">
<div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Resident ID</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['res_id']) ?>" >

                               </div>

<div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Firstname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['firstname']) ?>" >

                               </div>

                               <div class="col-md-2 m-1 p-1 border rounded shadow-sm">
                               <label >Middlename</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['middlename']) ?>" >
                               

                               </div>


                               <div class="col-md-3   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Lastname</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['lastname']) ?>" >

                               </div>




                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>suffix</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['suffix'] ?>" >

                               </div>

                            

                               <div class="col-md-3 m-1 p-1 border rounded shadow-sm">
                               <label >Birth Date</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="  <?php $str = $resident['birthdate']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                               

                               </div>
                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Age</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['age'] ?>" >

                               </div>

                        

                               <div class="col-md-5 m-1 p-1 border rounded shadow-sm">
                               <label >Address</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($resident['household_no']) ?> <?= ucwords($resident['streetname']) ?>" >
                               

                               </div>

                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>Months of Pregnancy</label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['months_pregnant'] ?>" >

                               </div>

                               <div class="col-md-1 m-1 p-1 border rounded shadow-sm">
                               
                               <label>No. of Children </label>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= $resident['no_of_children'] ?>" >

                               </div>


                               <div class="col-md-4   m-1 p-1 border rounded shadow-sm">
                               
                               <label>Husband Name</label>
                               <?php  if(!empty($father)): ?>
                               <input type="text"  class="form-control fw-bold" style="font-size:18px; color:black;" readonly placeholder="" required name="" value="<?= ucwords($father['firstname']) ?> <?= ucwords($father['middlename']) ?> <?= ucwords($father['lastname']) ?>" >
                               <?php  endif ?>
                               </div>




                               </div>


					</div>


                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?> mt-2" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>



                    <div class="card border mt-2">
                               <div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Pregnant Check Up</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                        <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Check up
											</a>
										</div>
                                        <?php endif ?>
									</div>
								</div>
                       
                               <div class="card-body">
                            
                            

                                 
                               <?php if(!empty($family)): ?>
                                            <?php $no=1; foreach($family as $row): ?>
                               <div class="main-form ">
                                <div class="row border rounded m-1">
                                <div class="col-md-12 bg-primary-gradient  ">
                                        <div class="form-group m-0 ">
                                            <b for=""  style="font-size:20px; color:white;">No.<?= $no  ?></b>
                                        
                             
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link "  style="font-size:20px; color:white;" data-original-title="View Resident Info" onclick="editCheckUp(this)" 
                                                                data-checkupno="<?= $row['checkupno'] ?>"   data-type="<?= $row['type'] ?>"  data-datevisit="<?= $row['date_visit'] ?>" 
                                                              
                                                                    >
    


                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>

                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                    <!----
																<a type="button" data-toggle="tooltip" href="generate_residents.php?id=<?= $row['res_id'] ?>" class="btn btn-link btn-info" data-original-title="View Resident Info">
																	<i class="fa fa-file"></i>
																</a>---->

                                                                <a type="button" data-toggle="tooltip" href="model/remove_pregcheckup.php?id=<?= $row['checkupno'] ?>&pregno=<?=$resident['preg_no']?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-white btn-border btn-round btn-sm fw-bold" style="font-size:13px; color:white;" data-original-title="Remove">
																 Remove
																</a>
                                                                <?php endif ?>
													
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""> Type</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?= ucwords($row['type'])  ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="">Date Visit</label>
                                            <input type="text"   class="form-control fw-bold" style="font-size:18px; color:black;" readonly value="<?php $str = $row['date_visit']; $date = date('F j, Y', strtotime($str)); echo $date; ?>" >
                                        </div>
                                    </div>


                                   
                                 
                                 
                                </div>
                            </div>

                            <?php $no++; endforeach ?>
                                           <?php else: ?>
           
        
                                   <h1 colspan="4" class="text-center">No Check up Record</h1>
                           
                           <?php endif ?>
                                           </div>
                        




                   

						
</form>

						</div>
						</div>


                    



                      <!-- Modal -->
                      <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Check up </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addpreg_checkup.php" >
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="hidden" class="form-control"  name="pregno" value="<?=$resident['preg_no'] ?>" required>
                                   <select class="form-control"  name="type"  required>
                                                   <option disabled selected value="">Select Type</option>
                                                   <option value="Blood Pressure">Blood Pressure</option>
                                                   <option value="LMP">Last Menstrual Period</option>
                                                   <option value="EDC">Estimated Date of Confinement</option>
                                                   <option value="Gravida Para">Gravida Para</option>
                                                   <option value="Weight">Weight</option>
                                                   <option value="AOG">Age of Gestation</option>

                                                 
                                                   
                                                       </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Visit</label>
                                    <input type="date" class="form-control"  name="datevisit" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>









    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Check up </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/editcheckup.php" >
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="hidden" class="form-control"  name="pregno" value="<?=$resident['preg_no'] ?>"  required>
                                   <select class="form-control"  name="type" id="type"  required > 
                                                   <option disabled selected value="">Select Type</option>
                                                   <option value="Blood Pressure">Blood Pressure</option>
                                                   <option value="LMP">Last Menstrual Period</option>
                                                   <option value="EDC">Estimated Date of Confinement</option>
                                                   <option value="Gravida Para">Gravida Para</option>
                                                   <option value="Weight">Weight</option>
                                                   <option value="AOG">Age of Gestation</option>

                                                 
                                                   
                                                       </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Visit</label>
                                    <input type="hidden" class="form-control"  name="checkno"  id="checkno" required>
                                    <input type="date" class="form-control"  name="datevisit" id="datevisit" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
							
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>



  <script>
        $(document).ready(function() {
            
            $('.search_select_box select').selectpicker();
        });
    </script>


<script>


$(document).ready(function (e) {
  $("#formapps").on('submit',(function(e) {
   e.preventDefault();


   
   document.getElementById("acceptbtn").style.display = "none";
   document.getElementById("declinebtn").style.display = "none";
  
   document.getElementById("loading").style.display = "block";
   $.ajax({
    url: "model/accept_application.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success: function(data)
       { 
        document.getElementById("loading").style.display = "block";
       
        $('#notiferr').html(data);
     
        if($.trim(data)=="isempty"){
           
   document.getElementById("decline").style.display = "block";
   document.getElementById("accept").style.display = "block";
           
    
            document.getElementById("loading").style.display = "none";


        }else{


            if($.trim(data)=="success"){
                document.getElementById("loading").style.display = "none";
                window.location.pathname = ('/weabits/verify')
        //$('#errwarning').html(data);
        
        //$('#notiferr').html(' <b  class="border p-2 rounded border-success fw-bold pl-5 pr-5" style="color:green; letter-spacing:3px;">VERIFIED <b class="bg-success text-white rounded-circle  pl-1 pr-0">&#10003</b></b>');
  

     
  
      }else{
         
       // $('#notiferr').html('<b style="color:green; font-size:14px;">Verified Success!</b>');
         
      }
        }



    
         
     
       },
       
     
     
               
     });
  }));
 }); 





</script>

</body>
</html>

