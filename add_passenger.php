<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $passengerName = $_POST['passengerName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO Passenger (passenger_name, email, address, phone_number, username,password) VALUES ('$passengerName', '$email', '$address', '$phone_number', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {

        header('Location: passenger_dashboard.php'); 
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: index.html");
    exit();
}
?>
