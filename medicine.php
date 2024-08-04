<?php include 'server/server.php' ?>
<?php 


$barno=$_SESSION['bar_no'];


    $query = "SELECT * FROM inventory LEFT JOIN tblmedicine on tblmedicine.med_no=inventory.med_no WHERE bar_no=$barno    order by med_name asc";
                        $result = $conn->query($query);

    $manageinventory= array();
	while($row = $result->fetch_assoc()){
		$manageinventory[] = $row; 
	}






$query2= "SELECT *FROM tblreqmedicine LEFT join tbl_residents on tblreqmedicine.res_id=tbl_residents.res_id  LEFT JOIN tblmedicine on tblmedicine.med_no=tblreqmedicine.med_no WHERE tbl_residents.bar_no=$barno";
$result2= $conn->query($query2);

$reqmed= array();
while($row = $result2->fetch_assoc()){
$reqmed[] = $row; 
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Medicine- Weabits</title>
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

                    	<h2 class="text-white fw-bold">Health Center</h2>
							<div>

							</div>
						</div>
					</div>
				</div>
				
				<div class="page-inner mt--2">

              

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
										<div class="card-title">Medicine Inventory</div>
									   <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
										    
										    
										       <a href="#import" data-toggle="modal" class="btn btn-danger btn-border btn-round btn-sm">
												<i class="fa fa-file"></i>
												Import  CSV
											</a>
											
                                            <a href="#export" data-toggle="modal"  class="btn btn-success btn-border btn-round btn-sm" >
												<i class="fa fa-file"></i>
												Export as CSV
											</a>

                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="inventory">
                                            <thead>
                                                <tr>
                                           
								<th class="text-left">Medicine</th>
								<th class="text-right">Stock In</th>
								<th class="text-right">Stock Out</th>
								<th class="text-right">Expired</th>
								<th class="text-right">Stock Available</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
								$i = 1;
								$product = $conn->query("SELECT * FROM tblmedicine WHERE bar_no=$barno order by med_name asc");
								while($row=$product->fetch_assoc()):
								$inn = $conn->query("SELECT sum(qty) as inn FROM inventory where med_no = ".$row['med_no']);
								$inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
								$out = $conn->query("SELECT sum(qty) as `out` FROM tblreqmedicine where  med_no = ".$row['med_no']);
								$out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;

								$ex = $conn->query("SELECT sum(qty) as ex FROM expired_product where med_no = ".$row['med_no']);
								$ex = $ex && $ex->num_rows > 0 ? $ex->fetch_array()['ex'] : 0;

								$available = $inn - $out- $ex;
							?>
								<tr>
									
									<td class=""><?php echo $row['med_name'] ?> <sup><?php echo $row['measurement'] ?></sup></td>
									<td class="text-right"><?php echo $inn > 0 ? $inn : 0 ?></td>
									<td class="text-right"><?php echo $out > 0 ? $out : 0 ?></td>
									<td class="text-right"><?php echo $ex > 0 ? $ex : 0 ?></td>
									<td class="text-right"><?php echo $available ?></td>
								</tr>
							<?php endwhile; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                           
                                                <th class="text-left">Medicine</th>
								<th class="text-right">Stock In</th>
								<th class="text-right">Stock Out</th>
								<th class="text-right">Expired</th>
								<th class="text-right">Stock Available</th>
                                               
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
							</div>

        
                        </div>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Medicine Inventory</div>
										<div class="card-tools">
                                        <a href="#stockin" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Stock
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="expired">
                                            <thead>
                                                <tr>
                                           
                                        
                                                    <th scope="col">Medicine</th>
                                                    <th scope="col"  class="text-right">Quantity</th>
                                                   
                                                    <th scope="col"  class="text-center">Expiry Date</th>
                                                    <th scope="col"  class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($manageinventory)): ?>
                                                    <?php $no=1; foreach($manageinventory as $row): ?>
                                                    <tr>
                                                    <form method="POST" action="model/stockinoutexp.php" >
                                                        <td >
                                                            
                                                        
                                                        <input type="hidden" value="expired" class="form-control"  name="state" required>
                                                        <input type="hidden" value="<?= $row['id'] ?>"  name="id" required>
                                                        <input type="hidden" value="<?= $row['med_no'] ?>"  name="medno" required>
                                                        <?= $row['med_name'] ?><sup><?php echo $row['measurement'] ?></sup></td>
                                                        <td  class="text-right">
                                                            
                                                        <input type="hidden" value="<?= $row['qty'] ?>"  name="qty" required>
                                                        <?= $row['qty'] ?></td>
                                                    
                                                        <td  class="text-center">
                                                        <input type="hidden" value="<?= $row['expiry_date'] ?>"  name="expirydate" required>    
                                                        
                


                                                        <?php if($row['expired_confirm']==1): ?>
   <b class="text-danger"> <?php $str = $row['expiry_date']; $date = date('F j, Y', strtotime($str)); echo $date; ?></b> <b class="badge badge-danger">  Expired</b>
    <?php else: ?>
                                                            
                                                            <?php $str = $row['expiry_date']; $date = date('F j, Y', strtotime($str)); echo $date; ?>
                                                            <?php endif ?>    

                                                      
                                                       


                                                       

                                                        <td  class="text-right">


                                                        <?php if($row['expiry_date']< date("Y-m-d")&& $row['expired_confirm']==0): ?>
                                                        <button type="submit" class="btn btn-link text-danger fw-bold"  onclick="return confirm('Confirm expired medicine?');" data-original-title="Remove">
                                                        
                                                    
                                                        <b class="badge badge-success fw-bold   ">Confirm Expiration</b></button>
                                                        <?php endif ?>

                                                        </form>
                                                        <?php if($row['expired_confirm']==0): ?>
                                                        <a type="button" href="#editinventory" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Request Medicine" onclick="editInventory(this)" 
                                                         data-id="<?= $row['id'] ?>"  data-qty="<?= $row['qty'] ?>" 
                                                         data-medname="<?= $row['med_name'] ?>  <?= $row['measurement'] ?>" 
                                                     
                                                         >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                               
                                                              
                                                                <?php endif ?>
                                                                <a type="button" data-toggle="tooltip" href="model/stockinoutexp.php?id=<?=$row['id'] ?>&state=delete" onclick="return confirm('Are you sure you want to delete this Medicine?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                             

                                                        </td>

                                                 
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No  Medicine</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Medicine</th>
                                                    <th scope="col">Quantity</th>
                                                   
                                                    <th scope="col">Expiry Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
                            </div>	






                        </div>

                  


                      
					



                      <!-- Modal  stock-->
                      <div class="modal fade" id="stockin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Stock In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php" >

                            <div class="form-group">
                                <label>Choose  Medicine</label>
                                    <div class="search_select_box" >
                                  
                                  <select name="medno" class="form-control"  data-live-search="true" required >
                                  <option selected disabled value="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_no'].'">'.$row['med_name'].'   '.$row['measurement'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>

                                    <input type="hidden" value="stockin" class="form-control"  name="state" required>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" min="1"  name="qty" required>
                                </div>

                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="date" class="form-control"  name="expirydate" required>
                                </div>
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



             <!-- Modal  stock-->
             <div class="modal fade" id="stockout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Medicine Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php"  enctype="multipart/form-data">
                               


                            <div class="form-group">
                                <label>Choose Residents</label>
                                    <div class="search_select_box" >
                                  
                                  <select name="resid" class="form-control"  data-live-search="true" required>
                                  <option selected disabled value="">-- Select Residents -- </option>
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
                                <label>Choose  Medicine</label>
                                    <div class="search_select_box" >
                                  
                                  <select name="medno" class="form-control"  data-live-search="true" required >
                                  <option selected disabled value="">-- Choose Medicine-- </option>
                                  <?php
                                      $squery = mysqli_query($conn,"SELECT * FROM `tblmedicine` WHERE bar_no=$barno ");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['med_no'].'">'.$row['med_name'].'   '.$row['measurement'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>

                                    <input type="hidden" value="stockout" class="form-control"  name="state" required>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" min="1"  name="qty" required>
                                </div>


                                <div class="form-group">
                                    <label>Prescription Image</label>
                                    <input type="file" class="form-control"   name="image" accept="image/*" required>
                                </div>

                                
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


             <!-- Modal  stock-->
             <div class="modal fade" id="editstockinoutexp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Medicine Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php"  enctype="multipart/form-data">
                               
                            <div class="form-group">
                                    <label>Resident Name</label>
                                    <input type="text" readonly style="color:black;" class="form-control fw-bold" min="1"  id="fullname" required>
                                </div>


                                <div class="form-group">
                                    <label>Medicine</label>
                                    <input type="text" readonly class="form-control fw-bold" style="color:black;"  id="reqmedname" required>
                                </div>

                        
                                    
                                <input type="hidden" class="form-control" name="medno"  id="editmedno" required>
                                <input type="hidden"  class="form-control"  name="reqmedno" id="reqmedno" required>
                                    <input type="hidden" value="editstockout" class="form-control"  name="state" required>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control"  name="qty" id="reqqty" required>
                                </div>


                               
                                <div class="form-group">
                                <label>Prescription Image</label><br>
                                <img src="assets/img/weabitlogo.png" alt="..." class="img-fluid"   id="prescription"> <br>

                            
                                <label>Change to:</label>
                                    <input type="file" class="form-control"   name="image" accept="image/*">
                                </div>
                                
                              
                            
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to Proceed?');">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



               <!-- Modal -->
               <div class="modal fade" id="editinventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/stockinoutexp.php" >

                            <div class="form-group">
                            <input type="hidden" readonly    name="state"  class="form-control fw-bold" style="color:black;"  value="editinventory" required>
                            <input type="hidden" readonly    name="id"  class="form-control fw-bold" style="color:black;"   id="in_id" required>
                                    <label>Medicine</label>
                                    <input type="text" readonly style="color:black;" class="form-control fw-bold"  id="medname" required>
                                </div>

                          
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" min="0" name="qty"  id="qty" required>
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
             <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/import_medicine.php"  enctype="multipart/form-data">



                            <div class="form-group form-floating-label">
                        <label>Password</label>
                        <input type="password" id="cur_passi" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
                        <span toggle="#cur_passi" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                                <div class="form-group">
                                    <label>Import CSV File(this can only use once)</label>
                                    <input type="file" class="form-control" name="file"  accept=".csv" required>
                                </div>
                           
                            
                        </div>
                        <div class="modal-footer">
                          
                            <input type="submit" class="btn btn-primary"   name="importSubmit" value="IMPORT">
                        </div>
                        </form>
                    </div>
                </div>
            </div>



              <!-- Modal -->
              <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Export As CSV</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/export_medicine_csv.php"  enctype="multipart/form-data">


                            <div class="form-group form-floating-label">
                        <label> Password</label>
                        <input type="password" id="cur_passe" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
                        <span toggle="#cur_passe" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                           
                            
                        </div>
                        <div class="modal-footer">
                          
                            <input type="submit" class="btn btn-primary"   name="importSubmit" value="EXPORT" onclick="return confirm('Are you sure you want to Download this File?');">
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
            $('#inventory').DataTable();
            $('#expired').DataTable();
            $('#request').DataTable();
            $('.search_select_box select').selectpicker();
        });
    </script>


<script>




function editInventory(that){
   
   id = $(that).attr('data-id');
   medname = $(that).attr('data-medname');
   qty = $(that).attr('data-qty');

   $('#in_id').val(id);
   $('#medname').val(medname);
   $('#qty').val(qty);

}



function editReqMed(that){
   
   
   reqmedno= $(that).attr('data-reqmedno');
    bhw = $(that).attr('data-bhw');
    medname = $(that).attr('data-medname');
    medqty = $(that).attr('data-medqty');
   
    datereq = $(that).attr('data-datereq');
  
    medno= $(that).attr('data-medno');
 
    $('#editmedno').val(medno);
    $('#reqmedno').val(reqmedno);

      $('#reqmedname').val(medname);
      $('#reqqty').val(medqty);

      $('#bhwname').val(bhw);


    


           fname = $(that).attr('data-fname');
           mname = $(that).attr('data-mname');
           lname = $(that).attr('data-lname');
           suffix = $(that).attr('data-suffix');
         
         
        
             
             fullname=fname+'   '+mname+'   '+lname+'   '+suffix;
        
             $('#fullname').val(fullname);

             pres = $(that).attr('data-pres');

             username= $(that).attr('data-username');
             var str = pres;
    var n = str.includes("data:image");
    if(!n){
        pres = 'assets/uploads/'+username+'/prescription/'+pres;
    }
    $('#prescription').attr('src',pres);
  
  
  
  }


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

