<?php 





if(!empty($_SESSION['bar_no'])){



$barno=$_SESSION['bar_no'];





$chair_q = "SELECT * FROM tblchairmanship WHERE bar_no=$barno";
$res_q = $conn->query($chair_q);

$chair = array();
while($row = $res_q->fetch_assoc()){
    $chair[] = $row; 
}

}
    
?>