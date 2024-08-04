<?php include '../server/server.php' ?>




<?php


$barno=$_SESSION['bar_no'];
$restype=$_POST['restype'];
?>


<script>
    
    
    			$(document).ready(function() {

				$('.search_select_box select').selectpicker();
            });
</script>

<script>

        $('#resstreetid').change(function(){


var resstreet=$("#resstreetid").val();

$.ajax({
type: 'POST',
url: 'model/selectreshouseno.php',
data: { resstreet: resstreet, },
success: function(response) {
$('#reshouseno').html(response);

$('#resmember').html('');
$('#resresidentinfo').html('');

}

});

});



  




    </script>

<?php if($restype=='Resident'):?>

  <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Street</label>
                          	<div class="search_select_box">
                                  
								      <select  class="form-control " id="resstreetid" data-live-search="true" required>
									  <option selected disabled value="">-- Choose Street -- </option>
									  <?php
								
									       
										  $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno; ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>
                               </div>


<?php endif ?>
<?php if($restype=='Non-resident'):?>

	<div class="form-group">
											<label>Firstname</label>
										
											<input type="text" class="form-control" placeholder="Enter  FIrstname" name="resfirstname"  required>



										</div>
										
										
											<div class="form-group">
											<label>Middlename</label>
										
											<input type="text" class="form-control" placeholder="Enter Middlename" name="resmiddlename"  required>



										</div>
										
											<div class="form-group">
											<label>Lastname</label>
										
											<input type="text" class="form-control" placeholder="Enter Lastame" name="reslastname"  required>



										</div>
										  <div class="form-group ">
                                                <label class=" fw-bold">Suffix</label>
                                                <select class="form-control" name="ressuffix" >
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                           </div>
                                           
                                           	<div class="form-group">
											<label>Age</label>
										
											<input type="number" min="0" class="form-control" placeholder="Enter Age" name="resage" required>



										</div>
                                           	<div class="form-group">
											<label>Contact No.</label>
										
											<input type="number" min="0"  class="form-control" placeholder="Enter Contact No" name="rescontact" required>



										</div>
										
                                           		<div class="form-group">
											<label>Complete Address:</label>
										
											<input type="text" class="form-control"  name="resaddress" placeholder=" House# Street, Barangay, City/Municipality, Province" required>



										</div>

										<?php endif ?>