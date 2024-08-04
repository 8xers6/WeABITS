<?php include '../server/server.php' ?>


<script>
    
    
      $(document).ready(function() {
           
			$('.search_select_box select').selectpicker();
        });
        
          $('#hno').change(function(){


var houseno=$("#hno").val();

$.ajax({
type: 'POST',
url: 'model/selectresident.php',
data: { houseno: houseno, },
success: function(response) {
$('#member').html(response);
$('#residentinfo').html('');
}

});

});
      
</script>
 <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Household No</label>
	<div class="search_select_box" id="resident">  <select name="hno" class="form-control " id="hno"  data-live-search="true" required>
									  <option selected="" disabled  value="">-- Choose Householdno -- </option>


<?php




$barno=$_SESSION['bar_no'];
   
   
   
     $street = $conn->real_escape_string($_POST['street']);

   


$squery = mysqli_query($conn,"SELECT * from tblhousehold WHERE bar_no=$barno AND st_id=$street ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
											  
											  
												  <option value="'.$row['h_no'].'">'.$row['household_no'].'</option>    
											  ';
										  }
										  
										  
									
										  
										  

?>

</select> </div></div>