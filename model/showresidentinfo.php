<?php include '../server/server.php' ?>



<?php

   
$barno=$_SESSION['bar_no'];
    $resid = $conn->real_escape_string($_POST['resid']);
	$query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM tbl_residents WHERE res_id=$resid AND bar_no=$barno";
    $result = $conn->query($query);
	$resident = $result->fetch_assoc();

?>


<div class="form-group  border rounded mb-2 shadow-sm">
     <label>Relationship to Family: </label>
     <?=$resident['relation']; ?>


     
     </div>

<div class="form-group  border rounded mb-2 shadow-sm">
     <label>Last Name: </label>
     <?=$resident['lastname']; ?>
     <input type="hidden" name="lname" value="<?=$resident['lastname']; ?>">

     
     </div>
     
     
     <div class="form-group  border rounded mb-2 shadow-sm">
     <label>First Name: </label>
     <?=$resident['firstname']; ?>
     

     
     </div>
     
     
     <div class="form-group  border rounded mb-2 shadow-sm">
     <label>Middle Name: </label>
     <?=$resident['middlename']; ?>
     

     
     </div>
     
     <div class="form-group  border rounded mb-2 shadow-sm">
     <label>Suffix: </label>
     <?=$resident['suffix']; ?>
     

     
     </div>

<div class="form-group  border rounded mb-2 shadow-sm">
     <label>Gender: </label>
     <?=$resident['gender']; ?>
     
     
       <label class="ml-3">Birth Place: </label>
     <?=$resident['birthplace']; ?>
     

     
     </div>

 <div class="form-group  border rounded mb-2 shadow-sm">
     <label>Birtdate: </label>
    
      <?php $str = $resident['birthdate']; $date = date('F j, Y', strtotime($str)); echo $date; ?>
      
      <label class="ml-3">Age: </label>
    
 <?=$resident['age']; ?>
     
     </div>
     
     

     
     
<div class="form-group  border rounded mb-2 shadow-sm">
     <label>Citizenship: </label>
     <?=$resident['citizenship']; ?>
     

     
     </div>
     
     
         
     
<div class="form-group  border rounded mb-2 shadow-sm">
     <label>Religion: </label>
     <?=$resident['religion']; ?>
     

     
     </div>
     
     
     
     