
<?php include 'server/server.php' ?> 

<?php


$barno=$_SESSION['bar_no'];
// get Users





$state = $_GET['state'];



if($state=='Blotter'){

  
    $query = "SELECT * FROM `tblblotter`  WHERE  bar_no=$barno;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }


    $total = $result->num_rows;
}elseif($state=='patient'){

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,tbl_residents.email as emails,YEAR(tbl_residents.created_at)as year FROM `tblpatient` LEFT JOIN tbl_residents on tblpatient.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbl_residents.bar_no=$barno AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
    $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,tbl_residents.email as emails,YEAR(tbl_residents.created_at) as year FROM `tblpatient` LEFT JOIN tbl_residents on tblpatient.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE    tbl_residents.bar_no=$barno;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

}
    $total = $result->num_rows;
}elseif($state=='male'){

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.gender='Male' AND tbl_residents.alive=1 AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
    $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.gender='Male' AND tbl_residents.alive=1";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

}
    $total = $result->num_rows;
}elseif($state=='female'){
   

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.gender='Female' AND tbl_residents.alive=1   AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }
        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.gender='Female' AND tbl_residents.alive=1";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}







    $total = $result->num_rows;
}elseif($state=='senior'){
   

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=60 AND tbl_residents.alive=1  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y')>=60 AND tbl_residents.alive=1";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}




    $total = $result->num_rows;
}elseif($state=='pwd'){
  

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.pwd NOT IN ('Not Applicable') AND tbl_residents.alive=1  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.pwd NOT IN ('Not Applicable') AND tbl_residents.alive=1";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}








    $total = $result->num_rows;
}elseif($state=='deceased'){
   

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=0  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=0";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }
}








    $total = $result->num_rows;
}elseif($state=='soloparent'){
  


    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND solo_parent='Yes' AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y')>=18  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND solo_parent='Yes'  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y')>=18";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}









    $total = $result->num_rows;
}
elseif($state=='head'){
    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

   
       

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND relation='Head' AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }



    }else{

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND relation='Head'";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

    }
   
    $total = $result->num_rows;
}
elseif($state=='children'){
    

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];

        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND     DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=6  AND tblstreet.st_id=$street";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }



        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND      DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')>=0  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y')<=6 ";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }
    
}










    $total = $result->num_rows;
}
elseif($state=='newborn'){
   



    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tblchildren  LEFT JOIN tbl_residents on tbl_residents.res_id=tblchildren.res_id  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tbl_residents.verify_status='verified' AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tblchildren  LEFT JOIN tbl_residents on tbl_residents.res_id=tblchildren.res_id  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno  AND tbl_residents.verify_status='verified' ";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }
}











    $total = $result->num_rows;
}
elseif($state=='blocklisted'){
 

    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.blocklisted='Blocklisted' AND tbl_residents.bar_no=$barno  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.blocklisted='Blocklisted' AND tbl_residents.bar_no=$barno";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}








    $total = $result->num_rows;
}
elseif($state=='household'){
   



    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' GROUP BY tblhousehold.h_no;  AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,COUNT(tbl_residents.h_no) as members,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tblhousehold` LEFT JOIN tbl_residents ON tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' GROUP BY tblhousehold.h_no;";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}





    $total = $result->num_rows;
}elseif($state=='payments'){


     if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
          
     $mindate= $_GET['mindate'];
     $maxdate=$_GET['maxdate'];
     
     
     
     
    
      
     }else{
         
          if(!empty($_GET['type'])){
          
               $type=$_GET['type'];
      }
   
         
           if($type=='BusinessClearance'){
         
          
               
       
  $query = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    
    $total = $result->num_rows;

 


     }
         
         

     
    

}
  
}elseif($state=='business'){
      
    $query = "SELECT * FROM tblbusinesspermit LEFT JOIN tbl_residents ON tblbusinesspermit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbusinesspermit.busp_no;";
    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    
    $total = $result->num_rows;

}
elseif($state=='building'){
    $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age FROM tblbuilding_permit LEFT JOIN tbl_residents ON tblbuilding_permit.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno ORDER BY tblbuilding_permit.bp_no;";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }
    $total = $result->num_rows;
}
elseif($state=='bclearance'){

    $query = "SELECT *,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year` FROM `tbl_barangayclearance` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_barangayclearance.res_id  LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    $total = $result->num_rows;
}
elseif($state=='coi'){

    $query = "SELECT * FROM `tbl_indigency` LEFT JOIN tbl_residents ON tbl_residents.res_id=tbl_indigency.res_id LEFT JOIN tblhousehold on tbl_residents.h_no=tblhousehold.h_no LEft JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    $total = $result->num_rows;
}
elseif($state=='daycare'){

    $query = "SELECT * FROM tbldaycare LEFT JOIN tbl_residents ON tbldaycare.res_id=tbl_residents.res_id LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE  tbldaycare.bar_no=$barno ORDER BY tbldaycare.stud_no;";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    $total = $result->num_rows;
}
elseif($state=='equipment'){

    $query = "SELECT *,tblequipments.equip_no as equip_no,tblborrow.bor_no as bor_no,tbl_residents.res_id as res_id,tbl_residents.firstname as firstname,tbl_residents.middlename as middlename,tbl_residents.lastname as lastname,tblequipments.equipment_name as equipment_name,tblborrow.purpose as purpose,tblborrow.status as `status`,tblborrow.quantity as quantity,tblborrow.date_req as date_req,tblborrow.date_received as date_received,tblborrow.date_return as date_return  FROM `tblborrow` LEFT JOIN tbl_residents ON tblborrow.res_id=tbl_residents.res_id LEFT JOIN tblequipments on tblborrow.equip_no=tblequipments.equip_no
    LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tblborrow.status='returned' AND tblequipments.equipment_name IS NOT NULL ORder by tblborrow.bor_no DESC;";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }

    $total = $result->num_rows;
}
elseif($state=='vaccstatus'){



    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])&& !empty($_GET['vstatus'])){

        $street=$_GET['street'];

        $vaccstatus=$_GET['vstatus'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1  AND tblstreet.st_id=$street AND tbl_residents.vaccine_status='$vaccstatus'";

        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1";

        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}

   

    $total = $result->num_rows;
}
elseif($state=='projects'){
    $query = "SELECT * FROM `tblproject` WHERE bar_no=$barno ";

    if (!$result = $conn->query($query)) {
        exit($conn->error);
    }


    $queryb = "SELECT * FROM `tblproject` WHERE bar_no=$barno AND fund_by='Barangay'";

    if (!$result1 = $conn->query($queryb)) {
        exit($conn->error);
    }

    $queryspon = "SELECT * FROM `tblproject` WHERE bar_no=$barno AND fund_by='Sponsored'";

    if (!$result2 = $conn->query($queryspon)) {
        exit($conn->error);
    }
    

    
    $totalb = $result1->num_rows;
    $totalspon = $result2->num_rows;

    $total = $result->num_rows;
}

elseif($state=='all'){
  
 


    $barno=$_SESSION['bar_no'];
    if(!empty($_GET['street'])){

        $street=$_GET['street'];


        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1 AND tblstreet.st_id=$street";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }


        $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno AND st_id=$street");
        while ($row = mysqli_fetch_array($squery)){
               $streetname=$row['streetname'];   
          
        }
    
    
    }else{
   
        $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), `birthdate`)), '%Y') + 0 AS age,lpad(tbl_residents.res_id,6,'0') as res_id,lpad(tbl_residents.bar_no,3,'0') as bar_no,YEAR(created_at)as `year`,tbl_residents.email as emails FROM tbl_residents  LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblhousehold.st_id=tblstreet.st_id WHERE tbl_residents.bar_no=$barno AND tbl_residents.verify_status='verified' AND tbl_residents.alive=1";
        if (!$result = $conn->query($query)) {
            exit($conn->error);
        }

}


$total = $result->num_rows;
}





    $resident = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }
}



?>

<?php





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Report -  Barangay Management System</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Report</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">

                                        <?php   if($state!='payments' && $state!='Blotter' && $state!='household' && $state!='business' && $state!='building' && $state!='bclearance' && $state!='coi' && $state!='daycare' && $state!='equipment' && $state!='projects' ):  ?>
 
                                            <form>
                                        <div class="row">

                                        <input type="hidden" class="form-control"  name="state" value="<?= $state ?>" required>

<div class="col">
<label class=" fw-bold">Street/Purok/Sitio</label>
<select name="street" class="form-control border"    required >
                                                            <option  selected value="">-- Select Street -- </option>
                                                            <?php
                                                                $squery = mysqli_query($conn,"SELECT * from tblstreet WHERE bar_no=$barno");
                                                                while ($row = mysqli_fetch_array($squery)){
                                                                    echo '
                                                                        <option value="'.$row['st_id'].'">'.$row['streetname'].'</option>    
                                                                    ';
                                                                }
                                                            ?>
                                                            </select>
                                                            
                                                            
                                                            
           

                            </div>
                          

                                        <?php   if($state=='vaccstatus'): ?>

                            <div class="col-md-4">

<label class=" fw-bold">Vaccination Status</label>
                                                    <select class="form-control" required name="vstatus" >
                                                    <option disabled selected value="">Select Vaccination Status</option>
                                                    <option value="1st Dose">1st Dose</option>
                                                    <option value="2nd Dose">2nd Dose</option>
                                                    <option value="1st Booster">1st Booster</option>
                                                    <option value="2nd Booster">2nd Booster</option>
                                                   
                                                    <option value="Not Vaccinated">Not Vaccinated</option>
                                                    

                                            </select>
           

                            </div>
                            <?php endif ?>

                            <div class="col">
                                <br>

                                        <button type="submit" class="btn btn-primary" >
                           Submit </button>

                            </div>

                          
                          


                            </form>

                            <form>
                                        <div class="col">
                                        <input type="hidden" class="form-control" placeholder="Quantity"  name="state" value="<?= $state?>" min="0" required>


                      

                       
                                <br>

                                        <button type="submit" class="btn btn-primary" >
                           All <?php 

                           if($state=='all'){

                            echo '';
                           }else{

                            echo ucwords($state);
                           }
                           
                          ?> Residents</button>
<!---
<a href="#add" data-toggle="modal" class="btn btn-primary text-white">
											
											 Sort
											</a>---->
                          
                            </div>

                            </form>


	
                            </div>

                                            <?php endif ?>

                                        <?php   if($state=='payments'): ?>
                                          
                                        <form>
                                        <div class="row">
                                        <input type="hidden" class="form-control" placeholder="Quantity"  name="state" value="payments" min="0" required>

<div class="col">
Minimum Dates
                                        <input type="date" class="form-control"  name="mindate"  required>
           

                            </div>
                            <div class="col">
Maximum Dates
                                        <input type="date" class="form-control"  name="maxdate"  required>
           

                            </div>

                            <div class="col">
                                <br>

                                        <button type="submit" class="btn btn-primary" >
                           Submit </button>

                            </div>

                          
                          


                            </form>

                        

                                        </div>

                           

                            <?php    endif ?>

                                 
                                     
                                        </div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Report
											</button>
											<!--
												<a href="#printing" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
											
												Print Reports
											</a>--->
										</div>
									</div>
										<div class="card-head-row">
										<div class="card-title">
										    
										    
							
										    
										</div>
										<div class="card-tools">
										
										
										
										</div>
								</div>
								<div class="card-body " id="printThis">
                                <div class="d-flex flex-wrap justify-content-around" style="border-bottom:3px solid black">
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username']?>/barangayinfo/<?= $citylogo ?>" class="rounded-circle" width="160">
										</div>
										<div class="text-center">
                                            <h1 class="mb-0 fw-bold">Republic of the Philippines</h1>
                                            <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
											<h3 class="mb-0">City of 	<?= ucwords($city) ?></h3>
											<h3 class="mb-0"> Barangay <?= ucwords($barangayname) ?></i></h3>
                                            <p><i>Mobile No. <?= $phone ?></i></p>
                                           
										</div>
                                        <div class="text-center">
										<img src="assets/uploads/<?=$_SESSION['username'] ?>/barangayinfo/<?= $brgylogo ?>" class="rounded-circle" width="160">
										</div>
									</div>
									<div class=" justify-content-center" style="position:absolute; display:none; left: 110px; top: 300px;opacity: 0.2;">
                                          
										  <img src="assets/uploads/<?= $_SESSION['username']?>/barangayinfo/<?= $brgylogo ?>" class="img-fluid rounded-circle" width='800'> 
										</div>
                                    <div class="text-center">
                                   <?php if($state=='male'){
                                                     echo'<h1 class="mt-4 fw-bold" style="color:black;">All Male Residents</h1>';
                                                }elseif($state=='female'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Female Residents</h1>';
                                                }elseif($state=='senior'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Senior Citizen Residents</h1>';
                                                }elseif($state=='pwd'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Person With Disability</h1>';
                                                }
                                                elseif($state=='deceased'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Deceased Residents</h1>';
                                                } elseif($state=='soloparent'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Solo Parents </h1>';
                                                }elseif($state=='head'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Head of Families </h1>';
                                                }
                                                elseif($state=='children'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Children </h1>';
                                                } elseif($state=='newborn'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Newborn Babies </h1>';
                                                } elseif($state=='patient'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">Patient Report </h1>';
                                                } 
                                                elseif($state=='blocklisted'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Blocklisted Resident </h1>';
                                                }
                                                elseif($state=='household'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Household </h1>';
                                                } elseif($state=='payments'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> Payments </h1>';
                                                }
                                                elseif($state=='business'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Business Clearance  </h1>';
                                                }
                                                elseif($state=='building'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Building Clearance  </h1>';
                                                }
                                                elseif($state=='bclearance'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Barangay Clearance  </h1>';
                                                }
                                                elseif($state=='coi'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Certificate of Indigency  </h1>';
                                                }
                                                elseif($state=='daycare'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Day Care  </h1>';
                                                }
                                                elseif($state=='equipment'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> All Returned Equipment  </h1>';
                                                }
                                                elseif($state=='vaccstatus'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;"> Vaccination Status List  </h1>';
                                                } 
                                                elseif($state=='projects'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Projects </h1>';
                                                }
                                                 elseif($state=='Blotter'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">All Blotter </h1>';
                                                }
                                                elseif($state=='all'){
                                                    echo'<h1 class="mt-4 fw-bold" style="color:black;">Residents Master List</h1>';
                                                }?>
                                  
										</div>
                                        <?php               if($state=='payments'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="5" style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?php 
 if(!empty($_GET['mindate']) && !empty($_GET['maxdate'])){
 
    $mindate= $_GET['mindate'];
    $maxdate=$_GET['maxdate'];


    echo  'Dates: '.$mindate.' to '.$maxdate;

 }else{

echo'All Payments';

 }



?>

</th>
   
   


       
    
        <th colspan="3" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Amount:  <?php if(!empty($payments['am'])): ?>
												<b>&#8369</b> 
 													<?=number_format($payments['am'],2)?> 
													<?php  else:?>
													<b>&#8369</b> 0
														<?php  endif ?>



</th>


<?php               if($state=='pwd'){
        echo'  <th style="  border: 2px solid black;
        text-align: left;
        padding: 8px;"></th>';
    }  ?>
       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Date</th>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Control No</th>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">O.R. No</th>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">CTC No.</th></th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">     Resident ID  </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Recepient</th>





<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Amount</th>









</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['applied']) ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['busp_no']).' ' ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['or_no']).' ' ?> 


</td>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['ctc_no']).' ' ?> 


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

</td>






<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
<b>&#8369</b><?= number_format($row['amounts'],2) ?>

</td>




             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>



</table>


<?php            endif ?>
                                   

									
                                        <?php               if($state=='business'): ?>

                                            <table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;   ">
						
                        <thead >
                        <tr >
                                                <th colspan="8" style="  border: 2px solid black;
  text-align: center;
  padding: 8px;"></th>
                                               
                                               
					
           
                                                   
												
													<th colspan="5" style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Total Businesses:  <?= $total?></th>



                                                   
                                                  
                      
												
                            
 
                                                 
                                                   
                                                  
													
                                                   
												</tr>
                            <tr>
                            <th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Bp No. </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> O.R. NO  </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> CTC NO  </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Resident ID </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Business Owner  </th>
        
                              
                               
                            
                                <th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Name of Business</th>


<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Business Owner Address</th>

<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Business Address</th>

<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Nature of Business Ownership</th>
<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Business Nature</th>



<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Business Contact No.</th>

<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Date Applied</th>



<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Date Expired</th>
                               
                               
                               
                             
  
                
                             
                               
                              
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($resident)): ?>
                                <?php $no=1; foreach($resident as $row): ?>

                                    
                                <tr>


                                <td style="  border: 2px solid black;
text-align: left;
padding: 8px;">
                                       
                                     
                                        <?= ucwords($row['busp_no']) ?> 

                                        
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: left;
padding: 8px;">
                                       
                                     
                                        <?= ucwords($row['or_no']).' ' ?> 

                                        
                                    </td>

                                    <td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['ctc_no']).' ' ?> 


</td>

     

                                  
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['res_id'] ?>
                                      
                                    
                                    </td>


                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                      <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                      
                                    
                                    </td>

                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['businessname'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['household_no'] ?> , <?= $row['streetname'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['bstreet'] ?>
                                      
                                    
                                    </td>

                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['nature_of_business_ownership'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['nature'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['bcontact_no'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['applied'] ?>
                                      
                                    
                                    </td>
                                    <td style="  border: 2px solid black;
text-align: center;
padding: 8px;">
                                      
                                        <?= $row['expired_date'] ?>
                                      
                                    
                                    </td>

                                                         


   


                             
                                
                                    
                                </tr>
                                <?php $no++; endforeach ?>
                            <?php endif ?>
                        </tbody>
                        
                        
                        <tfoot>
    <tr>
      
         <td colspan="5" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="3" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="7" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>
                    
                    </table>


                    <?php            endif ?>



                    <?php               if($state=='building'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="6" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Building Clearance:  <?= $total?></th>



       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Bp No. </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> O.R. NO  </th>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> CTC NO  </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Resident ID </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Full Name </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Resident Address</th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Building Location</th>







<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Date Applied</th>













</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['bp_no']) ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['or_no']).' ' ?> 


</td>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['ctc_no']).' ' ?> 


</td>




<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['bhouseno'] ?> , <?= $row['bstreet'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['applied'] ?>


</td>







             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>



                 <tfoot>
    <tr>
      
         <td colspan="3" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="7" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>

</table>


<?php            endif ?>


<?php               if($state=='bclearance'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="6" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Barangay Clearance:  <?= $total?></th>



       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Clearance No. </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> O.R. NO  </th>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> CTC NO  </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Resident ID </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Full Name </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Resident Address</th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Purpose</th>







<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Date Issued</th>















</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['bclearance_no']) ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['or_no']).' ' ?> 


</td>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['ctc_no']).' ' ?> 


</td>




<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['purpose'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['date_issued'] ?>


</td>







             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>


                 <tfoot>
    <tr>
      
         <td colspan="3" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="3" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="7" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>
</table>


<?php            endif ?>




<?php               if($state=='coi'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="4" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Certificate of Indigency:  <?= $total?></th>



       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: center;
padding: 8px;">Control No. </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Resident ID </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Full Name </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Resident Address</th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Purpose</th>







<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Date Issued</th>















</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['control_no']) ?> 


</td>





<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['purpose'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['date_issued'] ?>


</td>







             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>

                 <tfoot>
    <tr>
      
         <td colspan="3" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="2" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="7" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>


</table>


<?php            endif ?>




<?php               if($state=='daycare'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="4" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Students:  <?= $total?></th>



       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: center;
padding: 8px;">Student No. </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Resident ID </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Full Name </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Student Address </th>


<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">School Year</th>


<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Parents/Guardian</th>























</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">


<?= ucwords($row['stud_no']) ?> 


</td>





<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['res_id'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['schoolyear'] ?> 


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

	  <?php
									       
									          $hno=$row['h_no'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno  AND (tbl_residents.relation='Head' OR tbl_residents.relation='Spouse')  AND tbl_residents.h_no=$hno");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo '
												  <option value="'.$rows['res_id'].'">'.$rows['firstname'].'  '.$rows['middlename'].'  '.$rows['lastname'].'   Relationship:'.$rows['relation'].' </option>    
											  ';
										  }
									  ?>


</td>






             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>
                 <tfoot>
    <tr>
      
         <td colspan="3" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="2" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="7" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>
</table>


<?php            endif ?>


<?php               if($state=='equipment'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="3" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Borrowers:  <?= $total?></th>



       
      

    


     
       
      
        
       
    </tr>
<tr>
    
    <th style="  border: 2px solid black;
text-align: center;
padding: 8px;"> Borrower Name </th>




<th style="  border: 2px solid black;
text-align: center;
padding: 8px;"> Equipment Name </th>

<th style="  border: 2px solid black;
text-align: center;
padding: 8px;"> Quantity </th>


    <th style="  border: 2px solid black;
text-align: center;
padding: 8px;"> Address </th>

























</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>


</td>





<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['equipment_name'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">


<?= $row['quantity'] ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['household_no'] ?> , <?= $row['streetname'] ?>


</td>





             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>

                 <tfoot>
    <tr>
      
         <td colspan="2" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="1" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="2" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>

</table>


<?php            endif ?>


<?php               if($state=='projects'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="3" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Barangay Projects:  <?= $totalb?></th>

<th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Sponsored Projects:  <?= $totalspon?></th>


       
    
        <th colspan="2" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Projects:  <?= $total?></th>




       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: center;
padding: 8px;">Project No. </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Fund By </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Project Name </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Sponsor Name </th>



<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Project Description </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Budget </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Project Status </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Approved Date </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> End Date </th>


























</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['proj_no']) ?> 


</td>





<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['fund_by'] ?>


</td>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">


<?= $row['project_name'] ?>


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['sponsor_name'] ?> 


</td>

<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['proj_description'] ?> 


</td>
<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['budget'] ?> 


</td>
<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['project_status'] ?> 


</td>
<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['approved_date'] ?> 


</td>
<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['end_date'] ?> 


</td>






             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>



                 <tfoot>
    <tr>
      
         <td colspan="3" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="3" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="4" style='   padding:10px;'>Submitted to: ________________________________</td>
     

    </tr>
  </tfoot>

</table>


<?php            endif ?>











                    <?php               if($state=='household'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>
    <th colspan="2" style="  border: 2px solid black;
text-align: center;
padding: 8px;"></th>
   
   


       
    
        <th colspan="3" style="  border: 2px solid black;
text-align: left;
padding: 8px;">Total Residents:  <?= $total?></th>


<?php               if($state=='pwd'){
        echo'  <th style="  border: 2px solid black;
        text-align: left;
        padding: 8px;"></th>';
    }  ?>
       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: left;
padding: 8px;">Household No. </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Street  </th>




<th style="   border: 2px solid black;
text-align: center;
padding: 8px;">Total Members</th>









</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['household_no']) ?> 


</td>
<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


<?= ucwords($row['streetname']).' ' ?> 


</td>




<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">

<?= $row['members'] ?>


</td>
             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>




<tfoot>
    <tr>
      
         <td colspan="1" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="1" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="1" style='   padding:10px;'>Submitted to:____________________________________</td>
     
       
    </tr>
  </tfoot>



</table>


<?php            endif ?>



<?php               if($state=='Blotter'): ?>

<table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">

<thead>
<tr>



       





       
      

    


     
       
      
        
       
    </tr>
<tr>
<th style="  border: 2px solid black;
text-align: center;
padding: 8px;">Blotter No. </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Complainant </th>

<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Respondent </th>


<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Blotter/Incident </th>



<th style="  border: 2px solid black;
text-align: left;
padding: 8px;"> Status </th>





</tr>
</thead>
<tbody>
<?php if(!empty($resident)): ?>
<?php $no=1; foreach($resident as $row): ?>


<tr>


<td style="  border: 2px solid black;
text-align: center;
padding: 8px;">


<?= ucwords($row['id']) ?> 


</td>





<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

   <?php if($row['complainant_type']=='Resident'): ?>
														    
														     	  <?php
									       
									          $resid=$row['complainant'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												      $clname=$rows['lastname'];
												    $cfname=$rows['firstname'];
												    $cmname=$rows['middlename'];
												    $csuffix=$rows['suffix'];
												     $cage=$rows['age'];
												      $ccontact=$rows['contact_no'];
												       $caddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														     
														     
														     
														      <sup style="color:green;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['complainant_type']=='Non-resident'): ?>
														     
														      <?php  $jsonobj =  $row['complainant'];

                                                                    $complainant = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $complainant->lastname.', '.$complainant->firstname.' '.$complainant->middlename.' '.$complainant->suffix;
                                                                      $cnlname=$complainant->lastname;
												    $cnfname=$complainant->firstname;
												    $cnmname=$complainant->middlename;
												    $cnsuffix=$complainant->suffix;
                                                                     
														    ?>
														    
														     <sup style="color:red;">(<?=$row['complainant_type']?>)</sup>
														    <?php endif ?>
													     

</td>


<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">


 <?php if($row['respondent_type']=='Resident'): ?>
														  	     	  <?php
									       
									          $resid=$row['respondent'];
									          
										  $squery = mysqli_query($conn,"SELECT  *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tbl_residents.birthdate)), '%Y') + 0 AS age,tbl_residents.email as emailadd FROM `tbl_residents` LEFT JOIN tblbarangay on tblbarangay.bar_no=tbl_residents.bar_no LEFT JOIN tblhousehold on tblhousehold.h_no=tbl_residents.h_no LEFT JOIN tblstreet on tblstreet.st_id=tblhousehold.st_id  WHERE tbl_residents.bar_no= $barno    AND tbl_residents.res_id=$resid");
										  while ($rows = mysqli_fetch_array($squery)){
											  echo 
												    $rows['lastname'].', '.$rows['firstname'].'  '.$rows['middlename'].' '.$rows['suffix'] ;
												    
												    
												    $rlname=$rows['lastname'];
												    $rfname=$rows['firstname'];
												    $rmname=$rows['middlename'];
												    $rsuffix=$rows['suffix'];
												    
												    $rage=$rows['age'];
												    $rcontact=$rows['contact_no'];
												     $raddress=$rows['household_no'].' '.$rows['streetname'];
										  }
									  ?>
														  
														  
														  
														    <sup style="color:green;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    
														    
														    <?php if($row['respondent_type']=='Non-resident'): ?>
														     <?php  $jsonobj =  $row['respondent'];

                                                                    $respondent = json_decode($jsonobj);
                                                                    
                                                                    
                                                                    
                                                                     echo $respondent->lastname.', '.$respondent->firstname.' '.$respondent->middlename.' '.$respondent->suffix;
                                                                     
                                                                     
                                                                            $rnlname=$respondent->lastname;
												    $rnfname=$respondent->firstname;
												    $rnmname=$respondent->middlename;
												    $rnsuffix=$respondent->suffix;
														    ?>
														    <sup style="color:red;">(<?=$row['respondent_type']?>)</sup>
														    <?php endif ?>
														    


</td>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?= $row['blotter_type'] ?> 


</td>

<td style="  border: 2px solid black;
text-align: left;
padding: 8px;">

<?= $row['status'] ?> 


</td>







             








</tr>
<?php $no++; endforeach ?>
<?php endif ?>
</tbody>

<tfoot>
    <tr>
      
         <td colspan="2" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="2" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="1" style='   padding:10px;'>Submitted to:_________________________________</td>
      
        <?php               if($state=='pwd'): ?>
           <td colspan="1" style='  padding:10px;'></td>
        <?php endif ?>
    </tr>
  </tfoot>









</table>


<?php            endif ?>











                 































                    <?php               if($state!='payments'&& $state!='Blotter' && $state!='household' && $state!='business' && $state!='building' && $state!='bclearance' && $state!='coi' && $state!='daycare' && $state!='equipment' && $state!='projects' ): ?>                    
                                          
                        <table style="color:black;  font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
						
											<thead>
                                            <tr>
                                                <th colspan="3" style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">
  

  <?php 
 if(!empty($streetname)){
 
   


    echo  'Street Name: '.$streetname;

 }else{

echo'All Residents';

 }



?>



</th>
                                               
                                               
					
           
                                                   
												
													<th colspan="4" style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Total Residents:  <?= $total?></th>

<?php               if($state=='vaccstatus' && !empty($vaccstatus)){
                                                    echo'  <th colspan="0" style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">All '.$vaccstatus.'</th>';
                                                }elseif($state=='vaccstatus'){

                                                    echo'  <th colspan="0" style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">All Status</th>';
                                                }elseif($state=='patient'){

                                                    echo'  <th colspan="0" style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;"></th>';
                                                }
                                                
                                                ?>
                                                
                                                
                                           



                                                   
                                                  
                      
												
                            
 
                                                 
                                                   
                                                  
													
                                                   
												</tr>
												<tr>
                                                <th style="  border: 2px solid black;
  text-align: center;
  padding: 8px;">RES. ID</th>
                                               
                                               
													<th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Fullname</th>
                                                    <th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">House No. & Street  </th>
                                                   
												
													<th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Birthdate</th>
                                                   
                                                   <?php   if($state=='deceased'){
                                                             echo '<th style="  border: 2px solid black;
                                                    text-align: center;
                                                    padding: 8px;">Age</th>';
                                                  }else{
                                                   echo '<th style="  border: 2px solid black;
                                                    text-align: center;
                                                    padding: 8px;">Age</th>';

                                                }  ?>
                      
												
                                                    <th style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">Gender</th>
    <?php               if($state=='pwd'){
                                                    echo'  <th style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">PWD</th>';
                                                }  ?>

<?php               if($state=='vaccstatus'){
                                                    echo'  <th style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">Vaccine Brand</th>';
                                                }  ?>
                                                <?php               if($state=='vaccstatus'){
                                                    echo'  <th style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">Vaccination Status</th>';
                                                }  ?>
                                                
                                                
                                                <?php               if($state=='patient'){
                                                    echo'  <th style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">Diagnosis</th>
                                                     <th style="  border: 2px solid black;
                                                    text-align: left;
                                                    padding: 8px;">Instructions</th>
                                                    ';
                                                }  ?>
                                              
 
                                                 
                                                   
                                                  
													
                                                   
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
                                                    <td style="  border: 2px solid black;
  text-align: center;
  padding: 8px;">Brgy-<?= $row['year'] ?>-<?= $row['res_id'] ?> </td>
                                                    
														<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">

                                                          
                                                       

                                                 <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>

                                                             
                                             

                                                        </td >

                                                        <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">
                                                           
                                                         
                                                            <?= ucwords($row['household_no'].',    '.$row['streetname']).' ' ?> 

                                                            
                                                        </td>
                                                        <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;">
                                                          
                                                            <?= $row['birthdate'] ?>
                                                          
                                                        
                                                        </td>
                                                    
														<td style="  border: 2px solid black;
  text-align: center;
  padding: 8px;"><?= $row['age'] ?></td>
                                                 <td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['gender'] ?></td>







<?php               if($state=='pwd'): ?>
<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['pwd'] ?></td>
                 	<?php endif ?>      
                    
                     <?php               if($state=='vaccstatus'): ?>
<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['vaccine_brand'] ?></td>
                 	<?php endif ?>  

                     <?php               if($state=='vaccstatus'): ?>
<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['vaccine_status'] ?></td>
                 	<?php endif ?>  
                 	
                 	
                 	     <?php               if($state=='patient'): ?>
<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['diagnosis'] ?></td>
                 	<?php endif ?> 
                 	    <?php               if($state=='patient'): ?>
<td style="  border: 2px solid black;
  text-align: left;
  padding: 8px;"><?= $row['instruction'] ?></td>
                 	<?php endif ?> 
                                        


                                                 
													
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
										  <tfoot>
    <tr>
      
         <td colspan="1" style='   padding:10px;'>printed date: <?=date("Y-m-d h:i:s")?></td>
      <td colspan="2" style='  text-align: left;   padding: 10px;'>
          <?php if($_SESSION['role']=='administrator'):?>
          Printed by:<br>
          <?=ucwords($barangayname)?>
         <?=ucwords($_SESSION['role']) ?>
           <?php endif ?>
           
            <?php if($_SESSION['role']!='administrator'):?>
           Printed by:<br>
         <?=$_SESSION['name']?>
          <div style="">
         <?=ucwords($_SESSION['role']) ?></div>
           <?php endif ?>
           
         
         </td>
      <td colspan="2" style='   padding:10px;'>Submitted to:</td>
       <td  colspan="2" style='border-top:solid black 1px;  padding:10px;'>__________________________________</td>
        <?php               if($state=='pwd'): ?>
           <td colspan="1" style='  padding:10px;'></td>
        <?php endif ?>
    </tr>
  </tfoot>
										</table>

                             <?php    endif ?>





                                      
                                       
                                    
                                </div>
                                     
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
					  <!-- Modal -->
            <div class="modal fade" id="printing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Print</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  >

										
										
										<div class="form-group">
                  Full Name
                                        <input type="text" class="form-control"  name="submitto"  >
           

                            </div>
                            <div class="form-group">
 Position
                                        <input type="text" class="form-control"  name="position" >
           

                            </div>
                              
                            
                        </div>
                    <div class="modal-footer">
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
     </div>
                 </div></div> 
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>