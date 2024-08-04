

<?php

include('server/serverhome.php');

$province_id =  $_POST['province_data'];

$query = "SELECT * FROM tblcity WHERE province_id = $province_id";
$result = mysqli_query($conn, $query);


$output = '<option disabled selected value="">Select City</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row['city_id'] . '">' . $row['city'] . '</option>';
}
echo $output;

?>