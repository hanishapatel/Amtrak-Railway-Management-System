<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $employeeEmail = $_POST['employeeEmail'];
    $employeeNumber = $_POST['employeeNumber'];
    $employeeUsername = $_POST['employeeUsername'];
    $employeePassword = $_POST['employeePassword'];
    $employeeAddress = $_POST['employeeAddress'];

    $updateSql = "UPDATE Employee SET
        employee_name = '$employeeName',
        email = '$employeeEmail',
        phone_number = '$employeeNumber',
        username = '$employeeUsername',
        password = '$employeePassword',
        address = '$employeeAddress'
        WHERE employee_id = $employeeId";

    if (mysqli_query($conn, $updateSql)) {
        echo '<script>alert("Employee details updated successfully"); window.location.href = "employee_dashboard.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error updating employee details"); window.location.href = "employee_dashboard.php";</script>';
        exit();
    }

    mysqli_close($conn);
}
?>
