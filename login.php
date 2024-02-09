<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $tableName = ($userType === 'passenger') ? 'Passenger' : 'Employee';

    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $specificEmployees = array('charlie', 'grace');
        if ($userType === 'employee' && in_array($username, $specificEmployees)) {
            session_start();
            $_SESSION['userType'] = $userType;
            $_SESSION['username'] = $username;

            header("Location: employee_dashboard.php");
            exit();
        } elseif ($userType === 'passenger') {

            session_start();
            $_SESSION['userType'] = $userType;
            $_SESSION['username'] = $username;

            header("Location: passenger_dashboard.php");
            exit();
        } else {

            session_start();
            $_SESSION['userType'] = $userType;
            $_SESSION['username'] = $username;

            header("Location: edit_employees_only.php");
            exit();
        }
    } else {

        echo '<script>alert("Invalid username or password"); window.location.href = "index.html";</script>';
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
