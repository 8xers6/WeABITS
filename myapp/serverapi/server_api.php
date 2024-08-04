<?php
$database	= 'u418722912_weabits';
$username	= 'u418722912_root';
$host		= 'localhost';
$password	= 'f/h|I8XF1';
ini_set('display_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);
// error_reporting(0);



$conn = new mysqli($host,$username,$password,$database);


?>