<?php include 'server/server.php' ?>




<?php 

	$query = "SELECT * FROM tblbarangay";
    $result = $conn->query($query);
	$total = $result->num_rows;


	



?>


<?php if($_SESSION['role']='superadmin'): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard -  Barangay Management System</title>




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
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt-2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row">
						<div class="col-md-4">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="	fas fa-university"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												
												<h2 class="fw-bold text-uppercase" style=" font-size:18px; width:500px; position:relative; left:-390px; text-align:right;">Registered Barangay</h2>
												<h3 class="fw-bold text-uppercase"  style="position:relative; left:-390px; text-align:right;"><?= number_format($total) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="addbarangay" class="card-link text-light">Total Barangays </a>
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





 
	

<script>
        $(document).ready(function () {
            showGraph();

			showPie();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var vaccine_status = [];
                    var number = [];
					

                    for (var i in data) {
                        vaccine_status.push(data[i].vaccine_status);
                        number.push(data[i].number);
                    }

                    var chartdata = {
                        labels: vaccine_status,
                        datasets: [
                            {
                                label: '',
                                backgroundColor: ['orange','blue','green','purple','red'],
                                
                             
                             
							
								data:number,
								fontSize: 20,

								
								

								
								
                            }
							
                        ]
                    };


					

				
					

					

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {


						
                        type: 'bar',
                        data: chartdata,
						options: {
                  
                    title: {
                        display: true,
                        text: 'Covid-19 Vaccination Status',
                        fontSize: 20
                    },


					scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Vaccination Status',
								fontSize: 18
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'No. of Population',
								fontSize: 18
                            },
                            ticks: {
                                beginAtZero: true,
								min:0,
								max:<?php echo $total  ?>,
								
                            }
                        }]
				}
			}




						
                    });
					
                });
            }
        }



		function showPie()
        {
            {
                $.post("data_gender.php",
                function (data)
                {
                    console.log(data);
                     var gender = [];
                    var number = [];
					

                    for (var i in data) {
                        gender.push(data[i].gender);
                        number.push(data[i].number);
                    }

                    var chartdata = {
                        labels: gender,
                        datasets: [
                            {
                                label: 'Gender',
                                backgroundColor: ['rgb(54, 162, 235)','rgb(255, 99, 132)'],
                            
                             
                             
							
								data:number,
								fontSize: 20,

								
								

								
								
                            }
							
                        ],

					
                    };


					

				
					

					

                    var graphTarget = $("#graphCanvasgender");

                    var barGraph = new Chart(graphTarget, {


						
                        type: 'doughnut',
                        data: chartdata,
						options: {
                  
				  title: {
					  display: true,
					  text: 'Male and Female Population',
					  fontSize: 20
				  },


		
		  }
					




						
                    });
					
                });
            }
        }



		
        </script>



</body>
</html>



<?php endif ?>




