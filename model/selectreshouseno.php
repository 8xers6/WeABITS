<?php include '../server/server.php' ?>


<script>
    
    
      $(document).ready(function() {
           
			$('.search_select_box select').selectpicker();
        });
        
          $('#reshno').change(function(){


var reshouseno=$("#reshno").val();

$.ajax({
type: 'POST',
url: 'model/selectresresident.php',
data: { reshouseno: reshouseno, },
success: function(response) {
$('#resmember').html(response);
$('#resresidentinfo').html('');
}

});

});
      
</script>
 <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Household No</label>
	<div class="search_select_box" id="resident">  <select name="reshno" class="form-control " id="reshno"  data-live-search="true" required>
									  <option selected="" disabled  value="">-- Choose Householdno -- </option>


<?php




$barno=$_SESSION['bar_no'];
   
   
   
     $street = $conn->real_escape_string($_POST['resstreet']);

   


$squery = mysqli_query($conn,"SELECT * from tblhousehold WHERE bar_no=$barno AND st_id=$street ");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
											  
											  
												  <option value="'.$row['h_no'].'">'.$row['household_no'].'</option>    
											  ';
										  }
										  
										  
									
										  
										  

?>

</select> </div></div>