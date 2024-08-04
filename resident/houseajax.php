<?php

include('server/serverhome.php');








$_SESSION['houseno']		   = $conn->real_escape_string($_POST['houseno']);

$_SESSION['street']		   = $conn->real_escape_string($_POST['street']);
$_SESSION['housetype']		   = $conn->real_escape_string($_POST['housetype']);
$_SESSION['landownership']		   = $conn->real_escape_string($_POST['landownership']);
$_SESSION['s_electricity']		   = $conn->real_escape_string($_POST['s_electricity']);
$_SESSION['s_cooking']		   = $conn->real_escape_string($_POST['s_cooking']);
$_SESSION['source_water']		   = $conn->real_escape_string($_POST['source_water']);
$_SESSION['waste_disposal']		   = $conn->real_escape_string($_POST['waste_disposal']);
$_SESSION['toilet']		   = $conn->real_escape_string($_POST['toilet']);






if(isset($_POST['vehicles'])) {
    // Loop through each selected checkbox 
    $vehicles="";
    foreach($_POST['vehicles'] as $selected_option) {

        $vehicles  .= $selected_option."  ";
    
    }

    $_SESSION['vehicles']=$vehicles;
}else{

    $_SESSION['vehicles']="";

}


if(isset($_POST['appliances'])){


    // Loop through each selected checkbox 
    $appliances="";
    foreach($_POST['appliances'] as $selected_options) {
      
        $appliances  .= $selected_options."  ";
    }

    $_SESSION['appliances']= $appliances;
    
}else{


    $_SESSION['appliances']="";
}



   include 'addfamily.php';

/*
if(!empty($_POST[''])){



}else{




}


*/

?>
