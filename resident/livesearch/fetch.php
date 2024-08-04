<?php include '../server/server.php' ?>
<?php
if(isset($_POST["limit"], $_POST["start"]))
{

 $query = "SELECT * FROM tblborrow ORDER BY bor_no DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 {
  echo '
  <h3>'.$row["bor_no"].'</h3>
  <p>'.$row["item_name"].'</p>
  <p class="text-muted" align="right">By - '.$row["purpose"].'</p>
  <hr />
  ';
 }
}

?>