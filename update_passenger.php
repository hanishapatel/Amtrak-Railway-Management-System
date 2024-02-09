<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passengerId = $_POST['passengerId'];
    $passengerName = $_POST['passengerName'];
    $passengerEmail = $_POST['passengerEmail'];
    $passengerNumber = $_POST['passengerNumber'];
    $passengerUsername = $_POST['passengerUsername'];
    $passengerPassword = $_POST['passengerPassword'];
    $passengerAddress = $_POST['passengerAddress'];

    $updateSql = "UPDATE Passenger SET
        passenger_name = '$passengerName',
        email = '$passengerEmail',
        phone_number = '$passengerNumber',
        username = '$passengerUsername',
        password = '$passengerPassword',
        address = '$passengerAddress'
        WHERE passenger_id = $passengerId";

    if (mysqli_query($conn, $updateSql)) {
        echo '<script>alert("Passenger details updated successfully"); window.location.href = "passenger_dashboard.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error updating passenger details"); window.location.href = "passenger_dashboard.php";</script>';
        exit();
    }

    mysqli_close($conn);
}
?>
