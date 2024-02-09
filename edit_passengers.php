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
        <h1 class="header-title">Passenger Dashboard</h1>
    </header>
    <div class="welcome-container">
        <div class="welcome-content">
            <p class="welcome-text">Welcome, <?php echo $username; ?> (Passenger)</p>
            <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>
    <nav class="dashboard-nav">
            <ul class="dashboard-nav-list"> 
                <li class="nav-item"><a href="passenger_dashboard.php" class="nav-link">Book Ticket</a></li>
                <li class="nav-item"><a href="current_reservation.php" class="nav-link">Previous Reservation</a></li>
                <li class="nav-item"><a href="edit_passengers.php" class="nav-link">Edit Passenger</a></li>
            </ul>
        </nav>

    <section class="content-section">
        <h2>Edit Passenger</h2>
        <form id="editPassengerForm" action="update_passenger.php" method="post">
            <label for="passengerId">Passenger ID:</label>
            <input type="text" id="passengerId" name="passengerId" readonly>

            <label for="passengerName">Passenger Name:</label>
            <input type="text" id="passengerName" name="passengerName">

            <label for="passengerEmail">Passenger Email:</label>
            <input type="email" id="passengerEmail" name="passengerEmail">

            <label for="passengerAddress">Passenger Address:</label>
            <input type="text" id="passengerAddress" name="passengerAddress">

            <label for="passengerNumber">Passenger Number:</label>
            <input type="text" id="passengerNumber" name="passengerNumber">

            <label for="passengerUsername">Passenger Username:</label>
            <input type="text" id="passengerUsername" name="passengerUsername">

            <label for="passengerPassword">Passenger Password:</label>
            <input type="password" id="passengerPassword" name="passengerPassword">

            

            <button type="submit">Update Passenger</button>
        </form>
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editPassengerForm = document.getElementById('editPassengerForm');
            var passengerIdInput = document.getElementById('passengerId');
            var passengerNameInput = document.getElementById('passengerName');
            var passengerEmailInput = document.getElementById('passengerEmail');
            var passengerNumberInput = document.getElementById('passengerNumber');
            var passengerUsernameInput = document.getElementById('passengerUsername');
            var passengerPasswordInput = document.getElementById('passengerPassword');
            var passengerAddressInput = document.getElementById('passengerAddress');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var passengerDetails = JSON.parse(xhr.responseText);

                    passengerIdInput.value = passengerDetails.passenger_id;
                    passengerNameInput.value = passengerDetails.passenger_name;
                    passengerEmailInput.value = passengerDetails.email;
                    passengerNumberInput.value = passengerDetails.phone_number;
                    passengerUsernameInput.value = passengerDetails.username;
                    passengerPasswordInput.value = passengerDetails.password;
                    passengerAddressInput.value = passengerDetails.address;
                }
            };
            xhr.open('GET', 'fetch_passenger.php?username=' + '<?php echo $username; ?>', true);
            xhr.send();
        });
    </script>


</body>
</html>
