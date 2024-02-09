<?php

include('connection.php');

$sql = "SELECT route_id, route_name FROM Route";
$result = mysqli_query($conn, $sql);

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['route_id']}'>{$row['route_name']}</option>";
}

mysqli_close($conn);

echo $options;
?>
