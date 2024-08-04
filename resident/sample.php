<?php



session_start();



$name=$_POST['name'];
$mi=$_POST['mi'];
$lname=$_POST['lname'];






//Store the array in a session variable called "cart"
$_SESSION['name'][] = $name;
$_SESSION['mi'][] = $mi;
$_SESSION['lname'][] = $lname;
//Dump out the session variable, just to
//see what it looks like.

var_dump($_SESSION['name']);
var_dump($_SESSION['mi']);
var_dump($_SESSION['lname']);




?>