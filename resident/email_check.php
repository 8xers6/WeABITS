<?php
	include('server/serverhome.php');








    $result = mysqli_query($conn,"select username from tbl_residents where username = '".$_POST['username']."' ");

    $cnt = mysqli_num_rows($result);
    print($cnt);



    ?>