<?php // function to get the current page name
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>



<?php


$resid=$_SESSION['resid'];



$query = "SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd,tbl_residents.username as user FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno AND tbl_residents.res_id='$resid'";
$result = $conn->query($query);
$resident = $result->fetch_assoc();

?>

<?php if($_SESSION['role']=='Resident'): ?>
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-3 ">
                    <?php if(!empty($resident['res_picture'])): ?>
                     
                        <img src="<?= preg_match('/data:image/i', $resident['res_picture']) ? $resident['res_picture'] : "../assets/uploads/resident_profile/".$resident['res_id']."/".$resident['res_picture'] ?>"  alt="Resident Profile" class="avatar rounded-circle ">
                    <?php else: ?>
                        <img src="../assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>
                   
                </div>

              
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role']=='Resident' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        
                        
                         
                       <b class="text-success "><?= ucfirst($resident['user'])  ?></b><br>
                       
                     
                      <span class="caret"></span>
                   
               
                    <b   style="font-size:12px; color:blue; font-size:10px;"> <?=$resident['emailadd']?></b><br>

            
                    </a>
                   
                    <div class="collapse in" id="collapseExample">
            
                        <ul class="nav">

                        <?php if(!empty($resident['birthdate'])): ?>

                    <li class="nav-item <?= $current_page=='residentprofile.php' || $current_page=='resident_info.php' ? 'active' : null ?>">





                    <a href="residentprofile" >
                    <i class="fas fa-user-tie"></i>
                        <p>Resident Profile</p>
                    </a>
                     </li>

                     <?php if($resident['blocklisted']=='No Record'): ?>
                        <li class="nav-item <?= $current_page=='generatekey.php' ? 'active' : null ?>">
                    <a href="generatekey"  >
                    <i class="fas fa-user-lock"></i>
                        <p>Create an Account</p>
                    </a>

                     </li>
                           
                                                       <?php endif ?>

                                               


               

                     <li class="nav-item <?= $current_page=='changepassword.php' ? 'active' : null ?>">
                    <a href="changepassword"  >
                    <i class="fas fa-key"></i>
                        <p>Change Password</p>
                    </a>

                     </li>


                     <li class="nav-item <?= $current_page=='changepassword.php' ? 'active' : null ?>">
                    <a href="model/logout.php"  onclick="return confirm('Are you sure you want to Sign Out?');"  >
                    <i class="	fa fa-power-off"></i>
                        <p>Sign Out</p>
                    </a>

                     </li>



                     <?php else: ?>
                      
                    <?php endif ?>

                        </ul>
                    </div>
                </div>
            </div>
       
            <ul class="nav nav-primary">
          
            <?php if(!empty($resident['birthdate'])): ?>
                <li class="nav-item <?= $current_page=='dashboard.php' || $current_page=='resident_info.php' || $current_page=='purok_info.php'  ? 'active' : null ?>">
                    <a href="dashboard" >
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
               


              
               



              <!----

                <?php if($resident['username']):?>
                    <li class="nav-item <?= $current_page=='reqdocs.php'|| $current_page=='choose_req_type.php' || $current_page=='online_req.php' ? 'active' : null ?>">
                    <a href="reqdocs">
                    <i class="fa fa-cogs"></i> 
                        <p> Barangay Services</p>
                    </a>
                </li>
                
                
              
            ----->
              
          
                <?php endif ?>


                <?php if($resident['username'] ): ?>
                    <li class="nav-item <?= $current_page=='myrequest.php' || $current_page=='reqviewdetails.php' ? 'active' : null ?>">
                    <a href="myrequest">
                    <i class="icon-layers"></i>
                        <p>My Certificates</p>
                    </a>
                </li>
                <?php endif ?>

                <?php if($resident['username']): ?>
                    <li class="nav-item <?= $current_page=='borrowed_items.php' ? 'active' : null ?>">
                    <a href="borrowed_items">
                    <i class="icon-layers"></i>
                        <p>Borrowed Equipment</p>
                    </a>
                </li>
                
                
              
          
                <?php endif ?>

             
          
            
               


            </ul>

            <?php else: ?>
                <?php if($resident['username']): ?>
                    <li class="nav-item <?= $current_page=='getstarted.php' ? 'active' : null ?>">
                    <a href="getstarted">
                    <i class="fa fa-arrow-right"></i>
                        <p>Getting Started</p>
                    </a>
                </li>
                
                
              
          
                <?php endif ?>
                      <?php endif ?>
        
        </div>
    </div>
</div>


<?php else: header('Location: ../dashboard'); ?>
   

<?php endif ?>
