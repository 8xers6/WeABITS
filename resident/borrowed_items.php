<?php include 'server/server.php' ?>
<?php


$resid=$_SESSION['resid'];


$barno=$_SESSION['barno'];





$query = "SELECT * FROM tbl_residents WHERE res_id=$resid";
$result = $conn->query($query);
$resident = $result->fetch_assoc();   


    $query1 = "SELECT * FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblborrow.status='pending' ORDER BY tblborrow.bor_no DESC";
    $result1 = $conn->query($query1);

    $pending = array();
    while($row = $result1->fetch_assoc()){
        $pending[] = $row; 
    }

    $pendingtotal = $result1->num_rows;


    $query2 = "SELECT * FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblborrow.status='approved' ORDER BY tblborrow.bor_no DESC";
    $result2 = $conn->query($query2);

    $approved = array();
    while($row = $result2->fetch_assoc()){
        $approved[] = $row; 
    }

    $approvedtotal = $result2->num_rows;



    $query3 = "SELECT * FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblborrow.status='borrowed' ORDER BY tblborrow.bor_no DESC";
    $result3 = $conn->query($query3);

    $borrowed = array();
    while($row = $result3->fetch_assoc()){
        $borrowed[] = $row; 
    }

    $borrowedtotal = $result3->num_rows;


    $query4 = "SELECT * FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblborrow.status='returned' ORDER BY tblborrow.bor_no DESC";
    $result4 = $conn->query($query4);

    $returned = array();
    while($row = $result4->fetch_assoc()){
        $returned[] = $row; 
    }
    $returnedtotal = $result4->num_rows;

    $query5 = "SELECT * FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id  WHERE tbl_residents.res_id=$resid AND tblborrow.status='cancelled' ORDER BY tblborrow.bor_no DESC";
    $result5 = $conn->query($query5);

    $cancelled = array();
    while($row = $result5->fetch_assoc()){
        $cancelled[] = $row; 
    }
    $cancelledtotal = $result5->num_rows;


    
	
?>
 <?php if($resident['username']): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Profile -  Barangay Management System</title>
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
				<div class="page-inner mt--2">

			
			
				
                
				



				<div class="row ">
			

			


					<div class="col-md-12 ">
						<?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" style="font-weight:bolder;" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>


			            </div>
					
				


               </div>



                    <!-----start card--->

                    <div class="card border ">
								<div class="card-header bg-primary-gradient rounded ">
									<div class="card-head-row ">
										<div class="card-title fw-bold text-uppercase text-white ">Borrowed Equipment</div>
                                        <?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
											    
											    <!----
												<a href="#add" data-toggle="modal" class="btn btn-white btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Request Item
												</a>----->
											</div>
										<?php endif?>
									</div>


                                    
								</div>


                 
                    

                  



			   <nav >
  <div class="nav nav-tabs   justify-content-center mt-2 mb-2" id="nav-tab" role="tablist">
    
    <button class="nav-link active ml-1  border" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false"><b style="font-size:13px;">Pending</b> </button>
    <button class="nav-link ml-1  border" id="nav-processing-tab" data-bs-toggle="tab" data-bs-target="#nav-approved" type="button" role="tab" aria-controls="nav-approved" aria-selected="false"><b style="font-size:13px;">Approved</b> </button>
    <button class="nav-link ml-1 border" id="nav-borrowed-tab" data-bs-toggle="tab" data-bs-target="#nav-borrowed" type="button" role="tab" aria-controls="nav-borrowed" aria-selected="false"><b style="font-size:13px;">Borrowed</b> </button>
    <button class="nav-link ml-1 border" id="nav-return-tab" data-bs-toggle="tab" data-bs-target="#nav-return" type="button" role="tab" aria-controls="nav-return" aria-selected="false"><b style="font-size:13px;">Returned</b> </button>
    <button class="nav-link ml-1 border" id="nav-cancelled-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelled" type="button" role="tab" aria-controls="nav-cancelled" aria-selected="false"><b style="font-size:13px;">Cancelled</b> </button>

  </div>
</nav>
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active rounded" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">


  <div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-danger  fw-bold"  id="live_search" autocomplete="off"  placeholder="Search  Equipment" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresult"></div>               


 

  </div>
<!-----endtab----->  




                                        





<div class="tab-pane fade  rounded " id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">


<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-success  fw-bold"  id="live_search_approved" autocomplete="off"  placeholder="Search  Equipment" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresult_approved"></div>               



   


</div>
<!-----endtab----->  



<div class="tab-pane fade  rounded" id="nav-borrowed" role="tabpanel" aria-labelledby="nav-borrowed-tab">


<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-primary  fw-bold"  id="live_search_borrow" autocomplete="off"  placeholder="Search  Equipment" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresult_borrow"></div>               



   


</div>
<!-----endtab----->  

			

					
<div class="tab-pane fade  rounded" id="nav-return" role="tabpanel" aria-labelledby="nav-return-tab">

<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0  fw-bold"  id="live_search_returned" autocomplete="off"  placeholder="Search  Equipment" style="width:300px; border:solid purple 2px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresult_returned"></div>               


  

   

</div>
<!-----endtab----->  
              
<div class="tab-pane fade  rounded" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab">

<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-dark  fw-bold"  id="live_search_cancel" autocomplete="off"  placeholder="Search  Equipment" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresult_cancel"></div>               

 
  

   


</div>
<!-----endtab----->  
                          
			
                  
                
							
						



					


						
                                         </div>
	




			
				
				
				
					
</div>

                                           </div>





         
     <!-- Modal -->
     <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_borrowed.php"  enctype="multipart/form-data" >
                              

                                <div class="form-group">
                                    <label>Item Name.</label>

									<div class="search_select_box">
                                  
								      <select  name="equipno" class="form-control " data-live-search="true">
									  <option selected="" disabled="">-- Select Equipment -- </option>
									  <?php
										  $squery = mysqli_query($conn,"SELECT *FROM tblequipments WHERE bar_no=$barno AND `status`='Available'");
										  while ($row = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$row['equip_no'].'"> Equipment Name: '.$row['equipment_name'].' | Quantity: '.$row['quantity'].'</option>    
											  ';
										  }
									  ?>
								                  </select>
							         </div>

						


                                </div>
                                <div class="form-group">

                                <label>Purpose</label>
                                <textarea type="text" class="form-control"  name="purpose" autocomplete="off" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control"  name="qty" autocomplete="off"  min="1" required>
                                </div>


                                <div class="form-group">
                                    <label>Date to Return</label>
                                    <input type="date" class="form-control"  name="datereturn" autocomplete="off"  min="1" required>
                                </div>

                                
                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if($resident['blocklisted']=='No Record'): ?>
                            <button type="submit" class="btn btn-primary">Request</button>
                            <?php else: ?>
                                                        <h1 class="text-center fw-bold" style="color:red;" >Blocklisted</h1>
                                                       <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



                                <!-- Modal -->
<div class="modal fade" id="viewborrow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">BORROW NO. <input type="text" id="borno" readonly  style="font-size:15px;  border:none; "></h5>
						    
                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
												</button>
                        </div>
                        <div class="modal-body">
                           

						    <h1 class="modal-title fw-bold text-uppercase"><input type="text"  id="item" readonly  style="font-size:20px;  border:none; "></h1>
                           
                           Quantity: <h1 class="modal-title fw-bold text-uppercase ml-4"><input type="text"id="qty" readonly  style="font-size:20px;  border:none; "></h1>
                            Date to Borrow: <h1 class="modal-title fw-bold text-uppercase ml-4"><input type="text" id="dtb" readonly  style="font-size:20px;  border:none;"></h1>
					
                             Date to Return: <h1 class="modal-title fw-bold text-uppercase ml-4"><input type="text" id="dtt" readonly  style="font-size:20px;  border:none; "></h1>
					


                           
							<label>Purpose & Details</label>
						    <textarea type="form" id="purpose" readonly style="color:black; width:100%; height:200px; text-align:justify; text-justify: inter-word; padding:20px; text-indent:10px; border: solid gray 1px;"></textarea>
                           

					                            
                        </div>
                     
                      
                    </div>
                </div>
            </div>
            <!---end modal-->







			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>


	

	<?php include 'templates/footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  


<script>
        $(document).ready(function() {
            $('.search_select_box select').selectpicker();

            $.ajax({

url:"livesearch/livesearchborrowpending.php",
method:"POST",
data:{live_search:$(this).val()},

success:function(result ){

    $("#searchresult").html(result);


}


});
                                    

         
    


            $("#live_search").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchborrowpending.php",
                            method:"POST",
                            data:{live_search:$(this).val()},

                            success:function(result ){

                                $("#searchresult").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchborrowpending.php",
                                method:"POST",
                                data:{live_search:$(this).val()},

                                success:function(result ){

                                    $("#searchresult").html(result);


                                }


                                });




                        }
                   

               
            });
        });


      
 
    </script>



<script>
        $(document).ready(function() {


            $.ajax({

url:"livesearch/livesearchborrowapproved.php",
method:"POST",
data:{live_search:$(this).val()},

success:function(result ){

    $("#searchresult_approved").html(result);


}


});
                                    

         
    


            $("#live_search_approved").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchborrowapproved.php",
                            method:"POST",
                            data:{live_search_approved:$(this).val()},

                            success:function(result ){

                                $("#searchresult_approved").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchborrowapproved.php",
                                method:"POST",
                                data:{live_search:$(this).val()},

                                success:function(result ){

                                    $("#searchresult_approved").html(result);


                                }


                                });




                        }
                   

               
            });
        });


      
 
    </script>



<script>
        $(document).ready(function() {


            $.ajax({

url:"livesearch/livesearchborrowed.php",
method:"POST",
data:{live_search_borrow:$(this).val()},

success:function(result ){

    $("#searchresult_borrow").html(result);


}


});
                                    

         
    


            $("#live_search_borrow").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchborrowed.php",
                            method:"POST",
                            data:{live_search_borrow:$(this).val()},

                            success:function(result ){

                                $("#searchresult_borrow").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchborrowed.php",
                                method:"POST",
                                data:{live_search_borrow:$(this).val()},

                                success:function(result ){

                                    $("#searchresult_borrow").html(result);


                                }


                                });




                        }
                   

               
            });
        });


      
 
    </script>




<script>
        $(document).ready(function() {


            $.ajax({

url:"livesearch/livesearchreturned.php",
method:"POST",
data:{live_search_returned:$(this).val()},

success:function(result ){

    $("#searchresult_returned").html(result);


}


});
                                    

         
    


            $("#live_search_returned").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchreturned.php",
                            method:"POST",
                            data:{live_search_returned:$(this).val()},

                            success:function(result ){

                                $("#searchresult_returned").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchreturned.php",
                                method:"POST",
                                data:{live_search_returned:$(this).val()},

                                success:function(result ){

                                    $("#searchresult_returned").html(result);


                                }


                                });




                        }
                   

               
            });
        });


      
 
    </script>



<script>
        $(document).ready(function() {


            $.ajax({

url:"livesearch/livesearchcancelled.php",
method:"POST",
data:{live_search_cancel:$(this).val()},

success:function(result ){

    $("#searchresult_cancel").html(result);


}


});
                                    

         
    


            $("#live_search_cancel").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchcancelled.php",
                            method:"POST",
                            data:{live_search_cancel:$(this).val()},

                            success:function(result ){

                                $("#searchresult_cancel").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchcancelled.php",
                                method:"POST",
                                data:{live_search_cancel:$(this).val()},

                                success:function(result ){

                                    $("#searchresult_cancel").html(result);


                                }


                                });




                        }
                   

               
            });
        });


      
 
    </script>





</body>
</html>


<?php else: header('Location: dashboard.php'); ?>
   

<?php endif ?>