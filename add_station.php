<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stationName = $_POST['stationName'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $address = $_POST['address'];

    $sql = "INSERT INTO Station (station_name, city, state, address) VALUES ('$stationName', '$city', '$state', '$address')";

    if (mysqli_query($conn, $sql)) {

        header('Location: manage_stations.php'); 
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
