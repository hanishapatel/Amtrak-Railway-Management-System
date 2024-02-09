<?php
session_start();
if (!isset($_SESSION['userType']) || !isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$userType = $_SESSION['userType'];
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Railway System Employee Dashboard</title>
</head>
<body>
<header>
    <h1 class="header-title">Employee Dashboard</h1>
</header>
<div class="welcome-container">
    <div class="welcome-content">
        <p class="welcome-text">Welcome, <?php echo $username; ?> (Employee)</p>
        <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
    </div>
</div>

<nav class="dashboard-nav">
    <ul class="dashboard-nav-list">
        <li class="nav-item"><a href="employee_dashboard.php" class="nav-link">Add Trains</a></li>
        <li class="nav-item"><a href="manage_routes.php" class="nav-link">Add Routes</a></li>
        <li class="nav-item"><a href="manage_stations.php" class="nav-link">Add Stations</a></li>
        <li class="nav-item"><a href="manage_employees.php" class="nav-link">Add Employees</a></li>
        <li class="nav-item"><a href="edit_employees.php" class="nav-link">Edit Employees</a></li>
    </ul>
</nav>

<section class="content-section">
    <h2>Edit Employee</h2>
    <form id="editEmployeeForm" action="update_employee.php" method="post">
        <label for="employeeId">Employee ID:</label>
        <input type="text" id="employeeId" name="employeeId" readonly>

        <label for="employeeName">Employee Name:</label>
        <input type="text" id="employeeName" name="employeeName">

        <label for="employeeEmail">Employee Email:</label>
        <input type="email" id="employeeEmail" name="employeeEmail">

        <label for="employeeAddress">Employee Address:</label>
        <input type="text" id="employeeAddress" name="employeeAddress">

        <label for="employeeNumber">Employee Number:</label>
        <input type="text" id="employeeNumber" name="employeeNumber">

        <label for="employeeUsername">Employee Username:</label>
        <input type="text" id="employeeUsername" name="employeeUsername">

        <label for="employeePassword">Employee Password:</label>
        <input type="password" id="employeePassword" name="employeePassword">

        

        <button type="submit">Update Employee</button>
    </form>
</section>

<footer class="dashboard-footer">
    <p class="footer-text">&copy; Amtrak Railway System</p>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editEmployeeForm = document.getElementById('editEmployeeForm');
        var employeeIdInput = document.getElementById('employeeId');
        var employeeNameInput = document.getElementById('employeeName');
        var employeeEmailInput = document.getElementById('employeeEmail');
        var employeeNumberInput = document.getElementById('employeeNumber');
        var employeeUsernameInput = document.getElementById('employeeUsername');
        var employeePasswordInput = document.getElementById('employeePassword');
        var employeeAddressInput = document.getElementById('employeeAddress');

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var employeeDetails = JSON.parse(xhr.responseText);

                employeeIdInput.value = employeeDetails.employee_id;
                employeeNameInput.value = employeeDetails.employee_name;
                employeeEmailInput.value = employeeDetails.email;
                employeeNumberInput.value = employeeDetails.phone_number;
                employeeUsernameInput.value = employeeDetails.username;
                employeePasswordInput.value = employeeDetails.password;
                employeeAddressInput.value = employeeDetails.address;
            }
        };
        xhr.open('GET', 'fetch_employee.php?username=' + '<?php echo $username; ?>', true);
        xhr.send();
    });
</script>


</body>
</html>
