<?php include 'server/server.php' ?>
<?php


   if(!empty($_SESSION['res_id'])){


   
   $resid=$_SESSION['res_id'];

   
$query = "SELECT * FROM tbl_residents WHERE res_id=$resid";
$result = $conn->query($query);
$resident = $result->fetch_assoc();


    $query1 = "SELECT * FROM `tblrequested_documents` WHERE tbl_residents.res_id=$resid AND tblrequested_documents.status='pending'";
    $result1 = $conn->query($query1);

    $pending = array();
    while($row = $result1->fetch_assoc()){
        $pending[] = $row; 
    }

    $pendingtotal = $result1->num_rows;


    $query2 = "SELECT * FROM `tblrequested_documents`  WHERE tbl_residents.res_id=$resid AND tblrequested_documents.status='processing'";
    $result2 = $conn->query($query2);

    $processing = array();
    while($row = $result2->fetch_assoc()){
        $processing[] = $row; 
    }

    $processtotal = $result2->num_rows;



    $query3 = "SELECT * FROM `tblrequested_documents` WHERE tbl_residents.res_id=$resid AND tblrequested_documents.status='released'";
    $result3 = $conn->query($query3);

    $released = array();
    while($row = $result3->fetch_assoc()){
        $released[] = $row; 
    }

    $releasedtotal = $result3->num_rows;


    $query4 = "SELECT * FROM `tblrequested_documents`  WHERE tbl_residents.res_id=$resid AND  tblrequested_documents.status='send'";
    $result4 = $conn->query($query4);

    $send = array();
    while($row = $result4->fetch_assoc()){
        $send[] = $row; 
    }
    $sendtotal = $result4->num_rows;

    $query5 = "SELECT * FROM `tblrequested_documents`  WHERE tbl_residents.res_id=$resid AND  (tblrequested_documents.status='received' OR tblrequested_documents.status='send')";
    $result5 = $conn->query($query5);

    $received = array();
    while($row = $result5->fetch_assoc()){
        $received[] = $row; 
    }
    $receivedtotal = $result5->num_rows;

   }
    
	
?>

   

  <?php if($_SESSION['role']=='Resident'): ?>
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
				
				<div class="page-inner ">

			
			
				
                
				



				<div class="row m-0">
			

			


					<div class="col-md-12">
						<?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" style="font-weight:bolder;" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>


			            </div>
					
				


               </div>



                    <!-----start card--->

                    <div class="card  m-0">
								<div class="card-header bg-primary-gradient rounded ">
									<div class="card-head-row ">
										<div class="card-title fw-bold text-uppercase text-white ">My Certificates</div>
									
									</div>
								</div>



                    


                 
                    

                  



			   <nav >
  <div class="nav nav-tabs  justify-content-center " id="nav-tab" role="tablist" >
    
    <button class="nav-link active ml-1 border" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false"><b style="font-size:13px; ">Pending</b> </button>
    <button class="nav-link  ml-1 border" id="nav-processing-tab" data-bs-toggle="tab" data-bs-target="#nav-processing" type="button" role="tab" aria-controls="nav-processing" aria-selected="false"><b style="font-size:13px;">Processing</b></button>
    <button class="nav-link  ml-1 border" id="nav-released-tab" data-bs-toggle="tab" data-bs-target="#nav-released" type="button" role="tab" aria-controls="nav-released" aria-selected="false"><b style="font-size:13px;">For Released</b> </button>

    <button class="nav-link  ml-1 border" id="nav-received-tab" data-bs-toggle="tab" data-bs-target="#nav-received" type="button" role="tab" aria-controls="nav-received" aria-selected="false"><b style="font-size:13px;">Completed</b> </button>
    <!---<button class="nav-link  ml-1 border" id="nav-cancelled-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelled" type="button" role="tab" aria-controls="nav-cancelled" aria-selected="false"><b style="font-size:13px;">Cancelled</b> </button>---->

  </div>
</nav>

<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active rounded m-2" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">

  <div class="row  justify-content-center m-0 ml-2 mr-2 mt-3 " >
<input type="text" class="form-control m-0 border-danger  fw-bold"  id="live_searchpending" autocomplete="off"  placeholder="Search Certificate" style="width:300px; ">

                                        </div>

                                        <div class="row   mt-3 mb-3   justify-content-center" id="searchresultpending"></div>               

 

                                  


   
 


				
		

  </div>
  <div class="tab-pane fade " id="nav-processing" role="tabpanel" aria-labelledby="nav-processing-tab">

  <div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-warning  fw-bold"  id="live_searchprocess" autocomplete="off"  placeholder="Search Certificate" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresultprocess"></div>               



                       
  

</div>


<div class="tab-pane fade" id="nav-released" role="tabpanel" aria-labelledby="nav-released-tab">


  <div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-success  fw-bold"  id="live_searchrel" autocomplete="off"  placeholder="Search  Certificate" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresultrel"></div>               


                     

</div>





                                        


<div class="tab-pane fade" id="nav-received" role="tabpanel" aria-labelledby="nav-received-tab">

<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-primary  fw-bold"  id="live_searchcom" autocomplete="off"  placeholder="Search Certificate" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresultcom"></div>   

</div>


<div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab">

<div class="row  justify-content-center m-0 ml-3 mr-3 mt-3 " >
<input type="text" class="form-control m-0 border-dark  fw-bold"  id="live_searchcancel" autocomplete="off"  placeholder="Search  Certificate" style="width:300px; ">

   
                                        </div>

                                        <div class="row md-12  mt-3 mb-3 justify-content-center" id="searchresultcancel"></div>   

</div>


                        </div>

                        </div>

                        </div>


                        



                    <!-- Modal -->
<div class="modal fade" id="viewdocrel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog  modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">REQUEST NO. <input type="text" id="reqno" readonly  style="font-size:15px;  border:none; "></h5>
						    
                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
												</button>
                        </div>
                        <div class="modal-body">
                           

						    <h1 class="modal-title fw-bold"><input type="text" id="doc" readonly  style="font-size:20px;  border:none; "></h1>
                           

					
                          


                           
							<label>Purpose & Details</label>
						    <textarea type="form" id="purpos" readonly style="color:black; width:100%; height:100px;  border: solid gray 1px;"></textarea>
                           

							


                            <div class="form-group ">
							<b style="font-size:15px; position:relative; left:5px; color:black;">Amount: &#8369</b>
                            <input type="number" class=" fw-bold"   id="am" readonly style="font-size:15px;  border:none; ">
                           

							</div>


                         
								

                           
							


							








                            
                        </div>
                     
                      
                    </div>
                </div>
            </div>
            <!---end modal-->




         
<!-- Modal -->
<div class="modal fade" id="viewdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">REQUEST NO. <input type="text" id="req_no" readonly  style="font-size:15px;  border:none; "></h5>
                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
												</button>
                        </div>
                        <div class="modal-body">
					
                        <h1 class=" fw-bold"><input type="text" id="docu" readonly  style="font-size:25px;  border:none; "></h1>
                           
                          


                        <label>Purpose & Details</label>
						    <textarea type="text" class="fw-bold" id="purpose" readonly style="color:black; width:100%; height:100px; border: solid gray 1px; "></textarea>
                           


                     
							<b style="font-size:15px; position:relative; left:5px; color:black;">Amount: &#8369</b>
                            <input type="number" class=" fw-bold"   id="amount" readonly style="font-size:15px;  border:none; ">
                         


                         
								

                               <br>
							
										
                                <b >Document Preview</b>
											
								<canvas id="pdf-canvas" width="800" class="rounded img-fluid"  style="border:solid black 1px;"></canvas>

								<div class="text-center mb-1"  style="visibility:hidden;">
												
											<button id="pdf-prev"  ><i class="fas fa-arrow-left"></i> Prev</button>
												<label id="pdf-current-page"></label> 
											    of <label id="pdf-total-pages"></label>
												<button id="pdf-next"> Next <i class="fas fa-arrow-right"></i></button>

												</div>
								<div id="pdf-loader" style="visibility:hidden;" ></div>
									<div id="pdf-contents"  style="visibility:hidden;">
										<div id="pdf-meta"  style="visibility:hidden;">
										
											
											
											
										</div>
										
										
										<div id="page-loader"  style="visibility:hidden;"></div>
									
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









<!----loader----->

<script>


        $(document).ready(function() {

           

          //pending
            $.ajax({

url:"livesearch/livesearchreqpending.php",
method:"POST",
data:{live_searchpending:$(this).val()},

success:function(result ){

    $("#searchresultpending").html(result);


}


});



//processing

$.ajax({

url:"livesearch/livesearchprocess.php",
method:"POST",
data:{live_searchprocess:$(this).val()},

success:function(result ){

    $("#searchresultprocess").html(result);


}


});


//released
$.ajax({

url:"livesearch/livesearchreleased.php",
method:"POST",
data:{live_searchrel:$(this).val()},

success:function(result ){

    $("#searchresultrel").html(result);


}


});


//cancelled
$.ajax({

url:"livesearch/livesearchreqcancel.php",
method:"POST",
data:{live_searchcancel:$(this).val()},

success:function(result ){

    $("#searchresultcancel").html(result);


}


});



//completed
$.ajax({

url:"livesearch/livesearchcompleted.php",
method:"POST",
data:{live_searchcom:$(this).val()},

success:function(result ){

    $("#searchresultcom").html(result);


}


});
                                    

         
    


        });


      
 
    </script>



<!----endloader----->





<!----search----->

<script>
        $(document).ready(function() {




            $("#live_searchpending").keyup(function(){



if($(this).val()!=""){






            $.ajax({

            url:"livesearch/livesearchreqpending.php",
            method:"POST",
            data:{live_searchpending:$(this).val()},

            success:function(result ){

                $("#searchresultpending").html(result);


            }

    
            });

        }else{

                                            $.ajax({

                url:"livesearch/livesearchreqpending.php",
                method:"POST",
                data:{live_searchpending:$(this).val()},

                success:function(result ){

                    $("#searchresultpending").html(result);


                }


                });




        }
   


});
          
                                    

         
    


            $("#live_searchprocess").keyup(function(){


                //alert(input);

                if($(this).val()!=""){



                

           
                            $.ajax({

                            url:"livesearch/livesearchprocess.php",
                            method:"POST",
                            data:{live_searchprocess:$(this).val()},

                            success:function(result ){

                                $("#searchresultprocess").html(result);


                            }

                    
                            });

                        }else{

                                                            $.ajax({

                                url:"livesearch/livesearchprocess.php",
                                method:"POST",
                                data:{live_searchprocess:$(this).val()},

                                success:function(result ){

                                    $("#searchresultprocess").html(result);


                                }


                                });




                        }
                   

               
            });





       
            $("#live_searchrel").keyup(function(){




if($(this).val()!=""){






            $.ajax({

            url:"livesearch/livesearchreleased.php",
            method:"POST",
            data:{live_searchrel:$(this).val()},

            success:function(result ){

                $("#searchresultrel").html(result);


            }

    
            });

        }else{

                                            $.ajax({

                url:"livesearch/livesearchreleased.php",
                method:"POST",
                data:{live_searchrel:$(this).val()},

                success:function(result ){

                    $("#searchresultrel").html(result);


                }


                });




        }
   


});




$("#live_searchcancel").keyup(function(){


//alert(input);

if($(this).val()!=""){






            $.ajax({

            url:"livesearch/livesearchreqcancel.php",
            method:"POST",
            data:{live_searchcancel:$(this).val()},

            success:function(result ){

                $("#searchresultcancel").html(result);


            }

    
            });

        }else{

                                            $.ajax({

                url:"livesearch/livesearchreqcancel.php",
                method:"POST",
                data:{live_searchcancel:$(this).val()},

                success:function(result ){

                    $("#searchresultcancel").html(result);


                }


                });




        }

});




$("#live_searchcom").keyup(function(){


//alert(input);

if($(this).val()!=""){






            $.ajax({

            url:"livesearch/livesearchcompleted.php",
            method:"POST",
            data:{live_searchcom:$(this).val()},

            success:function(result ){

                $("#searchresultcom").html(result);


            }

    
            });

        }else{

                                            $.ajax({

                url:"livesearch/livesearchcompleted.php",
                method:"POST",
                data:{live_searchcom:$(this).val()},

                success:function(result ){

                    $("#searchresultcom").html(result);


                }


                });

        }

});

        });


      
 
    </script>


<!----endsearch----->



</body>
</html>


<?php else: header('Location: ../dashboard.php'); ?>
   

<?php endif ?>


