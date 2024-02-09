<?php
include('connection.php');

$trainId = $_GET['train_id'];
$newCapacity = $_GET['new_capacity'];

$updateCapacityQuery = "UPDATE train SET capacity = $newCapacity WHERE train_id = $trainId";
mysqli_query($connection, $updateCapacityQuery);

if ($newCapacity == 0) {
    $updateStatusQuery = "UPDATE train SET status = 'inactive' WHERE train_id = $trainId";
    mysqli_query($connection, $updateStatusQuery);
}

mysqli_close($connection);
?>