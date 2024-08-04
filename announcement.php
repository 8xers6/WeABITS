<?php include 'server/server.php' ?>
<?php

$barno=$_SESSION['bar_no'];
$brgyname= $_SESSION['brgyname'];
    $query = "SELECT * FROM tblannouncement WHERE bar_no=$barno ORDER BY dateofactivity DESC";
    $result = $conn->query($query);

    $announcement = array();
    while($row = $result->fetch_assoc()){
        $announcement[] = $row; 
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Announcement -  Barangay Management System</title>
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
                                <h2 class="text-white fw-bold">Announcements</h2>
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
                                        <div class="card-title">Announcement Information</div>
                                        <div class="card-tools">
                                            <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm fw-bold">
                                                <i class="fa fa-plus"></i>
                                                Announcement
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="announ" class="display table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Activity Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Date of Activity</th>
                                                    <th scope="col">Place of Activity</th>
                                                    <th scope="col">Organizer</th>
                                                  
                                                 
                                                     <th scope="col">Status</th>

                                                      <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                           
                                             <tbody>
                                                <?php if(!empty($announcement)): ?>
                                                    <?php $no=1; foreach($announcement as $row): ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $row['activityname'] ?></td>
                                                        <td><?= substr($row['description'] , 0, 10) ?>...</td>
                                                         <td><?= $row['dateofactivity'] ?></td>
                                                         <td><?= $row['placeofactivity'] ?></td>
                                                         <td><?= $row['organizername'] ?></td>

                                                      
                                                         <td><b><?= $row['status']=='Active' ? '<span class="badge badge-success">Active</span>' :'<span class="badge badge-danger">Inactive</span>' ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                         <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Announcement" 

                                                         onclick="editAnnouncement(this)" 

         data-name="<?= $row['activityname'] ?>" data-des="<?= $row['description'] ?>"   data-date="<?= $row['dateofactivity'] ?>" 
         data-place="<?= $row['placeofactivity'] ?>" 
         data-stat="<?= $row['status'] ?>" 

         data-org="<?= $row['organizername'] ?>" 
         
         data-pic ="<?= $row['picture'] ?>" 
         data-brgy="<?= $_SESSION['username'];?>"
         data-id="<?= $row['id'] ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_announcement.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this Announcement?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
                                                 <th scope="col">No.</th>
                                                    <th scope="col">Activity Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Date of Activity</th>
                                                    <th scope="col">Place of Activity</th>
                                                    <th scope="col">Organizer</th>
                                                
                                                     <th scope="col">Status</th>

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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Create Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/save_announcement.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Activity Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Activity Name"  name="activityname" required>
                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Place of Activity</label>
                                            <input type="text" class="form-control" placeholder="Enter Place of Activity"  name="placeofactivity" required>
                                </div>
                                <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Date of Activity</label>
                                            <input type="date" class="form-control"  name="dateofactivity"  required>
                                </div>

                                <div class="form-group border rounded mb-2 shadow-sm">
                                    <label>Description</label>
                                    <textarea class="form-control" placeholder="Enter Announcement Description"  name="description"></textarea>
                                </div>
                        </div>
                        <div class="col-md-6">
                       
                     

              <div class="form-group  border rounded shadow-sm mb-2">
                                    <label>Status</label>
                                    <select class="form-control"  required name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>


                                <div class="form-group  border rounded  shadow-sm mb-2">
                                    <label>Organizer</label>
                                            <input type="text" class="form-control" placeholder="Enter Organizer Name"    name="organizer" required>
                                </div>

                                <div class="form-group   border rounded shadow-sm mb-2">
                       
                                  
                       <h4 style="text-align:center; font-weight:bolder;">Add Photo</h4>
                       <input type="file" class="addphoto" onchange="previewFile()" name="img"   accept="image/*" required>
                     
                    
                     
                    

              </div>



                           
                        </div>

                      


                    </div>
                   
                   
                    
                    
                   
                  
            </div>
            <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary fw-bold  " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary fw-bold">Create</button>
                        </div>
            </form>
        </div>
    </div>
</div>

             

   







        <!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Announcement</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_ann.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  border rounded mb-2 shadow-sm">
                                    <label>Activity Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Activity Name" id="actname" name="activityname" required>
                                </div>

                                <div class="form-group  border rounded mb-2 shadow-sm">
                                <label>Place of Activity</label>
                                            <input type="text" class="form-control" id="place"  name="placeofactivity" required>
                                </div>
                                <div class="form-group  border rounded mb-2 shadow-sm">
                                <label>Date of Activity</label>
                                            <input type="date" class="form-control" id="date"  name="dateofactivity"  required>
                                </div>

                               
                                <div class="form-group border rounded mb-2 shadow-sm">
                                <label>Current Photo</label><br>
                                <img src="assets/img/weabitlogo.png" alt="..." class="img-fluid     "   id="photo"> 

                                                </div>
                        </div>

                        <div class="col-md-6">
                       
                     

                       <div class="form-group  border rounded shadow-sm mb-2">
                                             <label>Status</label>
                                             <select class="form-control"  required name="status" id="stat">
                                                 <option value="Active">Active</option>
                                                 <option value="Inactive">Inactive</option>
                                             </select>
                                         </div>
         
         
                                         <div class="form-group  border rounded  shadow-sm mb-2">
                                             <label>Organizer</label>
                                                     <input type="text" class="form-control" placeholder="Enter Organizer Name" id="org"   name="organizer" required>
                                         </div>

                                         <div class="form-group border rounded mb-2 shadow-sm">
                                <label>Description</label>
                                    <textarea class="form-control" placeholder="Enter Announcement Description" id="des" name="description"></textarea>
                                </div>
         
                                         <div class="form-group  text-center  border rounded shadow-sm mb-2">
                                
                                       
                                         <h4 style="text-align:center; font-weight:bolder;">Change Image To:</h4>
                                    <input type="file" class="addimg" onchange="previewimage()" name="img"   accept="image/*"  hidden>
                              
                             
                                <img src="assets/img/uploadimage.png" class="img_preview  rounded"  width="80%" alt="Image preview" >
                                <button type="button" class="new-btn btn btn-primary rounded mt-3 mb-4 fw-bold" onclick="imagechange()">CHOOSE A IMAGE</button>
                             
                               
                                 
                       </div>
         
         
         
                                    
                                 </div>


                    </div>
                   
                   
                  
            </div>
            <div class="modal-footer">
                            <input type="hidden" id="ann_id"  name="id" >
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

    <script>
        $(document).ready(function() {
            $('#announ').DataTable();
          
        });

        
    </script>




<script >
    
    function previewFile() {
const preview = document.querySelector('.photo_preview');



const file = document.querySelector('.addphoto').files[0];
const reader = new FileReader();

reader.addEventListener("load", () => {
// convert image file to base64 string
preview.src = reader.result;
}, false);

if (file) {
reader.readAsDataURL(file);
}
}





</script>





<script>

const customBtn = document.querySelector('.custom-btn');
const file = document.querySelector('.addphoto');

function defaultBtnActive(){
    
    file.click();
 
    
 
 }
 


</script>



<script >
    
    function previewimage() {
const preview = document.querySelector('.img_preview');



const file = document.querySelector('.addimg').files[0];
const reader = new FileReader();

reader.addEventListener("load", () => {
// convert image file to base64 string
preview.src = reader.result;
}, false);

if (file) {
reader.readAsDataURL(file);
}
}





</script>



<script>

const customBtns = document.querySelector('.new-btn');
const files = document.querySelector('.addimg');

function  imagechange(){
    
    files.click();
 
    
 
 }
 


</script>







</body>
</html>