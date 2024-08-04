<?php include '../server/server.php' ?>


<script>
    
    
      $(document).ready(function() {
           
			$('.search_select_box select').selectpicker();
        });
        
        
           $('#comresid').change(function(){


var comresid=$("#comresid").val();

$.ajax({
type: 'POST',
url: 'model/showcomresidentinfo.php',
data: { comresid: comresid, },
success: function(response) {
$('#comresidentinfo').html(response);

}

});

});
        
        
      
</script>
 <div class="form-group  border rounded mb-2 shadow-sm">
                               <label>Choose Resident</label>
	<div class="search_select_box" >  <select name="comresid" class="form-control " id="comresid"  data-live-search="true" required>
									  <option selected="" disabled value="">-- Choose Resident -- </option>


<?php




$barno=$_SESSION['bar_no'];
   
   
     $houseno = $conn->real_escape_string($_POST['comhouseno']);

$squery = mysqli_query($conn,"SELECT * from tbl_residents  LEFT JOIN tblhousehold ON tblhousehold.h_no=tbl_residents.h_no 
										  LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id
										  WHERE tbl_residents.bar_no=$barno  AND tbl_residents.verify_status='verified' AND tbl_residents.h_no=$houseno");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
											  
											  
												  <option value="'.$row['res_id'].'">RES ID:'.$row['res_id'].' | '.$row['lastname'].', '.$row['firstname'].' '.$row['middlename'].' '.$row['suffix'].'</option>    
											  ';
										  }
										  
										  
										  echo' ';
										  
										  

?>

</select> </div></div>