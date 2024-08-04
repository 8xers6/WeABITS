<?php 

include '../server/server.php';

if (! empty($_FILES)) {

    $cur_pass 	= $conn->real_escape_string($_POST['cur_pass']);

$hashcur= hash("sha1",$cur_pass);
$username=$_SESSION['username'];


$backupfile=$_FILES["backup_file"]["name"];

$check = "SELECT * FROM tblsuperuser WHERE username='$username' AND `password`='$hashcur' AND `backupfile`='$backupfile'";
$res = $conn->query($check);

if(mysqli_num_rows($res) === 1){




     // Validating SQL file type by extensions
     if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {

        $_SESSION['message'] = 'Invalid File Type';
        $_SESSION['success'] = 'danger';

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
            
            if($response){
                $_SESSION['message'] = 'Database restored successfully.';
                $_SESSION['success'] = 'success';
            }else{
                $_SESSION['message'] = "Database not restored completely.";
                $_SESSION['success'] = 'danger';
            }
        }

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        
    }
            


   

}else{



    $_SESSION['message'] = 'Incorrect password or Invalid file';
    $_SESSION['success'] = 'danger';

header("Location: ../backup&restore");
}
   

}



function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';

    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = $conn->query($sql);
                if (! $result) {
                    $error .= $conn->error . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = false;
        } else {
            $response = true;
        }
    } // end if file exists
    return $response;
}