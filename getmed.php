<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];






$query = "SELECT * FROM `tblmedicine`  LEFT JOIN   med_category on tblmedicine.category_id=med_category.category_id LEFT JOIN type_list on tblmedicine.type_id=type_list.type_id  WHERE tblmedicine.bar_no=$barno";
$result = $conn->query($query);

$medicine= array();
while($row = $result->fetch_assoc()){
$medicine[] = $row; 
}



    $query1= "SELECT * FROM `med_category` WHERE `bar_no`=$barno";
    $result1 = $conn->query($query1);

$category= array();
while($row = $result1->fetch_assoc()){
$category[] = $row; 
}



$query2= "SELECT *FROM type_list WHERE bar_no=$barno";
$result2= $conn->query($query2);

$type_list= array();
while($row = $result2->fetch_assoc()){
$type_list[] = $row; 
}


$query = "SELECT * FROM `expired_product` LEFT JOIN tblmedicine on tblmedicine.med_no=expired_product.med_no WHERE tblmedicine.bar_no =$barno";
$result = $conn->query($query);

$expired= array();
while($row = $result->fetch_assoc()){
$expired[] = $row; 
}





	$query1 = "UPDATE tblbarangay SET  `equip`='1'  WHERE bar_no=$barno;";

		if($conn->query($query1) === true){

		
				
			
		}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Medicine Maintenance- Weabits</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
		<!-- Main Header -->
		<?php //include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php //include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="">
			<div class="content">
      <div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

                    
							<div>
	<h2 class="text-white fw-bold">Set Up Medicine </h2>
							</div>
							
						</div>
								 <a href="model/logout.php" class="text-white" onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        Sign Out
                    </a>
					</div>
				</div>
				
				<div class="page-inner ">

              

           <!-- Modal -->
		
 


                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?> mt-2" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>



                            


                          

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Category</div>
										<div class="card-tools">
											<a href="#addcategory" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Category
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                             
                                                    <th scope="col">Name</th>
                                             
                                                 
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($category)): ?>
                                                    <?php $no=1; foreach($category as $row): ?>
                                                    <tr>
                                                        <td><?= $row['category_name'] ?></td>
                                                     
                                                        <td>
                                                            <div class="form-button-action">
                                                       
                                                                <a type="button" data-toggle="tooltip" href="model/remove_medicine.php?id=<?= $row['category_id'] ?>&state=category" onclick="return confirm('Are you sure you want to delete this Medicine?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Name</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
                            </div>	



                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Type</div>
										<div class="card-tools">
											<a href="#addtype" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Type
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                             
                                                <th scope="col">Name</th>
                                               
                                            
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($type_list)): ?>
                                                    <?php $no=1; foreach($type_list as $row): ?>
                                                    <tr>
                                                        <td><?= $row['type_name'] ?></td>
                                                                                     
                                                  
                                                        <td>
                                                            <div class="form-button-action">
                                                       
                                                                <a type="button" data-toggle="tooltip" href="model/remove_medicine.php?id=<?= $row['type_id'] ?>&state=type" onclick="return confirm('Are you sure you want to delete this Medicine?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                              
                                                <th scope="col">Name</th>
                                               
                                            
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
                            </div>	



                            
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Medicine List</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Medicine
											</a>
											
											
											<a type="button" href="model/alldone" class="ml-3 btn btn-primary text-white fw-bold" onclick="return confirm('Are you sure you want to proceed?');">Next</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="medicine">
                                            <thead>
                                                <tr>
                                                <th scope="col">SKU</th>
                                                    <th scope="col">Medicine  <sup><b>(measurement)</b></sup></th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Category</th>
                                                 

                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($medicine)): ?>
                                                    <?php $no=1; foreach($medicine as $row): ?>
                                                    <tr>
                                                    <td><?= $row['sku'] ?></td>
                                                        <td><?= $row['med_name'] ?> <sup><b><?= $row['measurement'] ?></b></sup></td>
                                                        <td><?= $row['type_name'] ?></td>
                                                        <td><?= $row['category_name'] ?></td>
                                                      


                                                      
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#editmed" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Medicine" onclick="editMedicine(this)" 
                                                                    data-medno="<?= $row['med_no'] ?>" data-medname="<?= $row['med_name'] ?>"
                                                                    data-sku="<?= $row['sku'] ?>"   data-measurement="<?= $row['measurement'] ?>"
                                                                    data-category="<?= $row['category_id'] ?>" 
                                                                    data-type="<?= $row['type_id'] ?>"

                                                                    data-des="<?= $row['description'] ?>"

                                                                    data-price="<?= $row['price'] ?>"
                                                                    >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_medicine.php?medno=<?= $row['med_no'] ?>&state=medicine" onclick="return confirm('Are you sure you want to delete this Medicine?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Medicine  <sup><b>(measurement)</b></sup></th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Category</th>
                                             
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
							</div>




                        </div>

                        


                      <!-- Modal category -->
                      <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addmedicine.php" >


                                    <input type="hidden" class="form-control"  name="state" value="addcategory" required>
                    
                            <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control"  name="category" placeholder="Enter Category" required>
                                </div>
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


             <!-- Modal category -->
             <div class="modal fade" id="addtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addmedicine.php" >


                                    <input type="hidden" class="form-control"  name="state" value="addtype" required>
                    
                            <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" class="form-control"  name="type" placeholder="Enter Type" required>
                                </div>
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

                          

                      
					



                      <!-- Modal -->
                      <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addmedicine.php" >


                                    <input type="hidden" class="form-control"  name="state" value="addmedicine" required>
                             

                            <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control"  name="sku" placeholder="Enter SKU" required>
                                </div>
                            <div class="form-group">
                                    <label>Medicine</label>
                                    <input type="text" class="form-control"  name="medicine" placeholder="Enter Medicine" required>
                                </div>
                                <div class="form-group">
                                    <label>Measurement</label>
                                    <input type="text" class="form-control"  name="measurement" placeholder="Enter Measurement" required>
                                </div>

                          
                                <div class="form-group">
                                <label>Category</label>
                                 
                                  <select name="category" class="form-control"  required>
                                  <option selected disabled value="">-- Choose Category-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `med_category` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['category_id'].'">'.$row['category_name'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                
                                    </div>


                                    <div class="form-group">
                                <label>Type</label>
                                 
                                  <select name="type" class="form-control"  required>
                                  <option selected disabled value="">-- Choose Type-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `type_list` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['type_id'].'">'.$row['type_name'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                
                                    </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control"  name="des" placeholder="Enter Description" required></textarea>
                                </div>

                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>




               <!-- Modal -->
               <div class="modal fade" id="editmed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addmedicine.php" >


                                    <input type="hidden" class="form-control"  name="state" value="editmedicine" required>
                             
                                    <input type="text" class="form-control"  name="medno" id="medno" value="editmedicine" required>
                            <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control"  name="sku" id="sku" placeholder="Enter SKU" required>
                                </div>
                            <div class="form-group">
                                    <label>Medicine</label>
                                    <input type="text" class="form-control"  name="medicine"  id="medname" placeholder="Enter Medicine" required>
                                </div>
                                <div class="form-group">
                                    <label>Measurement</label>
                                    <input type="text" class="form-control"  name="measurement" id="measurement" placeholder="Enter Measurement" required>
                                </div>

                          
                                <div class="form-group">
                                <label>Category</label>
                                 
                                  <select name="category" class="form-control" id="category"  required>
                                  <option selected disabled value="">-- Choose Category-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `med_category` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['category_id'].'">'.$row['category_name'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                
                                    </div>


                                    <div class="form-group">
                                <label>Type</label>
                                 
                                  <select name="type" class="form-control"  id="type" required>
                                  <option selected disabled value="">-- Choose Type-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `type_list` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['type_id'].'">'.$row['type_name'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                
                                    </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control" id="des" name="des" placeholder="Enter Description" required></textarea>
                                </div>

                           
                            
                        </div>
                        <div class="modal-footer">
     
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>





       <!-- Modal -->
       <div class="modal fade" id="addexp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Expired Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addexpmedicine.php" >

                            <div class="form-group">
                                <label>Choose Expired Medicine</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="medno" class="form-control"  data-live-search="true">
                                  <option selected="" disabled="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_no'].'">Medno:'.$row['med_no'].' | '.$row['med_name'].' | Quantity: '.$row['med_qty'].' | Stocks: '.$row['med_stocks'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>
                          
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" placeholder="Quantity"  name="qty" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label>Stocks</label>
                                    <input type="number" class="form-control"  name="stocks" placeholder="Stocks" min="0" required>
                                </div>

                                <div class="form-group">
                                    <label>Date Expired</label>
                                    <input type="date" class="form-control"  name="medexp" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Proceed?');">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>




               <!-- Modal -->
               <div class="modal fade" id="editexp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Expired Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_medicine.php" >

                            <div class="form-group">
                            <label>Expired No</label>
                            <input type="text" readonly style="color:black;"  class="form-control fw-bold"  name="medicine" id="expno" required>
                                    <label>Medicine</label>
                                    <input type="text" readonly style="color:black;"  class="form-control fw-bold"  class="form-control"  name="medicines" id="emed_name" required>
                                </div>

                          
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control"  name="qty"  id="eqty" required>
                                </div>
                                <div class="form-group">
                                    <label>Stocks</label>
                                    <input type="number" class="form-control"  name="stocks" id="expstocks" required>
                                </div>

                                <div class="form-group">
                                    <label>Date Expired</label>
                                    <input type="date" class="form-control"  name="medexp" id="medexp" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>











             <!-- Modal -->
       <div class="modal fade" id="addmedreq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/addreqmed.php" >


                            <div class="form-group">
                                <label>Choose Residents</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="resid" class="form-control"  data-live-search="true">
                                  <option selected="" disabled="">-- Select Residents -- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * from tbl_residents WHERE bar_no=$barno  AND verify_status='verified' ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['res_id'].'">Resident ID:'.$row['res_id'].' | '.$row['firstname'].'  '.$row['middlename'].'  '.$row['lastname'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>

                            <div class="form-group">
                                <label>Choose Medicine</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="medicine" class="form-control"  data-live-search="true">
                                  <option selected="" disabled="" value="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_name'].'">Medno:'.$row['med_no'].' | '.$row['med_name'].' | Quantity: '.$row['med_qty'].' | Stocks: '.$row['med_stocks'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>
                          
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" placeholder="Quantity"  name="qty" min="0" required>
                                </div>

                                <div class="form-group">
                                    <label>Attended Barangay Health Worker </label>
                                    <input type="text" class="form-control" placeholder="BHW name"  name="bhw"  required>
                                </div>


                                <div class="form-group">
                                    <label>Request Date</label>
                                    <input type="date" class="form-control" placeholder=""  name="datereceived" min="0" required>
                                </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Proceed?');">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


        <!-- Modal -->
        <div class="modal fade" id="editmedreq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Request Medicine</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_reqmed.php" >


                            <div class="form-group">
                                <label>Residents Name</label>
                                <input type="text" class="form-control fw-bold" placeholder="" style="color:black;"  id="fullname" readonly required>
                                    </div>

                            <div class="form-group">
                            <input type="text" class="form-control fw-bold" style="color:black;" placeholder="" id="reqmedname"  readonly required>
                                <label>Change Medicine To:</label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="medicine" class="form-control"  data-live-search="true">
                                  <option selected="" disabled="" value="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_name'].'">Medno:'.$row['med_no'].' | '.$row['med_name'].' | Quantity: '.$row['med_qty'].' | Stocks: '.$row['med_stocks'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>
                          
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" placeholder="Quantity"  name="qty" min="1" id="reqqty"   required>
                                </div>

                                <div class="form-group">
                                    <label>Attended Barangay Health Worker </label>
                                    <input type="text" class="form-control" placeholder="BHW name"  name="bhw" id="bhwname"  required>
                                </div>


                                <div class="form-group">
                                    <label>Request Date</label>
                                    <input type="date" class="form-control" placeholder=""  name="datereceived" min="0" id="datereq" required>
                                </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" class="form-control" placeholder="" name="reqno" id="reqmedno" readonly required>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to Proceed?');">Save Changes</button>
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
            $('#medicine').DataTable();
            $('.search_select_box select').selectpicker();
        });
    </script>


<script>


function editMedicine(that){
   
   
  
   medno= $(that).attr('data-medno');
   medname = $(that).attr('data-medname');
   measurement = $(that).attr('data-measurement');
   sku = $(that).attr('data-sku');
   category = $(that).attr('data-category');
   type = $(that).attr('data-type');
   des = $(that).attr('data-des');
   price = $(that).attr('data-price');
 
 
     $('#medno').val(medno);
     $('#medname').val(medname);
     $('#measurement').val(measurement);
     $('#sku').val(sku);
     $('#category').val(category);
     $('#type').val(type);
     $('#des').val(des);
     $('#price').val(price);
    
     


 
 
 
 
 }






</script>

</body>
</html>

