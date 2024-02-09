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
        <h2>Add New Train</h2>
        <form action="add_train.php" method="post">
            <label for="trainName">Train Name:</label>
            <input type="text" id="trainName" name="trainName" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Active">Active</option>
            </select>

            <label for="routeId">Select Route:</label>
            <select id="routeId" name="routeId" required>
                <option value="" disabled selected>Select a Route</option>

            </select>

            <label for="origin_station">Start Station:</label>
            <input type="text" id="origin_station" name="origin_station" readonly>

            <label for="destination_station">End Station:</label>
            <input type="text" id="destination_station" name="destination_station" readonly>

            <label for="departureTime">Departure Time:</label>
            <input type="time" id="departureTime" name="departureTime" required>

            <label for="arrivalTime">Arrival Time:</label>
            <input type="time" id="arrivalTime" name="arrivalTime" required>

            <label for="dayOfWeek">Day of the Week:</label>
            <select id="dayOfWeek" name="dayOfWeek" required>
                <option value="" disabled selected>Select a Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>


            <button type="submit">Add Train</button>
        </form>
    </section>

    <footer>
      <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var routeDropdown = document.getElementById('routeId');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    routeDropdown.innerHTML = xhr.responseText;
                }
            };

            xhr.open('GET', 'fetch_routes.php', true);
            xhr.send();
        });

    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var routeDropdown = document.getElementById('routeId');
            var startStationInput = document.getElementById('origin_station');
            var endStationInput = document.getElementById('destination_station');

            routeDropdown.addEventListener('change', function () {
                var selectedRouteId = routeDropdown.value;

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {

                        var response = JSON.parse(xhr.responseText);

                        startStationInput.value = response.startStation;
                        endStationInput.value = response.endStation;
                    }
                };
                xhr.open('GET', 'get_stations.php?routeId=' + selectedRouteId, true);
                xhr.send();
            });
        });
    </script>



</body>
</html>
