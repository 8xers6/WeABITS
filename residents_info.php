<?php include 'server/server.php' ?>
<?php 

    $state = $_GET['state'];

    $barno=$_SESSION['bar_no'];
    
    if($state=='male'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id WHERE tbl_residents.gender='Male' AND tbl_residents.alive=1 AND tbl_residents.bar_no=$barno";
        $result = $conn->query($query);
    }elseif($state=='female'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id WHERE tbl_residents.gender='Female' AND tbl_residents.alive=1  AND tbl_residents.bar_no=$barno";
        $result = $conn->query($query);
    }
    elseif($state=='senior'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=60 AND tbl_residents.alive=1   AND tbl_residents.bar_no=$barno";
        $result = $conn->query($query);
    } elseif($state=='pwd'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.pwd NOT IN ('Not Applicable') AND tbl_residents.alive=1";
        $result = $conn->query($query);
    }elseif($state=='deceased'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id WHERE  tbl_residents.alive=0  AND tbl_residents.bar_no=$barno";
        $result = $conn->query($query);
    }else if($state=='all'){
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tbl_residents LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id WHERE tbl_residents.alive=1   AND tbl_residents.bar_no=$barno";
        $result = $conn->query($query);
     
    }
	
    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Information -  Barangay Management System</title>
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
				<div class="page-inner">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif ?>
                    <?php if(isset($_SESSION['role']) && isset($_SESSION['role']) =='administrator'):?>
                    <div class="row mt--2">
                        
                       
                        
                       
                    </div>
                    <?php endif ?>
                    
                    <div class="row mt--2">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">
                                            <?php 
                                                if($state=='male'){
                                                    echo 'All Male Resident';
                                                }elseif($state=='female'){
                                                    echo 'All Female Resident';
                                                }
                                                elseif($state=='senior'){
                                                    echo 'All Senior Citizen';
                                                }
                                                elseif($state=='pwd'){
                                                    echo 'All PWD';
                                                }  elseif($state=='deceased'){
                                                    echo 'All Deceased';
                                                }else{
                                                    echo 'All Resident';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="display table table-striped">
                                            <thead>
                                                <tr>
                                                <th scope="col">Fullname</th>
                                                    <th scope="col">House No. & Street  </th>
                                                   
												
													<th scope="col">Birthdate</th>
                                                   
													<th scope="col">Age</th>
												
                                                    <th scope="col">Gender</th>
                                                    <?php
                                                    
                                                    if($state=='pwd'){
                                                    echo '<th scope="col">PWD</th>';
                                                }  
                                                 
                                                    
                                                    ?>
                                                
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($resident)): ?>
                                                    <?php $no=1; foreach($resident as $row): ?>
                                                    <tr>
                                                    <td>
                                                        <div  style="width:210px;">
                                                          
                                                       


                                                        <?php if(!empty($row['res_picture'])): ?>

<img src="<?= preg_match('/data:image/i', $row['res_picture']) ?  $row['res_picture'] : "./assets/uploads/resident_profile/".$row['res_id']."/". $row['res_picture'] ?>" alt="..." class="avatar-img rounded-circle "  style="position: relative;  width:50px; height:50px; border-radius:50px;">
<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
<?php else: ?>
<img src="assets/img/person.png" alt="..."class="img-fluid rounded-circle  " width="50" > <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
<?php endif ?> 
                                                             
                                                                
                                                              
                                                        </div>

                                                        </td>

                                                        <td>
                                                            <div style="width:140px;">
                                                         
                                                            <?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

                                                             </div>
                                                        </td>
                                                        <td>
                                                            <div style="width:90px;">
                                                            <?= $row['birthdate'] ?>
                                                              </div>
                                                        
                                                        </td>
                                                      
														<td><?= $row['age'] ?></td>
                                                        <td><?= $row['gender'] ?></td>
                                                        
                                                        <?php   if($state=='pwd'):?>
                                                        
                                                         <td><?= $row['pwd'] ?></td>
                                                        <? endif ?>
                                                        
                                                       
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Fullname</th>
                                                    <th scope="col">House No. & Street  </th>
                                                   
												
													<th scope="col">Birthdate</th>
                                                   
													<th scope="col">Age</th>
												
                                                    <th scope="col">Gender</th>
                                                      <?php
                                                    
                                                    if($state=='pwd'){
                                                    echo '<th scope="col">PWD</th>';
                                                }  
                                                 
                                                    
                                                    ?>
                                                
                                         
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-md-3">
                            <div class="card card-stats card-<?php 
                                                    if($state=='male'){
                                                        echo 'primary';
                                                    }elseif($state=='female'){
                                                        echo 'danger';
                                                    }elseif($state=='senior'){
                                                    echo 'warning';
                                                    }elseif($state=='pwd'){
                                                        echo 'secondary';
                                                    }elseif($state=='deceased'){
                                                        echo 'gray';
                                                    }else{
                                                        echo 'primary';
                                                    }?> card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <?php 
                                                    if($state=='male'){
                                                        echo '<i class="flaticon-user"></i>';
                                                    }elseif($state=='female'){
                                                        echo ' <i class="icon-user-female"></i>';
                                                    }
                                                    elseif($state=='senior'){
                                                        echo ' <i class="fab fa-jenkins"></i>';
                                                    }  elseif($state=='pwd'){
                                                        echo ' <i class="fas fa-wheelchair"></i>';
                                                    } elseif($state=='deceased'){
                                                        echo ' <i class="fas fa-people-carry"></i>';
                                                    }else{
                                                        echo '<i class="flaticon-users"></i>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-5 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">
                                                <?php 
                                                    if($state=='male'){
                                                        echo 'All Male Resident';
                                                    }elseif($state=='female'){
                                                        echo 'All Female Resident';
                                                    }elseif($state=='senior'){
                                                        echo 'All Senior Citizen';
                                                    } elseif($state=='pwd'){
                                                        echo 'All PWD';
                                                    }elseif($state=='deceased'){
                                                        echo 'All Deceased';
                                                    }else{
                                                        echo 'All Resident';
                                                    }
                                                ?>
                                                </p>
                                                <h4 class="card-title"><?= number_format(count($resident)) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
</body>
</html>