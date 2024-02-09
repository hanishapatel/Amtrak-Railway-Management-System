
<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $departureTime = $_POST['departureTime'];
    $arrivalTime = $_POST['arrivalTime'];
    $dayOfWeek = $_POST['dayOfWeek'];

    $sql = "INSERT INTO Schedule (departure_time, arrival_time, day_of_week) VALUES ('$departureTime', '$arrivalTime', '$dayOfWeek')";

    if (mysqli_query($conn, $sql)) {

        header('Location: manage_schedules.php'); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
