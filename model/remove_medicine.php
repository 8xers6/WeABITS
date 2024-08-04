<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];



    if($_GET['state']=='category'){



        $id 	= $conn->real_escape_string($_GET['id']);



        if(!empty($id) ){

            $query  = "DELETE FROM `med_category` WHERE category_id=$id";
            $result  = $conn->query($query);
    
            if($result === true){
                $_SESSION['message'] = 'Category Deleted!';
                $_SESSION['success'] = 'danger';
    
            }else{
                $_SESSION['message'] = ' Error!';
                $_SESSION['success'] = 'danger';
            }
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }

    }


    if($_GET['state']=='type'){



        $id 	= $conn->real_escape_string($_GET['id']);



        if(!empty($id) ){

            $query  = "DELETE FROM `type_list` WHERE type_id=$id";
            $result  = $conn->query($query);
    
            if($result === true){
                $_SESSION['message'] = 'Type Deleted!';
                $_SESSION['success'] = 'danger';
    
            }else{
                $_SESSION['message'] = ' Error!';
                $_SESSION['success'] = 'danger';
            }
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }

    }



    if($_GET['state']=='medicine'){



        $medno 	= $conn->real_escape_string($_GET['medno']);



        if(!empty($medno) ){

            $query  = "DELETE FROM `tblmedicine` WHERE med_no=$medno";
            $result  = $conn->query($query);
    
            if($result === true){
                $_SESSION['message'] = 'Medicine Deleted!';
                $_SESSION['success'] = 'danger';
    
            }else{
                $_SESSION['message'] = ' Error!';
                $_SESSION['success'] = 'danger';
            }
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }

    }


    if($_POST['state']=='delexp'){



        $id 	= $conn->real_escape_string($_POST['id']);



        if(!empty($id) ){

            $query  = "DELETE FROM `expired_product` WHERE id=$id";
            $result  = $conn->query($query);
    
            if($result === true){
                $_SESSION['message'] = 'Expired Medicine Deleted!';
                $_SESSION['success'] = 'danger';
    
            }else{
                $_SESSION['message'] = ' Error!';
                $_SESSION['success'] = 'danger';
            }
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }

    }
  
   


   

    header("Location: ../med_maintenance.php");

	$conn->close();