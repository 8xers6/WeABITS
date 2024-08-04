<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tblbarangay LEFT JOIN tblcity on tblbarangay.city_id=tblcity.city_id LEFT JOIN tblprovince on tblprovince.province_id=tblcity.province_id";
    $result = $conn->query($query);

    $barangay = array();
	while($row = $result->fetch_assoc()){
		$barangay[] = $row; 
	}
?>


<?php if(isset($_SESSION['username']) && $_SESSION['role']=='superadmin' ): ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Add Barangay Users -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Add Barangay Users</h2>
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
										<div class="card-title">List of Barangay Users</div>
										<div class="card-tools">
									
											
											
											    <button type="button" 
          class="btn btn-info btn-border btn-round btn-sm"
            data-bs-toggle="modal" 
            data-bs-target="#add">
											        	<i class="fa fa-plus"></i>
        Add Barangay Users
        </button>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="streettable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">BarNo.</th>
                                                    <th scope="col">Barangay Name</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Province</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Created_At</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($barangay)): ?>
                                                    <?php foreach($barangay as $row): ?>
                                                    <tr>
                                                        <td><?= $row['bar_no'] ?></td>
                                                        <td><?= $row['barangayname'] ?></td>
                                                        <td><?= $row['city'] ?></td>
                                                        <td><?= $row['province'] ?></td>
                                                        <td><?= $row['username'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['created_at'] ?></td>
                                                        <td>

                                                        
                                                            <div class="form-button-action">
                                                         <a type="button" href="#changeemail"  data-bs-toggle="modal" 
            data-bs-target="#changeemail" class="btn btn-link btn-primary" title="Edit Barangay" onclick="editBarangay(this)" 
                                                                    data-barno="<?= $row['bar_no'] ?>"  data-brgyname="<?= $row['barangayname'] ?>"  data-uname="<?= $row['username'] ?>" data-email="<?= $row['email'] ?>" >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                
                                                                   <a type="button" href="#changepassword"  data-toggle="modal" 
             class="btn btn-link btn-primary" title="Change password" onclick="editBarangay(this)" 
                                                                    data-barno="<?= $row['bar_no'] ?>"  data-brgyname="<?= $row['barangayname'] ?>"  data-uname="<?= $row['username'] ?>" data-email="<?= $row['email'] ?>" >
                                                                   <i class="fa fa-lock"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_barangay.php?id=<?= $row['bar_no'] ?>" onclick="return confirm('Are you sure you want to delete this Barangay this cant be undone?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>

                                                            
                                                        </td>
                                                    </tr>
                                                    <?php  endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th scope="col">BarNo.</th>
                                                    <th scope="col">Barangay Name</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Province</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Created_At</th>
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
            <div class="modal fade" id="add" tabindex="-1"  data-bs-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Barangay Registration</h5>
                            <a href="/addbarangay.php" class="btn btn-danger text-white"  onclick="return confirm('Are you sure to cancel this registration?');">
                              Cancel
                            </a>
                             
                        </div>
                        <div class="modal-body">
                            <form  id="email_verify" >
                                 <div class="form-group">
                                    <label>Email</label> 
                                                  <div id="div1"></div>                    <input type="text" class="form-control" placeholder="Enter Email" name="email" required>  
                                    </div>
                                  <div class="form-group">
                                 <button type="submit" class="btn btn-primary form-control" id="emailbtn" onclick="return confirm('Are you sure you want toproceed');">Send OTP</button>
                                 
                                 </div>
                            </form>
                            
                            
                            
                            
                                 <form   id="otp_verify" style="display:none;"  >
                                 <div class="form-group">
                                    <label>OTP Code</label>
                                    <div id="div2"></div>
                                    <input type="number" class="form-control" placeholder="Enter OTP Code" name="otp" required>
                                    
                                  
                                </div>
                                
                                  <div class="form-group">
                                 <button type="submit" class="btn btn-primary form-control"  id="verifybtn">Verify OTP</button>
                                 
                                 </div>
                            </form>
                            
                             <form   id="addbarangay" style="display:none;" >
                              <div id="div3"></div>
                                <div class="form-group">
                                    <label>Barangay Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Barangay Name" name="barangayname" required>
                                    
                                </div>

                               <!-----

                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" name="password" type="password" class="form-control mb-1" required>
				
					           <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                     <button type='button' onclick="genPassword()"  class="btn btn-primary">Generate Password</button>
                                     <button type='button' onclick="copyPassword()"  class="btn btn-primary">Copy Password</button>
                                  
                                </div>---->
                                <div class="form-group">
                                <label>Province</label>
                                         
                                                            <select name="province" class="form-control input-sm"  id="province"  required>
                                                            <option  disabled selected="" value="" >-- Select Province -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblprovince");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['province_id'].'">'.$row['province'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                      
                                                            </div>
                                                            
                                                                 <div class="form-group">
                                    <label>Select Municipality</label>
                                   
                                                            
                                                            <select name="city" class="form-control border" id="city"  required >
                                                            <option disabled selected value="">-- Select Municipality -- </option>
                                                        
                                                            </select>
                                                        </div>
                                                            <div class="form-group">
                                 <button type="submit" class="btn btn-primary form-control" id="submitbtn" onclick="return confirm('Are you sure you want to proceed');">Submit</button>
                                 
                                 </div>
                                                            
                                                                </form>
                                                                
                                                                
                                                                
                    <span role="alert" id="loading" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                        

                                 
                            
                        </div>
                     
            
                    </div>
                </div>
            </div>
            
            
            
            
               <!-- Modal change email-->
            <div class="modal fade" id="changeemail" tabindex="-1"  data-bs-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Email Address</h5>
                            <a href="/addbarangay.php" class="btn btn-danger text-white"  onclick="return confirm('Are you sure to cancel this registration?');">
                              Cancel
                            </a>
                             
                        </div>
                        <div class="modal-body">
                            <form  id="email_change" >
                            
                            <div class="form-group">
                                    <label>Barangay Name</label>
                                    <input type="text" id="brgyname" class="form-control fw-bold" readonly placeholder="Enter Barangay Name" name="barangayname" required>
                                    
                                    
                                </div>
                                 <div class="form-group">
                                    <label>Email</label> 
                                                  <div id="div1s"></div>                    <input type="text" class="form-control" placeholder="Enter Email" name="email" required>  
                                    </div>
                                  <div class="form-group">
                                 <button type="submit" class="btn btn-primary form-control" id="emailbtns" onclick="return confirm('Are you sure you want toproceed');">Send OTP</button>
                                 
                                 </div>
                            </form>
                            
                            
                            
                            
                                 <form   id="otp_verifies" style="display:none;"  >
                                 <div class="form-group">
                                    <label>OTP Code</label>
                                    <div id="div2s"></div>
                                    <input type="number" class="form-control" placeholder="Enter OTP Code" name="otp" required>
                                      <input type="text" id="barno" name="barno"class="form-control fw-bold" readonly >
                                  <input type="hidden" class="form-control fw-bold"  name="changeemail" value="yesssed" required>
                                </div>
                                
                                  <div class="form-group">
                                 <button type="submit" class="btn btn-primary form-control"  id="verifybtns">Verify OTP</button>
                                 
                                 </div>
                            </form>
                            
                            
                                                                
                                                                
                                                                
                    <span role="alert" id="loadings" aria-hidden="true" style="display:none; color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="assets/img/ajax-loader.gif" style="height: 20px; width: 20px; "/> </span>   
                                                        

                                 
                            
                        </div>
                     
            
                    </div>
                </div>
            </div>

         
<!-- Modal chhange -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Barangay Password</h5>
              
            </div>
            <div class="modal-body">
                <form method="POST" action="model/changepasswordbarangay.php">
                    <div class="form-group">
                        <label>Barangay Name</label>
                          <input type="text" class="form-control fw-bold" style="color:black" readonly id="brgy_name" required >
                        <input type="hidden" class="form-control" name="barno" id="bar_no" required >
                    </div>
                    <div class="form-group form-floating-label">
                        <label>SuperAdmin Password</label>
                        
                        <input type="password" id="cur_passc" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
                        <span toggle="#cur_passc" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>New Password</label>
                        <input type="password" id="new_passc" class="form-control" placeholder="Enter New Password" name="new_pass" required >
                        <span toggle="#new_passc" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Confirm Password</label>
                        <input type="passwor" id="con_passc" class="form-control" placeholder="Confirm Password" name="con_pass" required >
                        <span toggle="#con_passc" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <?php if(isset($_SESSION['username'])): ?>
                            <button type="submit" class="btn btn-primary">Change</button>
                            <?php endif ?>
            </div>
            </form>
        </div>
    </div>
</div>

<style>
    
    
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
	
	
	    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
         integrity=
"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>

    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#streettable').DataTable();
            $('.search_select_box select').selectpicker();



          
        });










    </script>


<script>


        
     
  



$('#province').change(function(){


var prov=$("#province").val();

$.ajax({
type: 'POST',
url: 'model/place.php',
data: { prov: prov, },
success: function(response) {
$('#city').html(response);

}

});

});



$('#provinces').change(function(){


var prov=$("#provinces").val();

$.ajax({
type: 'POST',
url: 'model/place.php',
data: { prov: prov, },
success: function(response) {
$('#cities').html(response);

}

});

});



//add
var password=document.getElementById("password");

function genPassword() {
   var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   var passwordLength = 12;
   var password = "";
for (var i = 0; i <= passwordLength; i++) {
  var randomNumber = Math.floor(Math.random() * chars.length);
  password += chars.substring(randomNumber, randomNumber +1);
 }
       document.getElementById("password").value = password;
}

function copyPassword() {
 var copyText = document.getElementById("password");
 copyText.select();
 document.execCommand("copy");  
}







//edit
var password=document.getElementById("passwords");

function genPasswords() {
   var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   var passwordLength = 12;
   var password = "";
for (var i = 0; i <= passwordLength; i++) {
  var randomNumber = Math.floor(Math.random() * chars.length);
  password += chars.substring(randomNumber, randomNumber +1);
 }
       document.getElementById("passwords").value = password;
}

function copyPasswords() {
 var copyText = document.getElementById("passwords");
 copyText.select();
 document.execCommand("copy");  
}


$(document).ready(function (e) {
  $("#email_verify").on('submit',(function(e) {
   e.preventDefault();
   
   
   
   document.getElementById("loading").style.display="block";
    document.getElementById("emailbtn").style.display="none";

   $.ajax({
    url: "otp.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
 
  if($.trim(response)=="invalidemail"){
    $('#div1').html("<b style='color:red;' class='text-center'>Invalid Email</b>");
    document.getElementById("loading").style.display="none";
     document.getElementById("emailbtn").style.display="block";

  }else{
      
        if($.trim(response)=="emailistaken"){
    $('#div1').html("<b style='color:red;' class='text-center'>Email is already taken</b>");
    document.getElementById("loading").style.display="none";
 document.getElementById("emailbtn").style.display="block";
  }else{
      
      document.getElementById("loading").style.display="none";
      document.getElementById("otp_verify").style.display="block";
      
      
      document.getElementById("email_verify").style.display="none";
      
  }
      
      
  }



   

 },
 


         
});
 

  
  }));
  
  
  
  
  
  
$("#otp_verify").on('submit',(function(e) {
   e.preventDefault();
document.getElementById("loading").style.display="block";
document.getElementById("verifybtn").style.display="none";
   $.ajax({
    url: "otp_verify.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
 
  if($.trim(response)=="incorrect"){
    $('#div2').html("<b style='color:red;' class='text-center'>Incorrect OTP</b>");
    document.getElementById("verifybtn").style.display="block";
document.getElementById("loading").style.display="none";
  }else{
      
    
      document.getElementById("loading").style.display="none";
      document.getElementById("otp_verify").style.display="none";
      
      
      document.getElementById("addbarangay").style.display="block";
      
  
      
      
  }



   

 },
 


         
});
 

  
  }));
  
  
  
  
  
    
$("#addbarangay").on('submit',(function(e) {
   e.preventDefault();
   
   
   document.getElementById("submitbtn").style.display="none";
document.getElementById("loading").style.display="block";
   $.ajax({
    url: "model/addbarangay.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
     
     
     
     
   if($.trim(response)=="success"){
                document.getElementById("loading").style.display="none";
                window.location.pathname = ('/addbarangay')
  
  

     
  
      }else{
         
       document.getElementById("verifybtn").style.display="block";
         
      }
   

 },
 


         
});
 

  
  }));
  
  
  
  
  
    
$("#otp_verifies").on('submit',(function(e) {
   e.preventDefault();
document.getElementById("loadings").style.display="block";
document.getElementById("verifybtns").style.display="none";
   $.ajax({
    url: "otp_verifies.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
 
 //$('#div2s').html(response);
  if($.trim(response)=="incorrect"){
$('#div2s').html("<b style='color:red;' class='text-center'>Incorrect OTP</b>");
    document.getElementById("verifybtns").style.display="block";
    document.getElementById("loadings").style.display="none";
  }else{
      
     document.getElementById("verifybtns").style.display="block";
       document.getElementById("loadings").style.display="none";
              window.location.pathname = ('/addbarangay')
      
  
      
      
  }



   

 },
 


         
});
 

  
  }));
  
  
  
  
  
    $("#email_change").on('submit',(function(e) {
   e.preventDefault();
   
   
   
   document.getElementById("loadings").style.display="block";
    document.getElementById("emailbtns").style.display="none";

   $.ajax({
    url: "otp.php",
type: "POST",
data:  new FormData(this),
contentType: false,
    cache: false,
processData:false,
beforeSend : function()
{

},
success:  function(response)
 { 
 
  if($.trim(response)=="invalidemail"){
    $('#div1').html("<b style='color:red;' class='text-center'>Invalid Email</b>");
    document.getElementById("loadings").style.display="none";
     document.getElementById("emailbtns").style.display="block";

  }else{
      
        if($.trim(response)=="emailistaken"){
    $('#div1s').html("<b style='color:red;' class='text-center'>Email is already taken</b>");
    document.getElementById("loadings").style.display="none";
 document.getElementById("emailbtns").style.display="block";
  }else{
      
      document.getElementById("loadings").style.display="none";
      document.getElementById("otp_verifies").style.display="block";
      
      
      document.getElementById("email_change").style.display="none";
      
  }
      
      
  }



   

 },
 


         
});
 

  
  }));
  
  
  
  
  
  
  
 });

    </script>
</body>
</html>

<?php endif ?>
