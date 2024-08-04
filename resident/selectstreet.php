

<?php

include('server/serverhome.php');

$barangay_id =  $_POST['barangay_data'];

$query = "SELECT * FROM tblstreet WHERE bar_no =$barangay_id ";
$result = mysqli_query($conn, $query);


$output = '<option disabled selected value="">Select Street</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row['st_id'] . '">' . $row['streetname'] . '</option>';
}
echo $output;

?>