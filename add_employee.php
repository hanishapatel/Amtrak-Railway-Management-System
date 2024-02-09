<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $employeeName = $_POST['employeeName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO Employee (employee_name, email, address, phone_number, role,username,password) VALUES ('$employeeName', '$email', '$address', '$phone_number', '$role', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {

        header('Location: manage_employees.php'); 
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
