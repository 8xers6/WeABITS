<?php 


	$pos_q = "SELECT * FROM tblposition ORDER BY `order` ASC";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}

	$chair_q = "SELECT * FROM tblchairmanship";
	$res_q = $conn->query($chair_q);

	$chair = array();
	while($row = $res_q->fetch_assoc()){
		$chair[] = $row; 
	}
    
?>