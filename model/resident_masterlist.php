<?php include '../server/serverhome.php' ?>  
<?php include 'fetch_brgy_info.php' ?>
<?php






// get Users
$query = "SELECT `res_id`, `firstname`, `lastname`, `middlename`, `house_no`, `street`, `birthdate`, `age`, `birthplace`, `occupation`, `citizenship`, `civil_status`, `religion`, `gender`, `resident_type`, `educational_attainment`, `monthly_income`, `length_of_stay`, `blood_type`, `contact_no`, `username`, `remarks` FROM `tbl_residents` WHERE verification_status='verified' ORDER BY lastname ASC";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$resident = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}






?>





<?php 
    $query = "SELECT * FROM tblbrgy_info";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
		$province = $row['province'];
		$town	= $row['town'];
		$brgy 		= $row['brgy_name'];
		$number =  $row['number'];
		$city_logo 	= $row['city_logo'];
		$brgy_logo		= $row['brgy_logo'];
		$db_txt		= $row['text'];
		$db_img		= $row['image'];
		$email	= $row['emailaddress'];
		$map		= $row['map_url'];
	}

	$pos_q = "SELECT * FROM tblposition ORDER BY `order` ASC";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}

	$chair_q = "SELECT * FROM tblchairmanship";
	$res_q = $conn->query($chair_q);

	$chair = array();
	while($row = $res_q->fetch_assoc()){
		$chair[] = $row; 
	}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>

	<title>Residents Master List  -  Barangay Management System</title>
  
 
 
</head>
                                  


<body>
<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">Print</button>

<div id="printThis">

  
                                    <table style="  text-align: left; width:100%; border-bottom:solid black 3px; ">
  <tr style="  border: 1px solid black; text-align: center; ">
    <th> <img src="../assets/uploads/barangay/<?= $city_logo ?>" class="img-fluid" width="100"></th>
    <th style=" line-height: 1.2; font-family:arial; letter-spacing: 1px;">Republic of the Philippines<br>
                                         Province of <?= ucwords($province) ?><br>
											City of <?= ucwords($town) ?><br>
											Barangay <?= ucwords($brgy) ?><br>
                                           Mobile No. <?= $number ?>
                                           
    <th>  <img src="../assets/uploads/barangay/<?= $brgy_logo ?>" class="img-fluid" width="100"></th>
  </tr>

</table>

<h1 style="text-align:center;">Residents Master List</h1>

                  
										<table style="  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;">
											<thead>
												<tr>
                                                <th style="  border: 1px solid black;
  text-align: center;
  padding: 8px;">No</th>
                                               
                                               
													<th style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">Fullname</th>
                                                    <th style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">House No. & Street  </th>
                                                   
												
													<th style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">Birthdate</th>
                                                   
													<th style="  border: 1px solid black;
  text-align: center;
  padding: 8px;">Age</th>
												
                                                    <th style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">Gender</th>
                                                 
                                                   
                                                  
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
                                                    <td style="  border: 1px solid black;
  text-align: center;
  padding: 8px;"><?= $no ?></td>
                                                    
														<td style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">

                                                          
                                                       

                                                 <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

                                                             
                                             

                                                        </td >

                                                        <td style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">
                                                           
                                                         
                                                            <?= ucwords($row['house_no'].',    '.$row['street']).' ' ?> 

                                                            
                                                        </td>
                                                        <td style="  border: 1px solid black;
  text-align: left;
  padding: 8px;">
                                                          
                                                            <?= $row['birthdate'] ?>
                                                          
                                                        
                                                        </td>
                                                      
														<td style="  border: 1px solid black;
  text-align: center;
  padding: 8px;"><?= $row['age'] ?></td>
                                                        <td style="  border: 1px solid black;
  text-align: left;
  padding: 8px;"><?= $row['gender'] ?></td>
                                                     
                                        


                                                 
													
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
										
										</table>

                                                    </div>




                                                    
		
                                                   
                                     
                                                    <script>
           

           var table = $('#revenuetable').DataTable({
				"order": [[ 0, "desc" ]],
				dom: 'Bfrtip',
				buttons: [
					'print'
				]
				});
    </script>

</body>
</html>


