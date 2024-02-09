<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $trainName = $_POST['trainName'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];
    $routeId = $_POST['routeId']; 

    $departureTime = $_POST['departureTime'];
    $arrivalTime = $_POST['arrivalTime'];
    $dayOfWeek = $_POST['dayOfWeek'];

    $trainSql = "INSERT INTO Train (train_name, capacity, status) VALUES ('$trainName', $capacity, '$status')";
    if (mysqli_query($conn, $trainSql)) {

        $trainId = mysqli_insert_id($conn);
        $scheduleSql = "INSERT INTO Schedule (train_id, route_id, departure_time, arrival_time, day_of_week) VALUES ($trainId, $routeId, '$departureTime', '$arrivalTime', '$dayOfWeek')";

        if (mysqli_query($conn, $scheduleSql)) {
            header('Location: employee_dashboard.php'); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
