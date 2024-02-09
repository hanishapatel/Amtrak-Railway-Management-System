<!-- <?php
include('connection.php');


$sql = "SELECT station_id, station_name FROM Station";
$result = mysqli_query($conn, $sql);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['station_id']}'>{$row['station_name']}</option>";
}

mysqli_close($conn);

echo $options;
?> -->


<?php
include('connection.php');

$sql = "SELECT station_id, station_name FROM Station";
$result = mysqli_query($conn, $sql);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['station_name']}'>{$row['station_name']}</option>";
}

mysqli_close($conn);

echo $options;
?>
