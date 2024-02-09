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
            <p class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?> (Employee)</p>
            <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

    <nav class="dashboard-nav">
        <ul class="dashboard-nav-list">
            <li class="nav-item"><a href="employee_dashboard.php" class="nav-link">Add Trains</a></li>
            <li class="nav-item"><a href="manage_routes.php" class="nav-link">Add Routes</a></li>
            <li class="nav-item"><a href="manage_stations.php" class="nav-link">Add Stations</a></li>
            <!-- <li class="nav-item"><a href="manage_schedules.php" class="nav-link">Manage Schedules</a></li> -->
            <li class="nav-item"><a href="manage_employees.php" class="nav-link">Add Employees</a></li>
            <li class="nav-item"><a href="edit_employees.php" class="nav-link">Edit Employees</a></li>
        </ul>
    </nav>

    <section class="content-section">
        <h2>Add New Employee</h2>

        <form action="add_employee.php" method="post">
            <label for="employeeName">Employee Name:</label>
            <input type="text" id="employeeName" name="employeeName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" required>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required>

            <label for="role">create Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="role">Create Password:</label>
            <input type="text" id="password" name="password" required>

            <button type="submit">Add Employee</button>
        </form>
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>
</body>
</html>
