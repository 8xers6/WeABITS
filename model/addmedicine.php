<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    $barno=$_SESSION['bar_no'];
  
   

    if($_POST['state']=='addcategory'){

         

    $category	= $conn->real_escape_string($_POST['category']);



    if(!empty($barno) && !empty($category)){

        $insert  = "INSERT INTO `med_category` (`bar_no`, `category_name`) VALUES ('$barno', '$category');";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Category added!';
            $_SESSION['success'] = 'success';

        }else{

            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    }


    if($_POST['state']=='addtype'){

         

        $type	= $conn->real_escape_string($_POST['type']);
    
    
    
        if(!empty($barno) && !empty($type)){
    
            $insert  = "INSERT INTO `type_list` (`bar_no`, `type_name`) VALUES ('$barno', '$type');";
            $result  = $conn->query($insert);
    
            if($result === true){
                $_SESSION['message'] = 'Type added!';
                $_SESSION['success'] = 'success';
    
            }else{
    
                $_SESSION['message'] = 'Error!';
                $_SESSION['success'] = 'danger';
    
            }
    
        }else{
    
            $_SESSION['message'] = 'Please fill up the form completely!';
            $_SESSION['success'] = 'danger';
        }
    
        }






    if($_POST['state']=='addmedicine'){

         
        $sku	= $conn->real_escape_string($_POST['sku']);
    $medicine 	= $conn->real_escape_string($_POST['medicine']);
    $measurement 	= $conn->real_escape_string($_POST['measurement']);

    $category	= $conn->real_escape_string($_POST['category']);
    $type 	= $conn->real_escape_string($_POST['type']);
    $description 	= $conn->real_escape_string($_POST['des']);



    if(!empty($barno) && !empty($medicine)){

        $insert  = "INSERT INTO `tblmedicine` (`bar_no`, `med_name`, `measurement`, `description`, `category_id`, `type_id`, `sku`) 
                                     VALUES ('$barno', '$medicine', '$measurement', '$description', '$category', '$type', '$sku');";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Medicine added!';
            $_SESSION['success'] = 'success';

        }else{

            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    }



    if($_POST['state']=='editmedicine'){

        $medno	= $conn->real_escape_string($_POST['medno']);
        $sku	= $conn->real_escape_string($_POST['sku']);
    $medicine 	= $conn->real_escape_string($_POST['medicine']);
    $measurement 	= $conn->real_escape_string($_POST['measurement']);

    $category	= $conn->real_escape_string($_POST['category']);
    $type 	= $conn->real_escape_string($_POST['type']);
    $description 	= $conn->real_escape_string($_POST['des']);



    if(!empty($barno) && !empty($medicine)){

        $insert  = "UPDATE `tblmedicine` SET `med_name`='$medicine',`measurement`='$measurement',`description`='$description',`category_id`='$category',`type_id`='$type',`sku`='$sku' WHERE `med_no`='$medno'";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Medicine Updated!';
            $_SESSION['success'] = 'success';

        }else{

            $_SESSION['message'] = 'Error!';
            $_SESSION['success'] = 'danger';

        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    }
    

    header("Location: ../med_maintenance.php");

	$conn->close();