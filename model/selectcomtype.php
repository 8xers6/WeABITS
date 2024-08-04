<?php include '../server/server.php' ?>




<?php


$barno=$_SESSION['bar_no'];
$comtype=$_POST['comtype'];
?>


<script>
    
    
    			$(document).ready(function() {


				$('.search_select_box select').selectpicker();
            });
</script>
<script>

        $('#comstreetid').change(function(){


var comstreet=$("#comstreetid").val();

$.ajax({
type: 'POST',
url: 'model/selectcomhouseno.php',
data: { comstreet: comstreet, },
success: function(response) {
$('#comhouseno').html(response);

$('#commember').html('');
$('#comresidentinfo').html('');

}

});

});



  




    </script>

<?php if($comtype=='Resident'):?>

  <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Street</label>
                          	<div class="search_select_box">
                                  
								      <select  class="form-control " id="comstreetid" data-live-search="true" required>
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
<?php if($comtype=='Non-resident'):?>

	<div class="form-group">
											<label>Firstname</label>
										
											<input type="text" class="form-control" placeholder="Enter  Firstame" name="comfirstname"  required>



										</div>
										
										
											<div class="form-group">
											<label>Middlename</label>
										
											<input type="text" class="form-control" placeholder="Enter Middleame" name="commiddlename"  required>



										</div>
										
											<div class="form-group">
											<label>Lastname</label>
										
											<input type="text" class="form-control" placeholder="Enter Lastame" name="comlastname"  required>



										</div>
										  <div class="form-group ">
                                                <label class=" fw-bold">Suffix</label>
                                                <select class="form-control" name="comsuffix" >
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
										
											<input type="number" min="0" class="form-control" placeholder="Enter Age" name="comage" required>



										</div>
                                           	<div class="form-group">
											<label>Contact No.</label>
										
											<input type="number" min="0" class="form-control" placeholder="Enter Contact No" name="comcontact" required>



										</div>
										
                                           		<div class="form-group">
											<label>Complete Address:</label>
										
											<input type="text" class="form-control"  name="comaddress" placeholder=" House# Street, Barangay, City/Municipality, Province" required>



										</div>

										<?php endif ?>