<?php include '../server/server.php' ?>
<?php 




if(!empty($_SESSION['otp'])){

    unset($_SESSION['otp']);
  }


  if(!empty($_SESSION['s_email'])){

    unset($_SESSION['s_email']);
  }


  if(!empty($_SESSION['otpvalidation'])){

    unset($_SESSION['otpvalidation']);
  }
 

	
$barno=$_SESSION['barno'];



$resid=$_SESSION['resid'];

$query1 = "SELECT * FROM tbl_residents WHERE res_id=$resid";
$result1 = $conn->query($query1);
$resident = $result1->fetch_assoc();

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title> Generate Key-  Weabits</title>
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
				
				<div class="page-inner mt-2 ">
						<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>

				<div class="row mt--2 justify-content-center">
            
				<div class="col-md-6">

                           

					<div class="card border" id="emaildiv">
						<div class="card-header bg-primary-gradient">
							<div class="card-head-row">
								<div class="card-title fw-bold text-white">Create User Account to Family Members</div>
								<div class="card-tools">
									
								</div>
							</div>
						</div>
						<div class="card-body" >


 


						<form method="POST" id="otpform">
						
							<div class="form-group form-floating-label">
								<label>Email Address</label>
								<input type="email" class="form-control" placeholder="Enter Email Address" name="email" required >
								
							</div>
						

                            <div id="errwarning" class="text-center">
                                    
                            
							</div>
                            <span role="alert" id="emailloading" class="text-center" aria-hidden="true" style="display:none;color:black; font-size:15px; "> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
							<div class="row justify-content-center m-4">
							
								<button type="submit" class="btn btn-primary fw-bold" id="sendotp">Send OTP</button>
							</div>
							</form>

                        </div>
                    </div>



                    <div class="card border" id="otpdiv" style="display:none;">
						<div class="card-header bg-primary-gradient">
							<div class="card-head-row">
								<div class="card-title fw-bold text-white text-center">Email Verification OTP Code</div>
								<div class="card-tools">
									
								</div>
							</div>
						</div>
						<div class="card-body text-center" >



                        <div id="incorrect"></div>
                        <form  id="otpveriform">


<input

      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code1"
      name="c1"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 1)"
      onKeydown="keydownHandler(event, 'code', 1)"
      onKeyup="autotab(event, 1, 'code2')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code2"
      name="c2"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 2)"
      onKeydown="keydownHandler(event, 'code', 2)"
      onKeyup="autotab(event, 2, 'code3')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code3"
      name="c3"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 3)"
      onKeydown="keydownHandler(event, 'code', 3)"
      onKeyup="autotab(event, 3, 'code4')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code4"
      name="c4"
      class=" code text-center w-8 xxs:w-12 mx-1 border-primary rounded "
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 4)"
      onKeydown="keydownHandler(event, 'code', 4)"
      onKeyup="autotab(event, 4, 'code5')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code5"
      name="c5"
      class="code text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 5)"
      onKeydown="keydownHandler(event, 'code', 5)"
      onKeyup="autotab(event, 5, 'code6')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code6"
      name="c6"
      class="code text-center w-8 xxs:w-12 mx-1  border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 6)"
      onKeydown="keydownHandler(event, 'code', 6)"
      onKeyup="autotab(event, 6, 'code7')"
      required
    />
                   
					
				
                <div class="form-action mb-3">
            
                <button  class="btn btn-primary fw-bold pl-5 pr-5 mt-3">VERIFY</button>
               
				      
				</div>

                <span role="alert" id="otploading" aria-hidden="true" style="display:none;color:black; font-size:15px; "> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
        <div class="div1" id="div1"></div>


                                    </div>

                                    

                                    <span role="alert" id="loading" aria-hidden="true" style="color:black; font-size:15px; text-align:center; position:relative"> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
                               







    </form>
                            


 



                        </div>

                        <div class="card border" style="display:none;" id="familydiv">
						<div class="card-header bg-primary-gradient">
							<div class="card-head-row">
								<div class="card-title fw-bold text-white">Create User Account to Family Members</div>
								<div class="card-tools">
									
								</div>
							</div>
						</div>
						<div class="card-body" >


 


						<form method="POST" id="familyform">
						
					
							
                            <div class="form-group">
                                <label>Choose Family Members </label>
                                    <div class="search_select_box" style="border:solid black 1px; border-radius:5px;">
                                  
                                  <select name="resid" class="form-control" required>
                                  <option selected="" disabled="" value="">-- Select Residents -- </option>
                                  <?php

                                  $hno=$resident['h_no'];
                                      $squery = mysqli_query($conn,"SELECT *,tbl_residents.res_id as res_id,YEAR(created_at)as `year`,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.bar_no,5,'0') as bar_no,tbl_residents.email as emails FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id   WHERE tblhousehold.bar_no=$barno AND tbl_residents.h_no=$hno AND tbl_residents.relation Not in ('Head') AND tbl_residents.email is null");
                                      while ($row = mysqli_fetch_array($squery)){
                                          echo '
                                              <option value="'.$row['res_id'].'">Resident ID:'.$row['res_id'].' | '.$row['firstname'].'  '.$row['middlename'].'  '.$row['lastname'].' | Relation:'.$row['relation'].'</option>    
                                          ';
                                      }
                                  ?>
                                              </select>
                                 </div>
                                    </div>

							</div>
                            <span role="alert" id="famloading" class="text-center" aria-hidden="true" style="display:none;color:black; font-size:15px; "> Please Wait <img src="./assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/> </span>
                           
							<div class="row justify-content-center m-4">
                            <div id="errfamily"></div>
                           
								<button type="submit" class="btn btn-primary" id="famacc" onclick="return confirm('Are you sure you want to proceed?');">Create Account</button>
							</div>
							</form>

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



    <style>



.code{
  border: 2px solid #333;
  padding: 5px 5px;
  font-weight:bold;
  width: 30px;
  text-align: center;
}

/* Chrome, Safari, Edge, Opera */
.code::-webkit-outer-spin-button,
.code::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
.code[type="number"] {
  -moz-appearance: textfield;
}


</style>


    <script>

 
















$(document).ready(function (e) {

    $("#otpform").on('submit',(function(e) {
   e.preventDefault();
   $('#errwarning').html('');
   document.getElementById("emailloading").style.display = "block";
   document.getElementById("sendotp").style.display = "none";
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
    success:  function(data)
       { 
       
       
     
     
      

        if($.trim(data)=="emailistaken"){
            document.getElementById("emailloading").style.display = "none";
            $('#errwarning').html('<b style="color:red">Email is already taken!</b>');
            document.getElementById("sendotp").style.display = "block";
        }else{


            document.getElementById("emaildiv").style.display = "none";
            document.getElementById("otpdiv").style.display = "block";

           




        }

      

         
     
       },
       
     
     
               
     });
  }));





  $(document).ready(function (e) {
  $("#otpveriform").on('submit',(function(e) {
   e.preventDefault();




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
    $('#incorrect').html("<b style='color:red;' class='text-center'>Incorrect - OTP Code!</b>");
    document.getElementById("otp").style.display = "block";

  }else{
    document.getElementById("familydiv").style.display = "block";
  
    document.getElementById("otpdiv").remove();
  
  }



   

 },
 


         
});
 

  
  }));
 }); 











  $("#familyform").on('submit',(function(e) {
   e.preventDefault();
 
   document.getElementById("famloading").style.display = "block";
   document.getElementById("famacc").style.display = "none";
   //document.getElementById("famacc").style.display = "none";
   $.ajax({
          url: "model/generate_key.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
          cache: false,
    processData:false,
    beforeSend : function()
    {
    
    },
    success:  function(data)
       { 
       
        $('#errfamily').html(data);

    
     
        if($.trim(data)=='success'){
            document.getElementById("famloading").style.display = "none";
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
          window.location.pathname = ('/weabits/resident/generatekey')



        }else{




        }

       
      
      

         
     
       },
       
     
     
               
     });
  }));
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

        </script>


<script>










    </script>
</body>
</html>