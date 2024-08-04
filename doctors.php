<?php include 'server/server.php' ?>
<?php

   $barno=$_SESSION['bar_no'];
    $query = "SELECT * FROM `tbldoctors` WHERE bar_no=$barno ";
    $result = $conn->query($query);

    $doctors = array();
	while($row = $result->fetch_assoc()){
		$doctors[] = $row; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Doctors  Appointment-  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Health Center</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">List of Doctors </div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Doctor
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                  
                                                    <th scope="col">Doctor Name</th>
                                                    <th scope="col">Specialization</th>
                                                    <th scope="col">Time Available</th>
                                                    <th scope="col">About</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($doctors)): ?>
                                                    <?php $no=1; foreach($doctors as $row): ?>
                                                    <tr>
                                                     
                                                        <td><?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['lastname'] ?> <?= $row['suffix'] ?></td>
                                                        <td><?= $row['specialization'] ?></td>
                                                        <td><?= $row['timeavailable'] ?></td>
                                                        <td><?= $row['aboutdoc'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Info" onclick="editDoctor(this)" 
                                                                    data-fname="<?= $row['firstname'] ?>"
                                                                    data-mname="<?= $row['middlename'] ?>"
                                                                    data-lname="<?= $row['lastname'] ?>"
                                                                    data-suffix="<?= $row['suffix'] ?>"
                                                                    
                                                                    
                                                                    data-spec="<?= $row['specialization'] ?>" data-ta="<?= $row['timeavailable'] ?>"
                                                                    data-about="<?= $row['aboutdoc'] ?>"  data-id="<?= $row['doc_id'] ?>"

                                                                    data-image="<?= $row['image'] ?>"

                                                                    data-username="<?= $_SESSION['username'] ?>"
                                                                    
                                                                    >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_doctor.php?id=<?= $row['doc_id'] ?>" onclick="return confirm('Are you sure you want to remove this doctor?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">Doctor Name</th>
                                                    <th scope="col">Specialization</th>
                                                    <th scope="col">Time Available</th>
                                                    <th scope="col">About</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/adddoctor.php"   enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label>Firstame</label>
                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required>
                                </div>
                                <div class="form-group">
                                    <label>Middlename</label>
                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                </div>
                                <div class="form-group">
                                    <label>Lastame</label>
                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required>
                                </div>
                                
                                
                                 <div class="form-group ">
                                                <label class=" fw-bold">Suffix</label>
                                                <select class="form-control" name="suffix"  >
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                           </div>

                              <div class="form-group ">
                                              <label for="specialty">Select a Doctor Specialty:</label>
<select  class="form-control" required name="specialty">
    <option value="" disabled selected>Select a Doctor Specialty</option>
    <option value="Allergist">Allergist</option>
    <option value="Anesthesiologist">Anesthesiologist</option>
    <option value="Cardiologist">Cardiologist</option>
    <option value="Dermatologist">Dermatologist</option>
    <option value="Endocrinologist">Endocrinologist</option>
    <option value="Gastroenterologist">Gastroenterologist</option>
    <option value="Hematologist">Hematologist</option>
    <option value="Infectious disease specialist">Infectious Disease Specialist</option>
    <option value="Internist">Internist</option>
    <option value="Nephrologist">Nephrologist</option>
    <option value="Neurologist">Neurologist</option>
    <option value="Obstetrician/Gynecologist">Obstetrician/Gynecologist</option>
    <option value="Oncologist">Oncologist</option>
    <option value="Ophthalmologist">Ophthalmologist</option>
    <option value="Orthopedic surgeon">Orthopedic Surgeon</option>
    <option value="Otolaryngologist">Otolaryngologist (ENT Specialist)</option>
    <option value="Pediatrician">Pediatrician</option>
    <option value="Physical medicine and rehabilitation specialist">Physical Medicine and Rehabilitation Specialist</option>
    <option value="Plastic surgeon">Plastic Surgeon</option>
    <option value="Pulmonologist">Pulmonologist</option>
    <option value="Radiologist">Radiologist</option>
    <option value="Rheumatologist">Rheumatologist</option>
    <option value="Surgeon">Surgeon</option>
    <option value="Urologist">Urologist</option>
    <!-- Add more specialties as needed -->
</select>

                                           </div>


                                <div class="form-group">
                                    <label>Time Available</label>
                                    <input type="text" class="form-control" placeholder="Enter Time Available" name="time" required>
                                </div>


                                <div class="form-group">
                                    <label>About</label>
                                    <textarea type="text" class="form-control" placeholder="Enter About" name="about" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Doctor picture</label>
                                    <input type="file" class="form-control"  name="images"  accept="image/*" required>
                                </div>
                              
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/editdoctor.php"  enctype="multipart/form-data" >
                            <div class="form-group">
                                    <label>Firstame</label>
                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" id="fname" required>
                                </div>
                                <div class="form-group">
                                    <label>Middlename</label>
                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" required>
                                </div>
                                <div class="form-group">
                                    <label>Lastame</label>
                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" required>
                                </div>
                                
                                
                                 <div class="form-group ">
                                                <label class=" fw-bold">Suffix</label>
                                                <select class="form-control" name="suffix" id="suffix" >
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="">None</option>
                                                    <option value="Jr.">Jr.</option>
                                                    <option value="Sr.">Sr.</option>
                                                    <option value="I.">I</option>
                                                    <option value="II.">II</option>
                                                    <option value="II.">III</option>
                                                   
		
                                            </select>
                                           </div>

                              <div class="form-group ">
                                              <label for="specialty">Select a Doctor Specialty:</label>
<select  class="form-control" required name="specialty" id="specialty">

    <option value="" disabled selected>Select a Doctor Specialty</option>
    <option value="Allergist">Allergist</option>
    <option value="Anesthesiologist">Anesthesiologist</option>
    <option value="Cardiologist">Cardiologist</option>
    <option value="Dermatologist">Dermatologist</option>
    <option value="Endocrinologist">Endocrinologist</option>
    <option value="Gastroenterologist">Gastroenterologist</option>
    <option value="Hematologist">Hematologist</option>
    <option value="Infectious disease specialist">Infectious Disease Specialist</option>
    <option value="Internist">Internist</option>
    <option value="Nephrologist">Nephrologist</option>
    <option value="Neurologist">Neurologist</option>
    <option value="Obstetrician/Gynecologist">Obstetrician/Gynecologist</option>
    <option value="Oncologist">Oncologist</option>
    <option value="Ophthalmologist">Ophthalmologist</option>
    <option value="Orthopedic surgeon">Orthopedic Surgeon</option>
    <option value="Otolaryngologist">Otolaryngologist (ENT Specialist)</option>
    <option value="Pediatrician">Pediatrician</option>
    <option value="Physical medicine and rehabilitation specialist">Physical Medicine and Rehabilitation Specialist</option>
    <option value="Plastic surgeon">Plastic Surgeon</option>
    <option value="Pulmonologist">Pulmonologist</option>
    <option value="Radiologist">Radiologist</option>
    <option value="Rheumatologist">Rheumatologist</option>
    <option value="Surgeon">Surgeon</option>
    <option value="Urologist">Urologist</option>
    <!-- Add more specialties as needed -->
</select>

                                           </div>



                                <div class="form-group">
                                    <label>Time Available</label>
                                    <input type="text" class="form-control" placeholder="Enter Time Available" name="time" id="ta" required>
                                </div>


                                <div class="form-group">
                                    <label>About</label>
                                    <textarea type="text" class="form-control" placeholder="Enter About" name="about" id="about" required></textarea>
                                </div>


                                <div class="form-group">
                                        <label>Current Photo</label><br>
                                <img src="assets/img/weabitlogo.png" alt="..." class="img-fluid"   id="photo"> <br>


                                    <label>Change picture to:</label>
                                    <input type="file" class="form-control" name="images"  accept="image/*" >
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="id" name="docid" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#streettable').DataTable();


        });


function editDoctor(that){
   
   
   id= $(that).attr('data-id');
   fname= $(that).attr('data-fname');
     mname= $(that).attr('data-mname');
       lname= $(that).attr('data-lname');
         suffix= $(that).attr('data-suffix');
   spec = $(that).attr('data-spec');
    ta = $(that).attr('data-ta');
    about = $(that).attr('data-about');

    image = $(that).attr('data-image');

     username = $(that).attr('data-username');

    $('#id').val(id);
   $('#fname').val(fname);
    $('#mname').val(mname);
     $('#lname').val(lname);
      $('#suffix').val(suffix);
   $('#specialty').val(spec);
   $('#ta').val(ta);
   $('#about').val(about);

   var str = image;
    var n = str.includes("data:image");
    if(!n){
        image = 'assets/uploads/'+username+'/doctor/'+image;
    }
    $('#photo').attr('src',image);


}
    </script>
</body>
</html>