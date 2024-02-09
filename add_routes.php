<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $routeName = $_POST['routeName'];
    $startStation = $_POST['startStation'];
    $endStation = $_POST['endStation'];

    $sql = "INSERT INTO Route (route_name, origin_station, destination_station) VALUES ('$routeName', '$startStation', '$endStation')";

    if (mysqli_query($conn, $sql)) {

        header('Location: manage_routes.php'); 
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
