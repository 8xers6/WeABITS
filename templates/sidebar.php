<?php // function to get the current page name
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>

<?php
/*
$database	= 'u418722912_weabits';
$username	= 'u418722912_root';
$host		= 'localhost';
$password	= '9E/rw>!dK';

ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);
// error_reporting(0);

$conn = new mysqli($host,$username,$password,$database);

if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error());
}
*/
?>





<?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty($_SESSION['avatar'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>
                   
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' ||$_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                        <?php if($_SESSION['role']=='administrator' ||$_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>
                      
                          
                        <?= isset($_SESSION['username']) && $_SESSION['role']=='administrator'||$_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon' ? '<span class="caret"></span>' : null ?> 
                        <?php endif ?>
                        <?php if($_SESSION['role']=='administrator'): ?>
                        
                        
                        
                        <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                            
                            
                            
                            
                       
                        <?php endif ?>
                        
                        
                                   <?php if($_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>
                        
                        
                        
                        <?= isset($_SESSION['clerkusername']) ? ucfirst($_SESSION['clerkusername']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                            
                            
                            
                            
                       
                        <?php endif ?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            
                                                 <?php if($_SESSION['role']=='administrator'): ?>
                           
                        <li class="nav-item ">
                        <a href="#changepass" data-toggle="modal">
                              
                                    <span class="link-collapse"><i class="fas fa-key"></i></span>Change Password
                                </a>
                        </li>
                 

<?php endif?>
                     <li class="nav-item <?= $current_page=='changepassword.php' ? 'active' : null ?>">
                    <a href="model/logout.php"  onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        <p>Sign Out</p>
                    </a>

                     </li>

                          
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">

           <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='Clerk'  || $_SESSION['role']=='Population' || $_SESSION['role']=='BHW' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>
          

                <li class="nav-item <?= $current_page=='dashboard.php' || $current_page=='residents_info.php'  ? 'active' : null ?>">
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
           

                <li class="nav-item <?= $current_page=='official.php' ? 'active' : null ?>">
                    <a href="official">
                        <i class="fas fa-user-tie"></i>
                        <p>Brgy Official and Staff</p>
                    </a>
                </li>

                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'  || $_SESSION['role']=='Population'): ?>


                <li class="nav-item <?= $current_page=='createaccount.php' || $current_page=='verify.php' || $current_page=='residents.php' || $current_page=='household_records.php' || $current_page=='view_householdmembers.php'  ? 'active' : null ?>">
                    <a href="#Population" data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <i class="icon-people"></i>
                            <p>Population</p>
                        <span class="caret"></span>
                    </a>
                    <div class="border rounded collapse <?= $current_page=='createaccount.php'  ||$current_page=='verify.php' || $current_page=='residents.php'|| $current_page=='view_householdmembers.php'  || $current_page=='household_records.php' ? 'show' : null ?>" id="Population">
                        <ul class="nav nav-collapse">


                    <li class="nav-item <?= $current_page=='residents.php' || $current_page=='generate_residents.php' || $current_page=='masterlist.php' ? 'active' : null ?>">
                    <a href="residents">
                        <i class="icon-people"></i>
                        <p>All Residents</p>
                    </a>
                </li>
              
               
            
              

                <li class="nav-item <?= $current_page=='household_records.php' || $current_page=='view_householdmembers.php'  ? 'active' : null ?>">
                    <a href="household_records">
                    <i class='fas fa-home'></i>
                        <p>HouseHold Records</p>
                    </a>
                </li>
                
                                           
                        <li class="nav-item <?= $current_page=='verify.php' || $current_page=='.php'  ? 'active' : null ?>">
                    <a href="verify">
                    <i class="fa fa-search"></i>
                        <p>Verify Resident</p>
                    </a>
                    </li>
 <li class="nav-item <?= $current_page=='createaccount.php' || $current_page=='.php'  ? 'active' : null ?>">
                    <a href="createaccount">
                    <i class="fas fa-user-edit"></i>
                        <p>Create Account</p>
                    </a>
                    </li>

                         


                    

                     
                        
                        
                        
                        </ul>
                    </div>
                </li>

                <?php endif?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'  || $_SESSION['role']=='BHW'): ?> 
                <li class="nav-item <?=$current_page=='household_records.php' || $current_page=='medicine.php'||  $current_page=='patientrecord.php'||  $current_page=='reqmedicine.php' ||$current_page=='pregdetails.php' || $current_page=='newborn.php' ||  $current_page=='newborndetails.php'  ||  $current_page=='doctors.php' || $current_page=='pregnant.php' ||  $current_page=='patient.php'  ? 'active' : null ?>">
                    <a href="#health" data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <i class="	fa fa-heartbeat"></i>
                            <p>Health Center</p>
                        <span class="caret"></span>
                    </a>
                    <div class="border rounded collapse <?=$current_page=='household_records.php'|| $current_page=='pregdetails.php'||$current_page=='medicine.php'||  $current_page=='patientrecord.php' ||  $current_page=='reqmedicine.php'  ||  $current_page=='doctors.php' ||  $current_page=='newborn.php' ||  $current_page=='newborndetails.php' || $current_page=='pregnant.php' || $current_page=='patient.php'  ? 'show' : null ?>" id="health">
                        <ul class="nav nav-collapse">
                             <!---
                            <?php if(isset($_SESSION['username']) &&  $_SESSION['role']=='BHW'): ?> 
                               <li class="nav-item <?= $current_page=='household_records.php' || $current_page=='view_householdmembers.php'  ? 'active' : null ?>">
                    <a href="household_records">
                    <i class='fas fa-home'></i>
                        <p>HouseHold Records</p>
                    </a>
                </li>
                          <?php endif ?> 
                          
                          
                          --->
                        <li class="nav-item <?= $current_page=='medicine.php' || $current_page=='patientrecor.php' ? 'active' : null ?>">
                    <a href="medicine">
                        <i class="fas fa-pills"></i>
                        <p>Medicine Inventory</p>
                    </a>
                </li>
                
                
             
                
                 <li class="nav-item <?= $current_page=='patient.php' || $current_page=='patientrecord.php'  ? 'active' : null ?>">
                    <a href="patient">
                  <i class='icon-layers'></i>
                        <p>Patient</p>
                    </a>
                </li>


                <li class="nav-item <?= $current_page=='newborn.php' ||  $current_page=='newborndetails.php' ? 'active' : null ?>">
                    <a href="newborn">
                  <i class='icon-layers'></i>
                        <p>New Born Babies</p>
                    </a>
                </li>

                        <li class="nav-item <?= $current_page=='pregnant.php' || $current_page=='pregdetails.php'  ? 'active' : null ?>">
                    <a href="pregnant">
                    <i class='icon-layers'></i>
                        <p>Pregnant</p>
                    </a>
                </li>
                
                <li class="nav-item <?= $current_page=='doctors.php'  ? 'active' : null ?>">
                    <a href="doctors">
                        <i class="fa fa-user-md"></i>
                        <p>Doctors</p>
                    </a>
                </li>


                

                    

                     
                        
                        
                        
                        </ul>
                    </div>
                </li>




<?php endif?>

<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'  || $_SESSION['role']=='Clerk'): ?>


                <li class="nav-item <?=$current_page=='listbrgyid.php' || $current_page=='barangayid.php' ||  $current_page=='residents_certification.php' || $current_page=='generate_brgy_certs.php' || $current_page=='building_permit.php' || $current_page=='generate_buildingpermit.php' ||  $current_page=='residents_indigency.php'|| $current_page=='generate_indigency_cert.php' || $current_page=='business_permit.php' || $current_page=='generate_business_permit.php' || $current_page=='cedula.php' ? 'active' : null ?>">
                    <a href="#documents" data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <i class="icon-layers"></i>
                            <p>Certificates</p>
                        <span class="caret"></span>
                    </a>
                    <div class="border rounded collapse <?=  $current_page=='listbrgyid.php'|| $current_page=='barangayid.php' || $current_page=='residents_certification.php'|| $current_page=='generate_brgy_certs.php'  || $current_page=='building_permit.php'  || $current_page=='generate_buildingpermit.php' ||  $current_page=='residents_indigency.php'|| $current_page=='generate_indigency_cert.php' || $current_page=='business_permit.php' || $current_page=='generate_business_permit.php' || $current_page=='cedula.php'? 'show' : null ?>" id="documents">
                        <ul class="nav nav-collapse ">
                
                        <li class="nav-item <?= $current_page=='listbrgyid.php' || $current_page=='barangayid.php' ? 'active' : null ?>">
                    <a href="listbrgyid">
                        <i class="fa fa-address-card"></i>
                        <p>Barangay ID</p>
                    </a>
                </li>
          
                <li class="nav-item <?= $current_page=='residents_certification.php' || $current_page=='generate_brgy_certs.php' ? 'active' : null ?>">
                    <a href="residents_certification">
                        <i class="icon-docs"></i>
                        <p>Barangay Clearance</p>
                    </a>
                </li>

                <li class="nav-item <?= $current_page=='building_permit.php' || $current_page=='generate_buildingpermit.php' ? 'active' : null ?>">
                    <a href="building_permit">
                        <i class="icon-doc" ></i>
                        <p>Building Clearance</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='business_permit.php' || $current_page=='generate_business_permit.php' ? 'active' : null ?>">
                    <a href="business_permit">
                        <i class="icon-doc"></i>
                        <p>Business Clearance</p>
                    </a>
                </li>
    <li class="nav-item <?= $current_page=='cedula.php' || $current_page=='cedula' ? 'active' : null ?>">
                    <a href="cedula">
                        <i class="icon-badge"></i>
                        <p>Cedula</p>
                    </a>
                </li>


                <li class="nav-item <?= $current_page=='residents_indigency.php' || $current_page=='generate_indigency_cert.php' ? 'active' : null ?>">
                    <a href="residents_indigency">
                        <i class="icon-docs"></i>
                        <p>Certificate of Indigency</p>
                    </a>
                </li>

              <li class="nav-item <?= $current_page=='blocklisted.php'   ? 'active' : null ?>">
                    <a href="blocklisted">
                       	<i class="fas fa-user-alt-slash"></i>
                        <p>Resident with Record</p>
                    </a>
                </li>
            

            

                         


                    

                     
                        
                        
                        
                        </ul>
                    </div>
                </li>



                <li class="nav-item <?= $current_page=='borrowed_item.php' || $current_page=='requested_docs.php' || $current_page=='revenue.php' ? 'active' : null ?>">
                    <a href="#transaction" data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <i class="fas fa-calculator"></i>
                            <p>Request</p>
                        <span class="caret"></span>
                    </a>
                    <div class="border rounded collapse <?= $current_page=='borrowed_item.php' || $current_page=='requested_docs.php'||  $current_page=='revenue.php' ? 'show' : null ?>" id="transaction">
                        <ul class="nav nav-collapse">
                          
                          
                                   <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                           
                        <li class="nav-item <?= $current_page=='borrowed_item.php'   ? 'active' : null ?>">
                    <a href="borrowed_item">
                        <i class="icon-layers"></i>
                        <p>Borrow Equipment</p>
                    </a>
                </li>

<?php endif?>
                <li class="nav-item <?= $current_page=='requested_docs.php' || $current_page=='requested_details.php'  ? 'active' : null ?>">
                    <a href="requested_docs">
                        <i class="icon-layers"></i>
                        <p>Requested Docs</p>
                    </a>
                </li>

<!---
                <li class="nav-item <//?= $current_page=='revenue.php' ? 'active' : null ?>">
                    <a href="revenue">
                        <i style="font-weight: bold;">&#8369</i>
                        <p>Revenues</p>
                    </a>
                </li>
--->

                

                    

                     
                        
                        
                        
                        </ul>
                    </div>
                </li>
               <?php endif?>

                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Peace & Order'  || $_SESSION['role']=='Lupon'): ?>

                    


              
                 
  
       
             
                
                 <li class="nav-item <?=$current_page=='peaceandorder.php' || $current_page=='lupon.php'|| $current_page=='blocklisted.php'   ? 'active' : null ?>">
                    <a href="#blotter" data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <i class="icon-layers"></i>
                            <p>Blotter</p>
                        <span class="caret"></span>
                    </a>
                    <div class="border rounded collapse <?= $current_page=='peaceandorder.php'|| $current_page=='lupon.php' ||$current_page=='blocklisted.php'    ? 'show' : null ?>" id="blotter">
                        <ul class="nav nav-collapse">
                           

                        <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Peace & Order'): ?>
                     <li class="nav-item <?= $current_page=='peaceandorder.php' || $current_page=='generate_blotter_report.php'  ? 'active' : null ?>">
                    <a href="peaceandorder">
                        <i class="fas fa-balance-scale"></i>
                        <p>Peace & Order</p>
                    </a>
                </li>
                <?php endif?>

                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Lupon'): ?>

                  <li class="nav-item <?= $current_page=='lupon.php'   ? 'active' : null ?>">
                    <a href="lupon">
                        <i class="fas fa-balance-scale"></i>
                        <p>Lupon</p>
                    </a>
                </li>
                
                
                <li class="nav-item <?= $current_page=='blocklisted.php'   ? 'active' : null ?>">
                    <a href="blocklisted">
                       	<i class="fas fa-user-alt-slash"></i>
                        <p>Resident with Record</p>
                    </a>
                </li>
                

                <?php endif?>
                

                    

                     
                        
                        
                        
                        </ul>
                    </div>
                </li>


              
                    
                <?php endif?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' || $_SESSION['role']=='Population'  ): ?>
                     <li class="nav-item <?= $current_page=='daycare.php' || $current_page=='generate_daycare.php'  ? 'active' : null ?>">
                    <a href="daycare">
                        <i class="	fas fa-graduation-cap"></i>
                        <p>Day Care</p>
                    </a>
                </li>
  <?php endif?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ): ?>
        
                 <li class="nav-item <?= $current_page=='announcement.php'  ? 'active' : null ?>">
                    <a href="announcement">
                        <i class="fas fa-bullhorn"></i>
                        <p>Announcements/Events</p>
                    </a>
                </li>
             

           


                <li class="nav-item <?= $current_page=='barangayfunds.php' ? 'active' : null ?>">
                    <a href="barangayfunds">
                        <i style="font-weight: bold;">&#8369</i>
                        <p>Barangay Funds</p>
                    </a>
                </li>
                
                        
                <?php endif?>
               
         

               
              
              

              
              


              


                
             
               

             
         


              

              



                

        


                

                <?php endif ?>

                <li class="nav-item <?= $current_page=='generate_report.php' ? 'active' : null ?>">
                    <a href="generate_report">
                    <i class="icon-docs"></i>
                        <p>Generate Reports</p>
                    </a>
                </li>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='Clerks'): ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">System</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#support" data-toggle="modal">
                            <i class="fas fa-flag"></i>
                            <p>Support</p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ||  $_SESSION['role']=='BHW'): ?>
             
                   

                
              


                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">System Maintenance</h4>
                </li>
                <li class="nav-item <?=$current_page=='equipment.php' || $current_page=='med_maintenance.php' || $current_page=='services.php' || $current_page=='street.php' || $current_page=='household.php'  ||$current_page=='barangayinfo.php' ||$current_page=='position.php' || $current_page=='chairmanship.php'  ||$current_page=='users.php' || $current_page=='support.php' || $current_page=='backup.php' || $current_page=='certificate.php' ? 'active' : null ?>">
                    <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i class="fa fa-cogs"></i>
                            <p>Maintenance</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?=$current_page=='equipment.php' || $current_page=='med_maintenance.php' || $current_page=='services.php' || $current_page=='street.php' ||$current_page=='household.php' ||$current_page=='barangayinfo.php' || $current_page=='position.php'  || $current_page=='chairmanship.php' || $current_page=='users.php' || $current_page=='support.php' || $current_page=='backup.php' ||$current_page=='certificate.php' ? 'show' : null ?>" id="settings">
                        <ul class="nav nav-collapse">
                           
                 <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ): ?>
                               <li class="<?= $current_page=='.php' ? 'active' : null ?>">
                                <a href="audit_trail.php">
                                    <span class="sub-item">Audit Trail</span>
                                </a>
                            </li>
                            <li class="<?= $current_page=='barangayinfo.php' ? 'active' : null ?>">
                                <a href="barangayinfo">
                                    <span class="sub-item">Barangay Info</span>
                                </a>
                            </li>
<!----
                            <li class="<?= $current_page=='household.php' ? 'active' : null ?>">
                                <a href="household">
                                    <span class="sub-item">Households</span>
                                </a>
                            </li>-->
                            
                           
                         

                            <li class="<?= $current_page=='street.php' ? 'active' : null ?>">
                                <a href="street">
                                    <span class="sub-item">Street</span>
                                </a>
                            </li>


                    <li class="<?= $current_page=='certificate.php' ? 'active' : null ?>">
                    <a href="certificate">
                       
                        <span class="sub-item">Certificates</span>
                    </a>
                </li>
                <li class="<?= $current_page=='equipment.php' ? 'active' : null ?>">
                    <a href="equipment">
                       
                        <span class="sub-item">Equipments</span>
                    </a>
                </li>
                         
                        
                        




                            <li class="<?= $current_page=='chairmanship.php' ? 'active' : null ?>">
                                <a href="chairmanship">
                                    <span class="sub-item">Chairmanship</span>
                                </a>
                            </li>
                            
                              <li class="<?= $current_page=='users.php' ? 'active' : null ?>">
                                    <a href="users">
                                        <span class="sub-item">Users</span>
                                    </a>
                                </li>
                            
                            
                               <?php endif ?>
                               <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator' ||  $_SESSION['role']=='BHW'): ?>
                              <li class="<?= $current_page=='med_maintenance.php' ? 'active' : null ?>">
                                <a href="med_maintenance">
                                    <span class="sub-item">Medicine Maintenance</span>
                                </a>
                            </li>
                            
                            <?php endif ?>
                            
                            <?php if($_SESSION['role']=='Clerk'):?>
                                <li>
                                    <a href="#support" data-toggle="modal">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                            <?php else: ?>
                              <!----
                                <li class="</?= $current_page=='support.php' ? 'active' : null ?>">
                                    <a href="support">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="backup/backup">
                                        <span class="sub-item">Backup</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#restore" data-toggle="modal">
                                        <span class="sub-item">Restore</span>
                                    </a>
                                </li>--->
                            <?php endif ?>
                        </ul>
                    </div>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>

<?php endif ?>





<?php if($_SESSION['role']=='superadmin'): ?>
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty($_SESSION['avatar'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>
                   
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role']=='superadmin' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                        <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                        <?= isset($_SESSION['username']) && $_SESSION['role']=='superadmin' ? '<span class="caret"></span>' : null ?> 
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                           <li class="nav-item ">
                        <a href="#schangepass" data-toggle="modal">
                              
                                    <span class="link-collapse"><i class="fas fa-key"></i></span>Change Password
                                </a>
                        </li>
                 


                     <li class="nav-item <?= $current_page=='changepassword.php' ? 'active' : null ?>">
                    <a href="model/s_logout.php"  onclick="return confirm('Are you sure you want to Sign Out?');" >
                    <i class="	fa fa-power-off"></i>
                        <p>Sign Out</p>
                    </a>

                     </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">

            <?php if(isset($_SESSION['username']) && $_SESSION['role']=='superadmin' ): ?>
          

                <li class="nav-item <?= $current_page=='s_dashboard.php'   ? 'active' : null ?>">
                    <a href="s_dashboard" >
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
           

              
              
            
                <li class="nav-item <?= $current_page=='addbarangay.php'  ? 'active' : null ?>">
                    <a href="addbarangay">
                        <i class="fa fa-plus"></i>
                        <p>Add Barangay Users</p>
                    </a>
                </li>

            


            


                

                <?php endif ?>

             
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='superadmin'): ?>
             
                    
              


                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">System Maintenance</h4>
                </li>
                <li class="nav-item <?= $current_page=='province.php' || $current_page=='city.php'  ||$current_page=='barangayinfo.php' ||$current_page=='position.php' || $current_page=='chairmanship.php'  ||$current_page=='users.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'active' : null ?>">
                    <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i class="icon-wrench"></i>
                            <p>Maintenance</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= $current_page=='city.php' || $current_page=='backup&restore.php'||  $current_page=='province.php'  ? 'show' : null ?>" id="settings">
                        <ul class="nav nav-collapse">
                        <li class="<?= $current_page=='city.php' ? 'active' : null ?>">
                                <a href="city">
                                    <span class="sub-item">City/Municipalities</span>
                                </a>
                            </li>



                            <li class="<//?= $current_page=='province.php' ? 'active' : null ?>">
                                <a href="province">
                                    <span class="sub-item">Province</span>
                                </a>
                            </li>
                            
                            
                            <li class="<?= $current_page=='backup&restore.php' ? 'active' : null ?>">
                                <a href="backup&restore">
                                    <span class="sub-item">Backup & Restore</span>
                                </a>
                            </li>
              
                           
                        </ul>
                    </div>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>

<?php endif ?>


