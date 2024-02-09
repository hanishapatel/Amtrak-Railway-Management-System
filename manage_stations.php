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
        <h2>Add New Station</h2>
        <form action="add_station.php" method="post">
            <label for="stationName">Station Name:</label>
            <input type="text" id="stationName" name="stationName" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <button type="submit">Add Station</button>
        </form>
    </section>


    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>
</body>
</html>
