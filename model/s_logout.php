<?php
	include '../server/server.php';
   	session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['bar_no']);
 

    session_start();	
    $_SESSION['messages'] = "You have been logged out!";
    $_SESSION['success'] = 'danger';


    header('location: ../s_admin');