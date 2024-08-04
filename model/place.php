<?php include '../server/server.php' ?>
<?php
 




 if(isset($_POST['prov'])){
   

    $prov =$_POST['prov'];
 
 


echo'

<div class="form-group">
<label>City Name</label>
<div class="search_select_box" style="border:solid blue 1px; border-radius:5px;">   
                            
                            <select name="city" class="form-control input-sm" id="city"  data-live-search="true" required >
                            <option  disabled selected="" value="">-- Select Municipality -- </option>';
                            
                                $squery = mysqli_query($conn,"SELECT * from tblcity WHERE `province_id`='$prov'");
                                while ($row = mysqli_fetch_array($squery)){
                                    echo '
                                        <option value="'.$row['city_id'].'">'.$row['city'].'</option>    
                                    ';
                                }
                        echo'
                            </select>
                        </div>
                            </div>';





                                                               


}


?>