<!-- <?php
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
    <title>Passenger Dashboard</title>
</head>
<body>
    <header>
        <h1>Passenger Dashboard</h1>
    </header>
    <div class="welcome-container">
        <div class="welcome-content">
            <p class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?> (Passenger)</p>
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

    <section class="content-section_reserv">
        <h2>Previous Reservation</h2>
        <table border="1" id="reservationTable">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Train ID</th>
                    <th>Departure Station</th>
                    <th>Arrival Station</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Ticket Type</th>
                    <th>Price</th>
                    <th>Seat Number</th>
                    <th>Special Requests</th>
                </tr>
            </thead>

            <tbody id="reservationTableBody"></tbody>
        </table>
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM loaded');

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var reservations = JSON.parse(xhr.responseText);


                var tableBody = document.getElementById('reservationTableBody');

                if (reservations.length === 0) {
                    var emptyRow = document.createElement('tr');
                    var emptyCell = document.createElement('td');
                    emptyCell.textContent = 'No reservations found.';
                    emptyCell.colSpan = 10;
                    emptyRow.appendChild(emptyCell);
                    tableBody.appendChild(emptyRow);
                } else {
                    reservations.forEach(function (reservation) {
                        var row = document.createElement('tr');

                        ['ticket_id', 'train_id', 'departure_station', 'arrival_station', 'departure_date', 'arrival_date', 'ticket_type', 'price', 'seat_number', 'special_requests'].forEach(function (key) {
                            var cell = document.createElement('td');
                            cell.textContent = reservation[key];
                            row.appendChild(cell);
                        });

                        tableBody.appendChild(row);
                    });
                }
            }
        };

        xhr.open('GET', 'fetch_reservation.php', true);
        xhr.send();
    });


    </script>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Passenger Dashboard</title>
</head>
<body>
    <header>
        <h1>Passenger Dashboard</h1>
    </header>
    <div class="welcome-container">
        <div class="welcome-content">
            <p class="welcome-text">Welcome, <?php echo $_SESSION['username']; ?> (Passenger)</p>
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

    <section class="content-section_reserv">
        <h2 style="text-align: center;">Previous Reservation</h2>
        <table border="1" id="reservationTable">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Train ID</th>
                    <th>Departure Station</th>
                    <th>Arrival Station</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Ticket Type</th>
                    <th>Price</th>
                    <th>Seat Number</th>
                    <th>Special Requests</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="reservationTableBody"></tbody>
        </table>
    </section>

    <footer class="dashboard-footer">
        <p class="footer-text">&copy; Amtrak Railway System</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded');

            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var reservations = JSON.parse(xhr.responseText);

                    var tableBody = document.getElementById('reservationTableBody');

                    if (reservations.length === 0) {
                        var emptyRow = document.createElement('tr');
                        var emptyCell = document.createElement('td');
                        emptyCell.textContent = 'No reservations found.';
                        emptyCell.colSpan = 11; 
                        emptyRow.appendChild(emptyCell);
                        tableBody.appendChild(emptyRow);
                    } else {
                        reservations.forEach(function (reservation) {
                            var row = document.createElement('tr');

                            ['ticket_id', 'train_id', 'departure_station', 'arrival_station', 'departure_date', 'arrival_date', 'ticket_type', 'price', 'seat_number', 'special_requests'].forEach(function (key) {
                                var cell = document.createElement('td');
                                cell.textContent = reservation[key];
                                row.appendChild(cell);
                            });

                            var departureDate = new Date(reservation['departure_date']);
                            var today = new Date();

                            if (departureDate > today) {
                                var cancelButton = document.createElement('button');
                                cancelButton.textContent = 'Cancel';
                                cancelButton.addEventListener('click', function () {
                                    var confirmCancel = confirm('Are you sure you want to cancel this reservation?');

                                    if (confirmCancel) {
                                        cancelReservation(reservation['ticket_id']);
                                    }
                                });

                                var actionCell = document.createElement('td');
                                actionCell.appendChild(cancelButton);
                                row.appendChild(actionCell);
                            } else {
                                var emptyActionCell = document.createElement('td');
                                row.appendChild(emptyActionCell);
                            }

                            tableBody.appendChild(row);
                        });
                    }
                }
            };

            xhr.open('GET', 'fetch_reservation.php', true);
            xhr.send();
        });

        function cancelReservation(ticketId, row) {
        var xhrCancel = new XMLHttpRequest();
        xhrCancel.open('POST', 'cancel_reservation.php', true);
        xhrCancel.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhrCancel.onreadystatechange = function () {
            if (xhrCancel.readyState === 4 && xhrCancel.status === 200) {
                alert(xhrCancel.responseText);
                row.remove();
            }
        };

        xhrCancel.send('ticketId=' + ticketId);
    }
    </script>
</body>
</html>
