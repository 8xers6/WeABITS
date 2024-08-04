

<?php

include('server/serverhome.php');

$city_id =  $_POST['city_data'];

$query = "SELECT * FROM tblbarangay WHERE city_id = $city_id";
$result = mysqli_query($conn, $query);


$output = '<option disabled selected value="">Select Barangay</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row['bar_no'] . '">' . $row['barangayname'] . '</option>';
}
echo $output;

?>